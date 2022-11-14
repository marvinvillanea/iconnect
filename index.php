<?php
session_start();
require_once 'config.php';
require_once 'functions.php';
require_once 'session.php';

if($islogin){
    if($u_type == 1){
        navigate("./dashboard/admin");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/logo.png" >
    <title>LocalMJob</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="verify.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <div class="main">
        <?php include 'header.php' ?>
        <div class="body">
            <p class="showcase_title">
                CONNECTING YOU TO THE OPPORTUNITIES
            </p>
            <p class="showcase_p">
                
            </p>
            <a href="<?= ($islogin) ? './jobs' :'./auth?a=join' ?>">
                GET STARTED
            </a>
        </div>
    </div>
</body>
</html>