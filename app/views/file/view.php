<?php
LoginManager::requireAccess(3);
echo "<h1>$postName</h1>";
echo "<h4>$postDesc</h4>";
echo "<img src='" . BASE_MEDIA . "uploads/$filepath' width='25%' height='auto'><br>";