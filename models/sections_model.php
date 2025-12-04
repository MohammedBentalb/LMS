<?php

require_once("./db/connection.php");

function getCourseSections($course_id){
    global $conn;

    $stm = mysqli_prepare($conn, "SELECT * FROM sections WHERE course_id = ?");
    if(!$stm){
        die("get course sections has failed");
    }
    mysqli_stmt_bind_param($stm, 'i', $course_id);
    mysqli_stmt_execute($stm);
    $preresult = mysqli_stmt_get_result($stm);
    return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
}

function getSingleSection($section_id){
    global $conn;

    $stm = mysqli_prepare($conn, "SELECT * FROM sections WHERE id = ?");
    if(!$stm){
        die("get course sections has failed");
    }
    mysqli_stmt_bind_param($stm, 'i', $section_id);
    mysqli_stmt_execute($stm);
    $preresult = mysqli_stmt_get_result($stm);
    return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
}