<?php


class Util // class full of static utility methods to make my life easier
{
    static $LoginInvalidMessage = 'Login details are incorrect';

    static function redirect($url=BASE_URL){ // redirects the user to the homepage
        header('Location: ' . $url);
    }

    static function show404error(){ // shows 404 error page
        include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');
        include (ROOT . DS . 'lib' . DS . 'error_pages' . DS . '404.php');
        include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
    }

    static function show401error(){ // shows 401 error page
        include(ROOT . DS . 'lib' . DS . 'error_pages' . DS . '401.php');
        include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');
    }

    // shows devError if global variable DEVELOPMENT_ENVIRONMENT is set, else shows generic error or specified generic error
    static function errorOut($devError, $userError='Internal server error occurred', $line=false){
        LogManager::logError($devError);
        if(DEVELOPMENT_ENVIRONMENT){
            return $line ? "Line $line: $devError" : $devError;
        }
        else{
            return $userError;
        }
    }

}