<?php

    require_once('./models/sections_model.php');
    require_once('./models/courses_model.php');
    
    
    if($course_id === null) header("Location: index.php");

    $foundCourse = getSingleCourse($course_id);
    if(!count($foundCourse)) header("Location: index.php");

    $urlArray = explode("/", $_SERVER['HTTP_REFERER']);
    $prevLocation = (end($urlArray));
    

    $titles = $_POST['section-title'];
    $positions = $_POST['section-position'];
    $contents = $_POST['section-content'];
    $good = false;
    $length = min(count($titles), count($contents), count($positions));

    for($i = 0; $i < $length; $i++){
        try{
            $good = insertSingleSection($course_id, $titles[$i], $contents[$i], $positions[$i]);
        }catch(mysqli_sql_exception $e){
            if($e->getCode() === 1062){
                $sections = getCourseSections($course_id);

                $lastPosition = end($sections)['position'] + 1;
                header("Location: {$prevLocation}&last_position=$lastPosition");
            }
        }
    }
    
    if($good) header("Location: index.php?v=coursess&action=detail&course_id=$course_id");