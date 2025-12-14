<?php

    require_once('./repository/baseRepository.php');
    
    class SectionORM extends BaseORM{
        protected static string $table = 'sections';
        protected static string $entityClass = Section::class;
        
        public function findByForeignKey(int $id): ?array{
            $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE course_id = :id");
            $stm->execute(["id" => $id]);
            $results = $stm->fetchAll();
            $class = static::$entityClass;
            $res = [];
            foreach($results as $data){
                $res = [...$res, new $class($data)];
            }
            return $results ? $res : null;
        }
    }

