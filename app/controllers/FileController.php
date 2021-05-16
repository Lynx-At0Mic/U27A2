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
            $this->setVar('filepath', $file['filepath']);
            $this->setVar('postName', $file['name']);
            $this->setVar('postDesc', $file['description']);
            $this->template->render();
        }
    }
}