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