<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
if(isset($_SESSION['customer-login'])){
    header('location: Customerdashboard/dashboard.php');
}

include ('../head/head.php');

    if(isset($_POST['register'])){
        $firstname = trim($_POST['firstname']);
        $middlename = trim($_POST['middlename']);
        $lastname = trim($_POST['lastname']);
        $address = trim($_POST['address']);
        $email = trim($_POST['email']);
        $number = trim($_POST['number']);
        $password = trim($_POST['password']);
        $repassword = trim($_POST['repassword']);
        $dob = trim($_POST['dob']);
        $gender =trim($_POST['gender']);
        $check = 0;

        //check if the required data is provided
        if(empty($firstname) && empty($lastname) && empty($email) && empty($address) && empty($number) && empty($password) && empty($repassword) && empty($dob) && empty($gender)){
            $allmessage = "*Please fill all the required fields"; 
        }
        else{
            //Check for Full Name
            if(empty($firstname) &&empty($middlename) && empty($lastname)){
                $usernameError = "*Full Name is required";
            }
            elseif(empty($firstname)){
                $usernameError = "*Firstname is required";
            }
            elseif(empty($lastname)){
                $usernameError = "*Lastname is required";
            }
            else{
                $check++;
            }

            //check address
            if(empty($address)){
                $addressError = "*Address is required";
            }
            else{
                $check++;
            }

            //check email
            if(empty($email)){
                $emailError = "*email is required";
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
            }
            else{
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                $check++;
            }

            //check number
            if(empty($number)){
                $numberError = "*Phone number is required";
            }
            elseif((strlen((string)$number)!=10 )){
                $numberError = "*Please enter a valid phone number";
            }
            elseif(preg_match("/[a-z]/i", $number)){
                $numberError = "*Please enter a valid phone number";
            }
            else{
                $check++;
            }

            //check for passwords
            if(empty($password) && empty($repassword)){
                $passwordError = "*passwords are required";
            }
            elseif(!($password == $repassword)){
                $passwordError = "*Password and Confirm Password must match";
            }
            elseif(strlen($password) < 8){
                $passwordError = "*Password must be 8 characters long";
            } 
            elseif(!(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@$!%*?&]){8,}/",$password ))){
                $passwordError = "*Password should contain at least 1 uppercase, <br> 1 number and 1 special character";
            }
            else{
                $password = hash("sha256", $password);
                $check++;
            }
            
            //check for gender
            if($gender == ""){
                $genderError = "*Choose a gender";
            }
            else{
                $check++;
            }

            //check for DOB
            if($dob == ""){
                $dobError = "*Please Provide your Date of birth";
            }

            else{
                $check++;
            }

            //check for terms
            if(!isset($_POST['terms'])){
                $agreeError = "*You must agree to our terms and conditions";
            }
            else{
                $check++;
            }
        }   


            if($check == 8){
               
                include('../connection/connect.php');
                $qry = "SELECT * FROM customer WHERE customer_email = '$email'";
                $sql = oci_parse($conn, $qry);
                $execute = oci_execute($sql);
                $count = oci_fetch_all($sql, $row);
                if($count == 1){
                    $allmessage = "This email is already registered";
                }
                else{
                    
                    //Inserts the data into the table after the from is submitted
                    $qry = "INSERT INTO customer VALUES ('', '$firstname', '$middlename', '$lastname', '$address', '$email', '$number', '$password',TO_DATE('$dob','MM/DD/YYYY'),'$gender','0')";
                    $sql = oci_parse($conn, $qry);
                    $execute = oci_execute($sql);
                    if($execute){
                        $_SESSION['verify-customer'] = $email;

                        $sql = "Select * from CUSTOMER where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
                        $qry = oci_parse($conn, $sql);
                        $execute = oci_execute($qry);
                        $row1 = oci_fetch_assoc($qry);
                        $cid =  $row1['CUSTOMER_ID'];
                        $_SESSION['customer-login-1'] = $cid;

                        $sql = "Insert Into cart values ('', $cid, 0)";   //creating new cart for non purchased cart
                        $qry = oci_parse($conn, $sql);
                        $execute = oci_execute($qry);

                        $sql = "Select * from cart where customer_id = $cid and purchased = 0";
                        $qry = oci_parse($conn, $sql);
                        $execute = oci_execute($qry);
                        $row = oci_fetch_assoc($qry);
                        $cart_id =  $row['CART_ID'];

                        if(isset($_SESSION['cart-p'])){
                        $p =0 ;
                        foreach($_SESSION['cart-p'] as $pid){

                            $a = "Select * from product where product_id = $pid";
                            $b = oci_parse($conn, $a);
                            $c = oci_execute($b);
                            $rowa = oci_fetch_assoc($b);
        
                            if(empty($rowa['DISCOUNT_PRICE'])){
                                $proprice = $rowa['PRODUCT_PRICE']; 
                            }
                            else{
                                $proprice = $rowa['DISCOUNT_PRICE']; 
                            }
        
                            
                            $pro_quantity = $_SESSION['p-quantity'][$p]; 
                            $sql = "Insert Into cart_product values ('', $cart_id, $pid, $pro_quantity, $proprice )";   //creating new cart for non purchased cart
                            $qry = oci_parse($conn, $sql);
                            $execute = oci_execute($qry);
                            $p++;
         
                        }
                    }

                        include('../mail/customer-email-verify-otp.php');
                       // header('location: otp-verify.php');
                        ?>
<script>
window.location.href = "otp-verify.php";
</script>
<?php
                    }
                    else{
                        $allmessage = "something went wrong";
                    }
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

        <link rel="stylesheet" href="style/registration.css">
        <title>Customer Registration</title>
    </head>

    <body>

        <div class="container-outerbody">
            <div class="d-flex login-move mt-5 ">
                <p class="create-acc">CREATE ACCOUNT</p>

                <p class="member-acc position-relative">Already a member? <a href="customer-login.php">Login</a></p>
            </div><br>
        </div>

        <div class="container-insidebody mt-3">
            <div class="error"><?php if(isset($allmessage)){echo $allmessage;}?></div>
            <form method="POST" action="">

                <!-- Names -->
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-12 stack">

                        <label>First Name</label>
                        <br>
                        <input type="text" name="firstname" placeholder="Enter Your First Name"
                            value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname']; }?>">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 stack">
                        <label>Middle Name</label>
                        <br>
                        <input type="text" name="middlename" placeholder="Enter Your Middle Name"
                            value="<?php if(isset($_POST['middlename'])){echo $_POST['middlename']; }?>">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 stack">
                        <label>Last Name</label>
                        <br>
                        <input type="text" name="lastname" placeholder="Enter Your Last Name"
                            value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname']; }?>">
                    </div>
                    <div class="error"><?php if(isset($usernameError)){echo $usernameError;}?></div>
                </div>


                <!-- Email -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 stack">
                        <label>Email</label>
                        <br>
                        <input type="text" name="email" placeholder="Enter Your Email"
                            value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>">
                        <div class="error"><?php if(isset($emailError)){echo $emailError;}?></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 stack">
                        <label>Phone number</label>
                        <br>
                        <input type="text" name="number" placeholder="Enter Your Phone Number"
                            value="<?php if(isset($_POST['number'])){ echo $_POST['number'];} ?>">
                        <div class="error"><?php if(isset($numberError)){echo $numberError;}?></div>
                    </div>
                </div>

                <!-- Password-->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 stack">
                        <label>Password</label>
                        <br>
                        <input type="password" name="password" placeholder="Enter Password" value="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 stack">
                        <label>Confirm Password</label>
                        <br>
                        <input type="password" name="repassword" placeholder="Enter Confirm Password" value="">
                    </div>
                    <div class="error"><?php if(isset($passwordError)){echo $passwordError;}?></div>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 stack">
                        <label>Address</label>
                        <br>
                        <input type="text" name="address" placeholder="Enter Your Address"
                            value="<?php if(isset($_POST['address'])){ echo $_POST['address'];} ?>">
                        <div class="error"><?php if(isset($addressError)){echo $addressError;}?></div>
                    </div>
                </div>

                <!-- DOB -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 stack">
                        <label>Date of Birth</label>
                        <br>
                        <input type="text" name="dob" placeholder="Enter Your DOB in MM/DD/YYYY"
                            value="<?php if(isset($_POST['dob'])){echo $_POST['dob']; }?>">
                        <div class="error"><?php if(isset($dobError)){echo $dobError;}?></div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 stack">
                        <label>Gender</label>
                        <br>
                        <select name="gender" id="">
                            <option value="">Choose a gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="other">Others</option>
                        </select>
                        <div class="error"><?php if(isset($genderError)){echo $genderError;}?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 stack">
                        <input type="checkbox" id="terms" name="terms" value="terms">
                        <label for="terms"> Accept our terms and conditions</label><br>
                        <div class="error"><?php if(isset($agreeError)){echo $agreeError;}?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-center stack">
                        <input type="submit" value="Register" name="register">
                    </div>
                </div>
            </form>
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

<?php
    include('../footer/footer.php');
?>
