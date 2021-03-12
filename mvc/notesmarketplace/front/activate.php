<?php

session_start();
include 'connection_db.php';

if(isset($_GET['token'])){
    
    $token = $_GET['token'];
    
    $updatequery = "update users set isemailverified = b'1' where token = '$token'";
    $uquery = mysqli_query($conn,$updatequery);
    
    if($uquery){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Your email is verified,please login";
            header('location:login.php');
        }else{
            $_SESSION['msg'] = "You are logged out";
            header('location:login.php');
        }
    }else{
        $_SESSION['msg'] = "email is not verified";
            header('location:signup.php');
    }
}
?> 