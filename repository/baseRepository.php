<?php

    require_once('./db/connection.php');
    require_once('./models/course_model.php');

    class BaseORM{
        protected PDO $pdo;
        protected static string $table;
        protected static string $entityClass;

        public function __construct() {
            $this->pdo = Database::getConnnection();
        }

        public function findById(int $id): ?object {
            $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id ");
            $stm->execute(["id" => $id]);
            $res = $stm->fetch();
            $class = static::$entityClass;
            return $res ? new $class($res) : null;
            
        }

        public function findAll(): ?array{
            $stm = $this->pdo->prepare("SELECT * FROM " . static::$table);
            $stm->execute();
            $results = $stm->fetchAll();
            $class = static::$entityClass;
            $res = [];
            foreach($results as $data){
                $res = [...$res, new $class($data)];
            }
            return $res;
        }
        
        public function findByForeignKey(int $id){
            // defiined in section orm child
            return null;
        }
        
        public function create(array $data): bool{
            unset($data['id'], $data['created_at'], $data['updated_at']);

            $fields = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_map(function($item){ return ":$item";}, array_keys($data)));
            $request = "INSERT INTO " . static::$table . " ( ". $fields ." ) VALUES ( ". $placeholders ." )";

            $stm = $this->pdo->prepare($request);
            $res = $stm->execute($data);
            return $res;

        }

        public function createMany(array $data): bool{
            $res = false;
            foreach($data as $datum){
                $fields = implode(", ", array_keys($datum));
                $placeholders = implode(", ", array_map(function($item){ return ":$item";}, array_keys($datum)));
                $request = "INSERT INTO " . static::$table . " ( ". $fields ." ) VALUES ( ". $placeholders ." )";

                $stm = $this->pdo->prepare($request);
                $res = $stm->execute($datum);
            }
            return $res;
        }
        
        public function update(array $data): bool{
            $id = $data['id'];
            unset($data['id'], $data['created_at'], $data['updated_at'], $data['course_id']);
            $keys = array_keys($data);
            $updateFields = [];

            foreach($keys as $key){
                $updateFields = [...$updateFields, "$key = :$key"];
            }

            $data = [...$data, "id" => $id];
            $request = "UPDATE " . static::$table . " SET " . implode(", ",$updateFields) . " WHERE id = :id";
            
            $stm = $this->pdo->prepare($request);
            $res = $stm->execute($data);
            return $res;
        }
        
        public function delete(int $id): bool{
            $stm = $this->pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
            $res = $stm->execute(["id" => $id]);
            return $res;
        }
    }

