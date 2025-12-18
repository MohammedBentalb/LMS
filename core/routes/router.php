<?php

namespace Core\Routes;

use Exception;
use Reflection;
use ReflectionClass;
use Repository\CourseRepository;
use Repository\SectionRepository;

class Router{
    private static array $routes = [];

    public static function add(string $route, string $actions){
        static::$routes = [...static::$routes, [$route, $actions]];
    }

    public static function dispatch(){
        $path = trim($_SERVER['REQUEST_URI'], "/");
        
        foreach(static::$routes as $route){
            if($path == "" || preg_match("#^$route[0]$#", $path)){
                static::execute($route[1]);
                return;
            }
        }
        
        $pathWithNoParam = explode('/', $path);
        array_pop($pathWithNoParam);
        $secondMatch = implode("/", $pathWithNoParam) . "/{id}";
        
        foreach(static::$routes as $route){
            $pattern = '#^' . str_replace('{id}', '(\d+)', $route[0]) . '$#';
            if($route[0] == "/") continue;
            if(preg_match($pattern, $path, $match)){
                $pathArray = explode("/", $path);
                $param =  (int) end($pathArray);
                static::execute($route[1], $param);
                return;
            }
        }

       throw new Exception("route is not defined");
        
    }

    public static function initialize(){
        require_once('./core/routes/routeList.php');
    }

    public static function execute($call, ?int $param = null ){
        $ClassAndMethod = explode("::", $call);
        $Controller = $ClassAndMethod[0];
        $method= $ClassAndMethod[1];

        call_user_func([new $Controller(new CourseRepository, new SectionRepository), $method], $param);
    }
}