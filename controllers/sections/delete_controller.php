<?php

require_once('./models/sections_model.php');

if(!isset($section_id)) {
    require_once('./views/error/error.php');
    return;
}

$foundSection = getSingleSection($section_id);
if(empty($foundSection)){
    require_once('./views/error/error.php');
    return;
}

$done = deleteSingleSection($section_id);

if($done){
    header("location: index.php?v=courses&action=detail&course_id=$course_id");
}

require_once('./views/error/error.php');