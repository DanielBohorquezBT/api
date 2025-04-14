<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Exercise;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'API de Ejercicios',
    description: 'CRUD de ejercicios usando Phalcon'
)]
#[OA\Tag(
    name: 'Ejercicios',
    description: 'Operaciones relacionadas con ejercicios'
)]
class ExercisesController extends Controller
{
    #[OA\Get(
        path: '/exercises',
        summary: 'Obtener todos los ejercicios',
        tags: ['Ejercicios'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de ejercicios'
            )
        ]
    )]
    public function indexAction()
    {
        $exercise = Exercise::find();
        $this->view->setVar('exercises', $exercise);
    }

    #[OA\Get(
        path: '/exercises/{id}',
        summary: 'Obtener un ejercicio por ID',
        tags: ['Ejercicios'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Ejercicio encontrado'
            ),
            new OA\Response(
                response: 404,
                description: 'Ejercicio no encontrado'
            )
        ]
    )]
    public function showAction($id)
    {
        $exercise = Exercise::findFirst($id);
        $this->view->exercise = $exercise;
    }

    #[OA\Post(
        path: '/exercises',
        summary: 'Crear un nuevo ejercicio',
        tags: ['Ejercicios'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'description'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'description', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Ejercicio creado exitosamente'
            ),
            new OA\Response(
                response: 400,
                description: 'Datos inválidos'
            )
        ]
    )]
    public function createAction()
    {
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

    #[OA\Delete(
        path: '/exercises/{id}',
        summary: 'Eliminar un ejercicio',
        tags: ['Ejercicios'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Ejercicio eliminado correctamente'
            ),
            new OA\Response(
                response: 404,
                description: 'Ejercicio no encontrado'
            )
        ]
    )]
    public function deleteAction($id)
    {
        $exercise = Exercise::findFirst($id);
        if ($exercise && $exercise->delete()) {
            $this->flash->success("Ejercicio eliminado");
        } else {
            $this->flash->error("Error al eliminar");
        }
        return $this->response->redirect("/exercises");
    }
}
