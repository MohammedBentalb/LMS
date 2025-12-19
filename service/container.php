<?php

namespace Service;

class Container{
    static array $bindings = [];
    public static function get(string $class){
        if(!isset(static::$bindings[$class])){
            return static::$bindings[$class] = (new Resolver(new Container))->resolve($class);
        }
        return static::$bindings[$class];
    }

    static function show(){
        return static::$bindings;
    } 
}