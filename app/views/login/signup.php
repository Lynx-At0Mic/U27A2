<div class="layoutContainer center">
    <div class="contentContainer roundFull">
        <form id="signupForm" method="post" onkeypress="getEnterKey(event)">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input class="button" type="button" name="submitBtn" value="Signup" onclick="signup()">
        </form>
        <h4 id="errorMessage" class="hidden">Text</h4>
    </div>
</div>
<script src="<?php echo BASE_MEDIA . 'js/login/signup.js'?>"></script>