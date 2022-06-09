<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
    include('../head/head.php');
    if(!isset($_SESSION['trader'])){
        header('Location: sell-on-cleckshop.php');
    }
    else{
        unset( $_SESSION['trader_reg']);
        unset($_SESSION['trader_OTP']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../style/trader-style.css">
</head>
<body>
    <div class="container-outer-box">
        <div class="outer-box">
            <h1>Thank you!</h1>
            <p>Your request has been sent and is under verification</p>

            <div class="back2home">
                <a  href="sell-on-cleckshop.php">Go to Home Page</a>
            </div><!-- End of back2home -->

        </div><!-- End of outer-box -->
    </div><!-- End of container-outer-box -->

</body>
</html>




<?php

unset($_SESSION['trader']);
?>