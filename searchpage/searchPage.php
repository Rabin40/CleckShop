<?php 
    include('../connection/connect.php');
    include('../head/head.php')
?>

<!doctype html>
<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="styles.css">

        <title>Search Page</title>
    </head>

    <body>


        <div class="container-fluid" style="margin-top:50px;">

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-md-4 col-sm-4 background1" id="left">
                    <div class="row">
                        <h2 class="mt-3">Price</h2>
                    </div>
                    <div class="row txt">
                        <input type="text" name="" placeholder="Min" />
                        <input type="text" name="" placeholder="Max" />
                        <a href="#"><i class="far fa-play-circle"></i></a>
                    </div>

                    <div class="row">
                        <div class="mt-4 star">
                            <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-3 star">
                            <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas star2 fa-star"></i></a>AND UP
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-3 star">
                            <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas star2 fa-star"></i><i
                                    class="fas star2 fa-star"></i></a>AND UP
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-3 star">
                            <a href=""><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas star2 fa-star"></i><i class="fas star2 fa-star"></i><i
                                    class="fas star2 fa-star"></i></a>AND UP
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-3 star">
                            <a href=""><i class="fas fa-star"></i><i class="fas star2 fa-star"></i><i
                                    class="fas star2 fa-star"></i><i class="fas star2 fa-star"></i><i
                                    class="fas star2 fa-star"></i></a>AND UP
                        </div>
                    </div>

                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8  background2" id="right">
                    <div class="row sorting">
                        <h5 class="mt-3 ms-3">"X" items found for <?php if(isset($_POST['search'])){echo trim($_POST['keywords']);} ?></h5>

                        <form action="" method="GET">
                            <div class="float-end d-flex">
                                <select name="sortCat" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Best Match</option>
                                    <option value="SORT BY product_price ASC">Price Ascending</option>
                                    <option value="SORT BY product_price DESC">Price Descending</option>
                                    <option value="SORT BY product_name DESC">Name Descending</option>
                                    <option value="SORT BY product_name ASC">Name Ascending</option>
                                </select>
                                <div class="sort-button">
                                    <input name="sort" value="Search" type="submit" />
                                </div>
                            </div>
                        </form> <!-- End of form sort-->
                    </div> <!-- End of row-->

                    <?php include('searchPro.php'); ?>
                </div>
            </div><!-- End of row -->
        </div><!-- End of container-fluid -->





        <script src="https://kit.fontawesome.com/5b4b4281ee.js" crossorigin="anonymous"></script>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    </body>

    <style>

    </style>

</html>


