<?php
    session_start();
    if(isset($_SESSION['trader-login'])){
        header('location: dashboard/dashboard.php');
    }

    include('../head/head.php');

    if(isset($_POST['login'])){

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(empty($email) && empty($password)){
            $error = "Email and Password is required";
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        }
        elseif(!empty($email) && empty($password)){
            $error = " Enter password";
        }
        else{
            $password = hash('sha256', $password);

            include('../connection/connect.php');
            $sql = "Select * from trader where UPPER(trader_email) = UPPER('$email') and UPPER(trader_password) = UPPER('$password')";
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
            $count = oci_fetch_all($qry, $temp);

            $execute = oci_execute($qry);
            if($count == 1){
                $row = oci_fetch_assoc($qry);
                if($row['TRADER_STATUS'] == 0){
                    $error = "Your account is not active. ";
                } 
                else{
                    $_SESSION['trader-login'] = $row['TRADER_ID'];
                //    header('Location: dashboard/dashboard.php');
                }
                ?>
<script>
window.location.href = "dashboard/dashboard.php";
</script>
<?php
            }
            else{
                $error = "Incorrect Username or Password";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../style/login.css" />

        <title>Login html</title>
    </head>

    <body>
        <div class="ask-login">
            <p>Are you a Customer?<a href="../customer/customer-login.php"> Login Here</a></p>
            <p>Want to be a seller?<a href="../trader/sell-on-cleckshop.php"> Register Here</a></p>
        </div>
        <div class="container">
            <div class="form-container">
                <h1 class="login-header">LOGIN</h1>
                <form class="login-form" action="" method="POST">
                    <div class="error"> <?php if(isset($error)){ echo $error;  }  ?></div>
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Enter Email"
                        value="<?php  if(isset($email)){ echo $email; } ?>" />
                    <br />


                    <i class="fas fa-key"></i>
                    <input type="password" name="password" placeholder="Enter Password" /><a href="">Forgot Password
                        ?</a>
                    <br /><br />
                    <div class="login-button">
                        <input type="submit" value="Login" name="login" />
                    </div>
                </form>
            </div>
            <!--form-container-->

            <div class="img-container">
                <img src="../images/trader-login-banner.jpg" class="img-fluid" alt="">
            </div>
            <!--img-container-->
        </div>
        <!--container-->
    </body>

</html>

<?php 
    include('../footer/footer.php');
?>
