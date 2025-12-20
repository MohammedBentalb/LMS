<?php

namespace Model;

use Validation\Attributes\Preserve;
use Validation\Attributes\Required;

    class BaseEntity{
        #[Preserve ] 
        public ?int $id;
        #[Preserve]
        #[Required]
        public string $title; 
        public ?string $createdAt = null;
        public ?string $updatedAt = null;

        public function castDate($updatedAtDate = false){
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $puredate = explode(" ", $updatedAtDate ? $this->createdAt : $this->updatedAt)[0];
            $day = explode('-', $puredate)[2];
            $month = explode('-', $puredate)[1];
            $year = explode('-', $puredate)[0];

            return $updatedAtDate ? "lastly updated on {$months[$month - 1]} $day, $year" : "created on {$months[$month - 1]} $day, $year";
        }
        public function getId(){
            return $this->id;
        }
    }