<?php
LoginManager::requireAccess(3);
//echo "<h1>$postName</h1>";
//echo "<h4>$postDesc</h4>";
//echo "<img src='" . BASE_MEDIA . "uploads/$filepath' width='25%' height='auto'><br>";
?>
<div class="layoutContainer center equalContainer">
    <div class="contentContainer">
        <?php if (LoginManager::hasAccess(2)){
            echo "<a id='deletePost' href='" . BASE_URL . "file/delete/$postID'>Delete Post</a>";
            echo "<a id='updatePost' href='" . BASE_URL . "file/update/$postID'>Update Post</a>";
        }?>
        <h1 style="text-align: left"> Title: <?php echo $postTitle; ?></h1>
        <?php
        if(strtolower(pathinfo($filepath,PATHINFO_EXTENSION)) === 'txt') { // if post is a text file display text box with text and not image
            $path = ROOT . DS . "public" . DS . "media" . DS . "uploads" . DS . $filepath;
            $file = fopen($path, "r");
            $text = fread($file, filesize($path));
            echo "<textarea rows=\"40\" cols=\"40\">$text</textarea>";
        }
        else{
            echo "<img src='" . BASE_MEDIA . "uploads/$filepath" . "' width='25%' height='auto'><br>";
        }
        ?>
        <h2 style="text-align: left">Description:</h2>
        <p style="text-align: left; margin-bottom: 5rem;"><?php echo $postDesc; ?></p>
        <h2 style="text-align: left">Write a comment...</h2>
        <textarea id="commentBox" cols="60" rows="4"></textarea>
        <button onclick="addComment(<?php echo $postID ?>)">Submit</button>
        <p id="messageBox"></p>
        <h2 style="text-align: left">Comments</h2>
        <div id="commentArea" style="text-align: left"><h3>Loading Comments...</h3></div>
    </div>
</div>
<script src="<?php echo BASE_MEDIA . 'js/files/comment.js'?>" onload="loadComments(<?php echo $postID ?>)"></script>
