<?php


class CommentController extends Controller
{
    function add(){
        if(!@$_POST['comment'] or !@$_POST['post_id']){
            $this->setVar('success', false);
            $this->setVar('error', Util::errorOut('Post vars not set!'));
        }
        elseif(LoginManager::loggedIn()){
            if($this->model->addComment($_POST['post_id'], $_SESSION['username'], $_POST['comment'])){
                $this->setVar('success', true);
                $this->setVar('error', null);
            }
            else{
                $this->setVar('success', false);
                $this->setVar('error', Util::errorOut($this->model->getError()));
            }
        }
        $this->template->render(false);

    }

    function get(){
        if(!@$_POST['post_id']){
            $this->setVar('success', false);
            $this->setVar('error', Util::errorOut('Post vars not set!'));
            $this->setVar('comments', null);
        }
        elseif($comments = $this->model->getComments($_POST['post_id'])){
            $this->setVar('success', true);
            $this->setVar('error', null);
            $this->setVar('comments', $comments);
        }
        else{
            $this->setVar('success', false);
            $this->setVar('error', Util::errorOut('No comments found!', 'No comments yet...'));
            $this->setVar('comments', null);
        }
        $this->template->render(false);
    }
}