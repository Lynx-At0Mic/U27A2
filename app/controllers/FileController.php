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

    function upload(){
        $this->template->render();
    }

    function addFile(){
        if(!LoginManager::loggedIn()){
            $this->setVar('success', false);
            $this->setVar('error', 'Unauthorised');
            $this->template->render();
            return;
        }
        $target_dir = ROOT . DS . "public" . DS . "media" . DS . "uploads";
        $filename = $this->model->registerFile($_SESSION['username'], basename($_FILES['fileToUpload']['name']), $_POST['title'], $_POST['description']);

        if (!$filename){
            $this->setVar('success', false);
            $this->setVar('error', $this->model->getError());
            $this->template->render();
            return;
        }
        $filepath = $target_dir . DS . $filename;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)){
            $this->setVar('success', true);
            $this->setVar('error', null);
            $this->template->render();
        }
        else {
            $this->setVar('success', false);
            $this->setVar('error', 'Error uploading file');
            $this->template->render();
        }
    }
}