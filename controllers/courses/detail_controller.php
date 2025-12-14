<?php

require_once("./models/course_model.php");
require_once("./models/section_model.php");
require_once("./repository/courseRepository.php");
require_once("./repository/sectionRepository.php");

$courses = new CourseORM();
$sections = new SectionORM();

$course = $courses->findById($course_id);
$courseSections = $sections->findByForeignKey($course_id);

if(!$course){
    require_once('./views/error/error.php');
    return;
}
require_once("./views/courses/course_details.php");