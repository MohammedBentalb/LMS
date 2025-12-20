<?php

namespace Model;
use Model\BaseEntity;

class Section extends BaseEntity{ 
    public int $courseId;
    public string $content;
    public int $position;


    public  function __construct(array $data) {
        $this->id = $data['id'];
        $this->courseId = $data["courseId"];
        $this->title = $data["title"];
        $this->content = $data["content"];
        $this->position = $data["position"];
        $this->createdAt = $data["created_at"] ?? null;
        $this->updatedAt = $data["updated_at"] ?? null;
    }
}
