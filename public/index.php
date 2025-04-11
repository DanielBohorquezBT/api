<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Dispatcher;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    // Dependency Injector con stack completo
    $di = new FactoryDefault();

    // Servicios
    include APP_PATH . '/config/services.php';

    // Rutas
    include APP_PATH . '/config/router.php';

    // Configuración
    $config = $di->getConfig();

    // Autoloader de namespaces personalizados
    include APP_PATH . '/config/loader.php';

    // Configurar dispatcher para usar namespaces en controladores
    $di->setShared('dispatcher', function () {
        $dispatcher = new Dispatcher();
        $dispatcher->setDefaultNamespace('App\Controllers');
        return $dispatcher;
    });

    // Aplicación
    $application = new Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
