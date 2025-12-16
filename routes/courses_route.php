<?php

$controller = new CoursesControlles(new CourseORM(), new SectionORM());

switch($action){
    case "detail":
        $controller->courseDetails($course_id);
        break;
    case "form":
        $controller->courseForm($course_id, $editMode);
        break;
    case "create":
        $controller->courseCreate($fileError);
        break;
    case "edit":
        $controller->courseEdit($course_id);
        break;
    case "delete":
        $controller->courseDelete($course_id);
        break;
    default:
        $controller->index();
}