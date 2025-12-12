<?php

require_once('./models/courses_model.php');
// check if the course exists (incase of an edite) using the the couusrseid if not show a page error(to be created later with other pages to show when there is no content
$course = null;

if(is_numeric($course_id)){
    $course = getSingleCourse($course_id);
    if(empty($course)) {
        require_once('./views/error/error_edit.php');
        return;
    };
    $editMode = true;
};

require_once('./views/courses/course_form.php');