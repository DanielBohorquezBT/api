<?php

use Phalcon\Autoload\Loader;

$loader = new Loader();

$loader->setNamespaces([
    'App\Controllers' => APP_PATH . '/controllers/',
    'App\Models' => APP_PATH . '/models/',
]);

$loader->register();