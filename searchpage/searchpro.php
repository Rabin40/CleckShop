<div class="container">
    <div class="row">

        <?php 
        
        if(!isset($_GET['search'])){

                    //trimming white space characters
                    $search = trim($_GET['keywords']);
                    $search = strtolower($search);
                  //  echo $search;
                    
                  include('../connection/connect.php');

                    $sql= "SELECT * FROM Product WHERE LOWER(product_name || product_description || product_shortdesc ) LIKE '%$search%'";
                

                  //  SELECT CONCAT(FIRSTNAME, ' ', LASTNAME) AS FIRSTNAME FROM customer;

                   $query = oci_parse($conn, $sql);

                   $execute = oci_execute($query);          

                    $checkProduct = oci_fetch_all($query, $aa);
                  //  echo $checkProduct;

                    $execute = oci_execute($query);                 
                    
                    if($checkProduct > 0){
                        while($row = oci_fetch_array($query)){
                            $pID = $row['PRODUCT_ID'];  

                            $sql2 = "SELECT * FROM Product WHERE product_id = '$pID'";

                            $query2 = oci_parse($conn, $sql2);

                            $execute2 = oci_execute($query2); 

                            $row2 = oci_fetch_array($query2);

                            //Setting image path
                            $imgPath = "http://localhost/ProjectManagement/Product/ProductImage/".$row2['PRODUCT_IMAGE1'];
                ?>

        <div class="col-md-3 col-sm-6">
            <a href="product.php?id=<?php echo $pID ?>">
                <div class="card">
                    <img class='card-img-top' src=" ../images/sausage1.jpg" />
                    <div class="card-body text-center mx-auto">
                        <div class='cvp'>
                            <h5 class="card-title font-weight-bold"><?php echo$row['PRODUCT_NAME'];?></h5>
                            <p class="card-text"><b>Price:</b> $ <?php echo$row['PRODUCT_PRICE']; ?></p>
                            <div class="custom">
                                <a href="#" class="btn details">View Product</a><br />
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>


        <?php
                        }
                    } 
                    else{
                        echo "No results found!";
                    }   
                }
                ?>
    </div><!-- End of row-->
</div><!-- End of container -->
<style>
a {
    text-decoration: none;
    color: black;
}

a:hover {
    color: black;
}

</style>
