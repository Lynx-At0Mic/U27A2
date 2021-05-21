<?php
LoginManager::requireAccess(1);

if(!$_POST['textArea']){
    die('No Post Var!');
}

$filename = ROOT . DS . 'tmp' . DS . 'logs' . DS . 'sitelog.log';
$log = fopen($filename, "w");
fwrite($log, $_POST['textArea']);
fclose($log);
echo "Log Saved!";
?>