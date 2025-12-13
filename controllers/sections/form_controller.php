<?php
require_once('./models/sections_model.php');
$res = getAllPositionOfSections($_GET['course_id']);
$positions = [];
foreach($res as $key => $val){
    $positions = [...$positions, $val['position']];
};
$positions = implode(",",$positions);
require_once('./views/sections/section_form.php');