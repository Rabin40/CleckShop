<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 if(! isset($_SESSION['verify-customer'])){
    header('location: ../homepage');
 }

include('../head/head.php') ;



 if(isset($_POST['verify'])){
    $enteredotp = $_POST['otp'];
    $enteredotp = (int)$enteredotp;
    $otp = $_SESSION['customer_OTP'];

    if($enteredotp == $otp){
        $email = $_SESSION['verify-customer'];
        
        include('../connection/connect.php');
        $sql = "Update CUSTOMER set customer_status = 1 where UPPER(customer_email) = UPPER('$email')" ;
        $qry = oci_parse($conn, $sql);
        $execute = oci_execute($qry);

        if($execute){
            $_SESSION['customer-login'] =  $email;
            unset( $_SESSION['verify-customer']);
          //  header('location: Customerdashboard/dashboard.php');
            ?>
<script>
window.location.href = "Customerdashboard/dashboard.php";
</script>
<?php
        }
        else{
            $_SESSION['customer-otp-message'] = "Something went wrong. Please try later !";
        }

    }
    else{
        $_SESSION['customer-otp-message'] = "Incorrect OTP !";
    }


 }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forget Password - Cleckshop</title>
        <link href="style/forget.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-outer-box">
            <div class="outer-box">
                <form class="login-form" action="" method="POST">
                    <h1>Verify your Email</h1>
                    <p><?php if(isset($_SESSION['customer-otp-message'])){ echo $_SESSION['customer-otp-message'];} ?>
                    </p>

                    <div class="email">
                        <i class="fas fa-user"></i>
                        <input type="text" name="otp" placeholder="Enter OTP">
                        <a href="../mail/customer-email-resend-otp.php">Resend OTP</a>
                    </div>

                    <div class="verify-button">
                        <input type="submit" value="verify" name="verify" />
                    </div>
                </form>

            </div><!-- End of outer-box -->
        </div><!-- End of container-outer-box -->

    </body>

</html>

<?php include('../footer/footer.php') ?>
