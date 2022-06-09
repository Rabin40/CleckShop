<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    include('../head/head.php');

    include('../connection/connect.php');


    if(isset($_POST['payment-submit'])){


        include('../connection/connect.php');
        $day = $_POST['day'];
        $time = $_POST['time'];
        $total = $_SESSION['checkout-total'];

    
        $cart_id = $_SESSION['cart-id'];
        $sqlp = "Insert into CLECKSHOP_ORDER values (order_seq.nextval, '$day', '$time', 0, SYSDATE, $total, $cart_id)";
        $qryp = oci_parse($conn, $sqlp);
        $executep = oci_execute($qryp);

        $sqlo = "Select * from cleckshop_order ORDER BY order_id DESC";
        $qryo = oci_parse($conn, $sqlo);
        $executeo = oci_execute($qryo);
        $rowo = oci_fetch_assoc($qryo);
        $order_id = $rowo['ORDER_ID'];
        $_SESSION['order'] = $order_id;

        $pmethod = $_POST['payment'];

       if($pmethod == "paypal"){
            $_SESSION['order'] = $order_id;
            include('../payment/paypal/index.php');
            ?>
            <script> 
                    document.getElementById('paypal-submit').click();
            </script>


            <?php


       }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Hemanta Bikram Singh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/header-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <title> Checkout</title>
</head>
<body>
    <div class="container">
            <main>
                <div class="main-container">
                    <div class="cart-nav">
                        <a href=""></a><p class="other-cart">1</p>
                        <h3 ><a class="other-cart-text" href="../cart/cart.php">SHOPPING CART</a></h3>
                        <i class="fas fa-angle-right"></i>
                        <p class="main-cart">2</p>
                        <h3 ><a class="main-cart-text" href="">CHECKOUT DETAILS</a></h3>
                        <i class="fas fa-angle-right"></i>
                        <p class="other-cart">3</p>
                        <h3 ><a class="other-cart-text"> ORDER COMPLETE</a></h3>
                    </div><!--cart-nav-->

                    <div class="checkout-main" >
                        <?php
                                if(! isset($_SESSION['customer-login'])){
                                    echo "You must login to proceed to checkout";
                                }
                                elseif(! isset($_SESSION['cart-p']) ){
                                    echo "Your cart is empty";
                                }
                                elseif(count($_SESSION['cart-p']) == 0){
                                    echo "Your cart is empty";
                                }
                                else{

                                    $email = $_SESSION['customer-login']; 
                                    $sql = "Select * from customer where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
                                    $qry = oci_parse($conn, $sql);
                                    $execute = oci_execute($qry);
                                    $row = oci_fetch_assoc($qry);
                                
                        ?>


                        <div class="checkout-main-1">
                            <h3>BILLING DETAILS</h3></br></br>
                            <form action="#" class="checkout-form">
                                
                                    <label for="firstname">First Name *</label>
                                    <input type="text" name="firstname" id="firstname" class="firstname" value="<?php echo $row['CUSTOMER_FNAME']  ?>" disabled></br>
                                    <label for="lastname">Last Name *</label>
                                    <input type="text" name="firstname" id="lastname" class="firstname" value="<?php echo $row['CUSTOMER_LNAME']  ?>" disabled></br>
                                    <label for="phone-number">Phone *</label>
                                    <input type="tel" name="tel" id="phone-number" class="phone" value="<?php echo $row['CUSTOMER_MOBILENO']  ?>" disabled></br>
                                    <label for="email">Email Addrress *</label>
                                    <input type="email" name="email" id="email" class="email" value="<?php echo $row['CUSTOMER_EMAIL']  ?>" disabled></br>
                                    <label for="email">Billing Addrress *</label>
                                    <input type="text" name="address" id="address" class="address" value="<?php echo $row['CUSTOMER_ADDRESS']  ?>" disabled>
                                    
                            </form>
                        </div><!--checkout-main-1-->
                        <div class="checkout-main-2">
                            <h3>YOUR ORDER</h3>
                            <ul>
                                <li>PRODUCT</li>
                                <li>SUBTOTAL</li>
                            </ul>
                            <div class="cart-line1"></div>
                            
                            <?php

                                $email = $_SESSION['customer-login'];

                                $sql = "Select * from CUSTOMER where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
                                $qry = oci_parse($conn, $sql);
                                $execute = oci_execute($qry);
                                $row1 = oci_fetch_assoc($qry);
                                $cid =  $row1['CUSTOMER_ID'];


                                $sql = "Select * from cart where customer_id = $cid and purchased = 0";
                                $qry = oci_parse($conn, $sql);
                                $execute = oci_execute($qry);
                                $row = oci_fetch_assoc($qry);      
                                $cart_id =  $row['CART_ID'];
                                $_SESSION['cart-id'] = $cart_id;
                                                          


                                $sql1 = "Select * from cart_product where cart_id = $cart_id";
                                $qry1 = oci_parse($conn, $sql1);
                                $execute1 = oci_execute($qry1);
                                $total = 0;
                        
                                while ($row1 = oci_fetch_assoc($qry1)){
                                    $pid = $row1['PRODUCT_ID'];
                                    $sql = "Select * from product where product_id = $pid";
                                    $qry = oci_parse($conn, $sql);
                                    $execute = oci_execute($qry);
                                    $row2 = oci_fetch_assoc($qry);

                                    $product_name = $row2['PRODUCT_NAME'];
                                    $product_qty = $row1['CARTPRODUCT_QUANTITY'];
                                    $price = $row1['PRODUCT_PRICE'] * $row1['CARTPRODUCT_QUANTITY'];

                                    echo "<ul>
                                    <li><p>".$product_name." × ". $product_qty ."	</p></li>
                                    <li>£". $price."</li>
                                </ul>";

                                    $total = $total + $price;
                                    $_SESSION['checkout-total'] = $total;
                                }

                            ?>


                            <div class="cart-line2"></div>
                            <ul>
                                <li>Subtotal</li>
                                <li>£ <?php echo $total  ?></li>
                            </ul>
                            <div class="cart-line2"></div>
                            <ul>
                                <li>Total</li>
                                <li>£ <?php echo $total  ?></li>
                            </ul>
                            <div class="cart-line1"></div>
                            <h3>Collection Slot</h3>
                            <form action="" method = "POST">
                            <div class="collection">

                            <?php
                                date_default_timezone_set('Asia/Kathmandu');
                                $date = date("Y-m-d");


                                $day = date("D",strtotime($date));

                                switch($day) {

                                case "Sun":
                                $a= strtotime($date."+ 3 days");
                                $b= strtotime($date."+ 4 days");
                                $c= strtotime($date."+ 5 days");
                                break;

                                case "Mon":
                                $a= strtotime($date."+ 2 days");
                                $b= strtotime($date."+ 3 days");
                                $c= strtotime($date."+ 4 days");
                                break;

                                case "Tue":
                                $a= strtotime($date."+ 1 days");
                                $b= strtotime($date."+ 2 days");
                                $c= strtotime($date."+ 3 days");
                                break;

                                case "Wed":
                                $a= strtotime($date."+ 1 days");
                                $b= strtotime($date."+ 2 days");
                                $c= strtotime($date."+ 7 days");
                                break;

                                case "Thu":
                                $a= strtotime($date."+ 1 days");
                                $b= strtotime($date."+ 6 days");
                                $c= strtotime($date."+ 7 days");
                                break;

                                case "Fri":
                                $a= strtotime($date."+ 5 days");
                                $b= strtotime($date."+ 6 days");
                                $c= strtotime($date."+ 7 days");
                                break;

                                case "Sat":
                                $a= strtotime($date."+ 4 days");
                                $b= strtotime($date."+ 5 days");
                                $c= strtotime($date."+ 6 days");
                                break;

                                }

                                $option1 =date("l-m-d-Y", $a);
                                $option2 = date("l-m-d-Y", $b);
                                $option3 =date("l-m-d-Y", $c);

                                ?>
                                
                                <div class="collection-day">
                                    <label for="c-day">Collection Day</label><br><br>
                                    <input type="radio" name="day" value="<?php echo $option1   ?>" required><?php echo $option1   ?> <br>
                                    <input type="radio" name="day" value="<?php echo $option2   ?>" required><?php echo $option2   ?> <br>
                                    <input type="radio" name="day" value="<?php echo $option3   ?>" required><?php echo $option3   ?> 
                                </div>
                                <div class="collection-time">
                                    <label for="c-day">Collection Time</label><br><br>
                                    <input type="radio" name="time" value="10-1" required> 10am - 1pm<br>
                                    <input type="radio" name="time" value="1-4"> 1pm - 4pm<br>
                                    <input type="radio" name="time" value="4-7"> 4pm - 7pm
                                </div>
                            </div>

                            <br>
                            <h3>Payment Methods</h3>
                            <div class="payment">
                            
                                <div class="payment-method">
                                    
                                    <label>
                                        <input type="radio" name="payment" value="paypal" checked >
                                        <img  src="../images/paypal.jpg" alt="Paypal logo">
                                    </label>
                                    <label>
                                        <input type="radio" name="payment" value="stripe"  >
                                        <img src="../images/card.jpg" alt="Card logo">
                                    </label>
                                </div><!--payment-method-->
                                <button class="complete-payment" name="payment-submit">PROCEED TO PAYMENT</button>
                                </form>
                            </div><!--payment-->

                        </div><!--checkout-main-2-->

                                <?php
                                }
                                
                                ?>
                    </div><!--checkout-main-->
                    
                </div><!--main-container-->
            </main>


    </div><!--container-->


    <script src="scripts/script.js"></script>
</body>
</html>

<?php 
    include('../footer/footer.php');
?>