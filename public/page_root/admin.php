<?php
    LoginManager::requireAccess(1);

    $filename = ROOT . DS . 'tmp' . DS . 'logs' . DS . 'sitelog.log';
    $log = fopen($filename, "r");
    $text = fread($log, filesize($filename));
?>

<div class="layoutContainer equalContainer center">
    <div class="contentContainer">
        <h1>Site activity log</h1>
        <textarea cols="80" rows="50"><?php echo $text; ?></textarea>
    </div>
</div>
