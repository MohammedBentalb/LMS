<?php

namespace Model;
use Model\BaseEntity;
use Validation\Attributes\Required; 
use Validation\Attributes\DefaultValue;
use Validation\Attributes\Preserve;

class Course extends BaseEntity{
    #[Preserve]
    #[Required]
    public string $description;
    #[Preserve]
    #[Required]
    public string $image;
    #[Preserve]
    #[DefaultValue("beginner")]
    #[Required]
    public string $level;
    #[Preserve]
    #[Required]
    public string $type;

    public  function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data['title'];
        $this->description =  $data["description"];
        $this->level=  $data["level"];
        $this->type=  $data["type"];
        $this->image =  $data["image"];
        $this->createdAt = $data["created_at"] ?? null;
        $this->updatedAt = $data["updated_at"] ?? null;
    }
    
    public function hydrate(array $data) {

    }
}