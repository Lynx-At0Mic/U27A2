<?php

define('BASE_URL', 'http://localhost/u27a2/');
define('BASE_MEDIA', 'http://localhost/u27a2/public/media/');

$db_mode = "development";

if($db_mode === "development"){
    define('DEVELOPMENT_ENVIRONMENT', true);
    $db_config = new DatabaseConfig('localhost', 'root', '', 'unit27a2');
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


//$db_config = array(
//    "development" => array(
//        "host" => "localhost",
//        "name" => "unit27a2",
//        "user" => "root",
//        "password" => ""
//    ),
//    "production" => array(
//        "host" => "PROD_HOST",
//        "name" => "PROD_DB",
//        "user" => "PROD_USER",
//        "password" => "PROD_PASSWORD"
//    )
//);