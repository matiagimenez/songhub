<?php

namespace Songhub\core;

use Exception;
use Songhub\core\exceptions\RouteNotFoundException;
use Songhub\core\Request;

class Router
{
    public array $routes = [
        "GET" => [],
        "POST" => [],
        "PUT" => [],
        "DELETE" => [],
    ];

    public string $notFound = "not_found";
    public string $internalError = "internal_error";

    public function __construct()
    {
        $this->get($this->notFound, 'ErrorController@notFound');
        $this->get($this->internalError, 'ErrorController@internalError');
    }

    /* El segundo parametro incluye el controlador y
    el método que procesaran la petición: 'controller@method' */
    public function loadRoutes($path, $controller_method, $httpMethod)
    {
        $this->routes[$httpMethod][$path] = $controller_method;
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

    public function exists($path, $httpMethod = "GET")
    {
        return array_key_exists($path, $this->routes[$httpMethod]);
    }

    public function getController($path, $httpMethod = "GET")
    {
        if (!$this->exists($path, $httpMethod)) {
            throw new RouteNotFoundException("No existe una ruta definida para ese path");
        }

        // Parseamos el string para obtener el controlador y el método
        return explode('@', $this->routes[$httpMethod][$path]);
    }

    private function invoke($controller, $method)
    {
        $controller = "Songhub\\app\\controllers\\{$controller}";
        $controllerInstance = new $controller;
        $controllerInstance->$method();
    }

    public function direct(Request $request)
    {
        try {
            list($path, $httpMethod) = $request->route();
            list($controller, $method) = $this->getController($path, $httpMethod);
            $this->invoke($controller, $method);
        } catch (RouteNotFoundException $error) {
            list($controller, $method) = $this->getController($this->notFound, "GET");
            $this->invoke($controller, $method);
        } catch (Exception $error) {
            list($controller, $method) = $this->getController($this->internalError, "GET");
            $this->invoke($controller, $method);
        }

    }
}