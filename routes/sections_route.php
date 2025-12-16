<?php

use ORM\CourseORM;
use ORM\SectionORM;

$sectionController = new SectionController( new CourseORM, new SectionORM);

switch($action){
    case "detail":
        $sectionController->sectionDetail($section_id);
        break;
    case "create":
        $sectionController->sectionCreate($course_id);
        break;
    case "edit":
        $sectionController->sectionEdit($section_id);
        break;
    case "form":
        $sectionController->sectionForm($section_id, $course_id, $sEditMode);
        break;
    case "delete":
        $sectionController->sectionDelete($section_id);
        break;
    default:
        header("Location: index.php");
}