<?php

require_once("./models/courses_model.php");

deleteSingleCourse($course_id);
header('Location: index.php');