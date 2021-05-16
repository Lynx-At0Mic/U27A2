<?php


class File extends Model
{
    private $error = "";

    function getError(){ // return error and clear the error message
        $error = $this->error;
        $this->error = "";
        return $error;
    }

    function getAllFiles(){
        $result = $this->query("SELECT file_id, name, description, filepath FROM files", true);
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

    function getFileByID($id){
        $result = $this->query("SELECT name, description, filepath FROM files WHERE file_id = $id");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        elseif($this->get_num_rows() === 0){
            $this->error = "fnf";
            return false;
        }
        return $result;
    }
}