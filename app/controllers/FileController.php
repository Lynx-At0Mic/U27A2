<?php

class FileController extends Controller{

    private $acceptedFileTypes = ["txt", "gif", "png", "jpeg", "jpg"]; // file types accepted

    function defaultAction(){ // default action site/file
        $rows = $this->model->getAllFiles();
        $this->setVar('files', $rows);
        $this->template->render();
    }

    function view($args){
        $file = $this->model->getFileByID($args[0]);
        $error = $this->model->getError();
        if(!$file and $error === 'fnf'){ // if file not found
            Util::show404error();
        }
        elseif($error !== ''){
            echo $error;
        }
        else{ // else show file post
            $this->setVar('postID', $args[0]);
            $this->setVar('user', $file['user']);
            $this->setVar('filepath', $file['filepath']);
            $this->setVar('postTitle', $file['title']);
            $this->setVar('postDesc', $file['description']);
            $this->template->render();
        }
    }

    function upload(){ // shows upload form
        $this->template->render();
    }

    function addFile(){ // adds file to database and moves it to upload folder
        if(!LoginManager::loggedIn()){ // check user is logged in
            $this->setVar('success', false);
            $this->setVar('error', 'Unauthorised');
            $this->template->render();
            return;
        }
        // check filetype is valid
        $filetype = strtolower(pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION));
        if(!in_array($filetype, $this->acceptedFileTypes)){
            $this->setVar('success', false);
            $this->setVar('error', 'File type not accepted!');
            $this->template->render();
            return;
        }


        $target_dir = ROOT . DS . "public" . DS . "media" . DS . "uploads";
        $filename = $this->model->registerFile($_SESSION['username'], basename($_FILES['fileToUpload']['name']), $_POST['title'], $_POST['description']);

        if (!$filename){ // if database error
            $this->setVar('success', false);
            $this->setVar('error', $this->model->getError());
            $this->template->render();
            return;
        }
        $filepath = $target_dir . DS . $filename;

        // try to move file to uploads folder
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)){
            LogManager::logActivity('File uploaded by user: ' . $_SESSION['username']);
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

    function delete($args){
        LoginManager::requireAccess(2);
        if($this->model->deleteFile($args[0])){
            LogManager::logActivity('Post deleted by user: ' . $_SESSION['username']);
            $this->setVar('success', true);
            $this->setVar('error', null);
            $this->template->render();
        }
        else {
            $this->setVar('success', false);
            $this->setVar('error', $this->model->getError());
            $this->template->render();
        }
    }
}