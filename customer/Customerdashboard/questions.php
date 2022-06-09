<?php include('../../head/head.php');

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
                    <a href="questions.php" class="active">
                        <i class='bx bx-book-alt' ></i>
                        <span class="links_name">Questions</span>
                    </a>
                    </li>
                    <li>
                    <a href="changepassword.php">
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
                
       
            <table id="showorder" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Question You have Asked</th>              
            </tr>
                 </thead>
                    <tbody>

                    <?php
                        include ('../../connection/connect.php');
                        $cid = $_SESSION['customer-login-1'];
                        $sql = "SELECT * from question_review where review_rating is null and status = 1 and customer_id = $cid";
                        $qry = oci_parse($conn, $sql);
                        $execute = oci_execute($qry);

                        while($row = oci_fetch_assoc($qry)){
                            $pid = $row['PRODUCT_ID'];
                            $sql1 = "SELECT * from PRODUCT where PRODUCT_ID = $pid";
                            $qry1 = oci_parse($conn, $sql1);
                            $execute1 = oci_execute($qry1);
                            $row1 = oci_fetch_assoc($qry1);
                            $pname = $row1['PRODUCT_NAME'];


                            echo  "<tr> 
                                        <td>$pname <br><br>
                                        
                                            <strong> Q: ".$row['QUESTION_QUERY']."</strong><br>
                                            ";
                                            if($row['QUESTION_ANS'] == null) {
                                                echo 'Not Answered yet';
                                            }
                                            echo " 
                                        </td>  
                                    </tr>";  
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="script.js"></script>
    <script>
     $(document).ready(function() {
    $('#showorder').DataTable();
  } );
  </script>
  </body>
</html>

<?php include('../../footer/footer.php'); ?>