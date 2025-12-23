<?php

namespace Model;

use Validation\Attributes\DefaultValue;
use Validation\Attributes\Required; 
use Validation\Attributes\Preserve;

class User{
    #[Preserve]
    public ?string $id;
    #[Preserve]
    #[Required]
    public ?string $name;
    #[Preserve]
    #[Required]
    public string $email;
    #[Preserve]
    #[Required]
    public string $password;
    #[Preserve]
    #[DefaultValue("guest")]
    #[Required]
    public ?string $role;
    public ?string $createdAt;
    public ?string $updatedAt;

    public  function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->role = $data["role"] ?? null;
        $this->password = $data["password"];
        $this->createdAt = $data["created_at"] ?? null;
        $this->updatedAt = $data["updated_at"] ?? null;
    }
}