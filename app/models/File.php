<?php


class File extends Model
{
    function getAllFiles(){ // returns all files stored in the database
        $result = $this->query("SELECT file_id, user, title, description, filepath FROM files ORDER BY file_id DESC", true);
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }

        $rows = array();
        while ($row = $result->fetch_assoc()){ // loop over all rows and add to rows variable
            $rows[] = $row;
        }
        return $rows;
    }

    function getFileByID($id){ // gets file by its corresponding id
        $result = $this->query("SELECT user, title, description, filepath FROM files WHERE file_id = $id");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        elseif($this->get_num_rows() === 0){ // if no files with specified id exist
            $this->error = "fnf";
            return false;
        }
        return $result;
    }

    function registerFile($user, $filename, $title, $description){ // adds a new file to the database
        $result = $this->query("INSERT INTO files (user, title, description, filepath) VALUES ('$user', '$title', '$description', 'tmp')");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }

        $id = $this->get_insert_id(); // get id of file added to database
        $filenameInDB = $id . $filename;
        // set filename to the id + original filename
        $result = $this->query("UPDATE files SET filepath = '$filenameInDB' WHERE file_id = $id");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        return $filenameInDB; // return altered filename

    }

    function updateFile($id, $user, $filename, $title, $description){
        $file = $this->getFileByID($id);
        if(!$filename){
            $result = $this->query("UPDATE files SET user='$user', title='$title', description='$description' WHERE file_id='$id'");
            if($result === false){ // if database error
                $this->error = Util::errorOut($this->get_error());
                return false;
            }
            return true;
        }
        else{
            $filenameInDB = $id . $filename;
            // set filename to the id + original filename
            $result = $this->query("UPDATE files SET user='$user', title='$title', description='$description', filepath='$filenameInDB' WHERE file_id='$id'");
            if($result === false){ // if database error
                $this->error = Util::errorOut($this->get_error());
                return false;
            }
            return $filenameInDB; // return altered filename
        }
    }

    function deleteFile($id){
        $result = $this->query("DELETE FROM files WHERE file_id = $id");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        return true;
    }
}