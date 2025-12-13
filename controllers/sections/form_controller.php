<?php
require_once('./models/sections_model.php');
$res = getAllPositionOfSections($course_id);
$positions = [];
$section = null;

foreach($res as $key => $val){
    $positions = [...$positions, $val['position']];
};

if(is_numeric($section_id)){
    $section = getSingleSection($section_id);
    if(empty($section)) {
        require_once('./views/error/error.php');
        return;
    }
    $sEditMode = true;
}

require_once('./views/sections/section_form.php');