<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['submit'])){
    $email = trim($_POST['trader_email']);
    $phone = trim($_POST['trader_phone']);
    $shopname = trim($_POST['trader_shopname']);
    $companyno = trim($_POST['trader_companyno']);
    $check = 0; 
    
        //check for emails
        if(empty($email)){
            $emailError = "*Email is required";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
        else{
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $check++;
        }

        //checks for phone
        if(empty($phone)){
            $phoneError = "Phone no. is required";
        }
        elseif(!preg_match("/^[0-9]{10}$/", $phone)){
            $phoneError = "Phone Number must be 10 digit number";
        }
        else{
            $check++;
        }

        //checks for shopname 
        if(empty($shopname)){
            $nameError = "Shop Name is Required ";
        }
        elseif(!(preg_match("/^[a-zA-Z ]*$/", $shopname))){
            $nameError = "Shop name should only contain alphabets";
        }
        else{
            $check++;
        }

        //checks for company number 
        if(empty($companyno)){
            $companyno = "Company Registration Number is required";
        }
        elseif(!preg_match("/^[0-9]{8}$/", $companyno)){
            $companyNoError = "Company no. must be 8 digit number";
        }
        else{
            $check++;
        }

    
        
        if($check == 4){

            include('../connection/connect.php');

            //check for email
            $upperemail = strtoupper($email);
            $sql = "SELECT * from Trader where UPPER(TRADER_EMAIL) = '$upperemail' ";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $items);
            if($count > 0){
                $emailError = "Email is already Registered ";
            }


            //check for phone
            $sql = "SELECT * from Trader where TRADER_MOBILENO = '$phone' ";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $items);
            if($count > 0){
                $phoneError = "Phone Number is already Registered ";
            }

            //check for shop name
            $uppershopname = strtoupper($shopname);
            $sql = "SELECT * from SHOP where UPPER(SHOP_NAME) = '$uppershopname' ";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $items);
            if($count > 0){
                $nameError = "Shop Name is already Registered ";
            }

            //check for company reg number
            $sql = "SELECT * from SHOP where SHOP_REGNO = '$companyno' ";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $items);
            if($count > 0){
                $companyNoError = "Company Registration is already Registered ";
            }

            if(!isset($emailError) && !isset($phoneError) && !isset($nameError) && !isset($companyNoError)){
               
                $_SESSION['trader_reg'] = array();
                array_push($_SESSION['trader_reg'], $email, $phone, $shopname, $companyno);

                include('../mail/trader-registration-otp.php');

                


                header('Location: traderregistration.php');
                ?>
                <script>window.location.href = "traderregistration.php";</script>
                <?php
            }
        }
}

?>