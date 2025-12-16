<?php

require_once('./repository/baseRepository.php');
require_once('./models/course_model.php');

    class CourseORM extends BaseORM{
        protected static string $table = 'courses';
        protected static string $entityClass = Course::class; 
    }