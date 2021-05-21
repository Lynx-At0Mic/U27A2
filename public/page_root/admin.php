<?php
    LoginManager::requireAccess(1);

    $filename = ROOT . DS . 'tmp' . DS . 'logs' . DS . 'sitelog.log';
    $log = fopen($filename, "r");
    $text = fread($log, filesize($filename));
    fclose($log);
?>


<div class="layoutContainer equalContainer center">
    <div class="contentContainer">
        <a id="updatePost" href="<?php echo BASE_URL;?>login/manage">Manage Users</a>
        <h1>Site Statistics</h1>
        <?php
        $numberOfActivities = preg_match_all("/\[Activity]/", $text);
        $numberOfErrors = preg_match_all("/\[Error]/", $text);
        $total = $numberOfErrors + $numberOfActivities;
        $percentOfActivities = ($numberOfActivities / $total) * 100;
        $percentOfErrors = ($numberOfErrors / $total) * 100;
        echo "Number of activities: $numberOfActivities. Number of Errors: $numberOfErrors<br>";
        echo "Error percentage: $percentOfErrors";
        echo "Activity percentage: $percentOfActivities";
        ?>
        <div style="display: flex; flex-direction: row; align-items: flex-start">
            <h5 style="background: red; padding: 2rem; width: <?php echo $percentOfErrors;?>%;"> <?php echo floor($percentOfErrors);?>% Errors</h5>
            <h5 style="background: dodgerblue; padding: 2rem; width: <?php echo $percentOfActivities;?>%;"><?php echo floor($percentOfActivities);?>% Activities</h5>
        </div>
        <h1>Site activity log</h1>
        <textarea cols="80" rows="50"><?php echo $text; ?></textarea>
    </div>
</div>
