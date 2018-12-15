<?php

include_once 'models/modelo.php';

class usuarios_model {

    private $db;

    public function __construct() {

        $this->db = bbdd::conectar();
    }

    
    /**
     * @funcionlog 
     * 
     * funcion del modelo encargado del listado de los 
     * procedimientos principales de la web.
     * 
     * @return type
     * 
     */
    public function listadolog() {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM log order by fechayhora";

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


    /**
     *  @login_usuarios
     * funcion del modelo encargado del
     * login del profesor
     * recibiendo un nombre de usuario y contraseña. 
     * 
     * @param type $nombre
     * @param type $contra
     * @return type
     */
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

                $perfilog = $return['datos']['perfil'];
                $actividad = "Login";
                $sqlog = "CALL log(:usuario,:perfil,:actividad)";

                $query = $this->db->prepare($sqlog);
                $query->bindParam(':usuario', $nombre);
                $query->bindParam(':perfil', $perfilog);
                $query->bindParam(':actividad', $actividad);

                $query->execute();
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
        }

        return $return;
    }


    /**
     * 
     * @insertar_usuarios
     * 
     * Funcion del modelo encargada de insertar 
     * nuevos usuarios a la web.
     * 
     * @param type $datos
     * @return type
     */
    public function insert_usuarios($datos) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {

            $this->db->beginTransaction();

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

                $nombrelog = $datos['nombre_usuario'];
                $perfilog = $datos['perfil'];
                $actividad = "Alta de Usuarios";

                $sqlog = "CALL log(:usuario,:perfil,:actividad)";

                $query = $this->db->prepare($sqlog);
                $query->bindParam(':usuario', $nombrelog);
                $query->bindParam(':perfil', $perfilog);
                $query->bindParam(':actividad', $actividad);

                $query->execute();

                $this->db->commit();
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();

            $this->db->rollBack();
        }

        return $return;
    }
    
    /**
     * @insertar_usuarios_admin
     * 
     * funcion del modelo encargada insertar usuarios
     * con permisos de admin si se precisa.(Solo admin)
     * 
     * @param type $datos
     * @return type
     * 
     */
    public function insert_usuariosAdmin($datos) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {

            $this->db->beginTransaction();

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

                $nombrelog = $datos['nombre_usuario'];
                $perfilog = $datos['perfil'];
                $actividad = "Alta de Usuarios por Admin";

                $sqlog = "CALL log(:usuario,:perfil,:actividad)";

                $query = $this->db->prepare($sqlog);
                $query->bindParam(':usuario', $nombrelog);
                $query->bindParam(':perfil', $perfilog);
                $query->bindParam(':actividad', $actividad);

                $query->execute();

                $this->db->commit();
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();

            $this->db->rollBack();
        }

        return $return;
    }

    /**
     * @listado_usuarios
     * 
     * Funcion del modelo encargada de 
     * listar a todos los profesores de la web
     * activados.
     * 
     * @return type
     * 
     */
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

    /**
     * @listado_sinActivar
     * 
     * Funcion del modelo encargada de mostrar
     * a los usuarios que no han sido activados
     * todavia.
     * 
     * @return type
     * 
     */
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

    /**
     * 
     *  @borrar_usuarios
     * 
     * Funcion del modelo encargada de eliminar
     * a los usuarios que deseé el admin mostrandose
     * por medio de un listado.
     * 
     * @param type $dni
     * @param type $nombreUsuario
     * @param type $perfil
     * @return boolean
     * 
     */
    public function borrar_usuario($dni, $nombreUsuario, $perfil) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        if ($dni && is_string($dni)) {

            try {

                $this->db->beginTransaction();

                $sql = "DELETE FROM usuarios WHERE dni = :dni";

                $consulta = $this->db->prepare($sql);

                $consulta->execute(['dni' => $dni]);

                if ($consulta) {

                    $return['correcto'] = TRUE;

                    $nombrelog = $nombreUsuario;
                    $perfilog = $perfil;
                    $actividad = "Eliminación de Usuario";

                    $sqlog = "CALL log(:usuario,:perfil,:actividad)";

                    $query = $this->db->prepare($sqlog);
                    $query->bindParam(':usuario', $nombrelog);
                    $query->bindParam(':perfil', $perfilog);
                    $query->bindParam(':actividad', $actividad);

                    $query->execute();

                    $this->db->commit();
                }
            } catch (PDOException $ex) {

                $return['error'] = $ex->getMessage();

                $this->db->rollBack();
            }
        } else {

            $return['correcto'] = FALSE;
        }


        return $return;
    }

    /**
     *  @actualizar_Usuario
     * 
     * Función encargada de actualizar usuarios 
     * y sus datos del perfil , cada profesor solo puede editar 
     * su perfil y el de nadie más.
     * 
     * 
     * @param type $datos
     * @return type
     * 
     */
    public function actualizar_usuario($datos) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {

            $this->db->beginTransaction();

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

                $nombrelog = $datos['nombre_usuario'];
                $perfilog = $datos['perfil'];
                $actividad = "Editar Perfil";

                $sqlog = "CALL log(:usuario,:perfil,:actividad)";

                $query = $this->db->prepare($sqlog);
                $query->bindParam(':usuario', $nombrelog);
                $query->bindParam(':perfil', $perfilog);
                $query->bindParam(':actividad', $actividad);

                $query->execute();

                $this->db->commit();
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();

            $this->db->rollBack();
        }
        return $return;
    }

    /**
     * @listado_usuario_dni
     * 
     * Función del modelo encargada de sacar 
     * a una persona por su dni.
     * 
     * 
     * @param type $dni
     * @return type
     * 
     */
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

    /**
     *  @actSolicitud
     * 
     * Función encargada de actualizar a los profesores no activos
     * a activos para poder acceder a la web (solo admin).
     * 
     * @param type $dni
     * @return type
     * 
     */
    public function actSolicitud($dni) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {

            $this->db->beginTransaction();

            $sql = "UPDATE usuarios SET activo= 1 WHERE dni = :dni";

            $consulta = $this->db->prepare($sql);

            $consulta->execute(['dni' => $dni]);

            if ($consulta) {

                $return["correcto"] = TRUE;

                $this->db->commit();
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();

            $this->db->rollBack();
        }

        return $return;
    }

    /**
     * @listadoFM
     * Funcion usada para el listado de 
     * familias profesionales.
     * 
     * @return type
     * 
     */
    public function listadoFM() {

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

                $fm = $consulta->fetchAll(PDO::FETCH_ASSOC);

                foreach ($fm as $row) {
                    
                    $output .= '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                }
                
                $return['datos'] = $output;
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }

        return $return;
    }

    /**
     * @listadoCF
     * 
     * Funcion usada para el listado de
     * Ciclos formativos.
     * 
     * @return type
     * 
     * 
     */
    public function listadoCF() {

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

                $cf = $consulta->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($cf as $row) {
                    
                    $output .= '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                }
                
                $return['datos'] = $output;
            }
        } catch (PDOException $ex) {

            $return["error"] = $ex->getMessage();
        }

        return $return;
    }

    /**
     * @listadoModulo
     * Funcion usada para el listado 
     * de las asignaturas.
     * 
     * @return type
     * 
     */
    
    public function listadoModulo() {

        $return = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => NULL
        ];

        try {

            $sql = "SELECT * FROM modulo";

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

    /**
     *  @insertarMensaje
     * 
     * Funcion encargada de enviar mensajes a otro profesor
     * u admin.
     * 
     * 
     * @param type $datos
     * @return type
     */
    public function insertMensaje($datos) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        try {

            $this->db->beginTransaction();

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

                $this->db->commit();
            }
        } catch (PDOException $ex) {

            $return['error'] = $ex->getMessage();
            echo $ex->getMessage();

            $this->db->rollBack();
        }

        return $return;
    }


    /**
     * * @listadoMensajes
     * 
     * Funcion encargada del listado de los mensajes
     * especificos de cada profesor. 
     * 
     * 
     * @param type $destinatario
     * @return type
     */
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

    /**
     *  @borrarMensaje
     * 
     * Función encargada de borrar los mensajes de la
     * bandeja de entrada de un profesor.
     * 
     * @param type $codMensaje
     * @return boolean
     * 
     */
    public function deleteMensaje($codMensaje) {

        $return = [
            "correcto" => FALSE,
            "error" => NULL
        ];

        if ($codMensaje) {

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM mensajes WHERE codMensaje = :codMensaje";

                $consulta = $this->db->prepare($sql);

                $consulta->execute(['codMensaje' => $codMensaje]);

                if ($consulta) {

                    $return['correcto'] = TRUE;

                    $this->db->commit();
                }
            } catch (PDOException $ex) {

                $return['error'] = $ex->getMessage();

                $this->db->rollBack();
            }
        } else {

            $return['correcto'] = FALSE;
        }


        return $return;
    }

    
    /**
     * * @listadoCorreo
     * 
     * Funcion encargada del listado de todos los 
     * usuarios de la web para enviar un correo
     * a un número indeterminado de usuarios.
     * 
     * @return type
     */
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