<?php

$controller = $_GET['v'] ?? "courses";
$course_id = isset($_GET['course_id']) ? (int) $_GET['course_id'] : null;
$section_id = isset($_GET['section_id']) ? (int) $_GET['section_id'] : null;
$action = $_GET['action'] ?? null;
$editMode = false;


switch($controller){
    case "sections":
        if(is_null($section_id)) {header("Location: index.php");}
        require("./routes/sections_route.php");
        break;
    default:
        require("./routes/courses_route.php");       
}