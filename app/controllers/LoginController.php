<?php


class LoginController extends Controller
{

    function defaultAction(){
        if(@$_SESSION['username'] and @$_SESSION['token']){
            if($this->model->validateAccessToken($this->model->getUserID($_SESSION['username']), $_SESSION['token'])){
                header('Location: ' . BASE_URL);
            }
            echo $this->model->getError();
        }
        $this->template->render();
    }
    function validateLogin(){
        if($this->model->validateLogin($this->model->getUserID($_POST['username']), $_POST['password'])){
            $this->setVar('validLogin', true);
            $this->setVar('error', null);
            $_SESSION['username'] = $_POST['username'];
            if($token = $this->model->generateAccessToken($this->model->getUserID($_POST['username']))){
                $_SESSION['token'] = $token;
            }
            else{
                $this->setVar('error', $this->model->getError());
            }
        }
        else{
            $this->setVar('validLogin', false);
            $this->setVar('token', null);
            $this->setVar('error', $this->model->getError());
        }
        $this->template->render(false);
    }

    function validateToken(){
        if(!$_SESSION['username'] or !$_SESSION['token'])
        if($this->model->validateAccessToken($this->model->getUserID()))
        $this->template->render(false);
    }

    function signup(){
        $this->model->getUserID(@$_POST['username']);
        $this->template->render();
    }

    function addUser(){
        if($this->model->signUpUser($_POST['username'], $_POST['password'])){
            $this->setVar('success', true);
            $this->setVar('error', null);
        }
        else{
            $this->setVar('success', false);
            $this->setVar('error', $this->model->getError());
        }
        $this->template->render(false);
    }
}