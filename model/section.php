<?php

namespace Model;
use Model\BaseEntity;
use Validation\Attributes\Required;
use Validation\Attributes\Preserve;

class Section extends BaseEntity{ 
    #[Preserve]
    #[Required]
    public int $courseId;
    #[Preserve]
    #[Required]
    public string $content;
    #[Preserve]
    #[Required]
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
