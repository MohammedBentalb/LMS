<?php
require_once('./models/section_model.php');
require_once('./models/course_model.php');
require_once('./repository/sectionRepository.php');
require_once('./repository/courseRepository.php');

if(!isset($section_id)) header('Location: index.php');
$courses = new CourseORM();
$sections = new SectionORM();
$section = $sections->findById($section_id);
$course = $courses->findById($section->courseId);

require_once('./views/sections/section_detail.php');