<?php
$router = new Phalcon\Mvc\Router();

$router->add("/", [
    "controller" => "index",
    "action" => "index",
]);

// Ruta por defecto para listar ejercicios
$router->add("/exercises", [
    "controller" => "exercises",
    "action"     => "index",
]);

// Ruta para ver un ejercicio específico
$router->add("/exercises/show/{id}", [
    "controller" => "exercises",
    "action"     => "show",
    "id"         => 1, // Ejemplo: /exercises/show/1
]);

return $router;
