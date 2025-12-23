<?php

class Autoload {
    public static function LoadClass(){
        spl_autoload_register(function ($className){
            $file = str_replace('\\', '/', $className) . ".php";
            if(!file_exists($file)){
                throw new ErrorException("$className IS NOT defined !!!!!");
            }
            require_once($file);            
        });
    }
}