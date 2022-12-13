<?php
session_start();

require_once '../../config.php';
require_once '../../functions.php';

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_value($con,"email");
    $password = mysqli_value($con,"password");

    function message($status,$message){
        $msg = array(
            "success" => $status,
            "message" => $message
        );
        echo arraytojson($msg);
        die();
    }
    if($email == ""){
        message(false,"Please enter your email.");
    }
    if($password == ""){
        message(false,"Please enter your password.");
    }

    //check if email is already registered
    $check_email = mysqli_query($con,"SELECT * FROM `tbl_accounts` WHERE `email` = '$email' AND `password` = '$password' and status_id = 1 limit 1 ");
    if($check_email) {
        if(hasResult($check_email)){

            $_SESSION["islogin"] = true;
            $_SESSION["data"] = mysqli_fetch_assoc($check_email);
            $data = $_SESSION["data"];
            $u_id = $data["id"];
            mysqli_query($con,"update tbl_accounts set updated_at = now() where id = ".$u_id."   ");
            message(true,"Successful login.");
        }else{
            message(false,"Email and password is not valid, Please try again.");
        }
    }else{
        message(false,"There was a problem with your email address.");
    }
}
?>