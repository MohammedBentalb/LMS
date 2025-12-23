<?php

namespace Repository;

use Model\Enrollment;
use Repository\EntityManager;

class EnrollmentsRepo extends EntityManager{
    protected static string $table = 'enrollments';
    protected static string $entityClass = Enrollment::class;
    
    public function isUserEnrolled(int $userId, int $courseId) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE userId = :userId AND courseId = :courseId");
        $stmt->execute(['userId' => $userId, 'courseId' => $courseId]);
        $found = $stmt->fetch();
        return  $found ? new static::$entityClass($found) : null;
    }
}