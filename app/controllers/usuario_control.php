<?php

include_once 'regex/regex.php';

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

        if (isset($_POST['submit']) && isset($_POST['nombre_usuario']) && isset($_POST['clave'])) {

            $resultModelo = $this->modelo->login_usuarios($_POST['nombre_usuario'], $_POST['clave']);

            if ($resultModelo['datos'] != NULL) { //Consulta ejecutada correctamenta
                if ($resultModelo['datos']['activo'] == 0) {

                    $this->mensajes[] = [
                        "tipo" => "warning",
                        "mensaje" => "Su cuenta no está activada aún"
                    ];
                } else {

                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "El login se realizo correctamente"
                    ];
                    header("Location: views/inicio_view.php");
                }
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

    public function adduser() {

        $parametros = [
            "tituloventana" => "Registro de Profesores",
            "datos" => [],
            "mensajes" => []
        ];

        if (isset($_POST['registro'])) {

            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $foto = $_POST['foto'];
            $nick = $_POST['nombre_usuario'];
            $contraseña = $_POST['contraseña'];
            $perfil = 'Profesor';
            $telefono_fijo = $_POST['telefono_fijo'];
            $telefono_movil = $_POST['telefono_movil'];
            $correo = $_POST['correo'];
            $departamento = $_POST['departamento'];
            $web = $_POST['web'];
            $blog = $_POST['blog'];
            $twitter = $_POST['twitter'];
            $activo = 0;
            $fecha_alta = date('d/n/Y');

            $campos = [
                'dni' => $dni,
                'nombre' => $nombre,
                'apellido1' => $apellido1,
                'apellido2' => $apellido2,
                'fotografia' => $foto,
                'nombre_usuario' => $nick,
                'password' => $contraseña,
                'perfil' => $perfil,
                'telefono_fijo' => $telefono_fijo,
                'telefono_movil' => $telefono_movil,
                'correo' => $correo,
                'departamento' => $departamento,
                'web' => $web,
                'blog' => $blog,
                'twitter' => $twitter,
                'activo' => $activo,
                'fecha_alta' => $fecha_alta
            ];

            var_dump($campos);
            
            

            $errores = filtro($campos);
            
            var_dump($errores);


            if ($errores['dni'] || $errores['nombre'] || $errores['apellido1'] || $errores['apellido2'] || $errores['password'] || $errores['telefono_fijo'] || $errores['telefono_movil'] || $errores['correo'] || $errores['web'] || $errores['twitter'] || $errores['blog']) {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Asegurate que todos los campos han sido introducidos correctamente"
                ];
            } else {

                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Tu usuario se registro, estas a la espera de activación"
                ];

                header("Location: index.php?controller=usuario&action=login");
                
                $resultModelo = $this->modelo->insert_usuarios($campos);
            }

            $parametros["mensajes"] = $this->mensajes;

            //Validar imagen
            /* if (isset($_FILES["foto"]) && (!empty($_FILES["foto"]["tmp_name"]))) {

              if (!is_dir("fotos")) {

              $dir = mkdir("fotos", 0777, TRUE);
              } else {

              $dir = TRUE;
              }

              if ($dir) {

              $nombre_fichero = time() . "-" . $_FILES["foto"]["name"];

              $movfichero = move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/" . $nombre_fichero);
              $imagen = $nombre_fichero;

              if ($movfichero) {

              $imagencargada = TRUE;
              } else {

              $imagencargada = FALSE;


              $this->mensajes[] = [
              "tipo" => "danger",
              "mensaje" => "Error al cargar la imagen"
              ];
              }
              }
              }
             */


            
        }

        include_once 'views/registro_view.php';
    }

}
?>

