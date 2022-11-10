<?php

namespace UF1\Controllers;

/**
 * Class HomeController
 * @package UF1\Controllers
 */
class HomeController
{
    /**
     * Metodo que redirecciona a la vista home.php
     * @redirect index.php
     */
    public static function index()
    {
        $host = $_SERVER['HTTP_HOST'];
        $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $html = 'index.php';
        $url = "http://$host$ruta/$html";
        header("Location: $url");
        die();
    }
}