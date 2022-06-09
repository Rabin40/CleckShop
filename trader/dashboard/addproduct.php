<?php 
session_start();
if(!isset($_SESSION['trader-login'])){
    header('location: ../login.php');
}
include ('insertProduct.php');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sider Menu Bar CSS</title>
    <link rel="stylesheet" href="../../style/trader-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="../../style/insert.css">
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
        <h1>Add Product</h1>
      </div>
      
      <div class="container-1">
            <div class="content">
                <form class="insert-form" method="POST" action="" enctype="multipart/form-data">
                    <div class="product-details">
                        <div class="input-box">
                            <label>Product Name</label><br>
                            <div class="error">
                                <?php if(isset($pName_err)){echo $pName_err . "<br/>";}?>
                            </div>
                            <input type="text" name="productName"
                                value="<?php if(isset($_POST['productName'])){echo $_POST['productName'];}?>" />
                        </div><!-- End of input box -->

                        <div class="input-box">
                            <label>Quantity</label><br>
                            <div class="error">
                                <?php if(isset($pQuantity_err)){echo $pQuantity_err. "<br/>";}?>
                            </div>
                            <input type="text" name="quantity"
                                value="<?php if(isset($_POST['quantity'])){ echo $_POST['quantity'];  } ?>">
                        </div>

                        <div class="input-box">
                            <label>Product Price</label><br>
                            <div class="error">
                                <?php if(isset($pPrice_err)){echo $pPrice_err. "<br/>";}?>
                            </div>
                            <input type="text" name="productPrice"
                                value="<?php if(isset($_POST['productPrice'])){ echo $_POST['productPrice'];  } ?>">
                        </div>

                        <div class="input-box">
                            <label>Discount Price</label><br>
                            <div class="error">
                                <?php if(isset($disPrice_err)){echo $disPrice_err. "<br/>";}?>
                            </div>
                            <input type="text" name="discountPrice"
                                value="<?php if(isset($_POST['discountPrice'])){ echo $_POST['discountPrice'];  } ?>">
                        </div>

                        <div class="input-box">
                            <label>Product Description</label><br>
                            <div class="error">
                                <?php if(isset($pDesc_err)){echo $pDesc_err. "<br/>";}?>
                            </div>
                            <textarea name="productDesc"
                                class="description"><?php if(isset($_POST['productDesc'])){echo trim($_POST['productDesc']);}?></textarea>
                        </div>

                        <div class="input-box description">
                            <label>Product Short Description</label><br>
                            <div class="error">
                                <?php if(isset($pShortdesc_err)){echo $pShortdesc_err. "<br/>";}?>
                            </div>

                            <textarea name="productShortdesc"
                                class="description"><?php if(isset($_POST['productShortdesc'])){echo trim($_POST['productShortdesc']);}?></textarea>
                        </div>


                        <div class="input-box">
                            <label>Category</label>
                            <div class="error">
                                <?php if(isset($proCategory_err)){echo $proCategory_err. "<br/>";}?>
                            </div>

                            <!-- This is for Dropdown menu -->
                            <?php 
                            include('../../connection/connect.php');
                        
                            $sql = "SELECT * FROM Category";
                        
                            $query = oci_parse($conn, $sql);
                        
                            $execute = oci_execute($query);
                                ?>

                            <select name="category">
                                <option value="">Select Category</option>
                                <?php    
                                    while ($row = oci_fetch_assoc($query)) 
                                    {
                                        echo "<option value=". $row['CATEGORY_ID'].">".$row['CATEGORY_NAME']."</option>";               
                                    }    
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <label>Feature Image</label>
                            <div class="error">
                                <?php if(isset($fileName_err)){echo $fileName_err. "<br/>";}?>
                            </div>
                            <input type="file" name="displayImg" class="form-control" />
                        </div>

                        <div class="input-box">
                            <label>Alternative Image 1 </label>
                            <div class="error">
                                <?php if(isset($fileName1_err)){echo $fileName1_err. "<br/>";}?>
                            </div>

                            <input type="file" name="altImg1" class="form-control" />

                        </div>

                        <div class="input-box">
                            <label>Alternative Image 2</label>
                            <div class="error">
                                <?php if(isset($fileName2_err)){echo $fileName2_err. "<br/>";}?>
                            </div>

                            <input type="file" name="altImg2" class="form-control" />

                        </div>

                        <div class="input-box">
                            <label>Alternative Image 3</label>
                            <div class="error">
                                <?php if(isset($fileName3_err)){echo $fileName3_err. "<br/>";}?>
                            </div>

                            <input type="file" name="altImg3" class="form-control" />

                        </div>

                        <div class="input-box">
                            <label>Alternative Image 4</label>
                            <div class="error">
                                <?php if(isset($fileName4_err)){echo $fileName4_err. "<br/>";}?>
                            </div>

                            <input type="file" name="altImg4" class="form-control" />

                        </div>
                    </div><!-- end of Product details -->


                    <!-- Button-->
                    <div class="button-add">
                        <input type="submit" name="addProduct" value="Add Product" />
                    </div>
                </form>
            </div>
        </div>

   </section>
  </body>
</html>
