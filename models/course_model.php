<?php

    require_once('./models/baseEntity.php');

    class Course extends BaseParent{
        public string $description;
        public string $image;
        public string $level;
        public string $type;
        public function __construct(array $data) {
            $this->id =  $data['id'];
            $this->title =  $data['title'];
            $this->description =  $data["description"];
            $this->level=  $data["level"];
            $this->type=  $data["course_type"];
            $this->image =  $data["image"];
            $this->createdAt =  $data["created_at"];
            $this->updatedAt = $data["updated_at"];
        }
    }







    
    // class Database{
    //     private static ?PDO $connection = null;
    //     public static function getConnnection(){
    //         if(self::$connection == null){
    //             return self::$connection = new PDO("mysql:host=localhost;dbname=lms;charset=utf8mb4","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    //         }
    //         return self::$connection;
    //     }
    // }

    // class BaseParent{ 
    //     public int $id;
    //     public string $title;
    //     public string $createdAt;
    //     public string $updatedAt;

    //     public function castDate($updatedAtDate = false){            
    //         $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    //         $puredate = explode(" ", $updatedAtDate ? $this->createdAt : $this->updatedAt)[0];
    //         $day = explode('-', $puredate)[2];
    //         $month = explode('-', $puredate)[1];
    //         $year = explode('-', $puredate)[0];

    //         return $updatedAtDate ? "lastly updated on {$months[$month - 1]} $day, $year" : "created on {$months[$month - 1]} $day, $year";
    //     }
    // }

    // class Course extends BaseParent{
    //     public string $description;
    //     public string $image;
    //     public string $level;
    //     public string $type;
    //     public function __construct(array $data) {
    //         $this->id = $data['id'];
    //         $this->title = $data['title'];
    //         $this->description = $data["description"];
    //         $this->level= $data["level"];
    //         $this->type= $data["course_type"];
    //         $this->image = $data["image"];
    //         $this->createdAt = $data["created_at"];
    //         $this->updatedAt = $data["updated_at"];
    //     }
    // }

    // class Section extends BaseParent{ 
    //     public int $courseId;
    //     public string $content;
    //     public int $position;
    //     public function __construct(array $data) {
    //         $this->id = $data["id"];
    //         $this->courseId = $data["course_id"];
    //         $this->title = $data["title"];
    //         $this->content = $data["content"];
    //         $this->position = $data["position"];
    //         $this->createdAt = $data["created_at"];
    //         $this->updatedAt = $data["updated_at"];
    //     }
    // }

    // // ORMM
    // class BaseORM{
    //     protected PDO $pdo;
    //     protected static string $table;
    //     protected static string $entityClass;

    //     public function __construct() {
    //         $this->pdo = Database::getConnnection();
    //     }

    //     public function findById(int $id): ?object {
    //         $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id ");
    //         $stm->execute(["id" => $id]);
    //         $res = $stm->fetch();
    //         $class = static::$entityClass;
    //         return new $class($res);
            
    //     }

    //     public function findAll(): ?array{
    //         $stm = $this->pdo->prepare("SELECT * FROM " . static::$table);
    //         $stm->execute();
    //         $results = $stm->fetchAll();
    //         $class = static::$entityClass;
    //         $res = [];
    //         foreach($results as $data){
    //             $res = [...$res, new $class($data)];
    //         }
    //         return $res;
    //     }
        
    //     public function findByForeignKey(int $id){
    //         // defiined in section orm child
    //         return null;
    //     }
        
    //     public function create(array $data): bool{
    //         unset($data['id'], $data['created_at'], $data['updated_at']);

    //         $fields = implode(", ", array_keys($data));
    //         $placeholders = implode(", ", array_map(function($item){ return ":$item";}, array_keys($data)));
    //         $request = "INSERT INTO " . static::$table . " ( ". $fields ." ) VALUES ( ". $placeholders ." )";

    //         $stm = $this->pdo->prepare($request);
    //         $res = $stm->execute($data);
    //         return $res;

    //     }

    //     public function createMany(array $data): bool{
    //         $res = false;
    //         foreach($data as $datum){
    //             $fields = implode(", ", array_keys($datum));
    //             $placeholders = implode(", ", array_map(function($item){ return ":$item";}, array_keys($datum)));
    //             $request = "INSERT INTO " . static::$table . " ( ". $fields ." ) VALUES ( ". $placeholders ." )";

    //             $stm = $this->pdo->prepare($request);
    //             $res = $stm->execute($datum);
    //         }
    //         return $res;
    //     }
        
    //     public function update(array $data): bool{
    //         $id = $data['id'];
    //         unset($data['id'], $data['created_at'], $data['updated_at'], $data['course_id']);
    //         $keys = array_keys($data);
    //         $updateFields = [];

    //         foreach($keys as $key){
    //             $updateFields = [...$updateFields, "$key = :$key"];
    //         }

    //         $data = [...$data, "id" => $id];
    //         $request = "UPDATE " . static::$table . " SET " . implode(", ",$updateFields) . " WHERE id = :id";
            
    //         $stm = $this->pdo->prepare($request);
    //         $res = $stm->execute($data);
    //         return $res;
    //     }
        
    //     public function delete(int $id): bool{
    //         $stm = $this->pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
    //         $res = $stm->execute(["id" => $id]);
    //         return $res;
    //     }
    // }

    // class CourseORM extends BaseORM{
    //     protected static string $table = 'courses';
    //     protected static string $entityClass = Course::class; 
    // }

    
    // class SectionORM extends BaseORM{
    //     protected static string $table = 'sections';
    //     protected static string $entityClass = Section::class;
        
    //     public function findByForeignKey(int $id): ?array{
    //         $stm = $this->pdo->prepare("SELECT * FROM " . static::$table . " WHERE course_id = :id");
    //         $stm->execute(["id" => $id]);
    //         $results = $stm->fetchAll();
    //         $class = static::$entityClass;
    //         $res = [];
    //         foreach($results as $data){
    //             $res = [...$res, new $class($data)];
    //         }
    //         return $res;
    //     }
    // }

