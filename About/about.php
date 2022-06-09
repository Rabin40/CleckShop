<?php
include('../head/head.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
    .img {
        background-image: url(image/about.jpeg);
        height: 500px;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .pt-6 {
        padding-top: 10%;
    }

    .px-6 {
        padding: 0 10%;
    }

    .member-img img {
        height: 120px;
        width: 120px;
        object-fit: contain;
        border-radius: 50%;
    }

    @media (max-width: 500px) {
        .pt-6 {
            padding-top: 25%;
        }

        .px-6 {
            padding: 0 2%;
        }
    }
    </style>
</head>

<body>
    <section class="About-section">
        <div class="container-fluid p-1 p-sm-3">
            <div class="row">
                <div class="col-12 text-center img mt-5 pt-6">
                    <h1 style="color: white;">About Us</h1>
                    <p class="px-6 fs-5" style="color: white;">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Perspiciatis reiciendis consequatur quam voluptatibus officia
                        dolorum mollitia minima eligendi odio modi explicabo porro facilis
                        sequi temporibus maiores culpa consectetur, tempore expedita?
                    </p>
                </div>
            </div>
        </div>
        <div>
            <p class="px-6 text-center fs-4 text-muted">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi rem
                nisi dignissimos praesentium, quam tempore, cumque autem distinctio
                atque nam quae deleniti, dolor nulla iste ipsum suscipit laborum unde
                voluptate!
            </p>
        </div>
        <div class="container member-img">
            <div class="row justify-content-center">
                <div class="col-md-2 col-sm-3 col-5 text-center mt-5">
                    <img src="image/about.jpeg" alt="" class="img img-fluid" />
                    <h3>Hemanta</h3>
                    <h6>Ceo/Company</h6>
                </div>
                <div class="col-md-2 col-sm-3 col-5 text-center mt-5">
                    <img src="image/about.jpeg" alt="" class="img img-fluid" />
                    <h3>Ayush</h3>
                    <h6>Ceo/Company</h6>
                </div>
                <div class="col-md-2 col-sm-3 col-5 text-center mt-5">
                    <img src="image/about.jpeg" alt="" class="img img-fluid" />
                    <h3>Arbind</h3>
                    <h6>Ceo/Company</h6>
                </div>
                <div class="col-md-2 col-sm-3 col-5 text-center mt-5">
                    <img src="image/about.jpeg" alt="" class="img img-fluid" />
                    <h3>Diwakar</h3>
                    <h6>Ceo/Company</h6>
                </div>
                <div class="col-md-2 col-sm-3 col-5 text-center mt-5">
                    <img src="image/about.jpeg" alt="" class="img img-fluid" />
                    <h3>Rabin</h3>
                    <h6>Ceo/Company</h6>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>

<?php 
    include('../footer/footer.php');
?>