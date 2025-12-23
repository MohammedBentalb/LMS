<?php

namespace Repository;

use Model\User;

class userRepository extends EntityManager{
    protected static string $table = "users";
    protected static string $entityClass = User::class;

    
    public function findByEmail(string $email): ?object {
        $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE email = :email ");
        $stm->execute(["email" => $email]);
        $res = $stm->fetch();
        if($res){
            $entity = new static::$entityClass($res);
            return $entity;
        }
        return null; 
    }
}
