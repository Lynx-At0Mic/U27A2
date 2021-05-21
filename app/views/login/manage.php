<?php
LoginManager::requireAccess(1);
?>

<div class="layoutContainer">
    <div class="contentContainer">
        <?php
        if(!$error) {
            foreach ($users as $user) { // print list of user to the screen
                echo "<div style='display: flex; flex-direction: row; align-items: center'>";
                echo "<h4 style='margin-right: 4rem;'>ID:" . $user['account_id'] . " Access Level:" . $user['access_level'] . " Username: " . $user['username'] . "</h4>";
                echo "<a id='deletePost' href='" . BASE_URL . "login/removeUser/" . $user['account_id'] . "'>Delete</a>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>
