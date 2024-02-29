<?php

namespace Songhub\core;

use Songhub\core\exceptions\RouteNotFoundException;

class Router
{
    public array $routes;
    /* El segundo parametro incluye el controlador y
    el método que procesaran la petición: 'controller@method' */
    public function loadRoutes($path, $controller_method)
    {
        $this->routes[$path] = $controller_method;
    }

    public function direct($path)
    {
        if (!array_key_exists($path, $this->routes)) {
            throw new RouteNotFoundException("No existe una ruta definida para ese path");
        }

        // Parseamos el string para obtener el controlador y el método
        list($controller, $method) = explode('@', $this->routes[$path]);
        $controller = "Songhub\\app\\controllers\\{$controller}";
        $controllerInstance = new $controller;
        $controllerInstance->$method();
    }
}