<?php

require_once("./models/courses_model.php");
require_once("./models/sections_model.php");

$course = getSingleCourse($course_id);
$courseSections = getCourseSections($course_id);
require_once("./views/courses/course_details.php");