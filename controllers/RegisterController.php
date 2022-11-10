<?php

namespace UF1\Controllers;

/**
 * Class RegisterController
 * @package UF1\Controllers
 */
class RegisterController
{
    /**
     * Metodo que se encarga de registrar un true en la sesion del usuario, para que sepa que se dirige a la pagina de registro
     * y redirecciona a la vista index.php
     * @redirect index.php
     */
    public static function index()
    {
        session_start();
        $_SESSION['user']['register'] = true;
        HomeController::index();
    }
}