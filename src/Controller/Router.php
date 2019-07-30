<?php
namespace MyApp\Controller;

class Router
{
    public const URL_MAP=[
        ''=> [
                'route' => "MyApp\Controller\ProductController::showProducts",
                'anonymous' => true,
        ],
        'products' => [
                'route'=>"MyApp\Controller\ProductController::showProducts",
                'anonymous'=>true,
        ],
        'login'=>[
                'route'=>"MyApp\Controller\UserController::showLoginForm",
                'anonymous'=>true,
        ],
        'register'=>[
                'route'=>"MyApp\Controller\UserController::showRegisterForm",
                'anonymous'=>true,
        ],
        'profile'=>[
                'route'=>"MyApp\Controller\UserController::showProfile",
                'anonymous'=>false,
            ],
        'upload'=>[
                'route'=>"MyApp\Controller\UserController::showUploads",
                 'anonymous'=>true,
        ],
        'product' => [
                'route' => "MyApp\Controller\ProductController::showProduct",
                'anonymous' => true
            ],
    ];

    public function match($url)
    {

        $urlParts=explode("/",$url);

        $route = $urlParts[1];
        $controllerAction = self::URL_MAP[$route]['route'];

        //todo implement nimeni
//        $this->nimeni->getLoggedUser();
//        if (!self::URL_MAP[$route]['anonymous'] && !$this->nimeni->isLogged()) {
//                //return call_user_func(self::URL_MAP['login']['route']);
//            $controllerAction = '';
//        }

        $arguments = [];

        if(isset($urlParts[2]) && !empty($urlParts[2])){
            $id = (int) $urlParts[2];
            $arguments[] = $id;
        }

        return call_user_func_array($controllerAction, $arguments);
        //return call_user_func(self::URL_MAP[$route]['route']);
    }
}