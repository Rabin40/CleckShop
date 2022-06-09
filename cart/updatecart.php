<?php
    session_start();
    if(isset($_POST['update_cart'])){

    
        
        $totalqty = array_sum($_SESSION['p-quantity']);

//

                $j=0;
                $totalqty = 0;
                foreach($_SESSION['cart-p'] as $product_id){
                    $new_qty = $_POST['update_qty_'.$j];
                    $totalqty = $totalqty + $new_qty;
                    $j++;
                }

                if($totalqty <=20){
                    $j=0;
                    foreach($_SESSION['cart-p'] as $product_id){

                        $new_qty = $_POST['update_qty_'.$j];
                        $_SESSION['p-quantity'][$j] = $new_qty;
                        $j++;
                }
            }else{
                $_SESSION['cartmessage'] = "There can be max 20 qty in a cart" ;
            }



        
    }


    $dk = 0;
    for($dk=0; $dk < count($_SESSION['cart-p']); $dk++){
        if(isset($_POST['delete_qty_'.$dk])){
            unset($_SESSION['cart-p'][$dk]);
            $_SESSION['cart-p'] = array_values($_SESSION['cart-p']);
            unset($_SESSION['p-quantity'][$dk]);
            $_SESSION['p-quantity'] = array_values($_SESSION['cart-p']);
            
        }
    }
                 include('../connection/connect.php');
                 $email =  $_SESSION['customer-login'];
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


                //deleting old cart_products from database
                $sql ="Delete from cart_product where cart_id = $cart_id";
                $qry = oci_parse($conn, $sql);
                $execute = oci_execute($qry);


                $p =0 ;
                foreach($_SESSION['cart-p'] as $pid){

                    $a = "Select * from product where product_id = $pid";
                    $b = oci_parse($conn, $a);
                    $c = oci_execute($b);
                    $rowa = oci_fetch_assoc($b);

                    if(empty($rowa['DISCOUNT_PRICE'])){
                        $proprice = $rowa['PRODUCT_PRICE']; 
                    }
                    else{
                        $proprice = $rowa['DISCOUNT_PRICE']; 
                    }

                    


                    $pro_quantity = $_SESSION['p-quantity'][$p]; 
                    $sql = "Insert Into cart_product values ('', $cart_id, $pid, $pro_quantity, $proprice )";   //creating new cart for non purchased cart
                    $qry = oci_parse($conn, $sql);
                    $execute = oci_execute($qry);
                    $p++;
 
                }







   header('location: cart.php');
?>