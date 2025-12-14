<?php

require_once('./models/section_model.php');
require_once('./repository/sectionRepository.php');

if(!isset($section_id)) {
    require_once('./views/error/error.php');
    return;
}

$sections = new SectionORM();
$sectionExist = $sections->findById($section_id);
if(empty($sectionExist)){
    require_once('./views/error/error.php');
    return;
}

$done = $sections->delete($section_id);

if($done){
    header("location: index.php?v=courses&action=detail&course_id=$course_id");
}

require_once('./views/error/error.php');