<?php include('../head/head.php');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 if(! isset($_SESSION['final-password-reset'])){
    header('location: ../homepage');
 }


 if(isset($_POST['submit-password'])){

    $new_password = trim($_POST['new-password']);
    $c_password = trim($_POST['c-password']);

    include('../connection/connect.php');
    $email = $_SESSION['final-password-reset'];
    $sql = "select * from customer where UPPER(customer_email) = UPPER('$email')";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    $row = oci_fetch_assoc($qry);
    $password = strtoupper($row['CUSTOMER_PASSWORD']);
    $check = 0;

    $upper_new_password = strtoupper(hash('sha256', $new_password));

    
    if(empty($c_password)){
        $c_password_err = "Confirm Password is Required";
    }
    elseif(!strcmp($password, $upper_new_password)){
        $new_password_err = "New Password cannot be your old password";
    }
    else{
        $c_password = hash('sha256', $c_password);
        $check++;
    }

    $password = hash('sha256', $new_password);
    if(empty($new_password)){
        $new_password_err = "New Password is Required";
    }
    elseif(strcmp($password, $c_password)){
        $new_password_err = "New password must match with confirm Password";
    }
    elseif(strlen($new_password) <8 ){
        $new_password_err = "Password must be 8 character long";
    }
    elseif(!(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@$!%*?&]){8,}/", $new_password))){
        $new_password_err = "Password should contain at least 1 uppercase, 1 number and 1 special character";
    } 
    else{
        $password = hash('sha256', $new_password);
        $check++;
    }

    if($check == 2){

        $sql = "UPDATE CUSTOMER set CUSTOMER_PASSWORD = '$password' where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
        $qry = oci_parse($conn, $sql);
        $execute = oci_execute($qry);

        if($execute){
            $message = "Password has been reset. You will be redirected in few sec";
            header( "refresh:5;url=customer-login.php" );
            unset($_SESSION['final-password-reset']);

        }
        else{
            $message = "Something went wrong !";
        }
    }


}










?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="style/resetpass.css">
        <title>Reset Password</title>
    </head>

    <body>

        <div class="container">
            <div class="d-flex justify-content-center mt-3">
                <h1>RESET PASSWORD</h1>
            </div>
        </div>

        <div class="container">
            <div class="outer-box">
                <form method="POST" action="">
                    <!-- New Password-->
                    <div class="row">
                    <?php if(isset($message)){ echo $message;}   ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 stack">
                            <label>New Password</label>
                            <div class="error"><?php if(isset($new_password_err)){ echo $new_password_err;}   ?></div>
                            <br>
                            <input type="text" name="new-password">
                        </div>
                    </div>

                    <!-- Confirm Password-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 stack">
                            <label>Confirm Password</label>
                            <div class="error"><?php if(isset($c_password_err)){ echo $c_password_err;}   ?></div>
                            <br>
                            <input type="text" name="c-password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center stack">
                            <input type="submit" value="Reset" name="submit-password">
                        </div>
                    </div>
                </form>
            </div>
        </div>




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

</html>

<?php include('../footer/footer.php');?>
