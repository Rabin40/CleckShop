<?php 
session_start();
if(!isset($_SESSION['trader-login'])){
    header('location: ../login.php');
}
include('../../connection/connect.php');
$sql = "Select * from trader where trader_id = ". $_SESSION['trader-login'];
$qry= oci_parse($conn, $sql);
$execute = oci_execute($qry);
$trow = oci_fetch_assoc($qry);

$sql = "Select * from shop where trader_id = ". $_SESSION['trader-login'];
$qry= oci_parse($conn, $sql);
$execute = oci_execute($qry);
$srow = oci_fetch_assoc($qry);


if(isset($_POST['update-profile'])){
    $name = trim($_POST['trader_name']);
    $description = trim($_POST['shop_description']);
    $address = trim($_POST['shop_address']);
    $logo_name = $_FILES['seller-logo']['name'];
    $logo_tem_loc = $_FILES['seller-logo']['tmp_name'];
    $logo_type=$_FILES[ 'seller-logo' ][ 'type' ];
    $check = 0;


    //check for trader name
    if(empty($name)){
        $name_err = "Full Name is required";
    }
    elseif(!(preg_match("/^[a-zA-Z ]*$/", $name))){
        $name_err ="Name should only contain alphabets";
    }
    else{
        $check++;
    }

    //check for description
    if(empty($description)){
        $desc_err = " Description is Required";
    }
    elseif(!(preg_match("/^[a-zA-Z0-9-,. ]*$/", $description))){
        $desc_err = "Description should only contain alpha numeric characters and (, or - or .)";  
    }
    else{
        $check++;
    }


    //check for shop address
    if(empty($address)){
        $add_err = "Address is Required";
   }
   elseif(!(preg_match("/^[a-zA-Z0-9-,. ]*$/", $address))){
       $add_err = "Address should only contain alpha numeric characters and (, or -)";
   }
   else{
       $check++;
   }

   //check for logo
   $extensions=array( 'image/jpeg', 'image/png', 'image/jpg' );

   if(!empty($logo_name)){
        if(!(in_array( $logo_type, $extensions ))){
            $logo_err = "Logo must be .jpg or .png";
        }
        else{
            $text = ", SHOP_LOGO = '$logo_name' ";
            $check++;
        }
    }
    else{
        $text = "";
        $check++;
    }

    unset($_SESSION['success']);

    if($check == 4){
        $sql = "Update TRADER set TRADER_FULLNAME = '$name' WHERE trader_id = ".$_SESSION['trader-login'];
        $qry = oci_parse($conn, $sql);
        $execute1 = oci_execute($qry);    
        
        $sql = "Update SHOP set SHOP_DESCRIPTION = '$description', SHOP_ADDRESS = '$address'".$text."WHERE trader_id = ".$_SESSION['trader-login'];
        $qry = oci_parse($conn, $sql);
        $execute2 = oci_execute($qry);
    

        if($execute1 && $execute2){
            header("Refresh:0");
            $_SESSION['success'] = "Profile Updated !";
            move_uploaded_file($logo_tem_loc, "../../images/$logo_name");
        }
        else{
            $_SESSION['success'] = "Something Went Wrong !";
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
    <link rel="stylesheet" href="../../style/update-profile.css">
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
        <h1>Update Profile</h1>
      </div>
      <div class="container-1">
                  
          <?php if(isset($_SESSION['success'])){ echo $_SESSION['success'];} ?>
          
          <form action='' class="trader-profile-update" method= "POST" enctype="multipart/form-data"> 
            <div class="user-details">
                    <div class="input-box">    
                        <span class="details">Full Name</span>
                        <div class="error"><?php if(isset($name_err)){ echo $name_err;} ?></div>
                        <input type="text" name="trader_name" value="<?php echo $trow['TRADER_FULLNAME']?>" >
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text"  value="<?php echo $trow['TRADER_EMAIL']?>" disabled>
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text"  value="<?php echo $trow['TRADER_MOBILENO']?>" disabled>
                    </div>

                    <div class="input-box">
                        <span class="details">Shop Name</span>
                        <input type="text"  value="<?php echo $srow['SHOP_NAME']?>" disabled>
                    </div>

                    <div class="input-box">
                        <span class="details">Shop Description</span>
                        <div class="error"><?php if(isset($desc_err)){ echo $desc_err;} ?></div>
                        <input type="text" name="shop_description" value="<?php echo $srow['SHOP_DESCRIPTION']?>" >
                    </div>

                    <div class="input-box">
                        <span class="details">Shop Address</span>
                        <div class="error"><?php if(isset($add_err)){ echo $add_err;} ?></div>
                        <input type="text" name="shop_address" value="<?php echo $srow['SHOP_ADDRESS']?>" >
                    </div>

                    <div class="input-box">
                        <span class="details">Shop Registration Number</span>
                        <input type="text"  value="<?php echo $srow['SHOP_REGNO']?>" disabled>
                    </div>
                        
                    <div class="input-box">
                        <span class="details">Shop Logo</span>
                        <div class="error"><?php if(isset($logo_err)){ echo $logo_err;} ?></div>
                        <img src="../../images/<?php echo $srow['SHOP_LOGO']?>" alt="<?php echo $srow['SHOP_LOGO']?>" width = 150px><br><br>
                        <span>Upload New logo:  </span>
                        <input type="file" name="seller-logo">
                    </div>
                </div>  
                <div class="button1" style="width: 169px; background: none; color: black;">
                    <input type="submit" name="update-profile" value="Update" >
                </div>      
           
        </form>
      </div><!-----End of the container body-->
   </section>
   </div>
  </body>
</html>
