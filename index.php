<?php

require_once('./core/kernel/autoloading.php');

use Core\Routes\Router;
use Service\Container;

session_start();

Autoload::LoadClass();
$route = Container::get(Router::class);
$route->initialize();
$route->dispatch();
