<?php


class LoginManager
{
    static function loggedIn(){
        $cont = new LoginController('login', 'Login', null);
        if($cont->validateToken()){
            return true;
        }
        return false;
    }
}