<?php
LoginManager::requireAccess(2);
?>

<div class="layoutContainer center">
    <div class="contentContainer roundFull">
        <form action="<?php echo BASE_URL?>file/updateFile/<?php echo $id?>" method="post" enctype="multipart/form-data" id="uploadForm">
            New title:
            <input type="text" name="title" value="<?php echo $title?>">
            New description
            <textarea name="description" form="uploadForm" cols="30" rows="5"><?php echo $desc?></textarea>
            New file:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Update Post" name="submit">
        </form>
    </div>
</div>