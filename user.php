<?php 
session_start();

if(!isset($_SESSION['email'])) {
    echo "<script>alert('You need to login to continue')</script>";
    header("refresh:1;url=/cuoiki/login.php");
    die();
}

?>