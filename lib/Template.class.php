<?php


class Template
{
    protected $variables = array();
    protected $controller;
    protected $action;

    function __construct($controller, $action) {
        $this->controller = $controller;
        $this->action = $action;
        if($this->action === 'defaultAction'){$this->action = 'default';}
    }

    function setVar($name, $value) {
        $this->variables[$name] = $value;
    }

    function render($renderHeaders=true) {
        extract($this->variables);

        if(!$renderHeaders){
            include (ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . $this->action . '.php');
            return;
        }

        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . 'header.php')) {
            include (ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . 'header.php');
        } else{include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'header.php');}

        include (ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . $this->action . '.php');

        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . 'footer.php')) {
            include (ROOT . DS . 'app' . DS . 'views' . DS . $this->controller . DS . 'footer.php');
        } else{include (ROOT . DS . 'lib' . DS . 'templates' . DS . 'footer.php');}
    }
}