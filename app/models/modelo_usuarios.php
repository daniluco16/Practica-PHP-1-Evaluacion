<?php

include_once 'models/modelo.php';

class usuarios_model {

    private $db;

    public function __construct() {

        $this->db = bbdd::conectar();
        
    }

    public function login_usuarios($nombre, $contra) {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM usuarios WHERE nombre_usuario=:nombre_usuario AND contraseña= :contra";

            $consulta = $this->db->prepare($sql);

            $result = $consulta->execute(['nombre_usuario' => $nombre,"contra" => $contra]);
            
            if ($result){
                
                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetch(PDO::FETCH_ASSOC);
            }
            
        } catch (Exception $ex) {
            
            $return['error'] = $ex->getMessage();
            
        }
        return $return;
    }

}

?>