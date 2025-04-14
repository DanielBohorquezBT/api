# 🏋️‍♂️ API de Ejercicios — Phalcon + Swagger

## 🚀 Tecnologías necesarias

- **Phalcon** v5
- **PHP** 8.4
- **Composer**

## 🧪 Prueba local


1. Abre tu terminal y navega a la raíz del proyecto.
2. Ejecuta:

```bash
composer install
php -S localhost:8000 -t public/
```

3. Abre tu navegador en: http://localhost:8000/exercises


## 🗃️ Base de datos

1. Ingresa a MySQL desde la consola:

```bash
mysql
```

2. Selecciona la base de datos:

```bash
USE fitness_api;
```

## 📘 Documentación con Swagger

✅ Sintaxis correcta con PHP 8.1+ (Atributos nativos)

```bash
#[OA\Info(
    version: '1.0.0',
    title: 'API de Ejercicios',
    description: 'CRUD de ejercicios usando Phalcon'
)]
```

❌ Forma incorrecta (PHPDoc, ya no recomendada):

```bash
/**
 * @OA\Info(...)
 */
```

## 🏷️ Información obligatoria por controlador

    ⭐️ Coloca estos atributos al inicio de cada controlador:
    
    #[OA\Info(...)]
    - version
    - title
    - description

    #[OA\Tag(...)]
    - name
    - description

    Ejemplo:

    #[OA\Info(
        version: '1.0.0',
        title: 'API de Ejercicios',
        description: 'CRUD de ejercicios usando Phalcon'
    )]

    #[OA\Tag(
        name: 'Ejercicios',
        description: 'Operaciones relacionadas con ejercicios'
    )]

## 🔁 Cómo documentar endpoints

    Ejemplo de un método GET documentado:

    #[OA\Get(                                           //Indica que responde a una solicitud GET HTTP
        path: '/exercises',                             //Define la ruta de la API. En este caso, se refiere a GET /exercises
        summary: 'Obtener todos los ejercicios',        //Una descripción corta y clara de lo que hace este endpoint
        tags: ['Ejercicios'],                           //Sirve para agrupar los endpoints en Swagger UI
        responses: [                                    //Aquí defines qué respuestas puede devolver tu API
            new OA\Response(
                response: 200,
                description: 'Lista de ejercicios'
            )
        ]
    )]


## 🔄 Actualizar archivo swagger.json

    👉 Verifica que tienes Swagger-PHP instalado (opcional y no recomandado en proyectos grandes):

        composer require zircote/swagger-php

    👉 Genera el archivo swagger.json automáticamente (puede variar según la ruta del proyecto):

        ./vendor/bin/openapi app/Controllers --output public/swagger.json
