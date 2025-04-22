<?php

use Controllers\HomeController;
require_once '../app/core/Router.php';

$router = new Router;
$router->get('/', [HomeController::class, 'index']);
$router->post('/list', [HomeController::class, 'list']);
$router->post('/types', [HomeController::class, 'types']);
$router->match();