<?php
require_once("./models/courses_model.php");

$courses = getCourses();
require_once("../brief-7/views/courses/index.php");