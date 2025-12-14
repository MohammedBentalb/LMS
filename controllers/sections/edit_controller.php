<?php

require_once('./models/section_model.php');
require_once('./repository/sectionRepository.php');



$sections = new SectionORM();
$section = $sections->findById($section_id);
if(!$section) {
    require_once('./views/error/error.php');
    return;
}

$title = htmlspecialchars($_POST['section-title'][0]);
$content = htmlspecialchars($_POST['section-content'][0]);


$done = $sections->update(["title" => $title, "content" => $content, "id" => $section_id]);
if($done) header("Location: index.php\?v=courses&action=detail&course_id=$course_id");