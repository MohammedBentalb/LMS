<?php

require_once('./models/sections_model.php');

if(!isset($_GET['section_id'])) {
    require_once('./views/error/error.php');
    return;
}

$foundSection = getSingleSection($_GET['section_id']);
if(empty($foundSection)){
    require_once('./views/error/error.php');
    return;
}

$done = deleteSingleSection($_GET['section_id']);
if($done){
    header("location: index.php");
}

require_once('./views/error/error.php');