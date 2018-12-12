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

            $result = $consulta->execute(['nombre_usuario' => $nombre, "contra" => $contra]);

            if ($result) {

                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }
        return $return;
    }

    public function insert_usuarios($datos) {

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


            if ($result) {

                $return['correcto'] = TRUE;
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;
    }

    public function insert_usuariosAdmin($datos) {

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


            if ($result) {

                $return['correcto'] = TRUE;
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;
    }

    public function listado_usuarios() {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM usuarios order by fecha_alta";

            $consulta = $this->db->query($sql);

            if ($consulta) {

                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;
    }

    public function listado_sinActivar() {

        $return = [
            "correco" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {
            $sql = "SELECT * FROM usuarios WHERE activo = 0 order by fecha_alta";

            $consulta = $this->db->query($sql);

            if ($consulta) {

                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;
    }

    public function borrar_usuario($dni) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        if ($dni && is_string($dni)) {

            try {

                $sql = "DELETE FROM usuarios WHERE dni = :dni";

                $consulta = $this->db->prepare($sql);

                $consulta->execute(['dni' => $dni]);

                if ($consulta) {

                    $return['correcto'] = TRUE;
                }
            } catch (PDOException $ex) {

                $return['error'] = $ex->getMessage();
            }
        } else {

            $return['correcto'] = FALSE;
        }


        return $return;
    }

    public function actualizar_usuario($datos) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {
            $sql = "UPDATE usuarios SET dni= :dni, nombre= :nombre, apellido1= :apellido1, apellido2= :apellido2,"
                    . " fotografia= :fotografia, nombre_usuario = :nombre_usuario, password= :password,"
                    . " telefono_fijo= :telefono_fijo, telefono_movil= :telefono_movil, correo= :correo,"
                    . " departamento= :departamento, web= :web, blog= :blog, twitter= :twitter WHERE dni = :dni";

            $consulta = $this->db->prepare($sql);

            $consulta->execute([
                'dni' => $datos["dni"],
                'nombre' => $datos["nombre"],
                'apellido1' => $datos["apellido1"],
                'apellido2' => $datos["apellido2"],
                'fotografia' => $datos["fotografia"],
                'nombre_usuario' => $datos["nombre_usuario"],
                'password' => sha1($datos["password"]),
                'telefono_fijo' => $datos["telefono_fijo"],
                'telefono_movil' => $datos["telefono_movil"],
                'correo' => $datos["correo"],
                'departamento' => $datos["departamento"],
                'web' => $datos["web"],
                'blog' => $datos["blog"],
                'twitter' => $datos["twitter"],
            ]);

            if ($consulta) {

                $return["correcto"] = TRUE;
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }
        return $return;
    }

    public function listado_usuario($dni) {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM usuarios WHERE dni = :dni";

            $consulta = $this->db->prepare($sql);
            $consulta->execute(['dni' => $dni]);

            if ($consulta) {

                $return["correcto"] = TRUE;
                $return["datos"] = $consulta->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }


        return $return;
    }

    public function actSolicitud($dni) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {
            $sql = "UPDATE usuarios SET activo= 1 WHERE dni = :dni";

            $consulta = $this->db->prepare($sql);

            $consulta->execute(['dni' => $dni]);

            if ($consulta) {

                $return["correcto"] = TRUE;
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }

        return $return;
    }

    public function listadoFM($ensenanzas) {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM fp";

            $consulta = $this->db->query($sql);

            if ($consulta) {

                $return["correcto"] = TRUE;

                $return["datos"] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }

        return $return;
    }

    public function listadoCF($familia) {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM cf";

            $consulta = $this->db->query($sql);

            if ($consulta) {

                $return["correcto"] = TRUE;

                $return["datos"] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }

        return $return;
    }
    
    public function listadoModulo() {
        
        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];
        
        try{
            
        } catch (PDOException $ex) {

        }
        
    }
    
    
    public function insertMensaje($datos) {
     
        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {

            $sql = "INSERT INTO mensajes(titulo, contenido, destinatario, Usuarios_dni, estado, fecha_mensaje) VALUES (:titulo, :contenido, :destinatario, :Usuarios_dni, :estado, :fecha_mensaje)";

            $consulta = $this->db->prepare($sql);

            $result = $consulta->execute([
                'titulo' => $datos["titulo"],
                'contenido' => $datos["contenido"],
                'destinatario' => $datos["destinatario"],
                'Usuarios_dni' => $datos["Usuarios_dni"],
                'estado' => $datos["estado"],
                'fecha_mensaje' => $datos["fecha_mensaje"]
            ]);


            if ($result) {

                $return['correcto'] = TRUE;
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
            echo $ex->getMessage();
        }

        return $return;
    }
    
    public function listadoMensajes($destinatario) {
        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM mensajes where destinatario = :destinatario order by fecha_mensaje ";

            $consulta = $this->db->prepare($sql);
                        

            $consulta->execute(['destinatario' => $destinatario]);

            if ($consulta) {

                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;   
    }
    public function deleteMensaje($codMensaje) {
        
        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        if ($codMensaje) {

            try {

                $sql = "DELETE FROM mensajes WHERE codMensaje = :codMensaje";

                $consulta = $this->db->prepare($sql);

                $consulta->execute(['codMensaje' => $codMensaje]);

                if ($consulta) {

                    $return['correcto'] = TRUE;
                }
            } catch (PDOException $ex) {

                $return['error'] = $ex->getMessage();
            }
        } else {

            $return['correcto'] = FALSE;
        }


        return $return;
        
    }
    
    public function listadoCorreo() {
        
        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM usuarios";

            $consulta = $this->db->query($sql);

            if ($consulta) {

                $return['correcto'] = TRUE;
                $return['datos'] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;
        
    }

}

?>