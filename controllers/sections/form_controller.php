<?php
require_once('./models/section_model.php');
require_once('./repository/sectionRepository.php');


$sections = new SectionORM();
$positions = [];

if(is_numeric($course_id)){
    $allSections = $sections->findByForeignKey($course_id);
    
    foreach($allSections as $s){
        $positions = [...$positions, $s->position];
    };
}

$section = null;

if(is_numeric($section_id)){
    $section = $sections->findById($section_id);

    if(empty($section)) {
        require_once('./views/error/error.php');
        return;
    }
    $sEditMode = true;
}

require_once('./views/sections/section_form.php');