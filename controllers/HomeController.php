<?php

namespace UF1\Controllers;

class HomeController
{
    public static function index()
    {
        $host = $_SERVER['HTTP_HOST'];
        $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $html = 'index.php';
        $url = "http://$host$ruta/$html";
        header("Location: $url");
    }
}