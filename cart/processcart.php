<?php
    session_start();
    if(isset($_POST['addsubmit'])){
        $quantity = $_POST['p-quantity'];

            if(! isset($_SESSION['cart-p'])){
                $_SESSION['cart-p'] = array();
                $_SESSION['p-quantity'] = array();
            }

            $totalqty = 0;
            $totalqty = array_sum($_SESSION['p-quantity']) + $quantity;
            if($totalqty <=20){

            $pindex = array_search($prid, $_SESSION['cart-p']);
            if($pindex !== false){
                $_SESSION['p-quantity'][$pindex] =  $_SESSION['p-quantity'][$pindex] + $quantity;
                $cartmessage =  "Cart quantity updated !";
            }
            else{
                array_push($_SESSION['cart-p'], $prid);
                array_push($_SESSION['p-quantity'], $quantity);
                $cartmessage =  "1 product has been added to cart";
            }

        }
        else{
            $cartmessage =  "There can be max 20 qty in a cart";
        }

            if(isset($_SESSION['customer-login'])){

                include('../connection/connect.php');
                 $email =  $_SESSION['customer-login'];
                $sql = "Select * from CUSTOMER where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
                $qry = oci_parse($conn, $sql);
                $execute = oci_execute($qry);
                $row1 = oci_fetch_assoc($qry);
                $cid =  $row1['CUSTOMER_ID'];


                //checked for non purchased card
                
                $sql = "Select * from cart where customer_id = $cid and purchased = 0";
                $qry = oci_parse($conn, $sql);
                $execute = oci_execute($qry);
                $count = oci_fetch_all($qry, $temp);
                if($count == 0){
                    $sql = "Insert Into cart values ('', $cid, 0)";   //creating new cart for non purchased cart
                    $qry = oci_parse($conn, $sql);
                    $execute = oci_execute($qry);
                }


                $sql = "Select * from cart where customer_id = $cid and purchased = 0";
                $qry = oci_parse($conn, $sql);
                $execute = oci_execute($qry);
                $row = oci_fetch_assoc($qry);
                $cart_id =  $row['CART_ID'];
                $_SESSION['cart-id'] = $cart_id;


                //deleting old cart_products from database
                $sql ="Delete from cart_product where cart_id = $cart_id";
                $qry = oci_parse($conn, $sql);
                $execute = oci_execute($qry);

                $p =0 ;
                foreach($_SESSION['cart-p'] as $paaid){

                    $a = "Select * from product where product_id = $paaid";
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
                    $sql = "Insert Into cart_product values ('', $cart_id, $paaid, $pro_quantity, $proprice )";   //creating new cart for non purchased cart
                    $qry = oci_parse($conn, $sql);
                    $execute = oci_execute($qry);
                    $p++;
 
                }

            }

    }















?>