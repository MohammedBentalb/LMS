<?php
require_once('./models/sections_model.php');



$section = getSingleSection($section_id);
if(empty($section)) {
    require_once('./views/error/error.php');
    return;
}

$done = updateAsingleSection($_POST['section-title'], $_POST['section-content'], $section_id);
if($done) header("Location: index.php\?v=courses&action=detail&course_id=$course_id");