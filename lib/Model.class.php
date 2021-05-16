<?php


class Model extends Database
{
    protected $model;
    protected $error = "";

    function __construct() {
        parent::__construct();

        $this->model = get_class($this); // gets the name of the model
    }

    function getError(){ // return error and clear the error message
        $error = $this->error;
        $this->error = "";
        return $error;
    }
}