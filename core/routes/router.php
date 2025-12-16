<?php

require_once('./repository/courseRepository.php');
require_once('./repository/sectionRepository.php');

class Router{
    private static array $routes = [];

    public function add(string $route, string $actions){
        static::$routes = [...static::$routes, [$route, $actions]];
    }

    public function dispatch(){
        $path = trim($_SERVER['REQUEST_URI'], "/");
        
        foreach(static::$routes as $route){
            if($path == "" || $route[0] === $path){
                 $this->execute($route[1]);
                 return;
            }
        }
        
        $pathWithNoParam = explode('/', $path);
        array_pop($pathWithNoParam);
        $secondMatch = implode("/", $pathWithNoParam) . "/{id}";
        
        foreach(static::$routes as $route){
            if(preg_match("#^(.+)/(\d+)/?$#", $path, $match) && $route[0] === $secondMatch){
                $pathArray = explode("/", $path);
                $param =  (int) end($pathArray);
                $this->execute($route[1], $param);
                return;
            }
        }

        var_dump($path);
    }

    public function execute($call, ?int $param = null ){
        // echo "<br/>";
        // echo "<br/>";
        // var_dump($call);
        //  echo "<br/>";
        //  echo "<br/>";
        //  echo "<br/>";
        // var_dump($param ?: "no params");
        $ClassAndMethod = explode("::", $call);
        $Controller = $ClassAndMethod[0];
        $method= $ClassAndMethod[1];
        call_user_func([new $Controller(new CourseORM(), new SectionORM()), $method], $param);
    }
}