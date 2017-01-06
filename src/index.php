<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$components = explode('/', $path);

// Front-Controller with controller-centric routing.
$controllerclass = $components[1]."Controller";

include_once("controller/".$controllerclass.".php");

$controller = new $controllerclass();

if (isset($components[3])) {
    $controller->setId($components[3]);

} 

$gets = explode('?', $_SERVER['REQUEST_URI'])[1];
if (isset($gets)) {

    $params = array(); 
    $pairs = explode('&', $gets);

    foreach ($pairs as $p) {
        $split = explode('=', $p);
        $params[$split[0]] = $split[1];
    }

    $controller->setParams($params);
}

if (isset($components[2])) {
    $controller->{$components[2]}();
}
?>
