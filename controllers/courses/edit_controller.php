<?php

require_once('./models/courses_model.php');

$foundCourse = getSingleCourse($course_id);

if(empty($foundCourse)){
    require_once('./views/courses/error_edite.php');
    return;
}
$fileError = false;
$image = $foundCourse[0]['image'];
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
    unlink(__DIR__ . "/../../public/images/" . $foundCourse[0]['image']);
}

$editDone = updateSingleCourse($_POST['course-title'], $_POST['course-content'], $_POST['course-level'], $_POST['course-type'], $image, $course_id);
header("location: index.php");