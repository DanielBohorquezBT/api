<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // Simulación de datos que podrías recuperar desde la base de datos
        $exercises = [];

        // Pasar los datos a la vista
        $this->view->setVar('exercises', $exercises);

        // Renderizar la vista 'index'
        $this->view->pick('index');
    }
}
