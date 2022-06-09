<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

 
if(! isset($_SESSION['customer-login'])){
    header('location: ../customer-login.php');
}

    unset($_SESSION['customer-login']);
    unset($_SESSION['cart-p']);
    unset($_SESSION['p-quantity']);
    header('location: ../../homepage')
?>