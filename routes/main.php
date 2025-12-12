<?php

$controller = $_GET['v'] ?? "courses";
$course_id = isset($_GET['course_id']) ? (int) $_GET['course_id'] : null;
$section_id = isset($_GET['section_id']) ? (int) $_GET['section_id'] : null;
$action = $_GET['action'] ?? null;
$editMode = false;
$sEditMode = false;
$positionError= null;


switch($controller){
    case "sections":
        require("./routes/sections_route.php");
        break;
    default:
        require("./routes/courses_route.php");       
}