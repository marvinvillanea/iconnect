<?php 
session_start();
require_once '../../config.php';
require_once '../../functions.php';
require_once '../../session.php';

setlocale(LC_MONETARY,"en_US");

if($islogin){
    if($u_type == 1){
        $page = (form("page")) ? value("page") : "dashboard";

        $load_jobs = mysqli_query($con,"SELECT * FROM `tbl_jobs`");
        $count_jobs = mysqli_num_rows($load_jobs);

        $load_company = mysqli_query($con,"SELECT * FROM `tbl_company`");
        $count_company = mysqli_num_rows($load_company);

        if(form("manage")){
            $update = true;
            $id = mysqli_value($con,"manage");
            if(is_numeric($id)){
                $manage_Job = mysqli_query($con,"SELECT * FROM `tbl_jobs`");
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
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.status = 1");
            }elseif($filter == "hired"){
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.status = 2");
            }elseif($filter == "declined"){
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid WHERE tbl_applicants.status = 3");
            }else{
                $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid");
            }
        }else{
            $filter = "all";
            $load_applicants = mysqli_query($con,"SELECT tbl_applicants.id, tbl_applicants.applicantsid, tbl_accounts.firstname, tbl_accounts.lastname, tbl_accounts.cnum, tbl_accounts.bday, tbl_accounts.address, tbl_accounts.age, tbl_resume.path AS 'resume', tbl_applicants.companyid, tbl_applicants.jobid, tbl_jobs.j_name, tbl_applicants.status, tbl_applicants.created_at FROM tbl_applicants INNER JOIN tbl_accounts ON tbl_accounts.id = tbl_applicants.applicantsid INNER JOIN tbl_resume ON tbl_resume.userid = tbl_applicants.applicantsid INNER JOIN tbl_jobs ON tbl_jobs.id = tbl_applicants.jobid");
        }

        $count_applicants = mysqli_num_rows($load_applicants);

        if(form("view") && value("sub") == "company"){
            $company_id = mysqli_value($con,"view");

            if(is_numeric($company_id)){
                $validate_company = mysqli_query($con,"
                SELECT
                    tbl_accounts.firstname,
                    tbl_accounts.lastname,
                    tbl_company.*
                FROM
                    `tbl_company`
                INNER JOIN tbl_accounts ON
                    tbl_accounts.id = tbl_company.userid
                WHERE
                    tbl_company.id =  $company_id
                ");
                if(hasResult($validate_company)){
                    $company_view = true;
                    $data = mysqli_fetch_assoc($validate_company);

                    $publisher_name = $data["firstname"]." ".$data["lastname"];
                    $company_name = $data["c_name"];
                    $company_address = $data["c_address"];
                    $company_cnum = $data["c_cnum"];
                    $company_position = $data["c_position"];
                    $company_created_at = $data["created_at"];


                    $load_company_reports = mysqli_query($con,"
                        SELECT
                            tbl_accounts.firstname,
                            tbl_accounts.lastname,
                            tbl_company_reports.*
                        FROM
                            `tbl_company_reports`
                        INNER JOIN tbl_accounts ON
                            tbl_accounts.id = tbl_company_reports.reported_by
                        WHERE
                            `company_id` = $company_id
                    ");
                }else{
                    $company_view = false;
                }
            }else{
                $company_view = false;
            }
        }else{
            $company_view = false;
        }

       

        if(form("filter") && value("sub") == "list" && value("page") == "accounts"){
            $filter = strtolower(mysqli_value($con,"filter"));

            if($filter == "all"){
                $load_accounts = mysqli_query($con,"SELECT * FROM `tbl_accounts`");
            }else{
                function filter($filter){
                    if($filter == "admin"){
                        return 1;
                    }
                    if($filter == "company"){
                        return 2;
                    }
                    if($filter == "client"){
                        return 3;
                    }
                }
    
                $account_type = filter($filter);
    
                $load_accounts = mysqli_query($con,"SELECT * FROM `tbl_accounts` WHERE type = $account_type");
            }
        } elseif(value("sub") == "pending" && value("page") == "accounts"){ 
            $load_accounts = mysqli_query($con,"SELECT * FROM `tbl_accounts` WHERE status_id = 0");
        }
        else{
            $filter = "all";
            $load_accounts = mysqli_query($con,"SELECT * FROM `tbl_accounts`");
        }
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
    <link rel="icon" href="../../assets/peso_logo_one.gif" >
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
    <script src="js/delete_company.js" defer></script>
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="box">
                <a href="../../" class="header_logo">
                    <img src="../../assets/peso_logo_one.gif" alt="logo">
                    <p>CONNECT</p>
                </a>
                <span></span>
                <div class="navigation desktop_icon_profile">
                    <a href="?page=dashboard">
                        Dashboard
                    </a>
                    <a href="?page=hire">
                        Company
                    </a>
                    <a href="?page=accounts">
                        Accounts
                    </a>
                </div>
            </div>
          

            <div class="navigation desktop_icon_profile">
                <button class="btn_user">
                    <i class="fa fa-user"></i>
                </button>
            </div>
            <div class="navigation mobile_icon_profile">
                <button class="btn_user">
                        <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="body" id="body_page_<?= $page ?>">
            <div class="profile_box" style="display:none">
                 <div class="hambuger_menu_desktop">
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
                <div class="hambuger_menu_mobile">
                    <div class="profile_box_footer">
                        <a href="?page=dashboard" class="btn_logout">Dashboard</a>
                    </div>
                    <div class="profile_box_footer">
                        <a href="?page=hire" class="btn_logout">Company</a>
                    </div>
                    <div class="profile_box_footer">
                        <a href="?page=hire&sub=jobs" class="btn_logout">Job's</a>
                    </div>
                    <div class="profile_box_footer">
                        <a href="?page=hire&sub=applicants" class="btn_logout">Applicants</a>
                    </div>
                    <div class="profile_box_footer">
                        <a href="?page=accounts&sub=pending" class="btn_logout">Pending Accounts</a>
                    </div>
                    <div class="profile_box_footer">
                        <a href="?page=accounts" class="btn_logout">Accounts</a>
                    </div>
                    <div class="profile_box_footer">
                        <a href="?page=profile" class="btn_logout">Account Information</a>
                    </div>
                     <div class="profile_box_footer">
                        <a href="./?page=profile&sub=password" class="btn_logout">Password</a>
                    </div>
                     <div class="profile_box_footer">
                        <a href="../../logout.php" class="btn_logout">Logout</a>
                    </div>
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
                        <a href="./?page=hire&sub=jobs">
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
                    <div class="box">
                        <div class="box_name">
                            Companies
                        </div>
                        <div class="box_count">
                            <?= $count_company ?>
                        </div>
                        <a href="?page=hire&sub=company">
                            VIEW
                        </a>
                    </div>
                </div>
            <?php }elseif($page == "hire"){?>
                <?php if(form("sub")){?>
                    <div class="sidebar">
                        <a href="?page=hire&sub=company" <?= (value("sub") == "company") ? 'class="active"' : "" ?>>
                            <i class="fa fa-list"></i>
                            <p class="name">Companies</p>
                        </a>
                        <a href="?page=hire&sub=jobs" <?= (value("sub") == "jobs") ? 'class="active"' : "" ?>>
                            <i class="fa fa-list"></i>
                            <p class="name">Job's</p>
                        </a>
                        <a href="?page=hire&sub=applicants" <?= (value("sub") == "applicants") ? 'class="active"' : "" ?>>
                            <i class="fa fa-users"></i>
                            <p class="name">Applicants</p>
                        </a>
                    </div>
                    <div class="showcase" id="showcase_sub_<?= value("sub") ?>">
                        <?php if(value("sub") == "jobs"){?>
                            <div class="t1">
                                <h3>Jobs</h3>
                                <p>A list of all the jobs.</p>
                            </div>
                            <div class="container">
                                <div class="container_title">
                                    Jobs
                                </div>
                                <div class="container_body">
                                    <?php if(hasResult($load_jobs)){?>
                                        <?php while($row = mysqli_fetch_assoc($load_jobs)){?>
                                            <div class="box">
                                                <div class="text">
                                                    <p class="name"><?= $row['j_name']; ?></p>
                                                    <p class="salary_range">&#8369; <?= number_format($row['j_min']).' - &#8369; '.number_format($row['j_max']) ?></p>
                                                    <p class="posted_at"><?= date("m/d/Y",strtotime($row["j_created_at"]))?></p>
                                                </div>
                                                <!-- <i class="fa fa-angle-right"></i> -->
                                            </div>
                                        <?php } ?>
                                    <?php }else{?>
                                        <div class="showcase" >
                                            <img src="./assets/empty.png" alt="empty" width="200">
                                            <p>No Job's Found</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }elseif(value("sub") == "company"){?>
                            <?php if($company_view){?>
                                <div class="t1">
                                    <h3>Manage Selected Company</h3>
                                </div>
                                <div class="container">
                                    <div class="container_title">
                                        <div class="title">
                                        Company
                                        </div>
                                        <div class="filter">
                                            <a href="./?page=hire&sub=company&view=<?= $company_id?>&action=overview" >OVERVIEW</a>
                                            <a href="./?page=hire&sub=company&view=<?= $company_id?>&action=reports" >REPORTS</a>
                                            <a href="./?page=hire&sub=company&view=<?= $company_id?>&action=delete" >DELETE COMPANY</a>
                                        </div>
                                    </div>
                                    <div class="container_body">
                                        <?php if(form("action")){
                                            $action = value("action");
                                        ?>
                                        <?php if($action == "overview"){?>
                                            <form method="post" style="margin: 1rem" autocomplete="off">
                                                <div class="field">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" name="tb_name" placeholder="Name" value="<?= $company_name ?>" readonly>
                                                </div>
                                                <div class="field">
                                                    <label for="name">Address</label>
                                                    <input type="text" id="name" name="tb_address" placeholder="Address" value="<?= $company_address ?>" readonly>
                                                </div>
                                                <div class="field">
                                                    <label for="name">Contact number</label>
                                                    <input type="text" id="name" name="tb_cnum" placeholder="Contact number" value="<?= $company_cnum ?>" readonly>
                                                </div>
                                                <div class="field">
                                                    <label for="name">Publisher's name</label>
                                                    <input type="text" id="name" name="tb_publisher_name" placeholder="Publisher's name" value="<?= $publisher_name ?>" readonly>
                                                </div>
                                                <div class="field">
                                                    <label for="name">Publisher's position</label>
                                                    <input type="text" id="name" name="tb_publisher_postion" placeholder="Publisher's position" value="<?= $company_position ?>" readonly>
                                                </div>
                                                <div class="field">
                                                    <label for="name">Created at</label>
                                                    <input type="text" id="name" name="tb_created_at" placeholder="Created at" value="<?= date("M d,Y",strtotime($company_created_at)) ?>" readonly>
                                                </div>
                                            </form>
                                        <?php }elseif($action == "reports"){?>
                                            <?php if(hasResult($load_company_reports)){?>
                                            <?php while($row = mysqli_fetch_assoc($load_company_reports)){?>
                                                <div class="box">
                                                    <div class="text">
                                                        <p style="font-size: 2rem; line-height: 2rem; text-transform: uppercase; margin-bottom: .3rem"><?= $row["firstname"]." ".$row["lastname"] ?></p>
                                                        <p style="font-size: .8rem; margin-bottom: 1rem"><?= date("M d,Y",strtotime($row["created_at"])) ?></p>
                                                        <p style="font-size: 1rem"><?= $row['message']; ?></p>
                                                    </div>
                                                    <!-- <i class="fa fa-angle-right"></i> -->
                                                </div>
                                            <?php } ?>
                                            <?php }else{?>
                                                <div class="showcase" >
                                                    <img src="./assets/empty.png" alt="empty" width="200">
                                                    <p>No reports</p>
                                                </div>
                                            <?php } ?>
                                        <?php }elseif($action == "delete"){?>
                                            <div class="showcase">
                                                <p>
                                                    Delete <?= $company_name ?> Company
                                                </p>
                                                <p>
                                                    Warning : This action cannot be undone.
                                                </p>
                                                <button class="btn_delete btn_delete_company" data-id="<?= $company_id ?>"> DELETE</button>
                                            </div>
                                        <?php }else{navigate("./?page=hire&sub=company&view=$company_id&action=overview");}?>
                                        <?php }else{ navigate("./?page=hire&sub=company&view=$company_id&action=overview"); }?>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div class="t1">
                                    <h3>Company</h3>
                                    <p>List of all companies.</p>
                                </div>
                                <div class="container">
                                    <div class="container_title">
                                        Companies
                                    </div>
                                    <div class="container_body">
                                        <?php if(hasResult($load_company)){?>
                                            <?php while($row = mysqli_fetch_assoc($load_company)){?>
                                                <a href="?page=hire&sub=company&view=<?= $row["id"] ?>" class="box">
                                                    <div class="text">
                                                        <p class="name"><?= $row['c_name']; ?></p>
                                                        <p class="salary_range"><?= $row['c_address']; ?></p>
                                                    </div>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            <?php } ?>
                                        <?php }else{?>
                                            <div class="showcase" >
                                                <img src="./assets/empty.png" alt="empty" width="200">
                                                <p>Company not found</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }?>
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
                                                <!-- <div class="box_buttons">
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
                                                </div> -->
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
                        <?php }else{ navigate("?page=hire&sub=company"); }?>
                    </div>
                <?php }else{ navigate("?page=hire&sub=company"); }?>
            <?php }elseif($page == "profile"){?>
                <?php if(form("sub")){?>
                    <div class="sidebar">
                        <a href="?page=profile&sub=general_information" <?= (value("sub") == "general_information") ? 'class="active"' : "" ?>>
                            <p class="name">General Information</p>
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
                                    <div class="container_body">
                                        <img src="../../assets/images/<?= $u_avatar ?>" class="company_logo_preview profile_picture">
                                        <input type="file" name="input_upload_field" id="input_upload_field" class="input_upload_field" data-set="avatar" accept="image/*">
                                        <br>
                                        <label for="input_upload_field" class="btn_upload_picture" >CHANGE AVATAR</label>
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
            <?php }elseif($page == "accounts"){?>    
                <?php if(form("sub")){?>
                    <div class="sidebar">
                        <a href="?page=accounts&sub=list" <?= (value("sub") == "list") ? 'class="active"' : "" ?>>
                            <i class="fa fa-list"></i>
                            <p class="name">List</p>
                        </a>
                        <br>
                         <a href="?page=accounts&sub=pending" <?= (value("sub") == "pending") ? 'class="active"' : "" ?>>
                            <i class="fa fa-list"></i>
                            <p class="name">Pending Accounts</p>
                        </a>
                    </div>
                    <div class="content">
                        <div class="showcase" id="showcase_sub_<?= value("sub") ?>">
                            <?php if(value("sub") == "list"){?>
                                <div class="container">
                                    <div class="container_title">
                                        <div class="title">
                                            Accounts
                                        </div>
                                        <div class="filter">
                                            <a href="./?page=accounts&sub=list&filter=all" class="<?= ($filter=="all") ? "active" : "" ?>" >ALL</a>
                                            <a href="./?page=accounts&sub=list&filter=admin" class="<?= ($filter=="admin") ? "active" : "" ?>">ADMIN</a>
                                            <a href="./?page=accounts&sub=list&filter=company" class="<?= ($filter=="company") ? "active" : "" ?>">COMPANY</a>
                                            <a href="./?page=accounts&sub=list&filter=client" class="<?= ($filter=="client") ? "active" : "" ?>">CLIENT</a>
                                        </div>
                                    </div>
                                    <div class="container_body">
                                        <?php if(hasResult($load_accounts)){?>
                                            <?php while($row = mysqli_fetch_assoc($load_accounts)){?>
                                                <div class="box">
                                                    <div class="text">
                                                        <p class="s_name">
                                                            <span class="label">Full name : </span>
                                                            <?= $row['firstname']; ?> <?= $row['lastname']; ?>
                                                        </p>
                                                        <p class="posted_at">
                                                            <span class="label">Level : </span>
                                                            <?php if($row["type"] == 1){?>
                                                                    Admin
                                                                <?php }elseif($row["type"] == 2){?>
                                                                    Company
                                                                <?php }elseif($row["type"] == 3){?>
                                                                    Client
                                                                <?php }else{ echo "Unknown"; } ?>
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
                                                            <span class="label">Created at : </span>
                                                            <?= date("m/d/Y",strtotime($row["created_at"]))?>
                                                        </p>
                                                        <p class="posted_at">
                                                            <span class="label">Last Login : </span>
                                                            <?= date("m/d/Y",strtotime($row["updated_at"]))?>
                                                        </p>
                                                        <p class="posted_at">
                                                            <span class="label">Status: </span>
                                                            <?php 
                                                            if($row["status_id"] == 0){
                                                                echo "<span style='color:blue'>PENDING</span>";
                                                            }  elseif($row["status_id"] == 1 ){
                                                                echo "<span style='color:green'>ACTIVE</span>";
                                                            } else {
                                                                echo "<span style='color:red'>NOT ACTIVE</span>";
                                                            }
                                                            ?>
                                                        </p>
                                                        <button type="button" id="<?php  echo $row["id"]?>" onclick="deleteAccount(this.id)"  style="color: white; padding:10px; background-color: #36344d; padding-left: 30px; padding-right: 30px;border-radius: 10px;">DELETE</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php }else{?>
                                            <div class="showcase" >
                                                <img src="./assets/empty.png" alt="empty" width="200">
                                                <p>No Job's Found</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }elseif(value("sub") == "company_information"){?>
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
                            <?php }elseif(value("sub") == "manage"){?>
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
                            <?php }elseif(value("sub") == "pending"){?>
                                <div class="container">
                                    <div class="container_title">
                                        <div class="title">
                                            Accounts
                                        </div>
                                    </div>
                                    <div class="container_body">
                                        <?php if(hasResult($load_accounts)){?>
                                            <?php while($row = mysqli_fetch_assoc($load_accounts)){?>
                                                <div class="box">
                                                    <div class="text">
                                                        <p class="s_name">
                                                            <span class="label">Full name : </span>
                                                            <?= $row['firstname']; ?> <?= $row['lastname']; ?>
                                                        </p>
                                                        <p class="posted_at">
                                                            <span class="label">Level : </span>
                                                            <?php if($row["type"] == 1){?>
                                                                    Admin
                                                                <?php }elseif($row["type"] == 2){?>
                                                                    Company
                                                                <?php }elseif($row["type"] == 3){?>
                                                                    Client
                                                                <?php }else{ echo "Unknown"; } ?>
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
                                                            <span class="label">Created at : </span>
                                                            <?= date("m/d/Y",strtotime($row["created_at"]))?>
                                                        </p>
                                                        <p class="posted_at">
                                                            <span class="label">Last Login : </span>
                                                            <?= date("m/d/Y",strtotime($row["updated_at"]))?>
                                                        </p>
                                                        <button type="button" id="<?php  echo $row["id"]?>" onclick="updateAccountStatus(this.id, this.name)" name="3"  style="color: white; padding:10px; background-color: #36344d; padding-left: 30px; padding-right: 30px;border-radius: 10px;">DECLINE</button>
                                                        <button type="button" id="<?php  echo $row["id"]?>" onclick="updateAccountStatus(this.id,this.name)" name="1"   style="color: white; padding:10px; background-color: #36344d; padding-left: 30px; padding-right: 30px;border-radius: 10px;">ACCEPT</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php }else{?>
                                            <div class="showcase" >
                                                <img src="./assets/empty.png" alt="empty" width="200">
                                                <p>No Pending Account</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }else{ navigate("?page=accounts&sub=list"); }?>
                        </div>                
                    </div>
                <?php }else{ navigate("?page=accounts&sub=list"); }?>
            <?php }else{ navigate("./"); }?>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    function updateAccountStatus(id, status){
        // alert(id);
         $.ajax({
            url : "./routes/confirmationStatus.php",
            method: "post",
            data : {
                id : id , status: status
            },
            success: (res) => {
                console.log(res)
                if(res.success){
                    Swal.fire(
                        'Success',
                        `${res.message}`,
                        'success'
                    ) 
                    setTimeout(() => {
                        window.location.href = "?page=accounts&sub=pending"
                    }, 500);
                }else{
                    Swal.fire(
                        'Failed',
                        `${res.message}`,
                        'error'
                    )
                }
            }
        });
        
    }
</script>