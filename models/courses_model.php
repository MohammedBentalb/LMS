<?php

    require("./db/connection.php");

    function getCourses(){
        global $conn;
        $stm = mysqli_prepare($conn, "SELECT * FROM courses");
        if(!$stm){
            return false;
        }
        
        mysqli_stmt_execute($stm);
        $preresult = mysqli_stmt_get_result($stm);
        return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
    }

    function getSingleCourse($id){
        global $conn;
        $stm = mysqli_prepare($conn, "SELECT * FROM courses where id = ?");
        if(!$stm){
            return false;
        }
        mysqli_stmt_bind_param($stm, "i", $id);
        mysqli_stmt_execute($stm);
        $preresult = mysqli_stmt_get_result($stm);
        return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
    }
    
    
    function insertSingleCourse($title, $desc, $level, $type, $image){
        global $conn;
        $stm = mysqli_prepare($conn, "INSERT INTO courses (title, description, level, course_type, image) VALUES (?, ?, ?, ?, ?)");
        if(!$stm){
            return false;
        }
        mysqli_stmt_bind_param($stm, "sssss", $title, $desc, $level, $type, $image);
        mysqli_stmt_execute($stm);
        return true;
    }

    function updateSingleCourse($title, $desc, $level, $type, $image, $course_id){
        global $conn;
        $stm = mysqli_prepare($conn, "UPDATE  courses SET title = ? , description = ?, level = ? , course_type = ?, image = ? WHERE id = ?");
        if(!$stm){
            return false;
        }
        mysqli_stmt_bind_param($stm, "sssssi", $title, $desc, $level, $type, $image, $course_id);
        mysqli_stmt_execute($stm);
        return true;
    }


    // function getSingleCourseWithSection($id){
    //     global $conn;
    //     $stm = mysqli_prepare($conn, "SELECT c.*, c.id AS course_id, s.*, s.id AS section_id FROM courses c JOIN sections s on c.id = s.course_id WHERE c.id = ?;");
    //     if(!$stm){
    //         return false;
    //     }
    //     mysqli_stmt_bind_param($stm, "i", $id);
    //     mysqli_stmt_execute($stm);
    //     $preresult = mysqli_stmt_get_result($stm);
    //     return $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
    // }