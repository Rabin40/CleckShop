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
        <img src="../../images/logo.png" alt="">
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
        <h1>All Products</h1>
      </div>
      
      <div class="content-body">

      <?php 
    if(isset($_SESSION['updelsuccess'])){ echo $_SESSION['updelsuccess']; }
    unset($_SESSION['updelsuccess']);
    include('../../connection/connect.php');

    $sql = "SELECT * FROM Product";
    $query = oci_parse($conn,$sql);  
    $execute = oci_execute($query);
?>

<table class="product-table" style="width:100%; line-height: 30px;" >
        <thead role="rowgroup">
            <tr>
                <th role="columnheader">SN</th>
                <th role="columnheader">Product Name</th>
                <th role="columnheader">Product Price</th>
                <th role="columnheader">Discount Price</th>
                <th role="columnheader">Quantity</th>
                <th role="columnheader">Category</th>  
                <th role="columnheader">Short Description</th>
                <th role="columnheader">Product Description</th> 
                <th role="columnheader">Status</th>
                <th role="columnheader">Image</th>
                <th role="columnheader">Edit</th>
                <th role="columnheader">Delete</th>
            </tr>
        </thead>
            <?php 
            $i=1;
                while ($row = oci_fetch_array($query)) {
            ?>

            <tr>
                <td role="cell"><?php echo $i;?></td>
                <td role="cell"><?php echo $row['PRODUCT_NAME'];?></td>
                <td role="cell">£ <?php echo $row['PRODUCT_PRICE'];?></td>
                <?php
                      if(empty($row['DISCOUNT_PRICE'])){
                        echo "<td role='cell'>-</td>";
                      }
                      else{
                        echo "<td role='cell'>£". $row['DISCOUNT_PRICE']."</td>";
                      }
                ?> 
                <td role="cell"><?php echo $row['PRODUCT_QUANTITY'];?></td>
                <?php
                      $catsql = "Select * from category where category_id = ". $row['CATEGORY_ID'];
                      $catqry = oci_parse($conn, $catsql);
                      $catexecute = oci_execute($catqry);
                      $catrow = oci_fetch_assoc($catqry);
                      echo "<td role='cell'>". $catrow['CATEGORY_NAME']."</td>";
                ?>
                <td role="cell"><?php echo $row['PRODUCT_DESCRIPTION'];?></td>             
                <td role="cell"><?php echo $row['PRODUCT_SHORTDESC'];?></td>
                <?php
                    if($row['STATUS'] == 0){
                      echo "<td role='cell'>Dissabled</td>";
                    }
                    else{
                      echo "<td role='cell'>Active</td>";
                    }


                ?>                
                <td role="cell"><img src="../../images/<?php echo $row['PRODUCT_IMAGE1']?>" width="100px"  class="img-fluid img-thumbnail" alt="<?php echo $row['PRODUCT_IMAGE1']  ?>" />
                </td>
                <td><a href="updateproduct.php?id=<?php echo $row['PRODUCT_ID']?>">Edit</a></td>
                <td><a href="deleteproduct.php?id=<?php echo $row['PRODUCT_ID'] ?>">Delete</a></td>

            </tr>
            <?php 
            $i++;
             }
            ?>
        </table>
      </div>
   </section>
   </div>
  </body>
</html>