<?php

define('BASE_URL', 'PATH TO SITE ROOT HERE/');
define('BASE_MEDIA', BASE_URL . 'public/media/');

$db_mode = "development";

if($db_mode === "development"){
    define('DEVELOPMENT_ENVIRONMENT', true);
    $db_config = new DatabaseConfig('HOST', 'USER', 'PASSWORD', 'DATABASE');
}
else{
    define('DEVELOPMENT_ENVIRONMENT', false);
    $db_config = new DatabaseConfig('PROD_HOST', 'PROD_USER', 'PROD_PASSWORD', 'PROD_DB');
}

class DatabaseConfig
{
    public $dbHost;
    public $dbUser;
    public $dbPassword;
    public $dbName;

    public function __construct($host, $user, $password, $name)
    {
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPassword = $password;
        $this->dbName = $name;
    }
}
