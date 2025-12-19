<?php

namespace Repository;
use Db\Database;
use Model\Course;
use Model\Section;
use PDO;
use Reflection;
use ReflectionClass;

class EntityManager{
    protected PDO $pdo;
    protected static string $table;
    protected static string $entityClass;
    
    public function __construct() {
        $this->pdo = Database::getConnnection();
    }

    public function findById(object $entity): ?object {
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id ");
        $stm->execute(["id" => $entity->id]);
        $res = $stm->fetch();
        if($res){
            $entity->hydrate($res);
            return $entity;
        }
        return null; 
    }

    public function findAll(): ?array{
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table);
        $stm->execute();
        $results = $stm->fetchAll();
        $class = static::$entityClass;
        $res = [];
        foreach($results as $data){
            $row = new $class($data['id']);
            $row->hydrate($data);
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
        var_dump($stm);
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
            if (in_array($name, ['id', 'createdAt', 'updatedAt'], true)) continue;
            $values[$prop->getName()] = $prop->getValue($entity);
            $placeholders[] = "$name = :$name";
        }

        $values['id'] = $entity->id;

        $stm = $this->pdo->prepare("UPDATE " . static::$table . " SET " . implode(", ", $placeholders) . " WHERE id = :id");
        $res = $stm->execute($values);
        return $res;
    }
    
    public function delete(object $entity): bool{
        $stm = $this->pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        $res = $stm->execute(["id" => $entity->id]);
        return $res;
    }
}