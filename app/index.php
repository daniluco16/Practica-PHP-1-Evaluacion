<?php

include_once 'controllers/usuario_control.php';
require_once 'parameters.php';

if (isset($_GET['controller']) && class_exists($_GET['controller'])."Controller") {

    $nombre_controlador = $_GET['controller']. "Controller";
    
    $controlador = new $nombre_controlador();


    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {

        $action = $_GET['action'];

        $controlador->$action();
    } else {

        $nombre_controlador = controller_default;
    }
    
 } else {
     
     $nombre_controlador = controller_default;
    
 }
?>