<?php

namespace Songhub\core;

class Session
{
    public function start()
    {
        session_start();
    }

    public function getName()
    {
        return session_name();
    }

    public function destroy()
    {
        $this->clear();
        $sessionName = $this->getName();
        setcookie($sessionName, '', time() - 3600);
        session_destroy();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function exists($key)
    {
        return isset($_SESSION[$key]);
    }
    private function clear()
    {
        $_SESSION = [];
    }

    public function isActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

}