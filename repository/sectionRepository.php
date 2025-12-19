<?php

namespace Repository;

use Model\Course;
use Repository\EntityManager;
use Model\Section;

class SectionRepository extends EntityManager{
    protected static string $table = 'sections';
    protected static string $entityClass = Section::class;
    
    public function findByForeignKey(Course|Section $entity): ?array{
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE courseId = :id");
        $stm->execute(["id" => $entity->id]);
        $results = $stm->fetchAll();
        $class = static::$entityClass;
        $res = [];
        foreach($results as $data){
            $row = new $class($data['id']);
            $row->hydrate($data);
            $res = [...$res, $row];
        }
        return $results ? $res : null;
    }
}