<?php

require_once('./core/kernel/autoloading.php');
require_once('./core/routes/Router.php');


Autoload::LoadClass();

$route = new Router();

$route->add("/", "CourseController::index");
$route->add("courses/create", "CourseController::courseCreate");
$route->add("courses/form", "CourseController::courseForm");
$route->add("courses/edit/{id}", "CourseController::courseForm");
$route->add("courses/detail/{id}", "CourseController::courseDetails");
$route->add("courses/delete/{id}", "CourseController::courseDelete");

$route->add("sections/form", "SectionController::sectionForm");
$route->add("sections/Create", "SectionController::sectionCreate");
$route->add("sections/edit/{id}", "SectionController::sectionEdit");
$route->add("sections/detail/{id}", "SectionController::sectionDetail");
$route->add("sections/delete/{id}", "SectionController::sectionDelete");


$route->dispatch();