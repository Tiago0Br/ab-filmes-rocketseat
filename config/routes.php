<?php

use Tiagolopes\AbFilmes\Controller\LoginController;
use Tiagolopes\AbFilmes\Utils\Router;

$router = new Router();

$router
    ->get('/', LoginController::class)
    ->run();
