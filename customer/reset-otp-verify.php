<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 if(! isset($_SESSION['reset_password'])){
    header('location: ../homepage');
 }

include('../head/head.php') ;



 if(isset($_POST['verify'])){
    $enteredotp = $_POST['otp'];
    $enteredotp = (int)$enteredotp;
    $otp = $_SESSION['reset_OTP'];

    if($enteredotp == $otp){
        $_SESSION['final-password-reset'] =   $_SESSION['reset_password'];
        header('location: setpassword.php');
    }
    else{
        $_SESSION['reset-otp-message'] = "Incorrect OTP !";
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
               <p><?php if(isset($_SESSION['reset-otp-message'])){ echo $_SESSION['reset-otp-message'];} ?></p>
               
               <div class="email">
                <i class="fas fa-user"></i>
                    <input type="text" name="otp" placeholder="Enter OTP">        
                    <a href="../mail/password-reset-resend-otp.php">Resend OTP</a>
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