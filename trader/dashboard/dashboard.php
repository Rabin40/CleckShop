<?php 
session_start();
if(!isset($_SESSION['trader-login'])){
    header('location: ../login.php');
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
    <header><h2>CLECKSHOP</h2></header>
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
        <h1>Dashboard</h1>
      </div>
      <div class="content-body">     
        <div class="dash-content">
            <button class="button1" type="button"><a href ="myprofile.php">My Profile</a></button>
            <button class="button2" type="button"><a href ="orders.php">Orders</a></button>
            <button class="button3" type="button"><a href ="payments.php">Payments</a></button>

          <div class="dash">
                <button class="button4" type="button"><a href ="myprofile.php">Change Password</a></button>
                <button class="button4" type="button"><a href ="orders.php">Questions</a></button>
                <button class="button4" type="button"><a href ="payments.php">Reviews</a></button>
          </div>
        </div>
      </div>
   </section>
   </div>
  </body>
</html>
