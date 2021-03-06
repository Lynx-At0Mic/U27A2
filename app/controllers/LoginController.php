<?php


class LoginController extends Controller
{

    function defaultAction(){ // shows logon screen default action for the the /login url
        if(@$_SESSION['username'] and @$_SESSION['token']){ // if user is already logged in
            // validate user login credentials
            if($this->model->validateAccessToken($this->model->getUserID($_SESSION['username']), $_SESSION['token'])){
                header('Location: ' . BASE_URL); // redirect to homepage
            }
        }
        $this->template->render(); // render login page
    }

    function validateLogin(){ // take user login info from ajax and validate
        // if login credentials are valid
        if($this->model->validateLogin($this->model->getUserID($_POST['username']), $_POST['password'])){
            $this->setVar('validLogin', true);
            $this->setVar('error', null);
            $_SESSION['username'] = $_POST['username'];
            // get access token for user
            if($token = $this->model->generateAccessToken($this->model->getUserID($_POST['username']))) {
                LogManager::logActivity('User login, user: ' . $_POST['username']);
                $_SESSION['token'] = $token;
            }
            else{ // if there was an error getting the access token
                $this->setVar('error', $this->model->getError());
            }
        }
        else{ // if login credentials are not valid
            LogManager::logError("User login failed to validate. Username: " . $_POST['username']);
            $this->setVar('validLogin', false);
            $this->setVar('token', null);
            $this->setVar('error', $this->model->getError());
        }
        $this->template->render(false);
    }

    function validateToken(){ // if session variables are not set
        if(!@$_SESSION['username'] or !@$_SESSION['token'] or !@$_SESSION['access_level']){
            return false;
        }
        // if user login credentials are valid
        if($this->model->validateAccessToken($this->model->getUserID($_SESSION['username']), $_SESSION['token'])){
            LogManager::logActivity('Validated token for user: ' . $_SESSION['username']);
            return true;
        }
        else{
            return false;
        }
    }

    function signup(){ // signup user
        $this->logout();
        $this->template->render(); // render signup page
    }

    function addUser(){ // adds user
        if(!@$_POST['username'] or !@$_POST['password']){ // if username or password post vars not set
            $this->setVar('success', false);
            $this->setVar('error', null);
        }
        if($this->model->signUpUser($_POST['username'], $_POST['password'])){ // sign up user with username and password
            LogManager::logActivity('User signup using username: ' . $_POST['username']);
            $this->setVar('success', true);
            $this->setVar('error', null);
        }
        else{ // error yikes
            $this->setVar('success', false);
            $this->setVar('error', $this->model->getError());
        }
        $this->template->render(false);
    }

    function logout(){ // unsets session variables which logs out the user
        unset($_SESSION['username']);
        unset($_SESSION['token']);
    }

    function manage(){ // generate list of users for admin panel
        $users = $this->model->getUsers();
        if($users){
            $this->setVar('users', $users);
            $this->setVar('error', null);
        }
        else{
            $this->setVar('users', null);
            $this->setVar('error', $this->model->getError());
        }
        $this->template->render();
    }

    function removeUser($args){
        if(!$this->model->removeUser($args[0])){
            $this->setVar('success', false);
            $this->setVar('error', $this->model->getError());
        }
        else{
            $this->setVar('success', true);
            $this->setVar('error', null);
        }
        $this->template->render();
    }
}