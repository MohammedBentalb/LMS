<?php

namespace Validation;

use ErrorException;
use ReflectionClass;
use Validation\Attributes\DefaultValue;
use Validation\Attributes\Preserve;
use Validation\Attributes\Required;

class EntityValidator{

    public function validator(object $entity){
        $ref = new ReflectionClass($entity);
        $fields = [];
        $placeholders = [];
        $values = [];
        
        foreach($ref->getProperties() as $property){
            if(!$property->getAttributes(Preserve::class)){
                continue;
            } 
            
            $value = $property->getValue($entity);
            $hasDefaults = $property->getAttributes(DefaultValue::class);
            if($value === null && $hasDefaults){
                $value = $hasDefaults[0]->newInstance()->value;
                $property->setValue($entity, $value);
            }

            if($value === null && $property->getAttributes(Required::class)){
                throw new ErrorException("the property {$property->getName()} is required");
            }

            $name = $property->getName();
            $placeholders[] = ":$name";
            $values[$name] = $value;
            $fields[] = $name;
        }

        return [
            "fields" => $fields,
            "values" => $values,
            "placeholders" => $placeholders
        ];
    }
}