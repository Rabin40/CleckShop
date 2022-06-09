<?php
  session_start();
  if(!isset($_SESSION['trader_reg'])){
    header('Location: sell-on-cleckshop.php');  
  }
  include('../head/head.php');


 $email = $_SESSION['trader_reg'][0];
 $phone = $_SESSION['trader_reg'][1];
 $shopname = $_SESSION['trader_reg'][2];
 $companyno = $_SESSION['trader_reg'][3];

  include('tradersecondvalidation.php');


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Card/Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/trader-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<body>
    <p class="title-head">Apply as a Seller</p>
    <p class="sidetitle">Are You a Customer <a href="#">Login Here</a></p>
    <p class="sidetitle-2">Already a Seller <a href="#">Login Here</a></p>
    <div class="container-1">
        <div class="content">
        <div class="error"><?php if(isset($all_error)){ echo $all_error."<br>";  }  ?></div>
            <form class="seller-registration-2" action="" method="POST" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <div class="error"><?php if(isset($trader_name_error)){ echo $trader_name_error."<br>";  }  ?></div>
                        <input type="text" name="trader_name" value="<?php  if(isset($trader_name)){ echo $trader_name; } ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Mobile No</span>
                        <div class="auto-input"><?php echo $phone?></div>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <div class="auto-input"><?php echo $email?></div>
                    </div>
                    <div class="input-box input-otp">
                        <span class="details">Enter OTP | <a href="../mail/trader-registration-resend-otp.php"> Resend OTP</a></span>
                        <div class="error"><?php if(isset($otp_error)){ echo $otp_error."<br>";  }  ?></div>
                        <input type="text" placeholder="<?php echo $_SESSION['trader-otp-message'] ?>" name="otp">
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <div class="error"><?php if(isset($password_error)){ echo $password_error."<br>";  }  ?></div>
                        <input type="password" name="trader_password">
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <div class="error"><?php if(isset($repassword_error)){ echo $repassword_error."<br>";  }  ?></div>
                        <input type="password" name="trader_repassword">
                    </div>
                    <div class="input-box">
                        <span class="details">Shop Name</span>
                        <div class="auto-input"><?php echo $shopname?></div>
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <div class="error"><?php if(isset($address_error)){ echo $address_error."<br>";  }  ?></div>
                        <input type="text" name="address" value="<?php  if(isset($address)){ echo $address; } ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Company Registration Number</span>
                        <div class="auto-input"><?php echo $companyno?></div>
                    </div>
                    <div class="input-box input-file">
                        <label>Upload Logo (.jpg or .png only)</label>
                        <div class="error"><?php if(isset($logo_error)){ echo $logo_error."<br>";  }  ?></div>
                        <input type="file" id="myfile" name="seller-logo">
                    </div>
                    <div class="input-box">
                        <span class="details">Shop Description</span>
                        <div class="error"><?php if(isset($description_error)){ echo $description_error."<br>";  }  ?></div>
                        <textarea name="shop-desc" class="shop-desc" value="<?php  if(isset($description)){ echo $description; } ?>"></textarea>
                    </div>
                </div>
                <div class="error"><?php if(isset($terms_error)){ echo $terms_error."<br>";  }  ?></div>
                <div class="terms-checkbox">
                    <input type="checkbox" name="termscheck">
                    <h5> I agree to the Terms & Conditions of Cleck Shop </h5>
                </div>
                
                <div class="button1">
                    <input type="submit" name="applyAsSeller" value="Apply">
                </div>
            </form>
        </div>
    </div>
</body>
</head>

</html>