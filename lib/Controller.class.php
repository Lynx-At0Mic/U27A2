<?php


class Controller
{
    protected $model;
    protected $controller;
    protected $action;
    protected $template;

    function __construct($model, $controller, $action) {

        $this->controller = $controller;
        $this->action = $action;
        $this->model = $model;

        $this->model = new $model;
        $this->template = new Template($controller, $action);

    }

    function setVar($name,$value) {
        $this->template->setVar($name,$value);
    }
}