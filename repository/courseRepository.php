<?php

require_once('./repository/baseRepository.php');

    class CourseORM extends BaseORM{
        protected static string $table = 'courses';
        protected static string $entityClass = Course::class; 
    }