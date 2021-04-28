<?php
spl_autoload_register("autoloader");

function autoloader($className) { // autoload classes from lib, app/controllers, and app/models
    if (file_exists(ROOT . DS . 'lib' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'lib' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
//        die("Could not find class $className");
        Util::show404error();
        die();
    }
}