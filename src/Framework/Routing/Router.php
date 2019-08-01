<?php

namespace MyApp\Framework\Routing;

use MyApp\Http\Session;

/**
 * Class Router
 * @package MyApp\Framework\Routing
 */
class Router
{

    /**
     * @param string $path
     * @return array
     */
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

    /**
     * @param string $route
     * @return bool
     */
    private function checkAuthorization(string $route): bool
    {
        $session = new Session();
        return !(URL_MAP[$route]['anonymous'] || $session->isLoggedIn());
    }

    /**
     * @param array $parts
     * @return array
     */
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
