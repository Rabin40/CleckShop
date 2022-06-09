<?php
    include('../head/head.php');
    include('traderfirstvalidation.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sell on CleckShop - Become a trader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/trader-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<body>

    <div class="trader-reg-container">
        <div class="bg-image">
            <div class="bg-image-1">
                <img src="../images/trader-banner-1.jpg" alt="Trader Banner 1">
            </div><!--bg-image-1-->
            <div class="bg-image-2">
                <h1 class="title">Start Your Business With Us</h1>
                <br>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit Voluptatum asperiores. eaque itaque at totam!
                    Ratione eius consecteturamet dolores ducimus recusandae hic laborum voluptates libero commodi iusto
                    distinctio</p>
                    <br><br>
                <h1 class="title-2">REGISTER HERE!</h1>
                <p class="already-seller">Already a Seller? <a href="login.php">Sign in</a></p>
            </div><!--bg-image-2-->
           
        </div><!--bg-image--->
        <div class="trader-reg-1">
        <form class="seller-registration" action="" method="POST">
            <p>APPLY AS A SELLER</p>
            <hr>
            <?php if(isset($allError)){ echo $allError;  }  ?>

            <label for="email"><b>Email</b></label>
            <div class="error"><?php if(isset($emailError)){ echo $emailError."<br>";  }  ?></div>
            <input type="email" placeholder="Enter Email" name="trader_email" value="<?php  if(isset($email)){ echo $email; } ?>" required>
            
            <label for="phone"><b>Phone Number</b></label>
            <div class="error"> <?php if(isset($phoneError)){ echo $phoneError;  }  ?></div>
            <input type="text" placeholder="Enter 10 digit Phone Number" name="trader_phone" value="<?php  if(isset($phone)){ echo $phone; } ?>" required>
            

            <label for="shop-name"><b>Shop Name</b></label>
            <div class="error"><?php if(isset($nameError)){ echo $nameError."<br>";  }  ?></div>
            <input type="text" placeholder="Enter Shop Name" name="trader_shopname" value="<?php  if(isset($shopname)){ echo $shopname; } ?>" required>
            
            <label for="company-registration-number"><b>Company Registration Number</b></label>
            <div class="error"><?php if(isset($companyNoError)){ echo $companyNoError."<br>";  }  ?></div>
            <input type="text" placeholder="Enter 8 digit Company's Registration Number" name="trader_companyno" id="companyno" value="<?php  if(isset($companyno)){ echo $companyno; } ?>" required>
            <hr>

            <button type="submit" name="submit" class="button">Next</button>
            <h3 class="step">Step 1 of 2</h3>
        </form>
</div><!--trader-reg-1-->


    </div><!--trader-reg-container-->

    <div class="heading-img">
        <img src="../images/trader-banner-2.jpg" alt="how to register">
    </div>

    <div class="low-title">
        <h1>Title</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet necessitatibus repudiandae veritatis
            nostrum rem voluptatibus minus exercitationem eius quia,
            laboriosam aliquid est nesciunt repellendus excepturi autem maxime quis unde accusamus
            laboriosam aliquid est nesciunt repellendus excepturi autem maxime quis unde accusamus
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum."
        </p>
    </div>

    <div class="low-title">
        <h1>Title</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet necessitatibus repudiandae veritatis
            nostrum rem voluptatibus minus exercitationem eius quia,
            laboriosam aliquid est nesciunt repellendus excepturi autem maxime quis unde accusamus
            laboriosam aliquid est nesciunt repellendus excepturi autem maxime quis unde accusamus
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum."
        </p>
    </div>

    <div class="low-title">
        <h1>Title</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet necessitatibus repudiandae veritatis
            nostrum rem voluptatibus minus exercitationem eius quia,
            laboriosam aliquid est nesciunt repellendus excepturi autem maxime quis unde accusamus
            laboriosam aliquid est nesciunt repellendus excepturi autem maxime quis unde accusamus
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum."
        </p>
    </div>

</body>

</head>
</html>

<?php 
    include('../footer/footer.php');
?>
