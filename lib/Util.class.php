<?php


class Util // class full of static utility methods to make my life easier
{
    static $LoginInvalidMessage = 'Login details are incorrect';

    static function redirect($url=BASE_URL){
        header('Location: ' . $url);
    }

    static function show404error(){
        include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');
        include (ROOT . DS . 'lib' . DS . 'error_pages' . DS . '404.php');
        include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
    }

    static function show403error(){
        include (ROOT . DS . 'lib' . DS . 'error_pages' . DS . '403.php');
        include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
    }

    static function errorOut($devError, $userError='Internal server error occurred', $line=false){
        if(DEVELOPMENT_ENVIRONMENT){
            return $line ? "Line $line: $devError" : $devError;
        }
        else{
            return $userError;
        }
    }

}