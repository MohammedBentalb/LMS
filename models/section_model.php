<?php

    require_once('./models/baseEntity.php');

    class Section extends BaseParent{ 
        public int $courseId;
        public string $content;
        public int $position;
        public function __construct(array $data) {
            $this->id = $data["id"];
            $this->courseId = $data["course_id"];
            $this->title = $data["title"];
            $this->content = $data["content"];
            $this->position = $data["position"];
            $this->createdAt = $data["created_at"];
            $this->updatedAt = $data["updated_at"];
        }
    }
