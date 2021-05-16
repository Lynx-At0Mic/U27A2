<?php
//        echo "<a href='" . BASE_URL . "file/view/" . $file['file_id'] ."'><img src='" . BASE_MEDIA . "uploads/" . $file['filepath'] . "' width='25%' height='auto'></a>";
if($files) {
    $count = 3;
    foreach ($files as $file) {
        if($count === 3){echo '</div><div class="layoutContainer">'; $count = 0;}
        else{$count++;}
        ?>

        <div class="contentContainer equalContainer imageBrowser">
            <?php
            echo "<h2>" . $file['title'] . "</h2><h6>By " . $file['user'] . "</h6>";
            echo "<a href='" . BASE_URL . "file/view/" . $file['file_id'] ."'><img src='" . BASE_MEDIA . "uploads/" . $file['filepath'] . "' width='100%' height='auto'></a>";?>
        </div>

    <?php
    }
    while($count != 3){
        echo '<div class="contentContainer equalContainer imageBrowser""></div>';
        $count++;
    }
}
else{
    echo 'no files';
}
?>
</div>