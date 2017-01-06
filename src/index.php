<?php

// Front-Controller with controller-centric routing.
$controllerclass = $_GET['controller'];
$controller = new $controllerclass();
if (isset($_GET['action']))
$controller->{$_GET['action']}();

?>
