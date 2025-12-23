<?php

namespace Service;

use Repository\userRepository;

class Session{
    public function __construct(private userRepository $userReop) {}

    public function getUserId(){
        return $_SESSION['userId'] ?? null;
    }

    public function getUser(){
        $id = $this->getUserId();
        return $id ? $this->userReop->findById($id) : null;
    }

    public function Set(string $key, mixed $value){
        $_SESSION[$key] = $value;
    }

    public function showIncrement(){
        return $_SESSION['countIntrence'] ?? null;
    }

    public function incrementCount(){
        isset($_SESSION['countIntrence']) ?  $_SESSION['countIntrence'] += 1 : $_SESSION['countIntrence'] = 0; 
    }

    public function unset(string $key){
        unset($_SESSION[$key], $_SESSION['countIntrence']);
    }
}