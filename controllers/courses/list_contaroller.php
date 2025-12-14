<?php
require_once('./repository/courseRepository.php');
require_once('./models/course_model.php');

$course = new CourseORM();
$courses = $course->findAll();
require_once("../brief-7/views/courses/index.php");