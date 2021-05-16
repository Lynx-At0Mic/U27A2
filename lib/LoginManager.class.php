<?php


class LoginManager
{
    private static function getLoginCont(){ // returns a login controller instance
        return new LoginController('login', 'Login', null);
    }
    static function loggedIn(){ // returns true if the user is logged in and credentials are valid
        $cont = LoginManager::getLoginCont();
        if($cont->validateToken()){
            return true;
        }
        return false;
    }

    static function requireAccess($level){ // kills process and shows 401 unauthorised if user does not have $level or higher access rights
        $loggedIn = LoginManager::loggedIn();
        if(!$loggedIn or @$_SESSION['access_level'] > $level){ // check user access level
            header('HTTP/1.1 401 Unauthorized', true, 401); // send 401 header
            Util::show401error();
            die();
        }
    }
}