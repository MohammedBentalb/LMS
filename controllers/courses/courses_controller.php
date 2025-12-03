<?php

require_once("./models/courses_model.php");
$action = $_GET['action'] ?? "list";

switch($action){
    case "detail":
        require("../brief-7/views/courses/course_details.php");
        break;
    case "add":
        require("../brief-7/views/courses/courses_create.php");
        break;
    case "edit":
        require("../brief-7/views/courses/courses_edit.php");
        break;
    case "delete":
        require("../brief-7/views/courses/courses_delete.php");
        break;
    default:
        $courses = getCourses();
        require("../brief-7/views/courses/index.php");
}