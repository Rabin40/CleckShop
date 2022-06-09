<?php
  
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
    $mailto =  $_SESSION['trader_reg'][0];
    $mail->addAddress("$mailto");
//    $mail->addAddress('receiver2@gfg.com', 'Name');
       
    $mail->isHTML(true);                                  
    $mail->Subject = "OTP code for registration on Cleckshop";

    $_SESSION['trader_OTP'] = random_int(100000, 999999);
    $mail->Body    = 'Your One Time Password (OTP) for trader registration is: '.$_SESSION['trader_OTP'];
    $mail->send();


    $_SESSION['trader-otp-message'] = "OTP has been send to your email !";
} catch (Exception $e) {
    $_SESSION['trader-otp-message'] = "OTP could be send. Try later !";
}
  
?>