<?php 
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
   
    if(isset($_SESSION['customer-login'])){
        header('location: Customerdashboard/dashboard.php');
    }
    include('../head/head.php');

    if(isset($_POST['verify'])){
        $email = trim($_POST['email']);

        if(empty($email)){
            $err = "email is required";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "Invalid email format";
        }
        else{
            include('../connection/connect.php');
            $sql = "Select * from CUSTOMER where UPPER(customer_email) = UPPER('$email')";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $temp);

            if($count == 1){
                $_SESSION['reset_password'] = $email ;
                include('../mail/password-reset-otp.php');
                header('location: reset-otp-verify.php');
            }
            else{
                $err = "Email not found";
            }
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
               <h1>Enter Your email</h1>
               <p><?php if(isset($err)){ echo $err;} ?></p>
               
               <div class="email">
                <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Enter Your Email">
               </div>

               <div class="verify-button">
                    <input type="submit" value="verify" name="verify"/>
                </div>
                </form>

        </div><!-- End of outer-box -->
    </div><!-- End of container-outer-box -->

</body>
</html>

<?php include('../footer/footer.php') ?>