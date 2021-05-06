<div class="layoutContainer center">
    <div class="contentContainer roundFull">
        <form id="loginForm" method="post" onkeypress="getEnterKey(event)">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input class="button" type="button" name="submitBtn" value="Login" onclick="login()">
        </form>
        <h4 id="errorMessage" class="hidden"></h4>
    </div>
</div>
<script src="<?php echo BASE_MEDIA . 'js/login/login.js'?>"></script>