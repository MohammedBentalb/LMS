<?php

$controller = $_GET['c'] ?? "courses";
$course_id = $_GET['course_id'] ?? null;

switch($controller){
    case "sections":
        if(is_null($course_id)) {header("Location: index.php");}
        require("controllers/sections_controller.php");
        break;
    
    default:
        require("controllers/courses_controller.php");
}