<?php

require_once("./models/course_model.php");
require_once("./repository/courseRepository.php");

$courses = new CourseORM();
$courseExist = $courses->findById($course_id);

if(!$courseExist){
    require_once('./views/error/error.php');
    return;
}

unlink('./public/images/' . $courseExist->image);
$courses->delete($course_id);
header('Location: index.php');