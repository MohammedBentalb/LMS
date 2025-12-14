<?php

    require('./repository/courseRepository.php');
    require('./repository/sectionRepository.php');

    require_once('./models/section_model.php');
    require_once('./models/course_model.php');
    
    
    if($course_id === null) header("Location: index.php");

    $courses = new CourseORM();
    $sections = new SectionORM();
    
    $courseExist = $courses->findById($course_id);
    if(!$courseExist) header("Location: index.php");

    $urlArray = explode("/", $_SERVER['HTTP_REFERER']);
    $prevLocation = (end($urlArray));
    

    $titles = $_POST['section-title'];
    $positions = $_POST['section-position'];
    $contents = $_POST['section-content'];

    $good = false;
    $length = min(count($titles), count($contents), count($positions));

    for($i = 0; $i < $length; $i++){
        try{
            $data = ["course_id" => $course_id, "title" => htmlspecialchars($titles[$i]), "content" => htmlspecialchars($contents[$i]), "position" => htmlspecialchars($positions[$i])];
            $good = $sections->create($data);
        }catch(PDOException $e){
            if($e->errorInfo[1] === 1062){
                $courseSections = $sections->findByForeignKey($course_id);
                $lastPosition = end($courseSections)->position;
                header("Location: {$prevLocation}&last_position=$lastPosition");
            }
        }
    }
    
    if($good) header("Location: index.php?v=coursess&action=detail&course_id=$course_id");