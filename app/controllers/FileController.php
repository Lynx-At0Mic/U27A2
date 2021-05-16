<?php

class FileController extends Controller{

    function defaultAction(){
        $rows = $this->model->getAllFiles();
        $this->setVar('files', $rows);
        $this->template->render();
    }

    function view($args){
        $file = $this->model->getFileByID($args[0]);
        $error = $this->model->getError();
        if(!$file and $error === 'fnf'){
            Util::show404error();
        }
        elseif($error !== ''){
            echo $error;
        }
        else{
            $this->setVar('postID', $args[0]);
            $this->setVar('user', $file['user']);
            $this->setVar('filepath', $file['filepath']);
            $this->setVar('postTitle', $file['title']);
            $this->setVar('postDesc', $file['description']);
            $this->template->render();
        }
    }
}