<?php

namespace Repository;
use Repository\EntityManager;
use Model\Course;

    class CourseRepository extends EntityManager{
        protected static string $table = 'courses';
        protected static string $entityClass = Course::class;
        
        public function findCoursesByUserEmail(string $email) {
            $stm = $this->pdo->prepare("SELECT c.* FROM users u JOIN enrollments e ON e.userId = u.id JOIN courses c ON c.id = e.courseId WHERE email = :email");
            $stm->execute(['email' => $email]);
            $res = $stm->fetchAll();
            $entities = [];
            foreach($res as $data){
                $entities[] = new Course($data);
            }
            return $entities;
        }
    }