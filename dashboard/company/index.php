<?php 
session_start();
require_once '../../config.php';
require_once '../../functions.php';
require_once '../../session.php';

setlocale(LC_MONETARY,"en_US");

if($islogin){
    if($u_type == 2){
        $page = (form("page")) ? value("page") : "dashboard";

        $load_jobs = mysqli_query($con,"SELECT * FROM `tbl_jobs` WHERE userid = $u_id");
        $count_jobs = mysqli_num_rows($load_jobs);

        if(form("manage")){
            $update = true;
            $id = mysqli_value($con,"manage");
            if(is_numeric($id)){
                $manage_Job = mysqli_query($con,"SELECT * FROM `tbl_jobs` WHERE id = $id");
                if(hasResult($manage_Job)){
                    $data = mysqli_fetch_assoc($manage_Job);
                }else{
                    $update = false;
                }
            }else{
                $update = false;
            }
        }else{
            $update = false;
        }

        if(form("filter") && value("sub") == "applicants"){
            $filter = strtolower(mysqli_value($con,"filter"));
            if($filter == "pending"){
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid,tbl_accounts.email, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.companyid = $c_id AND  tbl_applicants.status = 1");
            }elseif($filter == "hired"){
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid,tbl_accounts.email, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.companyid = $c_id AND  tbl_applicants.status = 2");
            }elseif($filter == "declined"){
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.email,tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.companyid = $c_id AND  tbl_applicants.status = 3");
            }else{
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid,tbl_accounts.email, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.companyid = $c_id");
            }


        }else{
            $filter = "all";
            $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.email,tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_accounts.email, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.companyid = $c_id");
        }

        $count_applicants = mysqli_num_rows($load_applicants);
    }else{
        navigate("../../");
    }
}else{
    navigate("../../");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DASHBOARD</title>
    <link rel="icon" href="../../assets/logo.png" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <!-- javascript -->
    <script src="js/index.js" defer></script>
    <script src="js/post_job.js" defer></script>
    <script src="js/edit_job.js" defer></script>
    <script src="js/manage_applicants.js" defer></script>
    <script src="js/update_account.js" defer></script>
    <script src="js/update_general.js" defer></script>
    <script src="js/update_company.js" defer></script>
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="box">
                <a href="../../" class="header_logo">
                    <img src="../../assets/logo.png" alt="logo">
                    <p>LocalMJob</p>
                </a>
                <span></span>
                <div class="navigation">
                    <a href="../../">
                        Home
                    </a>
                    <a href="?page=dashboard">
                        Dashboard
                    </a>
                    <a href="?page=hire">
                        Hire
                    </a>
                </div>
            </div>
            <div class="navigation">
                <button class="btn_user">
                    <i class="fa fa-user"></i>
                </button>
            </div>
        </div>
        <div class="body" id="body_page_<?= $page ?>">
            <div class="profile_box" style="display:none">
                <div class="profile_box_header">
                    <p class="profile_name">
                        <?= $u_fname." ". $u_lname ?>
                    </p>
                    <p class="profile_email">
                        <?= $u_email ?>
                    </p>
                </div>
                <div class="profile_box_body">
                    <a href="./?page=profile">Account Information</a>
                </div>
                <div class="profile_box_footer">
                    <a href="../../logout.php" class="btn_logout">Logout</a>
                </div>
            </div>
            <?php if($page == "dashboard"){?>
                <h2>Hi, <?= $u_fname." ". $u_lname ?> 👋</h2>
                <div class="dashboard">
                    <div class="box">
                        <div class="box_name">
                            Open Jobs
                        </div>
                        <div class="box_count">
                            <?= $count_jobs ?>
                        </div>
                        <a href="./?page=hire&sub=list">
                            VIEW
                        </a>
                    </div>
                    <div class="box">
                        <div class="box_name">
                            Applicants
                        </div>
                        <div class="box_count">
                            <?= $count_applicants ?>
                        </div>
                        <a href="?page=hire&sub=applicants">
                            VIEW
                        </a>
                    </div>
                </div>
            <?php }elseif($page == "hire"){?>
                <?php if(form("sub")){?>
                    <div class="sidebar">
                        <a href="?page=hire&sub=list" <?= (value("sub") == "list") ? 'class="active"' : "" ?>>
                            <i class="fa fa-list"></i>
                            <p class="name">List</p>
                        </a>
                        <a href="?page=hire&sub=postajob" <?= (value("sub") == "postajob") ? 'class="active"' : "" ?>>
                            <i class="fa fa-plus-circle"></i>
                            <p class="name">Jobs</p>
                        </a>
                        <a href="?page=hire&sub=applicants" <?= (value("sub") == "applicants") ? 'class="active"' : "" ?>>
                            <i class="fa fa-users"></i>
                            <p class="name">Applicants</p>
                        </a>
                    </div>
                    <div class="showcase" id="showcase_sub_<?= value("sub") ?>">
                        <?php if(value("sub") == "list"){?>
                            <div class="t1">
                                <h3>Jobs</h3>
                                <p>A list of all the jobs you've advertised.</p>
                            </div>
                            <div class="container">
                                <div class="container_title">
                                    Jobs
                                </div>
                                <div class="container_body">
                                    <?php if(hasResult($load_jobs)){?>
                                        <?php while($row = mysqli_fetch_assoc($load_jobs)){?>
                                            <a href="?page=hire&sub=postajob&manage=<?= $row["id"]?>" class="box">
                                                <div class="text">
                                                    <p class="name"><?= $row['j_name']; ?></p>
                                                    <p class="salary_range"><?= $row["j_currency_symbol"]." ".number_format($row['j_min'])." - ".$row["j_currency_symbol"]." ".number_format($row['j_max']) ?></p>
                                                    <p class="posted_at"><?= date("m/d/Y",strtotime($row["j_created_at"]))?></p>
                                                </div>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        <?php } ?>
                                    <?php }else{?>
                                        <div class="showcase" >
                                            <img src="./assets/empty.png" alt="empty" width="200">
                                            <p>No Job's Found</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }elseif(value("sub") == "postajob"){?>
                            <div class="t1">
                                <h3>Jobs</h3>
                                <p>Post job openings to find employee.</p>
                            </div>
                            <div class="container">
                                <div class="container_title">
                                    <?= ($update) ? "Edit Job description" : "Post a Job" ?>
                                </div>
                                <div class="container_body">
                                    <form method="post" class="<?= ($update) ? "edit_job" : "post_job" ?>">
                                        <?php if($update) {?>
                                            <div class="field">
                                                <input type="text" name="id" value="<?= ($update) ? $data["id"] : "" ?>" readonly>
                                            </div>
                                        <?php }?>
                                        <div class="field">
                                            <input type="text" name="position_name" value="<?= ($update) ? $data["j_name"] : "" ?>" id="position_name" placeholder="Position name">
                                        </div>
                                        <div class="field">
                                            <input type="number" name="position_age" value="<?= ($update) ? $data["j_age"] : "" ?>" id="position_age" placeholder="Qualification age">
                                        </div>
                                        <div class="field">
                                            <input type="number" name="minimum_salary" value="<?= ($update) ? $data["j_min"] : "" ?>"  id="minimum_salary" placeholder="Minimum salary">
                                        </div>
                                        <div class="field">
                                            <input type="number" name="maximum_salary" value="<?= ($update) ? $data["j_max"] : "" ?>" id="maximum_salary" placeholder="Maximum salary">
                                        </div>
                                        <div class="field">
                                            <select name="currency_symbol" id="currency_symbol">
                                                <option value="" <?= ($update) ? "" : "selected" ?> disabled>Currency symbol</option>
                                                <option value="₱" <?= ($update && $data["j_currency_symbol"] == "₱") ? "selected" : "" ?> >PH Peso</option>
                                                <option value="$" <?= ($update && $data["j_currency_symbol"] == "$") ? "selected" : "" ?> >US Dollars</option>
                                            </select>
                                        </div>
                                        <div class="field">
                                            <textarea name="description" class="description" id="content" placeholder="Description"><?= ($update) ? $data["j_description"] : "" ?></textarea>
                                        </div>
                                        <button class="btn_submit">
                                            SAVE
                                        </button>
                                    </form>
                                    <?php if($update) {?>
                                        <button data-id="<?= ($update) ? $data["id"] : "" ?>" class="btn_delete_job">
                                            DELETE
                                        </button>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }elseif(value("sub") == "applicants"){?>
                            <div class="t1">
                                <h3>Applicants</h3>
                                <p>List of all applicants in different positions.</p>
                            </div>
                            <div class="container">
                                <div class="container_title">
                                    <div class="title">
                                        Applicants
                                    </div>
                                    <div class="filter">
                                        <a href="./?page=hire&sub=applicants&filter=all" class="<?= ($filter=="all") ? "active" : "" ?>" >ALL</a>
                                        <a href="./?page=hire&sub=applicants&filter=pending" class="<?= ($filter=="pending") ? "active" : "" ?>">PENDING</a>
                                        <a href="./?page=hire&sub=applicants&filter=hired" class="<?= ($filter=="hired") ? "active" : "" ?>">HIRED</a>
                                        <a href="./?page=hire&sub=applicants&filter=declined" class="<?= ($filter=="declined") ? "active" : "" ?>">DECLINED</a>
                                    </div>
                                </div>
                                <div class="container_body">
                                    <?php if(hasResult($load_applicants)){?>
                                        <?php while($row = mysqli_fetch_assoc($load_applicants)){?>
                                            <div class="box">
                                                <div class="text">
                                                    <p class="j_name">
                                                        <span class="label">Job Title : </span>
                                                        <?= $row['j_name']; ?>
                                                    </p>
                                                        <b><p class="posted_at" style="color:#623ADA;">
                                                        <span class="label">Email : </span>
                                                        <?= $row["email"]?> </b>
                                                    </p>

                                                    <p class="name">
                                                        <span class="label">Full name : </span>
                                                        <?= $row['firstname']; ?> <?= $row['lastname']; ?>
                                                    </p>
                                                    <p class="posted_at">
                                                        <span class="label">Birthday : </span>
                                                        <?= date("m/d/Y",strtotime($row["bday"]))?>
                                                    </p>
                                                    <p class="posted_at">
                                                        <span class="label">Age : </span>
                                                        <?= $row["age"]?>
                                                    </p>
                                                    <p class="address">
                                                        <span class="label">Address : </span>
                                                        <?= $row['address']; ?>
                                                    </p>
                                                    <p class="posted_at">
                                                        <span class="label">Posted at : </span>
                                                        <?= date("m/d/Y",strtotime($row["created_at"]))?>
                                                    </p>
                                                </div>
                                                <div class="box_buttons">
                                                    <?php if($row["status"] == "2") {?>
                                                        <button data-id="<?= $row["id"] ?>" class="button disable btn_hired" disabled>
                                                            <i class="fa fa-check"></i>
                                                            HIRE
                                                        </button>
                                                        <button data-id="<?= $row["id"] ?>" class="button btn_decline">
                                                            <i class="fa fa-times"></i>
                                                            DECLINE
                                                        </button>
                                                        <a href="../../resume/<?= $row["resume"] ?>" class="button" download>
                                                            <i class="fa fa-file-text-o"></i>
                                                            DOWNLOAD RESUME
                                                        </a>


                                                              <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" class="button" download>
                                                            <i class="fa fa-file-text-o"></i>EMAIL CONFIRMATION
                                                        </a>




                                                    <?php }elseif($row["status"] == "3"){?>
                                                        <button data-id="<?= $row["id"] ?>" class="button disable btn_hired" >
                                                            <i class="fa fa-check"></i>
                                                            HIRE
                                                        </button>
                                                        <button data-id="<?= $row["id"] ?>" class="button btn_decline" disabled>
                                                            <i class="fa fa-times"></i>
                                                            DECLINE
                                                        </button>
                                                        <a href="../../resume/<?= $row["resume"] ?>" class="button" download>
                                                            <i class="fa fa-file-text-o"></i>
                                                            DOWNLOAD RESUME
                                                        </a>
                                                    <?php }else{?>
                                                        <button data-id="<?= $row["id"] ?>" class="button btn_hired">
                                                            <i class="fa fa-check"></i>
                                                            HIRE
                                                        </button>
                                                        <button data-id="<?= $row["id"] ?>" class="button btn_decline">
                                                            <i class="fa fa-times"></i>
                                                            DECLINE
                                                        </button>
                                                        <a href="../../resume/<?= $row["resume"] ?>" class="button" download>
                                                            <i class="fa fa-file-text-o"></i>
                                                            DOWNLOAD RESUME
                                                        </a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php }else{?>
                                        <div class="showcase" >
                                            <img src="./assets/empty.png" alt="empty" width="200">
                                            <p>No Applicants's Found</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }else{ navigate("?page=hire&sub=list"); }?>
                    </div>
                <?php }else{ navigate("?page=hire&sub=list"); }?>
            <?php }elseif($page == "profile"){?>
                <?php if(form("sub")){?>
                    <div class="sidebar">
                        <a href="?page=profile&sub=general_information" <?= (value("sub") == "general_information") ? 'class="active"' : "" ?>>
                            <p class="name">General Information</p>
                        </a>
                        <a href="?page=profile&sub=company_information" <?= (value("sub") == "company_information") ? 'class="active"' : "" ?>>
                            <p class="name">Company Information</p>
                        </a>
                        <a href="?page=profile&sub=password" <?= (value("sub") == "password") ? 'class="active"' : "" ?>>
                            <p class="name">Password</p>
                        </a>
                    </div>
                    <div class="content">
                        <div class="showcase" id="showcase_sub_<?= value("sub") ?>">
                            <?php if(value("sub") == "general_information"){?>
                                <div class="container"> 
                                    <div class="container_title">
                                        Avatar
                                    </div>
                                    <div class="container_body body_image">
                                        <img src="../../assets/images/<?= $u_avatar ?>" class="avatar round-image">
                                        <input type="file" name="input_upload_field" id="input_upload_field" class="input_upload_field" data-set="avatar" accept="image/*">
                                        <input 
                                            type="file"
                                            name="input_upload_field"
                                            id="change_avatar"
                                            class="input_upload_field"
                                            data-set="avatar"
                                            data-preview="avatar"
                                            accept="image/*"
                                        >
                                        <br>
                                        <label for="change_avatar" class="btn_upload_picture" >CHANGE AVATAR</label>
                                    </div>
                                </div>
                                <div class="container"> 
                                    <div class="container_title">
                                        Personal information
                                    </div>
                                    <div class="container_body">
                                        <form method="post" class="frm_<?= $page ?>">
                                            <div class="field">
                                                <label for="tb_firstnmae">First name</label>
                                                <input type="text" name="tb_firstname" id="tb_firstname" placeholder="First name" value="<?= $u_fname ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_lastname">Last name</label>
                                                <input type="text" name="tb_lastname" id="tb_lastname" placeholder="Last name" value="<?= $u_lname ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_age">Age</label>
                                                <input type="number" name="tb_age" id="tb_age" placeholder="Age" value="<?= $u_age ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_bday">Birthday</label>
                                                <input type="date" name="tb_bday"  id="tb_bday" value="<?= $u_bday ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_address">Address</label>
                                                <textarea name="tb_address" class="tb_address" id="tb_address" placeholder="Address"><?= $u_address ?></textarea>
                                            </div>
                                            <button class="button btn_submit">
                                                SAVE
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="container_title">
                                        Account settings
                                    </div>
                                    <div class="container_body">
                                        <form method="post" class="frm_<?= $page ?>_account">
                                            <div class="field">
                                                <label for="tb_email">Email</label>
                                                <input type="email" name="tb_email" id="tb_email" placeholder="Email" value="<?= $u_email ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_cnum">Contact number</label>
                                                <input type="number" name="tb_cnum" id="tb_cnum" placeholder="Contact number" value="<?= $u_cnum ?>">
                                            </div>
                                            <button class="button btn_submit">
                                                SAVE
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php }elseif(value("sub") == "company_information"){?>
                                <div class="container"> 
                                    <div class="container_title">
                                        Company Logo
                                    </div>
                                    <div class="container_body body_image">
                                        <img src="../../assets/images/<?= $c_logo ?>" class="company_logo_preview profile_picture">
                                        <input 
                                            type="file"
                                            name="input_upload_field"
                                            id="change_company_logo"
                                            class="input_upload_field"
                                            data-set="company_logo"
                                            data-preview="company_logo_preview"
                                            accept="image/*"
                                        >
                                        <br>
                                        <label for="change_company_logo" class="btn_upload_picture" >CHANGE COMPANY LOGO</label>
                                    </div>
                                </div>
                                <div class="container"> 
                                    <div class="container_title">
                                        Company Banner
                                    </div>
                                    <div class="container_body body_image">
                                        <img src="../../assets/images/<?= $c_banner ?>" class="company_banner_preview profile_picture">
                                        <input 
                                            type="file"
                                            name="input_upload_field"
                                            id="change_company_banner"
                                            class="input_upload_field"
                                            data-set="company_banner"
                                            data-preview="company_banner_preview"
                                            accept="image/*"
                                        >
                                        <br>
                                        <label for="change_company_banner" class="btn_upload_picture" >CHANGE COMPANY BANNER</label>
                                    </div>
                                </div>
                                <div class="container"> 
                                    <div class="container_title">
                                        Company Information
                                    </div>
                                    <div class="container_body">
                                        <form method="post" class="frm_<?= $page ?>_company">
                                            <div class="field">
                                                <label for="tb_name">Company name</label>
                                                <input type="text" name="tb_name" id="tb_name" placeholder="First name" value="<?= $c_name ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_cnum">Contact number</label>
                                                <input type="number" name="tb_cnum" id="tb_cnum" placeholder="Contact number" value="<?= $c_cnum ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_position">Position <br>(your position)</label>
                                                <input type="text" name="tb_position" id="tb_position" placeholder="Position (Your position)" value="<?= $c_position ?>">
                                            </div>
                                            <div class="field">
                                                <label for="tb_address">Address</label>
                                                <textarea name="tb_address" class="tb_address" id="tb_address" placeholder="Address"><?= $c_address ?></textarea>
                                            </div>
                                            <button class="button btn_submit">
                                                SAVE
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php }elseif(value("sub") == "password"){?>
                                <div class="container">
                                    <div class="container_title">
                                        Password
                                    </div>
                                    <div class="container_body">
                                        <form method="post" class="frm_<?= $page ?>_password">
                                            <div class="field">
                                                <label for="tb_pw">Old password</label>
                                                <input type="password" name="tb_pw" id="tb_pw" placeholder="Old password">
                                            </div>
                                            <div class="field">
                                                <label for="tb_newpw">New password</label>
                                                <input type="password" name="tb_newpw" id="tb_newpw" placeholder="New password">
                                            </div>
                                            <div class="field">
                                                <label for="tb_cnewpw">Confirm new password</label>
                                                <input type="password" name="tb_cnewpw" id="tb_cnewpw" placeholder="Confirm new password">
                                            </div>
                                            <button class="button btn_submit">
                                                SAVE
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php }else{ navigate("?page=profile&sub=general_information"); }?>
                        </div>                
                    </div>
                <?php }else{ navigate("?page=profile&sub=general_information"); }?>
            <?php }elseif($page == "settings"){?>    
                4
            <?php }else{ navigate("./"); }?>
        </div>
    </div>
</body>
</html>