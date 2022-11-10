<?php

require_once realpath('vendor/autoload.php');

//Especie de router que se encarga de redirigir a los controladores y metodos que se le indiquen por la url
//Example: ?controller_option={NombreControlador}&method_option={NombreMetodoControlador}
$controller_option = $_GET['controller_option'] ?? null;
$class = "UF1\\Controllers\\$controller_option";
$method = $_GET['method_option'] ?? '';
if(!class_exists($class) && !method_exists($class, $method)){
    require_once realpath('views/home.php');
    die();
}

$controller = new $class();
$controller->$method();

?>