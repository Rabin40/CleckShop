<?php
    if(!isset($_GET['id'])){
        header('location: ../homepage');
    }
    else{
        $prid = $_GET['id'];
    }

    include('../cart/processcart.php');
    include('../connection/connect.php');
    $sql = "SELECT * from Product where PRODUCT_ID = '$prid'";
    $qry = oci_parse($conn, $sql);
    $execute= oci_execute($qry);
    $count = oci_fetch_all($qry, $temp);
    if($count != 1){
        header('location: .');
    }
    $execute= oci_execute($qry);

    $row0 = oci_fetch_assoc($qry);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/product-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    
    <title>Products Page</title>
</head>
<body>
    <?php 
        include('../head/head.php');
    ?>
    <ul class="breadcrumb">
        <li><a href="#">Home </a><i class="fas fa-angle-right"></i></li>
        <li><a href="#">Products</a><i class="fas fa-angle-right"></i></li>
        <li><a href="#">Products Item</a></li>
    </ul>

    <section class="container product">
    <div class="cartmessage"><?php if(isset($cartmessage)){ echo $cartmessage; }    ?></div>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-12">
                <img class= "img-fluid w-100 pb-2 custom-padding1" img src="../images/<?php echo $row0['PRODUCT_IMAGE1']  ?>" id="MainImg" alt="">

                <div class="small-img-group custom-padding2">
                        <?php
                            if(! $row0['PRODUCT_IMAGE1'] == ''){ 
                                ?>
                            <div class="small-img-col">
                            <img src="../images/<?php echo $row0['PRODUCT_IMAGE1']  ?>" width ="100%" class="small-img" alt="">
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            if(! $row0['PRODUCT_IMAGE2'] == ''){ 
                                ?>
                            <div class="small-img-col">
                            <img src="../images/<?php echo $row0['PRODUCT_IMAGE2']  ?>" width ="100%" class="small-img" alt="">
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            if(! $row0['PRODUCT_IMAGE3'] == ''){ 
                                ?>
                            <div class="small-img-col">
                            <img src="../images/<?php echo $row0['PRODUCT_IMAGE3']  ?>" width ="100%" class="small-img" alt="">
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            if(! $row0['PRODUCT_IMAGE4'] == ''){ 
                                ?>
                            <div class="small-img-col">
                            <img src="../images/<?php echo $row0['PRODUCT_IMAGE4']  ?>" width ="100%" class="small-img" alt="">
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            if(! $row0['PRODUCT_IMAGE5'] == ''){ 
                                ?>
                            <div class="small-img-col">
                            <img src="../images/<?php echo $row0['PRODUCT_IMAGE5']  ?>" width ="100%" class="small-img" alt="">
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
           
             <div class="col-lg-6 col-md-12 col-12">            
                <h2 class = "product-title"><?php echo $row0['PRODUCT_NAME']  ?></h2>
                <?php
                    $sql = "select * from SHOP where trader_id = (Select trader_id from product where product_id = $prid  )";
                    $qry = oci_parse($conn, $sql);
                    $execute= oci_execute($qry);
                    $row1 = oci_fetch_assoc($qry);
                ?>
                    <a href = "../shop/shop/php?id=<?php echo $row1['SHOP_ID'] ?>" class="product-link"> SOLD BY <?php echo $row1['SHOP_NAME']  ?></a>
                    <div class = "product-price">
                        <h2>Price:
                        <?php 
                            if($row0['DISCOUNT_PRICE'] == ''){
                                echo "<span>£".$row0['PRODUCT_PRICE']." </span>";
                            }
                            else{
                                echo "<span>£".$row0['DISCOUNT_PRICE']." </span>";
                                echo "<del style=\"font-size:16px;\">".$row0['PRODUCT_PRICE']."</span>";
                            }
                        ?>
                        </h2></div>
                        <?php
                            $sql = "select * from  QUESTION_REVIEW where product_id=$prid and status = 1";
                            $qry = oci_parse($conn, $sql);
                            $execute= oci_execute($qry);
                            $count = oci_fetch_all($qry, $temp);
                            if($count == 0){
                                echo "No rating yet";
                            }
                            else{
                            $totalrating = 0;
                            oci_execute($qry);
                            while($row1 = oci_fetch_assoc($qry)){
                                $totalrating = $totalrating + $row1['REVIEW_RATING'];
                            }
                            $avgrating = $totalrating/$count;
                            $avgrating = round($avgrating);
                        
                        echo "<div class = \"product-rating\">";
                        for($i=1; $i<=$avgrating; $i++){
                            echo "<i class = \"fas fa-star\"></i>";
                        }
                        for($j=$i; $j<=5; $j++){
                            echo "<i style=\"color:black  \" class = \"fas fa-star\"></i>";
                        }


                        echo "<span> " .$avgrating."</span>";
}
                        ?>
                                
   
                    

            <div class="product-detail">
                <h2>Short Description:</h2>
                    <p><?php echo $row0['PRODUCT_SHORTDESC']  ?></p>
            </div>
            <form action="" method="POST">
                <input type = "number" name="p-quantity" min = "1" max = "<?php echo $row0['PRODUCT_QUANTITY'] ?>" value = "1">
                <button type="submit" name="addsubmit" class="add-btn">Add to Cart</button>
                <button type="submit" name="buysubmit" class="buy-btn">Buy Now</button>
                </form>              
                <div class = "social-links">
                    <p>Share Via: </p>
                    <a target="_blank" href = "https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fhamroflix.com%2F&amp;src=sdkpreparse">
                        <i class = "fab fa-facebook-f"></i>
                    </a>
                    <a href = "#">
                        <i class = "fab fa-twitter"></i>
                    </a>
                    <a href = "#">
                        <i class = "fab fa-instagram"></i>
                    </a>
                    <a href = "#">
                        <i class = "fab fa-whatsapp"></i>
                    </a>
              </div>
            </div>
        </div>
    </div>
</section>

<div class="container pt-5">
    <ul class="nav nav-tabs">
        <li class="nav-items "><a href="#home" class="nav-link" data-toggle="tab">Descriptions</a></li>
        <li class="nav-items"><a href="#quest" class="nav-link" data-toggle="tab">Questions</a></li>
        <li class="nav-items"><a href= "#reviews" class="nav-link" data-toggle="tab">Reviews</a></li>
    </ul>
    <div class="tab-content container pt-3">
        <div class="tab-pane active" id="home">
            <h2>Description of the Product</h2>
            <p><?php echo $row0['PRODUCT_DESCRIPTION']  ?></p>
        </div>
        <div class="tab-pane" id="quest">
            <?php include ('question.php'); ?>
        </div> 

        <div class="tab-pane" id="reviews">
            <?php include ('review.php'); ?>            
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
    <h2 class="line-text">RELATED PRODUCTS</h2>
        <?php 
        include ('slider.php'); ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="js/script.js"></script>

<!--- For Image SLider----->
<script>
    var MainImg = document.getElementById('MainImg');
    var smallimg = document.getElementsByClassName('small-img');

    smallimg[0].onclick = function(){
        MainImg.src = smallimg[0].src;
    }
     smallimg[1].onclick = function(){
        MainImg.src = smallimg[1].src;
    }
    smallimg[2].onclick = function(){
        MainImg.src = smallimg[2].src;
    }
    smallimg[3].onclick = function(){
        MainImg.src = smallimg[3].src;
    }
</script>
</body>
</html>