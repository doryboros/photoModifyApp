<?php
namespace MyApp\Controller;

class Router
{
    const URL_MAP=[
    'products' => "MyApp\Controller\ProductController::showProducts",
    'login'=>"MyApp\Controller\UserController::showLoginForm",
    'register'=>"MyApp\Controller\UserController::showRegisterForm",
    'profile'=>"MyApp\Controller\UserController::showProfile",
    'upload'=>"MyApp\Controller\UserController::showUploads",
    'product'=>"MyApp\Controller\ProductController::showProduct",
];


    function match($url)
    {

        $urlParts=explode("/",$url);

        $route = $urlParts[1];
        if(isset($urlParts[2]) && !empty($urlParts[2])){
            $id=(int)$urlParts[2];
            return call_user_func_array(self::URL_MAP[$route], [$id]);
        }

       return call_user_func(self::URL_MAP[$route]);
    }
}