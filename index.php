<?php

require_once('./core/kernel/autoloading.php');

use Core\Routes\Router;

Autoload::LoadClass();
Router::initialize();
Router::dispatch();
