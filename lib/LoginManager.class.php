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
            Util::show403error();
            die();
        }
    }
}