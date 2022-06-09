<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
if(! isset($_SESSION['customer-login'])){
    header('location: ../customer-login.php');
}

include('../../connection/connect.php');
$email = $_SESSION['customer-login']; 
$sql = "Select * from customer where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
$qry = oci_parse($conn, $sql);
$execute = oci_execute($qry);
$row = oci_fetch_assoc($qry);


include('../../head/head.php') ;


    if(isset($_POST['changepass'])){

        $old_password = trim($_POST['old-password']);
        $new_password = trim($_POST['new-password']);
        $c_password = trim($_POST['c-password']);
    
        include('../../connection/connect.php');
        $sql = "select * from customer where customer_id =".$_SESSION['customer-login-1'];
        $qry = oci_parse($conn, $sql);
        $execute = oci_execute($qry);
        $row = oci_fetch_assoc($qry);
        $password = strtoupper($row['CUSTOMER_PASSWORD']);
        $check = 0;
    
        $upper_old_password = strtoupper(hash('sha256', $old_password));
        $upper_new_password = strtoupper(hash('sha256', $new_password));
    
        
        if(empty($old_password)){
            $old_password_err = "Password is Required";
        }
        elseif(strcmp($password, $upper_old_password)){
            $old_password_err = "Incorrect Password";
        }
        elseif(!strcmp($password, $upper_new_password)){
            $old_password_err = "New Password cannot be your old password";
        }
        else{
            $check++;
        }
    
    
        if(empty($c_password)){
            $c_password_err = "Confirm Password is Required";
        }
        else{
            $c_password = hash('sha256', $c_password);
            $check++;
        }
    
    
        if(empty($new_password)){
            $new_password_err = "New Password is Required";
        }
        elseif((strcmp(hash('sha256', $new_password), $c_password))){
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
    
        if($check == 3){
    
            $sql = "UPDATE CUSTOMER set CUSTOMER_PASSWORD = '$password' where customer_id = ".$_SESSION['customer-login-1'];
            $qry = oci_parse($conn, $sql);
            $execute = oci_execute($qry);
    
            if($execute){
                $message = "Password has been reset";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/dashboard.css">

     <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/63b2f8517e.js"></script>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <title>Customer Dashboard</title>

  </head>
  <body>

    
    <div class="container-fluid pb-5">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-6 mt-3 customer">
                <img class="customer-logo" src="images/profile.png" alt="" style="width: 35%;">
                <div class="customerName">
                <h4><?php echo $row['CUSTOMER_FNAME']  ?></h4>
                    <h6><?php echo $row['CUSTOMER_EMAIL']  ?></h6>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-6 mt-3">
                <h1 class="txt1">Your Dashboard</h1>
                <div class="line mt-3"></div>
                <p class="mt-3" style="text-align:left">Here you can check your order, payments, questions asked, reviews and change password</p>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="tabs mt-4">
                <div class="tab-header">
                    <div class="sidebar">
                    <ul class="nav-links">
                    <li>
                    <a href="dashboard.php">
                        <i class='bx bx-grid-alt' ></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    </li>
                    <li>
                    <a href="myprofile.php">
                        <i class='bx bx-box' ></i>
                        <span class="links_name">My Profile</span>
                    </a>
                    </li>
                    <li>
                    <a href="orders.php">
                        <i class='bx bx-list-ul' ></i>
                        <span class="links_name">Orders</span>
                    </a>
                    </li>
                    <li>
                    <a href="payments.php">
                        <i class='bx bx-pie-chart-alt-2' ></i>
                        <span class="links_name">Payments</span>
                    </a>
                    </li>
                    <li>
                    <a href="reviews.php">
                        <i class='bx bx-coin-stack' ></i>
                        <span class="links_name">Reviews</span>
                    </a>
                    </li>
                    <li>
                    <a href="questions.php">
                        <i class='bx bx-book-alt' ></i>
                        <span class="links_name">Questions</span>
                    </a>
                    </li>
                    <li>
                    <a href="changepassword.php" class="active">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Change Password</span>
                    </a>
                    </li>
                    <li>
                    <a href="logout.php">
                        <i class='bx bx-log-out'></i>
                        <span class="links_name">Log out</span>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
            <div class="tab-content">
                <h2>You can change your Password Here</h2>
                    <form action="" method="POST">
                    <label for="password">Current Password</label>
                        <div class=error><?php if(isset($old_password_err)) echo $old_password_err ?></div>
                        <input type="password" placeholder="Enter Current password" name="old-password">
                    
                    <div class="new-pass">
                        <label for="password">New Password</label>
                        <div class=error><?php if(isset($new_password_err)) echo $new_password_err ?></div>
                        <input type="password" placeholder="Enter New Password" name="new-password" >
                    </div>
                    <div class="confirm-pass">
                        <label for="password">Confirm New Password</label>
                        <div class=error><?php if(isset($c_password_err)) echo $c_password_err ?></div>
                        <input type="password" placeholder="Enter Confirm Password" name="c-password">
                    </div>
                    <div class="submit">
                        <button type="submit" name="changepass" class="button">Submit</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="script.js"></script>
  </body>
</html>

<?php include('../../footer/footer.php'); ?>