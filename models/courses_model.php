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
        $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
        mysqli_stmt_close($stm);
        return $result;
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
        $result = mysqli_fetch_all($preresult, MYSQLI_ASSOC);
        mysqli_stmt_close($stm);
        return $result;
    }
    
    
    function insertSingleCourse($title, $desc, $level, $type, $image){
        global $conn;
        $stm = mysqli_prepare($conn, "INSERT INTO courses (title, description, level, course_type, image) VALUES (?, ?, ?, ?, ?)");
        if(!$stm){
            return false;
        }
        mysqli_stmt_bind_param($stm, "sssss", $title, $desc, $level, $type, $image);
        $status = mysqli_stmt_execute($stm);
        mysqli_stmt_close($stm);
        return $status;
    }

    function updateSingleCourse($title, $desc, $level, $type, $image, $course_id){
        global $conn;
        $stm = mysqli_prepare($conn, "UPDATE  courses SET title = ? , description = ?, level = ? , course_type = ?, image = ? WHERE id = ?");
        if(!$stm){
            return false;
        }
        mysqli_stmt_bind_param($stm, "sssssi", $title, $desc, $level, $type, $image, $course_id);
        $status = mysqli_stmt_execute($stm);
        mysqli_stmt_close($stm);
        return $status;
    }

    function deleteSingleCourse($course_id){
        global $conn;
        $stm = mysqli_prepare($conn, "DELETE FROM courses WHERE id = ?");
        if(!$stm){
            return false;
        }
        mysqli_stmt_bind_param($stm, "i", $course_id);
        $status = mysqli_stmt_execute($stm);
        mysqli_stmt_close($stm);
        return $status;
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