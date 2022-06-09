<?php
    session_start();

/*
    if(isset($_SESSION['customer-login'])){
        header('location: Customerdashboard/dashboard.php');
    }

*/
    

    if(isset($_SESSION['customer-login'])){
        header('location: Customerdashboard/dashboard.php');
    }

    include('../head/head.php');

    if(isset($_POST['login'])){

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(empty($email) && empty($password)){
            $error = "Email and Password are required";
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        }

        elseif(!empty($email) && empty($password)){
            $error = " Enter password";
        }
        else{
            $password = hash('sha256', $password);

            include('../connection/connect.php');
            $sql = "Select * from customer WHERE UPPER(customer_email) = UPPER('$email') AND UPPER(customer_password) = UPPER('$password')";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $temp);

            $execute = oci_execute($qry);
            if($count == 1){
                $row = oci_fetch_assoc($qry);
                if($row['CUSTOMER_STATUS'] == 0){
                    $_SESSION['verify-customer'] = $email;
                    include('../mail/customer-email-verify-otp.php');
                    header('location: otp-verify.php');
                } 
                else{
                    $_SESSION['customer-login'] = $row['CUSTOMER_EMAIL'];
                    $_SESSION['customer-login-1'] = $row['CUSTOMER_ID'];
                    $cid = $row['CUSTOMER_ID'];

                    $sql = "SELECT * from CART_PRODUCT where cart_id =(SELECT cart_id from cart where customer_id = $cid and PURCHASED = 0)";
                    $qry = oci_parse($conn, $sql);
                    $execute = oci_execute($qry);
                    $count = oci_fetch_all($qry, $temp);

                    if( $count != 0){
                        $execute = oci_execute($qry);

                                unset($_SESSION['cart-p']);
                                unset($_SESSION['p-quantity']);
                                $_SESSION['cart-p'] = array();
                                $_SESSION['p-quantity'] = array();

                                while($row1 = oci_fetch_assoc($qry)){
                                    array_push($_SESSION['cart-p'], $row1['PRODUCT_ID']);
                                    array_push($_SESSION['p-quantity'], $row1['CARTPRODUCT_QUANTITY']);
                                }

                    }
                    else{
                        if(isset($_SESSION['cart-p'])){
                            if(count($_SESSION['cart-p']) != 0){

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
                }
            }
        }

                    header('Location: Customerdashboard/dashboard.php');
                    ?>
<script>
location.reload()
</script>

<?php



                }
            }
            else{
                $error = "User not found";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../style/login.css" />

        <title>CleckShop - Customer Login</title>
    </head>

    <body>
        <div class="main-customer-login">
            <div class="ask-login">
                <p>New Customer?<a href="customer-registration.php"> Register Here</a></p>
                <p>Are you a Seller?<a href="../trader/login.php"> Login Here</a></p>
            </div>
            <div class="container">
                <div class="form-container">
                    <h1 class="login-header">LOGIN</h1>
                    <form class="login-form" action="" method="POST">
                        <div class="error"> <?php if(isset($error)){ echo $error; }?></div>
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="Enter Email"
                            value="<?php  if(isset($email)){ echo $email; } ?>" />
                        <br />


                        <i class="fas fa-key"></i>
                        <input type="password" name="password" placeholder="Enter Password" /><a
                            href="forgetpassword.php">Forgot Password ?</a>
                        <br /><br />
                        <div class="login-button">
                            <input type="submit" value="Login" name="login" />
                        </div>
                    </form>
                </div>
                <!--form-container-->

                <div class="img-container">
                    <img src="../images/trader-login-banner.jpg" class="img-fluid" alt="">
                </div>
                <!--img-container-->

            </div>
            <!--container-->
        </div>
    </body>

</html>

<?php
    include('../footer/footer.php');
?>
