<?php

namespace Core\Routes;

use Service\Container;
use Exception;
use Service\RouteResolver;

class Router{
    public function __construct(private RouteResolver $routeResolver) {}
    private array $routes = [];

    public function add(string $route, string $actions, $options = []){
        $this->routes = [...$this->routes, [$route, $actions, $options]];
    }

    public function dispatch(){
        $path = trim($_SERVER['REQUEST_URI'], "/");
        
        foreach($this->routes as $route){
            if (trim($route[0], '/') === '' && $path === '') {
                $this->routeResolver->execute($route[1], $route[2], null);
                return;
            }

            if (preg_match("#^$route[0]$#", $path)) {
                $this->routeResolver->execute($route[1], $route[2], null);
                return;
            }
        }
        
        $pathWithNoParam = explode('/', $path);
        array_pop($pathWithNoParam);        
        foreach($this->routes as $route){
            $pattern = '#^' . str_replace('{id}', '(\d+)', $route[0]) . '$#';
            if($route[0] == "/") continue;
            if(preg_match($pattern, $path, $match)){
                $pathArray = explode("/", $path);
                $param =  (int) end($pathArray);
                 $this->routeResolver->execute($route[1], $route[2], $param);
                return;
            }
        }
    require_once("./views/error/error.php");   
    }

    public function initialize(){
        $routeLoading = require_once('./core/routes/routeList.php');
        $routeLoading($this);
    }
}