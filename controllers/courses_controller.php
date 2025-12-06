<?php

require_once("./models/courses_model.php");
require_once("./models/sections_model.php");
$action = $_GET['action'] ?? "list";

switch($action){
    case "detail":
        $course_id = (int) $_GET['course_id'];
        $course = getSingleCourse($course_id);
        $courseSections = getCourseSections($course_id);
        require("../brief-7/views/courses/course_details.php");
        break;
    case "create":
        require("../brief-7/views/courses/courses_create_and_modify.php");
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