<?php

require_once('./models/course_model.php');
require_once('./repository/courseRepository.php');

$courses = new CourseORM();
$courseExist = $courses->findById($course_id);

if(!$courseExist){
    require_once('./views/error/error.php');
    return;
}

$fileError = false;
$image = $courseExist->image;
$MAXMB = 20;
$allowedTypes = [
    'image/jpeg' => 'jpeg',
    'image/jpg' => 'jpg',
    'image/png' => 'png'
];


if(!empty($_FILES) && $_FILES['course-image']['error'] === 0){
    if(round($_FILES['course-image']['size'] / (1024 * 1024), 2) > $MAXMB || round($_FILES['course-image']['size'] / (1024 * 1024), 2) <= 0 && !key_exists($_FILES['course-image']['type'], $allowedTypes)){
        $fileError = true;
        require_once('./views/courses/course_form.php');
        return;
    } 
    
    $purename =   preg_replace('/[^a-zA-Z0-9]/', '',pathinfo($_FILES['course-image']['full_path'], PATHINFO_FILENAME));
    $image = time() . "-mohammed-2-" . $purename . '.' . $allowedTypes[ $_FILES['course-image']['type']];
    
    if(!is_dir(__DIR__. '/../../public/images')){
        mkdir(__DIR__.'/../../public/images', 777, true);
    };
    move_uploaded_file($_FILES['course-image']['tmp_name'], __DIR__ . "/../../public/images/" . $image);
    unlink(__DIR__ . "/../../public/images/" . $courseExist->image);
}

$title = htmlspecialchars($_POST['course-title']);
$description = htmlspecialchars($_POST['course-content']);
$level = htmlspecialchars($_POST['course-level']);
$type = htmlspecialchars($_POST['course-type']);

$data = ["id" => $course_id, "title" => $title, "description" => $description, "level" => $level, "course_type" => $type, "image" => $image];

$done = $courses->update($data);
header("location: index.php");