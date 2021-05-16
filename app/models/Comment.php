<?php


class Comment extends Model
{
    function addComment($postID, $user, $comment){
        if(!$result = $this->query("INSERT INTO comments (post_id, user, text) VALUES ('$postID', '$user', '$comment')")){
            $this->error  = Util::errorOut($this->get_error());
            return false;
        }
        return true;
    }

    function getComments($postID){
        $result = $this->query("SELECT user, text, time FROM comments WHERE post_id = $postID ORDER BY time DESC", true);
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }

        $rows = array();
        while ($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
}