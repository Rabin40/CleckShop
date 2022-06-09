<?php include('../head/head.php');?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="../style/resetpass.css">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 stack">
                            <label>New Password</label>
                            <br>
                            <input type="text">
                        </div>
                    </div>

                    <!-- Confirm Password-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 stack">
                            <label>Confirm Password</label>
                            <br>
                            <input type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center stack">
                            <input type="submit" value="Reset" name="">
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
