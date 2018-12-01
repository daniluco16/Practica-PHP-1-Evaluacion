<?php

function filtro($datos){
    
    $error = array(
        
        "dni" => FALSE,
        "nombre" => FALSE,
        "apellido1" => FALSE,
        "apellido2" => FALSE,
        "password" => FALSE,
        "telefono_fijo" => FALSE,
        "telefono_movil" => FALSE,
        "correo" => FALSE,
        "web" => FALSE,
        "twitter" => FALSE,
        "blog" => FALSE
    );
    
    $regex = array(
      
        "dni" => '/^[0-9]{8}[A-Za-z]$/',
        "nombre" => '/[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/',
        "apellido1" => '/[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/',
        "apellido2" => '/[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/',
        "password" => '/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/',
        "telefono_fijo" => '/^(\+34|0034|34)?[6|7|9][0-9]{8}$/',
        "telefono_movil" => '/^[9|6|7][0-9]{8}$/',
        "correo" => '/^[a-zA-Z0-9]+@[A-Za-z0-9]+\.[a-zA-Z]{2,}$/',
        "web" => '@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i ',
        "twitter" => '/^@(\w){1,15}$/',
        "blog" => '/^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+(blogspot *\.)+[a-z0-9][a-z0-9\-]*$/'
    );
    
    if(empty($datos["dni"]) || !preg_match($regex["dni"], $datos["dni"])){
        
        $error['dni'] = TRUE;
        
    }
    if(empty($datos["nombre"]) || !preg_match($regex["nombre"], $datos["nombre"])){
        
        $error['nombre'] = TRUE;
        
    }
    if(empty($datos["apellido1"]) || !preg_match($regex["apellido1"], $datos["apellido1"])){
        
        $error['apellido1'] = TRUE;
        
    }
    if(empty($datos["apellido2"]) || !preg_match($regex["apellido2"], $datos["apellido2"])){
        
        $error['apellido2'] = TRUE;
        
    }
    if(empty($datos["password"]) || !preg_match($regex["password"], $datos["password"])){
        
        $error['password'] = TRUE;
        
    }
    if(empty($datos["telefono_fijo"]) || !preg_match($regex["telefono_fijo"], $datos["telefono_fijo"])){
        
        $error['telefono_fijo'] = TRUE;
        
    }
    if(empty($datos["telefono_movil"]) || !preg_match($regex["telefono_movil"], $datos["telefono_movil"])){
        
        $error['telefono_movil'] = TRUE;
    }
    if(empty($datos["correo"]) || !preg_match($regex["correo"], $datos["correo"])){
        
        $error['correo'] = TRUE;
        
    }
    if(!empty($datos['web']) && !preg_match($regex["web"], $datos["web"])){
     
        $error['web'] = TRUE;
        
    }
    if(!empty($datos['twitter']) && !preg_match($regex["twitter"], $datos["twitter"])){
        
        $error['twitter'] = TRUE;
        
    }
    if (!empty($datos['blog']) && !preg_match($regex["blog"], $datos["blog"])){
        
        $error['blog'] = TRUE;
        
    }
    
    return $error;
    
}


?>

