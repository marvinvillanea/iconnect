<?php

session_start();
require_once '../../../vendor/autoload.php';
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
    $status = mysqli_value($con,"status");

    $data = mysqli_query($con,"
        SELECT * FROM `tbl_accounts` WHERE `id` =  $id
    ");

    $data = mysqli_fetch_assoc($data);

    // $userid = $data["userid"];

    // $delete = mysqli_query($con,"DELETE FROM `tbl_company` WHERE `userid` =  $userid");
    // $delete = mysqli_query($con,"DELETE FROM `tbl_jobs` WHERE `userid` =  $userid");
    // $delete = mysqli_query($con,"DELETE FROM `tbl_resume` WHERE `userid` =  $userid");
    $change_account = mysqli_query($con,"
            UPDATE
                `tbl_accounts`
            SET
                `status_id` = $status
            WHERE
                `id` = $id
        ");


    if($change_account){
        if($status == "3"){
            $sms_message = 'Hi '.ucwords($data['firstname']).' Your Account has been Accepted by the Administrator.';
        }elseif($status == "1"){
            $sms_message = 'Hi '.ucwords($data['firstname']).' Your Account has been Decline by the Administrator.';
        }

        try {
            $details = [
                'to' => $data["cnum"],
                'text' => $sms_message,
            ];
            moviderSentSMS($con,$data["id"], $details);
        } catch (\Exception $e) {
            
        }

        message(true,"Successfully updated");
    }else{
        message(false,"Failed to update your account.");
    }
   
}