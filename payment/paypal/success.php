<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
}


if(! isset($_GET['PayerID'])){
    header('location: ../../homepage');
}

if(! isset($_SESSION['order'])){
    header('location: ../../homepage');
}

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
    $ref = $_GET['PayerID'];

    include('../../connection/connect.php');

    $order_id = $_SESSION['order'];

    $sql = "INSERT INTO PAYMENT VALUES (payment_seq.nextval, 1, 'paypal', '$ref', $order_id)";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);

    $sql = "Update CLECKSHOP_ORDER set ORDER_STATUS	= 1 where ORDER_ID = $order_id";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);

    $cart_id = $_SESSION['cart-id'];
    $sql = "Update Cart set Purchased = 1 where cart_id = $cart_id";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);

    unset($_SESSION['cart-p']);
    unset($_SESSION['p-quantity']);

    $sql = "Select * from cart_product where cart_id = $cart_id";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    while($row = oci_fetch_assoc($qry)){
        $pid = $row['PRODUCT_ID'];
        $qty = $row['CARTPRODUCT_QUANTITY'];

        $sql1 = "Select  * from product where product_id = $pid";
        $qry1 = oci_parse($conn, $sql1);
        $execute = oci_execute($qry1);
        $row1 = oci_fetch_assoc($qry1);
        $oldqty = $row1['PRODUCT_QUANTITY'];

        $newqty = $oldqty - $qty;

        $sql2 = "Update PRODUCT set PRODUCT_QUANTITY = $newqty where PRODUCT_ID = $pid";
        $qry2 = oci_parse($conn, $sql);
        $execute2 = oci_execute($qry2);
        
    }

    header('location: ../payment-success.php');


?>