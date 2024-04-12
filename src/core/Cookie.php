<?php

namespace Songhub\core;

class Cookie
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

    //? $expires_in: tiempo en segundos durante los cuales la cookie tendrá validez.
    public function set($key, $value, $expires_in = 3600)
    {
        setcookie($key, $value, time() + $expires_in, "/", "", false, true);
    }

    public function delete($key)
    {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, "", time() - 3600);
        }
    }

    public function get($key)
    {
        return ($_COOKIE[$key]) ?? null;
    }

    public function exists($key)
    {
        return isset($_COOKIE[$key]);
    }

}