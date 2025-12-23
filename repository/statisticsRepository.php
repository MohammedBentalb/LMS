<?php

namespace Repository;

use PDO;

class StatisticsRepository extends EntityManager {
    public function getTotalCourses(){
        $stm = $this->pdo->prepare("SELECT COUNT(*) as total_courses FROM courses");
        $stm->execute();
        $result = $stm->fetch();
        return $result;
    }

    public function getTotalUsers(){
        $stm = $this->pdo->prepare("SELECT COUNT(*) as total_users FROM users");
        $stm->execute();
        $result = $stm->fetch();
        return $result;
    }

    public function getAverageSectionPerCourse(){
        $stm = $this->pdo->prepare("SELECT AVG(total_section) as average_section FROM (SELECT c.id, COUNT(*) as total_section FROM courses c JOIN sections s ON s.courseId = c.id GROUP BY c.id) t");
        $stm->execute();
        $result = $stm->fetch();
        return $result;
    }

    public function getMostPopularCourse(){
        $stm = $this->pdo->prepare("SELECT c.* , COUNT(c.id) AS enrollments FROM courses c Join enrollments e on e.courseId = c.id GROUP BY c.id ORDER BY enrollments DESC LIMIT 1");
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getcoursesAnNumberOfEnrollments(){
        $stm = $this->pdo->prepare("SELECT c.id, c.title, c.image, COUNT(c.id) as enrollment FROM courses c JOIN enrollments e ON e.courseId = c.id GROUP BY c.id");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getCoursesWithMoreThan5Sections(){
        $stm = $this->pdo->prepare("SELECT c.*, count(s.id) as sectionsCount FROM courses c JOIN sections s on s.courseId = c.id GROUP BY c.id HAVING sectionsCount > 5");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getCoursesWithNoEnrollments(){
        $stm = $this->pdo->prepare("SELECT c.* FROM courses c LEFT JOIN enrollments e ON e.courseId = c.id WHERE e.id IS NULL");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getLastCourseEnrolledAt(){
        $stm = $this->pdo->prepare("SELECT c.*, MAX(s.enrolled_at) AS last_enrolled FROM courses c JOIN enrollments s ON s.courseId = c.id GROUP by s.id ORDER BY last_enrolled DESC");
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getUsersWithNoInscriptions(){
        $stm = $this->pdo->prepare("SELECT u.* FROM users u LEFT JOIN enrollments e ON e.userId = u.id WHERE e.id IS NULL");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}