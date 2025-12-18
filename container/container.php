<?php

class Container{
    public static function get(string $class){
        
    }

    public static function resolve(string $class){
            $reflection = new ReflectionClass($class);
            var_dump($reflection);
            $attr = $reflection->getAttributes();
            echo "<br/>";
            $constructor = $reflection->getConstructor();
            var_dump($constructor->getParameters());
    }
}