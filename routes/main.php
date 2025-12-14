<?php

require_once('./controllers/courses/controller.php');
require_once('./controllers/sections/controller.php');
require_once('./repository/courseRepository.php');
require_once('./repository/sectionRepository.php');
require_once('./models/course_model.php');
require_once('./models/section_model.php');

$controller = $_GET['v'] ?? "courses";
$course_id = isset($_GET['course_id']) ? (int) $_GET['course_id'] : null;
$section_id = isset($_GET['section_id']) ? (int) $_GET['section_id'] : null;
$action = $_GET['action'] ?? null;
$editMode = false;
$sEditMode = false;
$positionError= null;

switch($controller){
    case "sections":
        require_once("./routes/sections_route.php");
        break;
    default:
        require_once("./routes/courses_route.php");       
}