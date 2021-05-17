<?php


class File extends Model
{
    function getAllFiles(){
        $result = $this->query("SELECT file_id, user, title, description, filepath FROM files ORDER BY file_id DESC", true);
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
        $result = $this->query("SELECT user, title, description, filepath FROM files WHERE file_id = $id");
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

    function registerFile($user, $filename, $title, $description){
        $result = $this->query("INSERT INTO files (user, title, description, filepath) VALUES ('$user', '$title', '$description', 'tmp')");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }

        $id = $this->get_insert_id();
        $filenameInDB = $id . $filename;

        $result = $this->query("UPDATE files SET filepath = '$filenameInDB' WHERE file_id = $id");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        return $filenameInDB;

    }
}