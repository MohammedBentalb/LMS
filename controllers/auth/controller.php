<?php

namespace Controllers\Auth;

use Model\User;
use Repository\userRepository;
use Service\Authentification;

class Controller{
    public function __construct(private userRepository $userRepo, private Authentification $auth) {}

    public function registerView(){
        require_once('./views/auth/register.php');
    }
    
    public function loginView(){
        if($this->auth->checkAuth()) header("Location: /");
        require_once('./views/auth/login.php');
    }

    public function login(){
        $email = $_POST['user-email'];
        $password = $_POST['user-password'];
        $userExist = $this->userRepo->findByEmail($email);
        if(!$userExist || !password_verify($password, $userExist->password)) {
            $authError = "Wrong credentials";
            require_once("./views/auth/login.php");
            return;
        };
        
        $_SESSION['userId'] = $userExist->id;
        header("Location: /");
    }
    
    public function register(){
        $email = $_POST['user-email'];
        $passowrd = $_POST['user-password'];
        $name = $_POST['user-name'];
        
        $userExist = $this->userRepo->findByEmail($email);
        if($userExist) {
            $authError = "Email already taken";
            require_once("./views/auth/register.php");
            return;
        }
        
        $user = new User(["id" => null, "name" => $name, "email" => $email, "password" => password_hash($passowrd, PASSWORD_DEFAULT)]);
        $this->userRepo->create($user);
        $user = $this->userRepo->findByEmail($email);
        $_SESSION["userId"] = $user->id;
        header("Location: /");
    }
    
    public function logout(){
        var_dump("dadead");
       $isAuthenticated = $this->auth->checkAuth();
        if($isAuthenticated) {
            $this->auth->logout();
        }
       header("Location: /auth/view/login");
    }
}