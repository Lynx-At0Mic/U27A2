<?php
// BOILERPLATE
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once (ROOT . DS . 'config' . DS . 'config.php'); // get config file for database and server settings
require_once (ROOT . DS . 'lib' . DS . 'autoloader.php'); // setup class autoloader
// END BOILERPLATE

session_start();

$url = $_GET['url'];
if(!$url){
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');
    include 'page_root/homepage.php';
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
}

else if(file_exists("page_root/$url.php")){
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');
    include "page_root/$url.php";
    include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
}
else{
    $urlArray = array();
    $mvcArray = array();
    $urlArray = explode("/",$url);
//    print_r($urlArray);
//    print_r(array_slice($urlArray, 2));
    $count = 0;
    foreach ($urlArray as $urlElem){
        if($urlElem === ''){$urlElem = null;}
        if($count === 2){
            array_push($mvcArray, array_slice($urlArray, 2));
            break;
        }
        array_push($mvcArray, $urlElem);
        $count++;
    }

//    print_r($mvcArray);

    $controller = $mvcArray[0] ?? die('Something went very wrong :monkaS:');
    array_shift($mvcArray);
    $action = $mvcArray[0] ?? 'defaultAction';
    array_shift($mvcArray);
    $queryString = $mvcArray[0] ?? array('default');

//    if(count($queryString) > 1){ // remove extra query items in URL
//        header('Location: '. BASE_URL . "$controller/$action/$queryString[0]");
//    }

//    echo "<p>Controller: $controller, Action: $action, Query: $queryString[0]</p>";

    $controllerName = $controller;
    $controller .= 'Controller';
    $model = rtrim(ucfirst($controllerName), 's'); // strip s from plural
    $dispatch = new $controller($model, $controllerName, $action);

    if (method_exists($controller, $action)) {
        call_user_func_array(array($dispatch,$action),$queryString);
    } else {
//        echo "Method $action does not exist in $controller";
        Util::show404error();
    }
}
