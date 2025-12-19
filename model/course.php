<?php

namespace Model;
use Model\BaseEntity;

class Course extends BaseEntity{
    public string $description;
    public string $image;
    public string $level;
    public string $type;

    public  function __construct(?int $id = null) {
        $this->id = $id;
    }
    
    public function hydrate(array $data) {
        $this->title = $data['title'];
        $this->description =  $data["description"];
        $this->level=  $data["level"];
        $this->type=  $data["type"];
        $this->image =  $data["image"];
        $this->createdAt = $data["created_at"];
        $this->updatedAt = $data["updated_at"];
    }
}