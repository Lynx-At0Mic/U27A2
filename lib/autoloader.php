<?php
spl_autoload_register("autoloader");

function autoloader($className) { // autoload classes from lib, app/controllers, and app/models
    if (file_exists(ROOT . DS . 'lib' . DS . $className . '.class.php')) {
        require_once(ROOT . DS . 'lib' . DS . $className . '.class.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    } else {
//        die("Could not find class $className");
        Util::show404error();
        die();
    }
}