<?php include('../head/head.php');

include('../connection/connect.php');

$sql= "SELECT * FROM SHOP";

$query = oci_parse($conn, $sql);
$execute = oci_execute($query);    

$row = oci_fetch_array($query);
$query = oci_parse($conn, $sql);
$execute = oci_execute($query);  

?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/style2.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

        <title>Shop page</title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- This is Banner-->
                    <div class="shop-banner mt-4">
                        <img src="ShopPageImage/VEGIES.jpg" alt="">
                    </div><!-- end of shop banner-->
                </div> <!-- end of col-12-->
            </div><!-- end of row-->


            <div class="overlay">
                <div class="logo-overlay">
                    <img src="ShopPageImage/leaf.jpg" alt="">
                </div><!-- end of logo overlay-->

                <div class="text-overlay">
                    <p class="shop-title"><?php echo $row['SHOP_NAME'];?></p>
                    <p class="shop-address"><?php echo $row['SHOP_ADDRESS'];?></p>
                </div><!-- end of text-overlay-->
            </div><!-- end of overlay-->

            <!-- pRODUCT VIEW-->

            <div class="row">
                <div class="col-12">
                    <div class="button-profile">
                        <a href="">PROFILE</a>
                        <a class="allProduct" href="">ALL PRODUCT</a>
                    </div><!-- end of button-profile-->
                </div>
            </div><!-- end of row-->

            <div class="row">
                <div class="col-12">
                    <div class="form-group txtarea mt-4">
                        <textarea class="form-control" id="pointer"
                            rows="7"><?php echo $row['SHOP_DESCRIPTION'];?></textarea>
                    </div><!-- end of form group -->
                </div> <!-- col-12 -->
            </div><!-- row -->

            <div class="container">
                <div class="row mt-4 outline">
                    <div class="col-lg-4 col-md-4 col-sm-12 ">
                        <div class="d-flex justify-content-center">
                            <h3 class="title">Average Seller Rating</h3>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center component mt-2">
                                <h2>4.0</h2>
                                <div class="mt-4 star">
                                    <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <h3 class="title">Seller ratings and review</h3>
                        <div class="mt-4 star2">
                            <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a>
                        </div>
                        <div class="row txtarea">
                            <textarea name="" id="pointer" cols="30" rows="7"></textarea>
                            <p>Customer Name</p>
                        </div>

                        <div class="mt-4 star2">
                            <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a>
                        </div>
                        <div class="row txtarea">
                            <textarea name="" id="pointer" cols="30" rows="7"></textarea>
                            <p>Customer Name</p>
                        </div>

                    </div><!-- End of col-lg-8-->
                </div><!-- end of row-->

                <div class="row mt-5">
                    <div class="col-12">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="ShopPageImage/banner2.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="ShopPageImage/banner1.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="ShopPageImage/banner2.jpg" alt="Third slide">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End of row-->
            </div> <!-- End of container -->


        </div><!-- end of container-fluid-->





        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    </body>

</html>
<?php include('../footer/footer.php');?>
