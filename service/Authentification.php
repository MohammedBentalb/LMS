<?php

namespace Service;

use Repository\userRepository;

class Authentification{
    public function __construct(private userRepository $userRepo, private Session $session) {}

    public function authenticate(string $email, string $password){
        $user = $this->userRepo->findByEmail($email);
        if(!$user || password_verify($password, $user->password)){
            $authError = "Wrong credentials";
            require_once("./views/auth/login.php");
            return;
        }

        $this->session->set("userId", $user->id);
        session_regenerate_id(true);
        return true;
    }

    public function checkAuth(){
        $user = $this->session->getUser();
        return $user ? true : false;
    }

    public function logout(){
        $this->session->unset("userId");
    }
}