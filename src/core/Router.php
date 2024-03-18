<?php

namespace Songhub\core;

use Exception;
use Songhub\core\exceptions\RouteNotFoundException;
use Songhub\core\Request;
use Songhub\core\traits\Loggable;

class Router
{
    use Loggable;

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

    private function exists($path, $httpMethod = "GET")
    {
        return array_key_exists($path, $this->routes[$httpMethod]);
    }

    private function getController($path, $httpMethod = "GET")
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
            $this->logger->info("200: Path found", ["Path" => $path]);
        } catch (RouteNotFoundException $error) {
            list($controller, $method) = $this->getController($this->notFound, "GET");
            $this->logger->debug("404: Path not found", ["Path" => $path]);
        } catch (Exception $error) {
            list($controller, $method) = $this->getController($this->internalError, "GET");
            $this->logger->error("500: Internal server error", ["ERROR" => $error]);
        } finally {
            $this->invoke($controller, $method);

        }

    }
}