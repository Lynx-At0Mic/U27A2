<?php


class LoginManager
{
    private static function getLoginCont(){
        return new LoginController('login', 'Login', null);
    }
    static function loggedIn(){
        $cont = LoginManager::getLoginCont();
        if($cont->validateToken()){
            return true;
        }
        return false;
    }

    static function requireAccess($level){
        $loggedIn = LoginManager::loggedIn();
        if(!$loggedIn or @$_SESSION['access_level'] < $level){
            header('HTTP/1.1 401 Unauthorized', true, 401);
            Util::show401error();
            die();
        }
    }
}