<?php


class Model extends Database
{
    protected $model;

    function __construct() {
        parent::__construct();

        $this->model = get_class($this); // gets the name of the model
    }
}