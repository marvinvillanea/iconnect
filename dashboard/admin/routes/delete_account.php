<?php

session_start();
require_once '../../../config.php';
require_once '../../../functions.php';
require_once '../../../session.php';

 header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    function message($status,$message){
        $msg = array(
            "success" => $status,
            "message" => $message
        );
        echo arraytojson($msg);
        die();
    }

    $id = mysqli_value($con,"id");

    // $select_company = mysqli_query($con,"
    //     SELECT * FROM `tbl_company` WHERE `id` =  $id
    // ");

    // $data = mysqli_fetch_assoc($select_company);

    // $userid = $data["userid"];

    // $delete = mysqli_query($con,"DELETE FROM `tbl_company` WHERE `userid` =  $userid");
    // $delete = mysqli_query($con,"DELETE FROM `tbl_jobs` WHERE `userid` =  $userid");
    // $delete = mysqli_query($con,"DELETE FROM `tbl_resume` WHERE `userid` =  $userid");
    $delete = mysqli_query($con,"DELETE FROM `tbl_accounts` WHERE `id` =  $id");

    if($delete){
        message(true,"Successfully deleted.");
    }else{
        message(false,"Failed to delete the selected job.");
    }
}