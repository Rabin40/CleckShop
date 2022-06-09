<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="homepage-style.css">
    <!-- CSS only -->
      <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Cleckshop - The one</title>
  </head>
  <body>
    <?php 
      include('../head/head.php');
    ?>
    <div class="container-fluid pt-5"> 
        <div class="row slider-color">
         <div class="col-2">
          <div class="categories pt-5 ml-5">
            <strong>CATEGORIES</strong>                  
              <li><a href="">Fruits & Vegetables</a></li>
              <li><a href="">Bakery, Cakes & Dairy</a></li>
              <li><a href="">Snacks & Branded foods</a></li>
              <li><a href="">Eggs, Meat & Fish</a></li>
              <li><a href="">Foodgrains & Oil</a></li>
              <li><a href="">Beverages</a></li>
          </div>  <!-- categories -->
         </div><!-- col-2 -->

        <div class="col-10">      
                <div class="home-image-slider pt-5">
                  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                      <div class="carousel-inner custom-height">
                        <div class="carousel-item active">
                          <img src="../images/delicious cheese.jpg"  style="width:100%;" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="../images/breads and bake.jpg" style="width:100%;" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="../images/Bakery Shop.jpg" style="width:100%;"alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="../images/SeaFood.jpg" style="width:100%;"alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="../images/Milk.jpg" style="width:100%;" alt="...">
                        </div>
                      </div><!-- End of caraousel custom height -->
                      
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div><!-- End of carousel slide , fade-->
                </div><!------End of home-image-slider-->
              </div><!-----End of col-10-->
            </div><!-- End of row-->
          </div><!-- End of container-fluid -->

          <div class="container">
            <div class="row">
              <h2 class="line-text">TOP PRODUCTS</h2>
                <div class="grid-container">
                  <div class="big-main-image"> 
                    <img src="../images/macrons.jpg">
                  </div>

                  <div class="image-1">
                    <img src="../images/oyster.jpg">
                  </div>

                  <div class="image-2">  
                    <img src="../images/porkham1.jpg">
                  </div>

                  <div class="image-3"> 
                    <img src="../images/red velvet1.jpg">  
                  </div>

                  <div class="image-4"> 
                    <img src="../images/sourdough bread2.png">
                  </div>

                  <div class="image-5"> 
                    <img src="../images/crab3.jpg">
                  </div>

                  <div class="image-6"> 
                    <img src="../images/muffins.jpg">
                  </div>
               </div><!-- End of grid container-->
            </div><!-- End of row-->

            <h2 class="line-text2">SHOP NOW</h2>
           
            <div class="row custom">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="img-1">
                  <img src="../images/chicken 1.jpg" style='height: 350px; width: 100%; object-fit: cover' >
                  <div class="button1">
                    <a class="shopnow" href="">Shop Now</a>
                  </div>  <!-- End of button1 -->
                </div><!-- End of img-3 -->
              </div><!-- End of col-->

              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="img-2">
                  <img src="../images/cake.jpg"  style='height: 350px; width: 100%; object-fit: cover' >
                  <div class="button1">
                    <a class="shopnow" href="">Shop Now</a>
                  </div><!-- End of button1 -->
                </div><!-- End of img-3 -->
              </div><!-- End of img-2 -->
            </div><!-- End of row -->

            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="img-3">
                  <img src="../images/prawn3.jpg"  style='height: 350px; width: 100%; object-fit: cover' >
                  <div class="button1">
                    <a class="shopnow" href="">Shop Now</a>
                  </div><!-- End of button1-->
                </div><!-- End of img-3 -->
              </div><!-- End of col -->

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="img-3">
                  <img src="../images/sausage3.jpg"  style='height: 350px; width: 100%; object-fit: cover' >
                  <div class="button1">
                    <a class="shopnow" href="">Shop Now</a>
                  </div><!-- End of button1-->
                </div><!-- End of img-3 -->
              </div><!-- End of col -->
              
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="img-3">
                  <img src="../images/sourdough bread1.jpg"  style='height: 350px; width: 100%; object-fit: cover' >
                  <div class="button1">
                    <a class="shopnow" href="">Shop Now</a>
                  </div><!-- End of button1-->
                </div><!-- End of img-3 -->
              </div><!-- End of col -->
            </div><!-- End of row -->

            <h2 class="line-text">NEW PRODUCTS</h2>
            <?php 
            include('slider.php');
            ?>

            <h2 class="line-text">OUR FACILITIES</h2>
            
            <div class="row">
              
              <div class="col-4">
                <div class="ourfacilities">
                    <i class="color1 fas fa-star"></i>
                    <h3 class="facilities-txt">Best Offers</h3> 
                </div>
              </div><!-- End of col-->  
              
              <div class="col-4">
                    <div class="ourfacilities">
                        <i class="color2 fas fa-dollar-sign"></i>
                        <h3 class="facilities-txt">Secure Payment</h3> 
                    </div>               
              </div><!-- End of col-->  
              
              <div class="col-4">
                <div class="ourfacilities">
                    <i class="color3 fas fa-thumbs-up"></i>
                    <h3 class="facilities-txt">Genuine Products</h3> 
                </div>               
              </div><!-- End of col-->  

            </div><!-- End of row--> 
        
        </div><!-- End of contaier fluid-->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<?php include('../footer/footer.php'); ?>