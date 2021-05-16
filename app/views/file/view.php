<?php
LoginManager::requireAccess(3);
//echo "<h1>$postName</h1>";
//echo "<h4>$postDesc</h4>";
//echo "<img src='" . BASE_MEDIA . "uploads/$filepath' width='25%' height='auto'><br>";
?>
<div>
    <h1><?php echo $postName; ?></h1>
    <img src='<?php echo BASE_MEDIA . "uploads/$filepath"; ?>' width='25%' height='auto'><br>
    <p><?php echo $postDesc; ?></p>
    <textarea id="commentBox" cols="60" rows="4"></textarea>
    <br>
    <button onclick="addComment(<?php echo $postID ?>)">Submit</button>
    <p id="messageBox"></p>
    <div id="commentArea"></div>
</div>
<script src="<?php echo BASE_MEDIA . 'js/files/comment.js'?>" onload="loadComments(<?php echo $postID ?>)"></script>
