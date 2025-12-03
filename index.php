<?php

$controller = $_GET['c'] ?? "courses";
$course_id = $_GET['course_id'] ?? null;

switch($controller){
    case "sections":
        if(is_null($course_id)) {header("Location: index.php");}
        $message = "lsiting sections";
        require("controllers/sections/sections_controller.php");
        break;
    
    default:
        $message = "lsiting courses";
        require("controllers/courses/courses_controller.php");
}