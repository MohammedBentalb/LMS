<?php

class Autoload {
    public static function LoadClass(){
        spl_autoload_register(function ($className){
            $controlle = explode("/", trim($_SERVER['REQUEST_URI'], "/"))[0];
            $file = "controllers/". $controlle . "/controller.php";
            if(!file_exists($file)){
                throw new ErrorException("CONTROLLER IS NOT THER !!!!!");
            }

            require_once($file);
            require_once('./repository/courseRepository.php');
            require_once('./repository/sectionRepository.php');
            
        });
    }

}