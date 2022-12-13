<?php 

session_start();
require_once '../../../vendor/autoload.php';
require_once '../../../config.php';
require_once '../../../functions.php';
require_once '../../../session.php';

header("Content-Type: application/json");


function message($status,$message){
    $msg = array(
        "success" => $status,
        "message" => $message
    );
    echo arraytojson($msg);
    die();
}
if($islogin){
    $id = mysqli_value($con,"id");
    $action = mysqli_value($con,"action");

    $select_job = mysqli_query($con,"
    SELECT
        tbl_applicants.id,
        tbl_applicants.companyid,
        tbl_applicants.applicantsid,
        tbl_applicants.jobid,
        tbl_company.c_name,
        tbl_company.c_cnum,
        tbl_jobs.j_name,
        tbl_accounts.firstname,
        tbl_accounts.lastname,
        tbl_accounts.cnum
    FROM
        `tbl_applicants`
    INNER JOIN tbl_company ON tbl_company.id = tbl_applicants.companyid
    INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid
    INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid
    WHERE tbl_applicants.id = $id
    ");

    $info = mysqli_fetch_assoc($select_job);
    $fullname = $info["firstname"]." ".$info["lastname"];
    $company_name = $info["c_name"];
    $job_name = $info["j_name"];
    $company_cnum = $info["c_cnum"];
    $cnum = $info["cnum"];

    if($action == "2"){
        $sms_message = 'You`re hired, Hello '.$fullname.', We see your resume and you have good potential for this kind of job '.$job_name.' , Please contact us on '.$company_cnum.'. - '.$company_name.'. And congratulation!....... please be ready for your interview';

        createNotify($con, $info["applicantsid"], $sms_message, 0);
    }elseif($action == "3"){
        $sms_message = 'Hello '.$fullname.', Your application for this position '.$job_name.' was declined - '.$company_name.'.';
        createNotify($con, $info["applicantsid"], $sms_message, 0);
    }

    // clicksend_sms($cnum,$sms_message);
    $details = [
        'to' => $cnum,
        'text' => $sms_message,
    ];
    moviderSentSMS($con,$info["applicantsid"], $details);

    $update_status = mysqli_query($con,"UPDATE `tbl_applicants` SET `status` = $action WHERE `tbl_applicants`.`id` = $id");
    if($update_status){
        message(true,"Successfully updated.");
    }else{
        message(false,"Failed to update the status, Please try again.");
    }
}else{
    message(false,"Auth error");
}
?>