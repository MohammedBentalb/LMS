<?php

require_once("./models/courses_model.php");

$MAXMB = 20;
$fileError = false;
$allowedTypes = [
    'image/jpeg' => 'jpeg',
    'image/jpg' => 'jpg',
    'image/png' => 'png'
];

if(empty($_FILES['course-image']) || $_FILES['course_image']['error'] != 0 || round($_FILES['course-image']['size'] / (1024 * 1024), 2) > $MAXMB || round($_FILES['course-image']['size'] / (1024 * 1024), 2) <= 0 || !key_exists($_FILES['course-image']['type'], $allowedTypes)){
    $fileError = true;
    require_once('./views/courses/course_form.php');
    return;
}

$purename =   preg_replace('/[^a-zA-Z0-9]/', '',pathinfo($_FILES['course-image']['full_path'], PATHINFO_FILENAME));
$newName = time() . "-mohammed-2-" . $purename . '.' . $allowedTypes[ $_FILES['course-image']['type']];

if(!is_dir(__DIR__. '/../../public/images')){
    mkdir(__DIR__.'/../../public/images', 777, true);
};
if(move_uploaded_file($_FILES['course-image']['tmp_name'], __DIR__ . "/../../public/images/" . $newName)){
    $redir = insertSingleCourse($_POST['course-title'], $_POST['course-content'], $_POST['course-level'], $_POST['course-type'], $newName);
    if($redir) header('Location: index.php');
}