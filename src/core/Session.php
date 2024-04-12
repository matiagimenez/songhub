<?php

namespace Songhub\core;

use Songhub\core\Cookie;

class Session
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

    public function destroy()
    {
        session_start();

        $_SESSION = [];
        Cookie::getInstance()->delete(session_name());

        ini_set('session.gc_max_lifetime', 0);
        ini_set('session.gc_probability', 1);
        ini_set('session.gc_divisor', 1);

        session_destroy();
    }

    public function start($key, $value)
    {
        if (!$this->isActive()) {
            session_start();
        }

        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function exists($key)
    {
        return isset($_SESSION[$key]);
    }
    public function isActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

}