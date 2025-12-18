<?php

namespace Repository;
use Repository\EntityManager;
use Model\Course;

    class CourseRepository extends EntityManager{
        protected static string $table = 'courses';
        protected static string $entityClass = Course::class; 
    }