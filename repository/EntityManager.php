<?php

namespace Repository;
use Db\Database;
use FFI\Exception;
use PDO;
use ReflectionClass;
use Validation\EntityValidator;

class EntityManager{
    protected PDO $pdo;
    protected static string $table;
    protected static string $entityClass;
    
    public function __construct(protected EntityValidator $entitiyValidator) {
        $this->pdo = Database::getConnnection();
    }

    public function findById(int $id): ?object {
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id ");
        $stm->execute(["id" => $id]);
        $res = $stm->fetch();
        if($res){
            $entity = new static::$entityClass($res);
            return $entity;
        }
        return null; 
    }

    public function findAll(): ?array{
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table);
        $stm->execute();
        $results = $stm->fetchAll();
        $res = [];
        foreach($results as $data){
            $row = new Static::$entityClass($data);
            $res = [...$res, $row];
        }
        return $res;
    }
    
    public function create(object $entity){
        ["fields" => $fields, "values" => $values, "placeholders" => $placeholders] = $this->entitiyValidator->validator($entity);
       
        $stm = $this->pdo->prepare("INSERT INTO " . static::$table . " ( " . implode(", ", $fields) . " ) VALUES ( " . implode(", ", $placeholders) . " )");
        $results = $stm->execute($values);
        return $results;
    }

    public function createMany(array $data): bool{
        $res = true;
        foreach($data as $entity){
            if(!$res) throw new Exception("something wrong happened in create many EntityManager");
            ["fields" => $fields, "values" => $values, "placeholders" => $placeholders] = $this->entitiyValidator->validator($entity);            
            $stm = $this->pdo->prepare("INSERT INTO " . static::$table . " ( " . implode(", ", $fields) . " ) VALUES ( " . implode(", ", $placeholders) . " )");
            $res = $stm->execute($values);
        }
        return $res;
    }
    
    public function update(object $entity): bool{
        ["fields" => $fields, "values" => $values, "placeholders" => $placeholders] = $this->entitiyValidator->validator($entity);
        $group = [];
        foreach($values as $key => $value){
            $group[] =  "$key = :$key";
        }

        $stm = $this->pdo->prepare("UPDATE " . static::$table . " SET " . implode(", ", $group) . " WHERE id = :id");
        var_dump($values);
        $res = $stm->execute($values);
        return $res;
    }
    
    public function delete(int $id): bool{
        $stm = $this->pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        $res = $stm->execute(["id" => $id]);
        return $res;
    }
}