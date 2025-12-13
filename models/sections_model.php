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

    $stm = mysqli_prepare($conn, "SELECT s.id, s.course_id, s.title, s.content, s.position, s.created_at, s.updated_at, c.level, c.course_type FROM sections s JOIN courses c ON c.id = s.course_id WHERE s.id = ?;");
    if(!$stm){
        die("get course sections has failed");
    }
    mysqli_stmt_bind_param($stm, 'i', $section_id);
    mysqli_stmt_execute($stm);
    $preresult = mysqli_stmt_get_result($stm);
    return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
}

function insertSingleSection($course_id, $title, $content, $position){
    global $conn;

    $stm = mysqli_prepare($conn, "INSERT INTO sections (course_id, title, content, position) VALUES(?, ?, ?, ?)");
    if(!$stm){
        die("get course sections has failed");
    }
    mysqli_stmt_bind_param($stm, 'issi', $course_id, $title, $content, $position);
    $status = mysqli_stmt_execute($stm);
    mysqli_stmt_close($stm);
    return $status;
}

function deleteSingleSection($section_id){
    global $conn;
    $stm = mysqli_prepare($conn, "DELETE FROM sections WHERE id = ?");
    if(!$stm){
        return false;
    }
    mysqli_stmt_bind_param($stm, "i", $section_id);
    $status = mysqli_stmt_execute($stm);
    mysqli_stmt_close($stm);
    return $status;
}

function getAllPositionOfSections($course_id){
    global $conn;

    $stm = mysqli_prepare($conn, "SELECT position FROM `sections` WHERE course_id = ?;");
    if(!$stm){
        die("get course sections has failed");
    }
    mysqli_stmt_bind_param($stm, 'i', $course_id);
    mysqli_stmt_execute($stm);
    $preresult = mysqli_stmt_get_result($stm);
    return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
}

function updateAsingleSection($title, $content, $section_id){
    global $conn;
    $stm = mysqli_prepare($conn, "UPDATE sections SET title = ? , content = ? WHERE id = ?");
    if(!$stm){
        return false;
    }
    mysqli_stmt_bind_param($stm, "ssi", $title, $content, $section_id);
    $status = mysqli_stmt_execute($stm);
    mysqli_stmt_close($stm);
    return $status;
}