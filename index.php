<?php

require_once realpath('vendor/autoload.php');

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