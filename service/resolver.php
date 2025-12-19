<?php


namespace Service;

use ErrorException;
use ReflectionClass;

class Resolver{

    public function __construct(private Container $container) {}

    public function resolve(string $class){
        $ref = new ReflectionClass($class);

        if(!$ref->isInstantiable()){
            throw new ErrorException("Could not instantiate $class");
        }

        $constructor = $ref->getConstructor();
        if(!$constructor) return new $class();
        
        $args = [];
        foreach($constructor->getParameters() as $parameters){
            
            $type = $parameters->getType();
            if($type && !$type->isBuiltin()){
                $args[] = $this->container::get($type->getName());
                continue;    
            }

            if($parameters->isDefaultValueAvailable()){
                $arga[] = $parameters->getDefaultValue();
                continue;
            }
            throw new ErrorException("Could not resolve this {$type->getName()}");
        }
        return $ref->newInstanceArgs($args);
    }   
}
