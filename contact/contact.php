<?php
include('../head/head.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <title>Document</title>
    <style>
    .contact-info {
        height: 352px;
        width: 49%;
    }

    input[type = email], input[type = text]{
        height: 50px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        padding: 5px;
    }

    .pt-6 {
        padding-top: 70px !important;
    }

    .ps-6 {
        padding-left: 80px !important;
    }

    .fa-envelope {
        color: dodgerblue;
    }

    .contact-info {
        font-size: 20px;
    }

    .contact-info a {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="">Contact Us</h3>
                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleFormControlInput1" class="form-label">First Name</label><input type="text"
                            class="form-control" placeholder="Enter you first name" />
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleFormControlInput1" class="form-label">Last Name</label><input type="text"
                            class="form-control" placeholder="Enter you last name" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com" />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Type your Message"></textarea>
                </div>
            </div>

            <div class="contact-info col-md-6 shadow pt-6 ps-6">
                <h3>Contact Information</h3>
                <p class="pt-3">
                    <i class="fas fa-location-arrow"></i> Kathmandu, Nepal
                </p>
                <p><i class="fas fa-phone-square-alt"></i> 9888888888</p>
                <p>
                    <i class="far fa-envelope"></i> <a href=""> Cleckshop@gmail.com </a>
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.814291207813!2d85.31732961504859!3d27.692134082798226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b19295555f%3A0xabfe5f4b310f97de!2sThe%20British%20College%2C%20Kathmandu!5e0!3m2!1sen!2snp!4v1623859759267!5m2!1sen!2snp"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>

<?php 
    include('../footer/footer.php');
?>