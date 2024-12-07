<?php

namespace App\Models;

class SessionUsuario
{

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($usuario, $password, $status)
    {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['password'] = $password;
        $_SESSION['status'] = $status;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
    }

    public function isLogged()
    {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['password']) || !isset($_SESSION['status'])) {
            return false;
        } else {
            return true;
        }
    }
}
?>