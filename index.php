<?php

require 'vendor/autoload.php';

use MyApp\Controller\ProductController;

var_dump(class_exists(ProductController::class));

const URL_MAP=[
    '/' => "MyApp\Controller\ProductController::showProducts",
    '/login'=>"MyApp\Controller\UserController::login",
    '/register'=>"MyApp\Controller\UserController::register",
    '/profile'=>"MyApp\Controller\UserController::showProfile",
    '/upload'=>"MyApp\Controller\UserController::upload",
    '/product'=>"MyApp\Controller\ProductController::showProducts",
];


$url=$_SERVER['REQUEST_URI'];
//var_dump(URL_MAP[$url]);
//var_dump(call_user_func(URL_MAP[$url]));
var_dump(call_user_func("MyApp\Controller\ProductController::showProducts"));