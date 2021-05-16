<?php
global $url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Purple Sands</title>
    <link rel="stylesheet" href="<?php echo BASE_URL;?>public/media/css/mainStylesheet.css" type="text/css">
    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Noto+Sans+JP&family=Rubik&display=swap" rel="stylesheet">
    <script src="<?php echo BASE_MEDIA;?>js/config/config.js"></script>
    <script src="<?php echo BASE_MEDIA;?>js/site/navigation.js"></script>
</head>
<body>
<nav>
    <div class="showOnMobile">
        <button class="navOpenBtn" onclick="openNav()">☰</button>
    </div>
    <div class="navInnerContainer">
        <ul id="navigationList">
            <!--    <li><a href=""></a></li>    -->
            <a href="javascript:void(0)" class="showOnMobile closebtn" onclick="closeNav()">&times;</a>
            <li><a href="<?php echo BASE_URL;?>">Home</a></li>
            <li><a href="<?php echo BASE_URL . 'file';?>">Browse</a></li>
            <li style="margin-left: auto"><?php
                if(@$_SESSION['username'] and @$_SESSION['token']){
                    echo '<script src="' . BASE_MEDIA . 'js/login/logout.js"></script>';
                    echo '<a onclick="logout()">Logout</a>';
                }
                else{
                    echo '<a href="' . BASE_URL . 'login">Login</a>';
                }
                ?></li>
            <li><a href="<?php echo BASE_URL . 'login/signup';?>">Signup</a></li>
<!--            <li><a href="--><?php //echo BASE_URL . 'login';?><!--">--><?php
//                    if(@$_SESSION['username']){echo "Logged in as " . @$_SESSION['username'];}
//                    else{echo 'Not logged in';}
//                ?><!--</a></li>-->
        </ul>
    </div>
</nav>

