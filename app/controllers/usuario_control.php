<?php

require_once 'models/modelo_usuarios.php';

class usuarioController {
    
    private $modelo;
    
    private $mensajes;


    public function __construct() {
        
        $this->modelo = new usuarios_model();
        $this->mensajes = [];
        
    }
    

    public function login() {
        
        $parametros = [
          
            "tituloventana" => "Login de Administradores y Profesores",
            "datos" => NULL,
            "mensajes" => []
        ];
       
        
        if (isset($_POST['submit']) && isset($_POST['nombre_usuario']) && isset($_POST['clave'])){
            
            $resultModelo = $this->modelo->login_usuarios($_POST['nombre_usuario'], $_POST['clave']);
           
            if($resultModelo['datos'] != NULL ){ //Consulta ejecutada correctamenta
           
                
            $this->mensajes[] = [
              
                "tipo" => "success",
                "mensaje" => "El login se realizo correctamente"               
            ];
            
        } else {
           
            
            $this->mensajes[] = [
                
                "tipo" => "danger",
                "mensaje" => "El login no se realizo correctamente"
                
            ];   
        }
        $parametros["mensajes"] = $this->mensajes;
            
        }  
       
     include_once 'views/login_view.php';
    }

}
?>

