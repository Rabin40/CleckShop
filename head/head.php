<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include('connect.php');

?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Hemanta Bikram Singh">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="http://localhost/Cleckshop/head/header-style.css   ">
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
        <link rel="icon" href="http://localhost/Cleckshop/images/icon.png" type="image/gif">

    </head>

    <body>
        <div class="header-container">
            <div class="mobile-menu">
                <div class="mobile-menu-items">
                    <a href=""><i class="fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </div>
                <!--mobile-menu-items-->

                <div class="mobile-menu-items">
                    <a href=""><i class="fas fa-th"></i>
                        <p>Catagories</p>
                    </a>
                </div>
                <!--mobile-menu-items-->

                <div class="mobile-menu-items">
                    <div class="mobile-search-menu">
                        <i class="fas fa-search"></i>
                        <div class="mobile-search-container">
                            <div class="mobile-search">
                                <form method="GET" action="#" name="Search Form" id="search">
                                    <input type="search" class="search-form" name="search" placeholder="search..."
                                        id="search1" onclick="myFunction()" />
                                </form>
                                <a href=""><i class="fas fa-search"></i></a>
                            </div>
                            <!--mobile-search-->
                        </div>
                        <!--mobile-search-container-->
                        <p>Search</p>
                    </div>
                    <!--mobile-search-menu-->
                </div>
                <!--mobile-menu-items-->

                <div class="mobile-menu-items">
                    <a href="http://localhost/Cleckshop/cart/cart.php"><i class="fas fa-shopping-cart"></i>
                        <p>Cart</p>
                    </a>
                </div>
                <!--mobile-menu-items-->

                <div class="mobile-menu-items">
                    <a href=""><i class="fas fa-user"></i>
                        <p>Account</p>
                    </a>
                </div>
                <!--mobile-menu-items-->

            </div>
            <!--mobile-menu-->

            <div class="header-main">
                <div class="logo-container">
                    <a href="http://localhost/Cleckshop/homepage/index.php"><img
                            src="http://localhost/Cleckshop/images/logo.png" alt="Logo" /></a>
                </div>
                <!--logo-container-->
                <div class="search-container">
                    <form method="GET" action="#" name="Search Form">
                        <select name="search-category" class="search-category">.
                            <option value="">ALL</option>
                            <?php 

                            $sql = "Select * from category";
                            $qry = oci_parse($conn, $sql);
                            $execute = oci_execute($qry);
                            
                            while($row = oci_fetch_assoc($qry)){
                                $value = $row['CATEGORY_ID'];
                                $name = $row['CATEGORY_NAME'];
                                
                                echo "<option value=' $value'>$name</option>";
                            }
                        ?>
                        </select>

                        <input type="text" class="search-form1" name="keywords" placeholder="search..." />
                    </form>
                    <a href=""><i class="fas fa-search"></i></a>
                </div>
                <!--search-container-->
                <div class="cart-container">
                    <a href="http://localhost/Cleckshop/cart/cart.php"><i class="fas fa-shopping-cart"></i>
                        <a href="http://localhost/Cleckshop/cart/cart.php"> Cart</a>
                </div>
                <!--cart-container-->
                <div class="myaccount-container">
                    <a href="http://localhost/Cleckshop/customer/customer-login.php"><i class="fas fa-user"></i>

                        <a href='http://localhost/Cleckshop/customer/customer-login.php'>My Account </a>


                </div>
                <!--myaccount-container-->
            </div>
            <!--header-main-->

        </div>
        <!--Header-Container-->
    </body>

</html>
<script>
function myFunction() {
    value = document.getElementById('search').value
    console.log('value')
}
</script>
