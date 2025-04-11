<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Exercise;

class ExercisesController extends Controller {
    // Mostrar todos los ejercicios
    public function indexAction() {
        $exercise = Exercise::find();
        $this->view->setVar('exercises', $exercise);
    }

    // Mostrar un ejercicio por ID (ej: /exercise/show/1)
    public function showAction($id) {
        $exercise = Exercise::findFirst($id);
        $this->view->exercise = $exercise;
    }

    // Crear un nuevo ejercicio (POST)
    public function createAction() {
        if ($this->request->isPost()) {
            $exercise = new Exercise();
            $exercise->name = $this->request->getPost("name");
            $exercise->description = $this->request->getPost("description");
            
            if ($exercise->save()) {
                $this->flash->success("Ejercicio creado correctamente");
            } else {
                $this->flash->error("Error al crear el ejercicio");
            }
        }
    }

    // Eliminar un ejercicio (DELETE)
    public function deleteAction($id) {
        $exercise = Exercise::findFirst($id);
        if ($exercise && $exercise->delete()) {
            $this->flash->success("Ejercicio eliminado");
        } else {
            $this->flash->error("Error al eliminar");
        }
        return $this->response->redirect("/exercises");
    }
}
