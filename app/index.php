<?php

include_once 'controllers/usuario_control.php';

//$controlador = new usuarioController();


if (isset($_GET['controller']) && class_exists($_GET['controller'])."Controller") {

    $nombre_controlador = $_GET['controller']. "Controller";
    $controlador = new $nombre_controlador();


    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {

        $action = $_GET['action'];

        $controlador->$action();
    } else {

        echo "La página no existe";
    }
    
 } else {
     
     echo "La página no existe";
    
 }
?>