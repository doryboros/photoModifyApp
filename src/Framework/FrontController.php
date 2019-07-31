<?php

namespace MyApp\Framework;

use MyApp\Framework\Routing\Router;
use MyApp\Http\Request;

class FrontController
{
    public function dispatch(): void
    {
        $pathInfo='';
        if(isset($_SERVER['PATH_INFO'])){
            $pathInfo = $_SERVER['PATH_INFO'];
        }

        $router = new Router();
        [$controllerAction, $pathParams] = $router->route($pathInfo);

        $request = new Request($pathParams);

        call_user_func_array($controllerAction, [$request]);
        
    }
}