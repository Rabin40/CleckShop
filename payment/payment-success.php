<?php
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
    
    if(!isset($_SESSION['order'])){
        header('Location: ../homepage');
    }
    else{
        unset( $_SESSION['trader_reg']);
        unset($_SESSION['trader_OTP']);
    }

    include('../head/head.php');

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
            <h1>Payment Successful !</h1>
            <p>Your order has been received and it is being processed. </p>

            <div class="back2home">
                <a  href="../customer/Customerdashboard/orders.php">View Order</a>
            </div><!-- End of back2home -->

        </div><!-- End of outer-box -->
    </div><!-- End of container-outer-box -->

    <?php
        unset($_SESSION['order']);
    ?>

</body>
</html>




<?php

unset($_SESSION['trader']);
?>