<?php

namespace App\Controllers;

class IndexController
{
    protected $view;

    public function __construct()
    {
        $this->view = new \Phalcon\Mvc\View(); // Initialize the view property
    }

    public function indexAction()
    {
        // Renderizar la vista por defecto
        $this->view->pick('index', $exercises);
    }
}
