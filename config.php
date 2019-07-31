<?php

const URL_MAP = [
    '' => [
        'controller_action' => "MyApp\Controller\ProductController::showProducts",
        'anonymous' => true,
    ],
    'products' => [
        'controller_action' => "MyApp\Controller\ProductController::showProducts",
        'anonymous' => true,
    ],
    'login' => [
        'controller_action' => "MyApp\Controller\UserController::showLoginForm",
        'anonymous' => true,
    ],
    'register' => [
        'controller_action' => "MyApp\Controller\UserController::showRegisterForm",
        'anonymous' => true,
    ],
    'profile' => [
        'controller_action' => "MyApp\Controller\UserController::showProfile",
        'anonymous' => false,
    ],
    'upload' => [
        'controller_action' => "MyApp\Controller\ProductController::showUploads",
        'anonymous' => false,
    ],
    'product' => [
        'controller_action' => "MyApp\Controller\ProductController::showProduct",
        'anonymous' => true
    ],
    'loginPost' => [
        'controller_action' => "MyApp\Controller\UserController::login",
        'anonymous' => true
    ],
    'logout' => [
        'controller_action' => 'MyApp\Controller\UserController::logOut',
        'anonymous' => true
    ],
    'registerPost' => [
        'controller_action' => "MyApp\Controller\UserController::register",
        'anonymous' => true
    ],
    'uploadProductPost' => [
        'controller_action' => "MyApp\Controller\ProductController::uploadProduct",
        'anonymous' => false
    ]
];

return [
    'password' => 'borosdori',
    'user' => 'borosdori',
    'dsn' => 'mysql:host=localhost;port=3306;dbname=photoAppDB'
];