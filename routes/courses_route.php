<?php

switch($action){
    case "detail":
        require("./controllers/courses/detail_controller.php");
        break;
    case "form":
        require("./controllers/courses/form_controller.php");
        break;
    case "create":
        require("./controllers/courses/create_controller.php");        
        break;
    case "edit":
        require("./controllers/courses/edit_controller.php");
        break;
    case "delete":
        require("./controllers/courses/delete_controller.php");
        break;
    default:
        require("./controllers/courses/list_contaroller.php");
}