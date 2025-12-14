<?php

require_once('./models/course_model.php');
require_once('./repository/courseRepository.php');

$course = null;

if(is_numeric($course_id)){
    $courses = new CourseORM();
    $course = $courses->findById($course_id);
    if(empty($course)) {
        require_once('./views/error/error.php');
        return;
    };
    $editMode = true;
};

require_once('./views/courses/course_form.php');