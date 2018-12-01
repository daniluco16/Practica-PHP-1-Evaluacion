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
            "error" => NULL,
        ];

        try {

            $sql = "SELECT * FROM usuarios WHERE nombre_usuario=:nombre_usuario AND password= :contra";

            $consulta = $this->db->prepare($sql);

            $result = $consulta->execute(['nombre_usuario' => $nombre,"contra" => $contra]);
            
            if ($result){
                
                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetch(PDO::FETCH_ASSOC);
           
            }
            
        } catch (PDOException $ex) {
            
            $return['error'] = $ex->getMessage();
            
        }
        return $return;
    }
    
    public function insert_usuarios($datos){
        
        $return = [
            
            "correcto" => FALSE,
            "error" => NULL
            
        ];
        
        try {
            
            $sql = "INSERT INTO usuarios(dni, nombre, apellido1, apellido2, fotografia, nombre_usuario, password,"
                    . " perfil, telefono_fijo, telefono_movil, correo, departamento, web, blog, twitter,activo,fecha_alta)"
                    . " VALUES (:dni, :nombre, :apellido1, :apellido2, :fotografia, :nombre_usuario, :password, :perfil,"
                    . " :telefono_fijo, :telefono_movil, :correo, :departamento, :web, :blog, :twitter, :activo, :fecha_alta)";
            
            $consulta = $this->db->prepare($sql);
            
            $result = $consulta->execute([
                
                'dni' => $datos["dni"],
                'nombre' => $datos["nombre"],
                'apellido1' => $datos["apellido1"],
                'apellido2' => $datos["apellido2"],
                'fotografia' => $datos["fotografia"],
                'nombre_usuario' => $datos["nombre_usuario"],
                'password' => sha1($datos["password"]),
                'perfil' => $datos["perfil"],
                'telefono_fijo' => $datos["telefono_fijo"],
                'telefono_movil' => $datos["telefono_movil"],
                'correo' => $datos["correo"],
                'departamento' => $datos["departamento"],
                'web' => $datos["web"],
                'blog' => $datos["blog"],
                'twitter' => $datos["twitter"],
                'activo' => $datos["activo"],
                'fecha_alta' => $datos['fecha_alta']      
            ]);
           

            if($result){
                
                $return['correcto'] = TRUE;
                
            }
            
        } catch (PDOException $ex) {
            
            $return['error'] = $ex->getMessage();
            
        }
        
        return $return;
        
        
    }

}

?>