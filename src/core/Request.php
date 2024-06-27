<?php

namespace Songhub\core;

class Request
{
    private static $instance;
    private function __construct()
    {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

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
            $this->path(),
            $this->httpMethod(),
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

    public function getParameter(string $key, string $http_method = "GET")
    {
        switch (strtoupper($http_method)) {
            case 'GET':
                return htmlspecialchars($_GET[$key] ?? null, ENT_QUOTES);
            case 'POST':
                return htmlspecialchars($_POST[$key] ?? null, ENT_QUOTES);
            default:
                return null;
        }
    }


    public function getPostData(){
        return [
            "DATETIME" => $this->getParameter("DATETIME", "POST"),
            "DESCRIPTION" => $this->getParameter("DESCRIPTION", "POST"),
            "LIKES" => (int) $this->getParameter("LIKES", "POST"),
            "RATING" => (int) $this->getParameter("RATING", "POST"),
            "CONTENT_ID" => $this->getParameter("CONTENT_ID", "POST"),
            "USER_ID" => $this->getParameter("USER_ID", "POST"),
        ];
    }
}