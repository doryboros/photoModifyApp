<?php

namespace MyApp\Framework\Routing;

use MyApp\Http\Session;

class Router
{

    public function route(string $path): array
    {
        $path = trim($path, '/');
        $parts = explode('/', $path);
        $route = array_shift($parts);
        $controllerAction = URL_MAP[$route]['controller_action'];

        if ($this->checkAuthorization($route)) {
            $controllerAction = URL_MAP['login']['controller_action'];
        }

        $pathParameters = $this->extractPathParameters($parts);

        return [
            $controllerAction,
            $pathParameters
        ];
    }

    private function checkAuthorization(string $route): bool
    {
        $session = new Session();
        return !(URL_MAP[$route]['anonymous'] || $session->isLoggedIn());
    }

    private function extractPathParameters(array $parts): array
    {
        $arguments = [];
        do {
            $param = array_shift($parts);
            $value = array_shift($parts);

            if ($param === null || $value === null) {
                break;
            }
            $arguments[$param] = $value;
        } while (true);

        return $arguments;
    }
}
