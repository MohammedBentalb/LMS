<?php

namespace Service;

use Controllers\Courses\Controller;

class RouteResolver{
    public function __construct(private Authentification $auth, private Session $session) {}
    public function execute($call, $options, ?int $param = null){
        $ClassAndMethod = explode("::", $call);
        $Controller = $ClassAndMethod[0];
        $method = $ClassAndMethod[1];
        
        if(!empty($options["auth"])){
            if(!$this->auth->checkAuth()){
                header("location: /auth/view/login");
                return;
            }
        }
        if($Controller !== Controller::class){
            $this->session->incrementCount();
        }
        call_user_func([Container::get($Controller), $method], $param);
    }
}