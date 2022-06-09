<?php
    if(isset($_POST['applyAsSeller'])){

        $trader_name = trim($_POST['trader_name']);
        $phone = trim($_SESSION['trader_reg'][1]);
        $email = trim($_SESSION['trader_reg'][0]);
        $input_otp = trim($_POST['otp']); 
        $otp = $_SESSION['trader_OTP'];
        $password = trim($_POST['trader_password']);
        $repassword = trim($_POST['trader_repassword']);
        $shopname = trim($_SESSION['trader_reg'][2]);
        $address = trim($_POST['address']);
        $companyno = trim($_SESSION['trader_reg'][3]);
        $description = trim($_POST['shop-desc']);
        $logo_name = $_FILES['seller-logo']['name'];
        $logo_tem_loc = $_FILES['seller-logo']['tmp_name'];
        $logo_type=$_FILES[ 'seller-logo'][ 'type' ];
        $check = 0;
  
        if(empty($trader_name) && empty($password) && empty($repassword) && empty($address) && empty($description) && empty($input_otp) ){
            $all_error = "Please fill all the fields"; 
        }
        else{
            
            //check for Trader Full Name
            if(empty($trader_name)){
                $trader_name_error = "Full Name is required";
            }
            elseif(!(preg_match("/^[a-zA-Z ]*$/", $trader_name))){
                $trader_name_error ="Name should only contain alphabets";
            }
            else{
                $check++;
            }

            //check for OTP
            $input_otp = (int)$input_otp;
            if(empty($input_otp)){
                $otp_error = "OTP is required";
            }
            elseif(! ($input_otp == $otp)){
                $otp_error = "Invalid OTP";
            }
            else{
                $check++;
            }

            

            //check for Re Password
            if(empty($repassword)){
                $repassword_error = "Confirm Password is Required ";
            }   
            else{
                $repassword = hash('sha256', $repassword);
                $check++;
            }

            
            //check for password
            if(empty($password)){
                $password_error = "Password is Required";
            }
            elseif((strcmp(hash('sha256', $password), $repassword))){
                $password_error = "Password and Confirm-password must Match";
                $repassword_error = "Password and Confirm-password must Match";
            } 
            elseif(strlen($password) <8 ){
                $password_error = "Password must be 8 character long";
            }
            elseif(!(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@$!%*?&]){8,}/", $password))){
                $password_error = "Password should contain at least 1 uppercase, 1 number and 1 special character";
            } 
            else{
                $password = hash('sha256', $password);
                $check++;
            }

            //check for Address
            if(empty($address)){
                 $address_error = "Address is Required";
            }
            elseif(!(preg_match("/^[a-zA-Z0-9-,. ]*$/", $address))){
                $address_error = "Address should only contain alpha numeric characters and (, or -)";
            }
            else{
                $check++;
            }

            //check for logo
            $extensions=array('image/jpeg', 'image/png', 'image/jpg' );
                $check++;
        
        
            //check for Description
            if(empty($description)){
                $description_error = "Description is Required";
            }
            elseif(!(preg_match("/^[a-zA-Z0-9-,. ]*$/", $description))){
                $description_error = "Description should only contain alpha numeric characters and (, or - or .)";  
            }
            else{
                $check++;
            }



            //check for Terms
            if(!isset($_POST['termscheck'])){
                $terms_error = "You must agree to our terms and conditions.<br>";
            }
            else{
                $check++;
            }

    }

        if($check == 8){

            include('../connection/connect.php');
            $sql = "INSERT into Trader values ('', '$trader_name', '$email', '$phone', '$password', 0) ";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);

            $email = strtoupper($email);
            $sql = "SELECT * from TRADER where UPPER(trader_email) = '$email'";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $row = oci_fetch_assoc($qry);
            $trader_id = $row['TRADER_ID'];



        $sql = "INSERT into Shop values ('', '$shopname', '$description','$address', '$companyno', '$logo_name', 0, '$trader_id') ";
        $qry = oci_parse($conn, $sql);
        $execute = oci_execute($qry);
        move_uploaded_file($logo_tem_loc, "../images/$logo_name");



        if($execute){
            $_SESSION['trader'] = $trader_id;
            header('Location: registration-success.php');
            ?>
<script>
window.location.href = "registration-success.php";
</script>
<?php
        }
        else{  
?>
<script>
alert("Something went wrong")
</script>
<?php

        }
        
        }
    }

?>
