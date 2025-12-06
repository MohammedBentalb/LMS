<?php

switch($action){
    case "detail":
        require("./controllers/sections/detail_controller.php");
        break;
    case "create":
        require("./controllers/sections/form_controller.php");        
        break;
    case "edit":
        require("./controllers/sections/form_controller.php");
        break;
    case "delete":
        require("./controllers/sections/delete_controller.php");
        break;
    default:
        require("./controllers/sections/list_contaroller.php");
}