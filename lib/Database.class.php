<?php


class Database
{
    // documenting variable types because i like autocomplete :)
    /* @var mysqli_driver */
    private $conn;
    /* @var mysqli_result */
    private $result;

    function __construct()
    {
        global $db_config; // get variables from config
        $this->conn = new mysqli(
            $db_config->dbHost,
            $db_config->dbUser,
            $db_config->dbPassword,
            $db_config->dbName
        );

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error); // remove error before production release
        }
    }

    function query($sql, $raw=false){
        $this->result = $this->conn->query($sql);
        if(!$this->result){return false;} // return false if error
        if(preg_match("/select/i",$sql) and !$raw){ // return assoc array if query is a select query
            return $this->result->fetch_assoc();
        }
        return $this->result; // else return result
    }

    function get_num_rows() { // returns number of rows result contains
        return $this->result->num_rows;
    }

    function get_insert_id(){ // gets the id of the last record inserted
        return $this->conn->insert_id;
    }

    function free_result(){ // free memory
        $this->result->free_result();
    }

    function get_error(){ // gets error
        return $this->conn->error;
    }
}