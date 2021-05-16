<?php
if($files) {
    foreach ($files as $file) {
        echo "<img src='" . BASE_MEDIA . "uploads/" . $file['filepath'] . "' width='25%' height='auto'><br>";
    }
}
else{
    echo 'no files';
}