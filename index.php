<?php

// FRONT CONTROLLER

session_start();

// 1. Подключение файлов
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

// 2. Вызов Router
$router = new Router();
$router->run();