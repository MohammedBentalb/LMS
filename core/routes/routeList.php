<?php

use Core\Routes\Router;

Router::add("/", "controllers\courses\controller::index");
Router::add("courses/create", "controllers\courses\controller::courseCreate");
Router::add("courses/form", "controllers\courses\controller::courseForm");
Router::add("courses/form/{id}", "controllers\courses\controller::courseForm");
Router::add("courses/edit/{id}", "controllers\courses\controller::courseEdit");
Router::add("courses/detail/{id}", "controllers\courses\controller::courseDetails");
Router::add("courses/delete/{id}", "controllers\courses\controller::courseDelete");

Router::add("sections/create/{id}", "controllers\sections\controller::sectionCreate");
Router::add("sections/form/{id}", "controllers\sections\controller::sectionForm");
Router::add("sections/form/edit/{id}", "controllers\sections\controller::sectionFormEdit");
Router::add("sections/form/create/{id}", "controllers\sections\controller::sectionFormCreate");
Router::add("sections/edit/{id}", "controllers\sections\controller::sectionEdit");
Router::add("sections/detail/{id}", "controllers\sections\controller::sectionDetail");
Router::add("sections/delete/{id}", "controllers\sections\controller::sectionDelete");