<?php include('../head/head.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password - Cleckshop</title>
    <link href="../style/forget.css" rel="stylesheet">
</head>
<body>
<div class="container-outer-box">
        <div class="outer-box">
           <form class="login-form" action="" method="POST">
               <h1>Verify your Email First to Reset your Password</h1>
               
               <div class="email">
                <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Enter Your Email">
               </div>

               <div class="verify-button">
                    <input type="submit" value="verify" name="verify"/>
                </div>
                </form>

        </div><!-- End of outer-box -->
    </div><!-- End of container-outer-box -->

</body>
</html>

<?php include('../footer/footer.php') ?>