<?php
LoginManager::requireAccess(3);
?>

<div class="layoutContainer center">
    <div class="contentContainer roundFull">
        <form action="<?php echo BASE_URL?>file/addFile" method="post" enctype="multipart/form-data" id="uploadForm">
            Title:
            <input type="text" name="title">
            Description
            <textarea name="description" form="uploadForm" cols="30" rows="5"></textarea>
            File:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</div>

