<?php

namespace Songhub\core;

class Request
{

    public function path()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    public function httpMethod()
    {
        return parse_url($_SERVER['REQUEST_METHOD'], PHP_URL_PATH);
    }
    public function route()
    {
        return [
            'path' => $this->path(),
            'httpMethod' => $this->httpMethod(),
        ];
    }

    public function protocol()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    }
    public function host()
    {
        return $_SERVER['HTTP_HOST'];
    }
}