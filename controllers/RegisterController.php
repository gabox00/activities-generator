<?php

namespace UF1\Controllers;

class RegisterController
{
    public static function index()
    {
        session_start();
        $_SESSION['user']['register'] = true;
        HomeController::index();
    }
}