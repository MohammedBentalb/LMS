<?php

namespace Repository;

use Repository\EntityManager;
use Model\Section;

class SectionRepository extends EntityManager{
    protected static string $table = 'sections';
    protected static string $entityClass = Section::class;
    
    public function findByForeignKey(int $id): ?array{
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE courseId = :id");
        $stm->execute(["id" => $id]);
        $results = $stm->fetchAll();
        $class = static::$entityClass;
        $res = [];
        foreach($results as $data){
            $row = new $class($data);
            $res = [...$res, $row];
        }
        return $results ? $res : null;
    }
}