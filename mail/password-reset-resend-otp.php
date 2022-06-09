<?php
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  
$mail = new PHPMailer(true);
  
try {
    //$mail->SMTPDebug = 2;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com ;';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'cleckshop@gmail.com';                 
    $mail->Password   = 'Cleckshop12@';                        
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 587;  
  
    $mail->setFrom('cleckshop@gmail.com', 'Cleckshop');      
    $mailto =  $_SESSION['reset_password'];
    $mail->addAddress("$mailto");
//    $mail->addAddress('receiver2@gfg.com', 'Name');
       
    $mail->isHTML(true);                                  
    $mail->Subject = "OTP code to reset password on Cleckshop";

    $_SESSION['reset_OTP'] = random_int(100000, 999999);
    $mail->Body    = 'Your One Time Password (OTP) to reset password is: '.$_SESSION['reset_OTP'];
    $mail->send();


    $_SESSION['reset-otp-message'] = "OTP has been sent to your email !";
} catch (Exception $e) {
    $_SESSION['reset-otp-message'] = "OTP could be sent Try later !";
}
header('Location: ../customer/reset-otp-verify.php');

?>