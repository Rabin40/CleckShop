<?php 
session_start();
if(!isset($_SESSION['trader-login'])){
    header('location: ../login.php');
}

if(isset($_POST['resetpassword'])){

    $old_password = trim($_POST['old-password']);
    $new_password = trim($_POST['new-password']);
    $c_password = trim($_POST['c-password']);

    include('../../connection/connect.php');
    $sql = "select * from trader where trader_id =".$_SESSION['trader-login'];
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    $row = oci_fetch_assoc($qry);
    $password = strtoupper($row['TRADER_PASSWORD']);
    $check = 0;

    $upper_old_password = strtoupper(hash('sha256', $old_password));
    $upper_new_password = strtoupper(hash('sha256', $new_password));

    
    if(empty($old_password)){
        $old_password_err = "Password is Required";
    }
    elseif(strcmp($password, $upper_old_password)){
        $old_password_err = "Incorrect Password";
    }
    elseif(!strcmp($password, $upper_new_password)){
        $old_password_err = "New Password cannot be your old password";
    }
    else{
        $check++;
    }


    if(empty($c_password)){
        $c_password_err = "Confirm Password is Required";
    }
    else{
        $c_password = hash('sha256', $c_password);
        $check++;
    }


    if(empty($new_password)){
        $new_password_err = "New Password is Required";
    }
    elseif((strcmp(hash('sha256', $new_password), $c_password))){
        $new_password_err = "New password must match with confirm Password";
    }
    elseif(strlen($new_password) <8 ){
        $new_password_err = "Password must be 8 character long";
    }
    elseif(!(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@$!%*?&]){8,}/", $new_password))){
        $new_password_err = "Password should contain at least 1 uppercase, 1 number and 1 special character";
    } 
    else{
        $password = hash('sha256', $new_password);
        $check++;
    }

    if($check == 3){

        $sql = "UPDATE TRADER set TRADER_PASSWORD = '$password' where trader_id = ".$_SESSION['trader-login'];
        $qry = oci_parse($conn, $sql);
        $execute = oci_execute($qry);

        if($execute){
            $message = "Password has been reset";
        }
        else{
            $message = "Something went wrong !";
        }
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
        <h1>Reset Password</h1>
      </div>
      <div class="content-reset">     
        <?php  if(isset($message)){ echo $message;} ?>
        <form class="trader-reset" action="" method="POST">
            <label class="oldpass">Old Password</label>
            <div class= error><?php if(isset($old_password_err)) echo $old_password_err ?></div>
            <input class="old" type="password" name="old-password">
            <br><br>

            <label class="newpass">New Password</label>
            <div class=error><?php if(isset($new_password_err)) echo $new_password_err ?></div>
            <input class="new" type="password" name="new-password">
            <br><br>


            <label class="changepass">Confirm Password</label>
            <div class=error><?php if(isset($c_password_err)) echo $c_password_err ?></div>
            <input class="change" type="password" name="c-password">
            <br><br>

            <div class="submit">
                <input type="submit" name="resetpassword" value="Reset Password" class="button">
            </div>
        </form>

      </div>
   </section>
   </div>
  </body>
</html>
