<?php

namespace Repository;
use Repository\EntityManager;
use Model\Course;
use Validation\EntityValidator;

    class CourseRepository extends EntityManager{
        protected static string $table = 'courses';
        protected static string $entityClass = Course::class; 
    }