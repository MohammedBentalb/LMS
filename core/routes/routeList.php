<?php

return function($router) {
    $router->add("auth/view/login", "controllers\auth\controller::loginView", []);
    $router->add("auth/view/register", "controllers\auth\controller::registerView", []);
    
    $router->add("auth/register", "controllers\auth\controller::register", []);
    $router->add("auth/login", "controllers\auth\controller::login", []);
    $router->add("auth/logout", "controllers\auth\controller::logout", []);
    
    $router->add("/", "controllers\courses\controller::index", []);
    $router->add("courses/myCourses", "controllers\courses\controller::courseEnrollment", ['auth' => true, 'ability' => 'course.create']);
    $router->add("courses/create", "controllers\courses\controller::courseCreate", ['auth' => true, 'ability' => 'course.create']);
    $router->add("courses/form", "controllers\courses\controller::courseForm", ['auth' => true, 'ability' => 'course.view']);
    $router->add("courses/form/{id}", "controllers\courses\controller::courseForm", ['auth' => true, 'ability' => 'course.view']);
    $router->add("courses/edit/{id}", "controllers\courses\controller::courseEdit", ['auth' => true, 'ability' => 'course.edit']);
    $router->add("courses/detail/{id}", "controllers\courses\controller::courseDetails", ['auth' => true, 'ability' => 'course.view']);
    $router->add("courses/delete/{id}", "controllers\courses\controller::courseDelete", ['auth' => true, 'ability' => 'course.delete']);
    
    $router->add("courses/enroll/{id}", "controllers\courses\controller::courseEnroll", ['auth' => true, 'ability' => 'course.enroll']);
    $router->add("courses/disenroll/{id}", "controllers\courses\controller::courseDisenroll", ['auth' => true, 'ability' => 'course.create']);
    
    $router->add("dashboard", "controllers\dashboard\controller::index", ['auth' => true, 'ability' => 'course.create']);
    
    $router->add("sections/create/{id}", "controllers\sections\controller::sectionCreate", ['auth' => true, 'ability' => 'section.create']);
    $router->add("sections/form/{id}", "controllers\sections\controller::sectionForm", ['auth' => true, 'ability' => 'section.view']);
    $router->add("sections/form/edit/{id}", "controllers\sections\controller::sectionFormEdit", ['auth' => true, 'ability' => 'section.edit']);
    $router->add("sections/form/create/{id}", "controllers\sections\controller::sectionFormCreate", ['auth' => true, 'ability' => 'section.create']);
    $router->add("sections/edit/{id}", "controllers\sections\controller::sectionEdit", ['auth' => true, 'ability' => 'section.edit']);
    $router->add("sections/detail/{id}", "controllers\sections\controller::sectionDetail", ['auth' => true, 'ability' => 'section.view']);
    $router->add("sections/delete/{id}", "controllers\sections\controller::sectionDelete", ['auth' => true, 'ability' => 'section.delete']);
};