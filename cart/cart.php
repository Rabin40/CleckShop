<?php
    include('../head/head.php');

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
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
    <title>Gift Shop - Cart</title>
</head>
<body>
    <div class="container">
            <main>
                <div class="main-container">
                    <div class="cart-nav">
                        <a href=""></a><p class="main-cart">1</p>
                        <h3 ><a class="main-cart-text" href="">SHOPPING CART</a></h3>
                        <i class="fas fa-angle-right"></i>
                        <p class="other-cart">2</p>
                        <h3 ><a class="other-cart-text" href="../checkout/checkout.php">CHECKOUT DETAILS</a></h3>
                        <i class="fas fa-angle-right"></i>
                        <p class="other-cart">3</p>
                        <h3 ><a class="other-cart-text" > ORDER COMPLETE</a></h3>
                    </div><!--cart-nav-->


                    
                    <div class="cart-main">
                        <div class="cart-main-1">
                        <div class="error"><?php if(isset($_SESSION['cartmessage'])){ echo $_SESSION['cartmessage'];   } ?> </div>


                        <?php
                            unset($_SESSION['cartmessage']);
                            if(! isset($_SESSION['cart-p']) ){
                                echo "Your cart is empty";
                            }
                            elseif(count($_SESSION['cart-p']) == 0){
                                echo "Your cart is empty";
                            }
                            else{
                    ?>
                            <ul>
                                <li>PRODUCT</li>
                                <li class="unused-li"></li>
                                <li>PRICE</li>
                                <li>QTY</li>
                                <li>SUBTOTAL</li>
                            </ul>
                            <div class="cart-line1"></div>
                            
                            <?php


                            include('../connection/connect.php');
                            $i = 0;
                            $subtotal_all = 0;
                            foreach($_SESSION['cart-p'] as $productid){
                                $sql = "SELECT * from PRODUCT where Product_id = $productid";
                                $qry = oci_parse($conn, $sql);
                                $execute = oci_execute($qry);

                                $row = oci_fetch_assoc($qry);

                                $product_image = $row['PRODUCT_IMAGE1'];
                                $product_name = $row['PRODUCT_NAME'];
                                if(empty($row['DISCOUNT_PRICE'])){
                                    $product_price = $row['PRODUCT_PRICE']; 
                                }
                                else{
                                    $product_price = $row['DISCOUNT_PRICE']; 
                                }
                                $product_quantity = $_SESSION['p-quantity'][$i];
                                $subtotal = $product_quantity*$product_price;
                                $subtotal_all = $subtotal_all + $subtotal;
                                if(! isset($_SESSION['update-qty'])){
                                    $_SESSION['update-qty'] = array();
                                }
                                array_push($_SESSION['update-qty'], 'update-qty-'.$i);
                            ?>
                            <form action="updatecart.php" method = POST>
                            <ul class="cart-product">
                                <li class="cart-product-list">
                                    <input type="submit" name="delete_qty_<?php echo$i ?>" id="delete_qty_btn_<?php echo$i ?> " value="x" style="height:25px;width:25px;border-radius:50px;cursor:pointer">
                                    <img src="../images/<?php echo $product_image ?>" alt="<?php echo $product_image ?>">
                                    <p><?php echo $product_name ?></p>
                                </li>
                                <li class="unused-li"></li>
                                <li>£ <?php echo $product_price ?></li>
                                <li>
                                        <input id="cart-quantity" class="quantity" name="update_qty_<?php echo$i ?>" type="number" min="1" value="<?php echo $product_quantity  ?>" max="<?php echo $row['PRODUCT_QUANTITY'] ?>">
                                </li>
                                <li class="subtotal-container">£ <p class="subtotal"><?php echo $subtotal  ?></p></li>
                            </ul>
                            <?php
                            $i++;
                            }
                            ?>

                            

                            <div class="cart-line2"></div>

                            <div class="cart-buttons">
                                <a href="../homepage"  class="continue-shopping">Continue Shopping</a>
                                
                                <input type="submit" name="update_cart"  class="update-cart" value="Update Cart">
                            </div><!--cart-buttons-->
                            </form>
                        </div><!--cart-main-1-->

                        <div class="cart-main-2">
                            <p>CART TOTALS</p>
                            <div class="cart-line1"></div>

                            <ul>
                                <li>Subtotal</li>
                                <li class="subtotal-container"><p class="subtotal-2">£ <?php  echo $subtotal_all  ?></p></li>
                            </ul>
                            <div class="cart-line2"></div>

                            <ul>
                                <li>Total</li>
                                <li class="coupon-message"></li>
                                <li class="subtotal-container">£ <p class="subtotal-3"><?php  echo $subtotal_all  ?></p></li>
                            </ul>
                            <div class="cart-line1"></div>

                            <button class="proceed-to-checkout" onclick="window.location.href='../checkout/checkout.php'"  >Proceed to Checkout</button>


                            <p>COUPON</p>
                            <div class="cart-line1"></div>
                            <input type="text" class="coupon-code" name="coupon" placeholder="COUPON CODE" >
                            <br>
                            <button onclick="return applyCouponCode()"  class="coupon-submit"  >APPLY COUPON </button>                             
                        

                        </div><!--cart-main-2-->
                    </div><!--cart-main-->

                            <?php
                            }
                            ?>

                </div><!--main-container-->
            </main>

    </div><!--container-->


    <script>

        for(i=0; i<20; i++){
            
            document.getElementById("myBtn").addEventListener("click", displayDate);

            button.click();

        }


    </script>
</body>
</html>