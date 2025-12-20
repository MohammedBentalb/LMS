<?php

namespace Repository;
use Db\Database;
use PDO;
use ReflectionClass;

class EntityManager{
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
    
    public function create(object $entity): bool{
        $keys = [];
        $values = [];

        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();
        foreach($properties as $prop){
            $name = $prop->getName();
            if (in_array($name, ['id', 'createdAt', 'updatedAt'], true)) continue;
            $keys[] = $name;
            $values[$name] = $prop->getValue($entity);
        }

        $fields = "( " . implode(", ", $keys) . " )";
        $placeholders = "( :" . implode(", :", $keys) . " )";

        $stm = $this->pdo->prepare("INSERT INTO " . static::$table . " " . $fields . " VALUES " . $placeholders);
        $results = $stm->execute($values);
        return $results;
    }

    public function createMany(array $data): bool{
        $keys = [];
        $values = [];
        foreach($data as $entity){
            $reflection = new ReflectionClass($entity);
            $properties = $reflection->getProperties();

            foreach($properties as $prop){
                $name = $prop->getName();
                if (in_array($name, ['id', 'createdAt', 'updatedAt'], true)) continue;
                $keys[] = $name;
                $values[$name] = $prop->getValue($entity);
            }

            $fields = "( " . implode(", ", $keys) . " )";
            $placeholders = "( :" . implode(", :", $keys) . " )";
            
            $stm = $this->pdo->prepare("INSERT INTO " . static::$table . " " . $fields . " VALUES " . $placeholders);
            $res = $stm->execute($values);
        }
        return $res;
    }
    
    public function update(object $entity): bool{
        $values = [];
        $placeholders = [];

        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();

        foreach($properties as $prop){
            $name = $prop->getName();
            if (in_array($name, ['createdAt', 'updatedAt'], true)) continue;
            $values[$prop->getName()] = $prop->getValue($entity);
            $placeholders[] = "$name = :$name";
        }

        $stm = $this->pdo->prepare("UPDATE " . static::$table . " SET " . implode(", ", $placeholders) . " WHERE id = :id");
        $res = $stm->execute($values);
        return $res;
    }
    
    public function delete(int $id): bool{
        $stm = $this->pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        $res = $stm->execute(["id" => $id]);
        return $res;
    }
}