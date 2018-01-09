<?php

error_reporting(E_ALL);

require_once __DIR__ . '/components/Autoloader.php';
$autoload = new \components\Autoloader(__DIR__);
spl_autoload_register([$autoload, 'load']);

$config = require_once __DIR__ . '/config.php';
echo (new \components\Application($config))->run();
