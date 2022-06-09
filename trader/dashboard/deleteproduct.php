<?php 
session_start();
if(!isset($_SESSION['trader-login'])){
    header('location: ../login.php');
}
include ('insertProduct.php');

if(isset($_GET['id'])){
    $pid = $_GET['id'];
}
else{
    header('Location: productrecord.php');
}
if(isset($_POST['updateproduct'])){
    header('location: updateproduct.php?id='.$pid);
}
if(isset($_POST['deleteproduct'])){
    $sql = "DELETE FROM product WHERE product_id = $pid";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);

    if($execute){
        $_SESSION['updelsuccess'] = "1 row deleted";
        header('location: productrecord.php');
    }
    else{
        $err = "Something went wrong. Could not delete Product";
    }

}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sider Menu Bar CSS</title>
    <link rel="stylesheet" href="../../style/trader-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

  </head>
  <body>
    <div class="container">
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
    <header><h2>SHOP NAME</h2></header>
    <ul>
     <li><a href="dashboard.php"><i class="fas fa-qrcode"></i>Dashboard</a></li>
     <li><a href="productrecord.php"><i class="fas fa-shopping-bag"></i>Product</a></li>
     <li><a href="addproduct.php"><i class="fas fa-cart-plus"></i>Add Product</a></li>
     <li><a href="updateprofile.php"><i class="fas fa-user-circle"></i>Update Profile</a></li>
     <li><a href="resetpassword.php"><i class="fas fa-lock"></i>Reset Password</a></li>
     <li><a href="http://127.0.0.1:8080/apex/"><i class="fas fa-circle-notch"></i>Oracle Dashboard</a></li>
     <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>
   </div>
   <section>
      <div class="header">
        <a href=""><img src="../../images/logo.png" alt=""></a>
      </div>
      <div class="trader-info">
        <p>
            <?php
                include('../../connection/connect.php');
                $tid =  $_SESSION['trader-login'];
                $sql = "select * from trader where trader_id = '$tid'";
                $qry = oci_parse($conn, $sql);
                $execute = oci_execute($qry);
                $row = oci_fetch_assoc($qry);

                $tname = $row['TRADER_FULLNAME'];
                echo "Hi, $tname";
            ?>
        </p>
        <h1>Delete Product</h1>
      </div>
      
      <div class="content-body">
            <?php
                if(isset($err)){echo $err;}
            $sql = "SELECT * FROM Product where product_id = $pid";
            $query = oci_parse($conn,$sql);  
            $execute = oci_execute($query);
            $count = oci_fetch_all($query, $temp);
            if($count == 0){
                header('location: productrecord.php');
            }
            $execute = oci_execute($query);
            $row = oci_fetch_assoc($query);
            ?>
            <p>You are about to Delete Following Product: </p><br>
            <ul class="delete-view">
                <li>Product Name: <?php echo $row['PRODUCT_NAME'] ?></li>
                <li>Product Price: <?php echo $row['PRODUCT_PRICE'] ?></li>
                <li>Discount Price <?php echo $row['DISCOUNT_PRICE'] ?></li>   
                <li>Short Description: <?php echo $row['PRODUCT_SHORTDESC'] ?></li>
                <li>Product Description: <?php echo $row['PRODUCT_DESCRIPTION'] ?></li>
                <br>
                <form action="" method="POST">

                    <input type="submit" name='updateproduct' value="Update Product">
                    <input type="submit" name='deleteproduct' value="Delete Product">
                </form>
            </ul>


      </div>
   </section>
   </div>
  </body>
</html>
