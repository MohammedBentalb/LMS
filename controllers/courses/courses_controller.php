<?php

$action = $_GET['action'] ?? "list";

switch($action){
    case "add":
        require("../brief-7/views/courses/courses_create.php");
        break;
    case "edit":
        require("../brief-7/views/courses/courses_edit.php");
        break;
    case "delete":
        require("../brief-7/views/courses/courses_delete.php");
        break;
    default:
        require("../brief-7/views/courses/index.php");
}