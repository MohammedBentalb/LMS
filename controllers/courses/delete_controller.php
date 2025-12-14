<?php

require_once("./models/courses_model.php");

// get the course image name, to unlink it before deleeting a course

$foundCourse = getSingleCourse($course_id);

if(empty($foundCourse)){
    require_once('./views/error/error.php');
    return;
}
unlink('./public/images/' . $foundCourse[0]['image']);
deleteSingleCourse($course_id);
header('Location: index.php');