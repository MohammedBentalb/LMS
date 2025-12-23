<?php

namespace Model;

use Validation\Attributes\Preserve;
use Validation\Attributes\Required;

class Enrollment{
    #[Preserve]
    public ?int $id;
    #[Preserve]
    #[Required]
    public int $courseId;
    #[Preserve]
    #[Required]
    public int $userId;
    public function __construct(array $data){   
        $this->id = $data['id'] ?? null;
        $this->courseId = $data['courseId'];
        $this->userId= $data['userId'];
    }
}