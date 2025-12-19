<?php

namespace Container;

use ReflectionClass;

class Container{
    
    static array $bindings = [];
    
    public static function get(string $class){
        if(!isset(static::$bindings[$class])){
            return static::$bindings[$class] = new $class(...Container::resolve($class));
        }
        return static::$bindings[$class];
    }

    static function show(){
        return static::$bindings;
    }

    private static function resolve(string $class): array{
        $args = [];
        $reflection = new ReflectionClass($class);
        if($reflection->isInstantiable()){
            $constructor = $reflection->getConstructor();
            foreach($constructor->getParameters() ?: [] as $parameters){
                $type = ($parameters->getType());
                if($type->isBuiltin()) continue;
                $typeClass = $type->getName();
                if(!class_exists($typeClass)) continue;
                $nestedReflection = new ReflectionClass($typeClass);
                if(!$nestedReflection->isInstantiable()) continue;
                $args = [...$args, new $typeClass()];
            }
        }
        return $args;
    } 
}