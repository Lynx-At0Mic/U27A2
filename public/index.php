<?php
// BOILERPLATE
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once (ROOT . DS . 'config' . DS . 'config.php'); // get config file for database and server settings
require_once (ROOT . DS . 'lib' . DS . 'autoloader.php'); // setup class autoloader
// END BOILERPLATE

session_start();

$url = $_GET['url']; // get URL path from .htaccess for routing
if(!$url){ // if URL points to base path, load homepage
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');
    include 'page_root/homepage.php';
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
}

else if(file_exists("page_root/$url.php")){ // if URL points to page in page_root folder
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');
    include "page_root/$url.php";
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
}
else{ // if URL points to MVC controller + action + query, verified by .htaccess
    $urlArray = array();
    $mvcArray = array();
    $urlArray = explode("/",$url); // split URL on '/'

    $count = 0;
    foreach ($urlArray as $urlElem){ // seperate query string from MVC controller and action
        if($urlElem === ''){$urlElem = null;}
        if($count === 2){
            array_push($mvcArray, array_slice($urlArray, 2)); // push whole query string onto MVC array without splitting
            break;
        }
        array_push($mvcArray, $urlElem);
        $count++;
    }

    $controller = @$mvcArray[0] ?: die('Something went very wrong :monkaS:');
    array_shift($mvcArray);
    $action = @$mvcArray[0] ?: 'defaultAction';
    array_shift($mvcArray);
    $queryString = count($mvcArray)==0 ? array('default') : $mvcArray;
    $queryString = is_array($queryString) ? $queryString : array($queryString);

//    if(count($queryString) > 1){ // remove extra query items in URL
//        header('Location: '. BASE_URL . "$controller/$action/$queryString[0]");
//    }

//    echo "<p>Controller: $controller, Action: $action, Query: $queryString[0]</p>";

    $controllerName = $controller;
    $controller .= 'Controller';
    $model = rtrim(ucfirst($controllerName), 's'); // strip s from plural
    $dispatch = new $controller($model, $controllerName, $action);

    if (method_exists($controller, $action)) { // if controller with action exists
        call_user_func_array(array($dispatch,$action),$queryString);
    } else { // else show 404 page not found
//        echo "Method $action does not exist in $controller";
        Util::show404error();
    }
}
