<?php

$action = $_GET['action'] ?? "list";

switch($action){
    case "create":
        require("../brief-7/views/sections/sections_create.php");
        break;
    case "edit":
        require("../brief-7/views/sections/sections_edit.php");
        break;
    case "delete":
        require("../brief-7/views/sections/sections_delete.php");
        break;
    default:
        require("../brief-7/views/sections/index.php");
}