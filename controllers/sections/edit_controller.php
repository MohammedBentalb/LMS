<?php
require_once('./models/sections_model.php');



$section = getSingleSection($section_id);
if(empty($section)) {
    require_once('./views/error/error.php');
    return;
}

$title = htmlspecialchars($_POST['section-title'][0]);
$content = htmlspecialchars($_POST['section-content'][0]);


$done = updateAsingleSection($title, $content, $section_id);
if($done) header("Location: index.php\?v=courses&action=detail&course_id=$course_id");