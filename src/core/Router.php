<?php

namespace Songhub\core;

use Songhub\core\exceptions\RouteNotFoundException;

class Router
{
    public array $routes = [
        "GET" => [],
        "POST" => [],
        "PUT" => [],
        "DELETE" => [],
    ];

    /* El segundo parametro incluye el controlador y
    el método que procesaran la petición: 'controller@method' */
    public function loadRoutes($path, $controller_method, $http_method)
    {
        $this->routes[$http_method][$path] = $controller_method;
    }

    public function get($path, $controller_method)
    {
        $this->loadRoutes($path, $controller_method, "GET");
    }
    public function post($path, $controller_method)
    {
        $this->loadRoutes($path, $controller_method, "POST");
    }
    public function put($path, $controller_method)
    {
        $this->loadRoutes($path, $controller_method, "PUT");
    }
    public function delete($path, $controller_method)
    {
        $this->loadRoutes($path, $controller_method, "DELETE");
    }

    public function exists($path, $http_method = "GET")
    {
        return array_key_exists($path, $this->routes[$http_method]);
    }

    public function getController($path, $http_method = "GET")
    {
        // Parseamos el string para obtener el controlador y el método
        return explode('@', $this->routes[$http_method][$path]);
    }

    public function direct($path, $http_method = "GET")
    {
        if (!$this->exists($path, $http_method)) {
            throw new RouteNotFoundException("No existe una ruta definida para ese path");
        }

        list($controller, $method) = $this->getController($path, $http_method);
        $controller = "Songhub\\app\\controllers\\{$controller}";
        $controllerInstance = new $controller;
        $controllerInstance->$method();
    }
}