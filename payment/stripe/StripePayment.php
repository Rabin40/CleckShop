<?php
namespace PhpPot\Service;

require_once 'vendor/stripe/autoload.php';

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class StripePayment
{

    private $apiKey;

    private $stripeService;

    public function __construct()
    {
        require_once "config.php";
        $this->apiKey = STRIPE_SECRET_KEY;
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->apiKey);
    }

    public function addCustomer($customerDetailsAry)
    {
        
        $customer = new Customer();
        
        $customerDetails = $customer->create($customerDetailsAry);
        
        return $customerDetails;
    }

    public function chargeAmountFromCard($cardDetails)
    {
        $customerDetailsAry = array(
            'email' => $cardDetails['email'],
            'source' => $cardDetails['token']
        );
        $customerResult = $this->addCustomer($customerDetailsAry);
        $charge = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $cardDetails['amount']*100 ,
            'currency' => $cardDetails['currency_code'],
            'description' => $cardDetails['item_name'],
            'metadata' => array(
                'order_id' => $cardDetails['item_number']
            )
        );
        $result = $charge->create($cardDetailsAry);

        return $result->jsonSerialize();
    }
}




use \PhpPot\Service\StripePayment;

if (!empty($_POST["token"])) {
    require_once 'StripePayment.php';
    $stripePayment = new StripePayment();
    
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);
    
    require_once "DBController.php";
    $dbController = new DBController();
    
    $amount = $stripeResponse["amount"] /100;
    
    $param_type = 'ssdssss';
    $param_value_array = array(
        $_POST['email'],
        $_POST['item_number'],
        $amount,
        $stripeResponse["currency"],
        $stripeResponse["balance_transaction"],
        $stripeResponse["status"],
        json_encode($stripeResponse)
    );
    $query = "INSERT INTO tbl_payment (email, item_number, amount, currency_code, txn_id, payment_status, payment_response) values (?, ?, ?, ?, ?, ?, ?)";
    $id = $dbController->insert($query, $param_type, $param_value_array);
    
    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
       $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
    }
}