<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Purple Sands</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/media/css/mainStylesheet.css';?>" type="text/css">
    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Noto+Sans+JP&family=Rubik&display=swap" rel="stylesheet">
</head>
<body>
<nav>
    <div class="navInnerContainer">
        <div id="logoContainer">
            <a href="<?php echo BASE_URL;?>" style="display: flex; justify-content: center"><img id="logoImage" src="<?php echo BASE_MEDIA . 'assets/img/logo.png'?>"></a>
        </div>
        <ul id="navigationList">
            <!--    <li><a href=""></a></li>    -->
            <li><a href="<?php echo BASE_URL;?>">Home</a></li>
            <li><a href="<?php echo BASE_URL . 'login';?>">Login</a></li>
            <li><a href="<?php echo BASE_URL . 'login/signup';?>">Signup</a></li>
            <li><a href="<?php echo BASE_URL . 'login';?>"><?php
                    if(@$_SESSION['username']){echo "Logged in as " . @$_SESSION['username'];}
                    else{echo 'Not logged in';}
                ?></a></li>
        </ul>
    </div>
</nav>

