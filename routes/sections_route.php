<?php

switch($action){
    case "detail":
        require("./controllers/sections/detail_controller.php");
        break;
    case "create":
        require("./controllers/sections/create_controller.php");        
        break;
    case "edit":
        require("./controllers/sections/edit_controller.php");
        break;
    case "form":
        require("./controllers/sections/form_controller.php");
        break;
    case "delete":
        require("./controllers/sections/delete_controller.php");
        break;
    default:
        header("Location: index.php");
}