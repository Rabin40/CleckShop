<?php
    session_start();
    unset($_SESSION['trader-login']);
    header('location: ../login.php')



?>
