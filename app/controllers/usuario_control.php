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

            $resultModelo = $this->modelo->login_usuarios($_POST['nombre_usuario'], sha1($_POST['clave']));

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


                    session_start();
                    $_SESSION['dni'] = $resultModelo['datos']['dni'];
                    $_SESSION['nombre_usuario'] = $resultModelo['datos']['nombre_usuario'];
                    $_SESSION['perfil'] = $resultModelo['datos']['perfil'];
                    $_SESSION['nombre'] = $resultModelo['datos']['nombre'];
                    $_SESSION['foto'] = $resultModelo['datos']['fotografia'];
                    $_SESSION['apellidos'] = $resultModelo['datos']['apellido1'] . " " . $resultModelo['datos']['apellido2'];
                    $_SESSION['telefonos'] = $resultModelo['datos']['telefono_movil'] . " / " . $resultModelo['datos']['telefono_fijo'];
                    $_SESSION['correo'] = $resultModelo['datos']['correo'];

                    header("Location: " . base_url . "usuario/inicio");
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
            $foto = NULL;
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


            if (isset($_FILES["foto"]) && (!empty($_FILES["foto"]["tmp_name"]))) {

                if (!is_dir("../Assets/img/fotos/")) {
                    $dir = mkdir("fotos", 0777, true);
                } else {
                    $dir = true;
                }

                if ($dir) {

                    $nombrefichimg = time() . "-" . $_FILES["foto"]["name"];

                    $movfichimg = move_uploaded_file($_FILES["foto"]["tmp_name"], "../Assets/img/fotos/" . $nombrefichimg);
                    $foto = $nombrefichimg;

                    if ($movfichimg) {
                        $imagencargada = true;
                    } else {
                        $imagencargada = false;
                        $this->mensajes[] = [
                            "tipo" => "danger",
                            "mensaje" => "Error: La imagen no se cargó correctamente! :("
                        ];
                        $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
                    }
                }
            }

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

            $errores = filtro($campos);

            if ($errores['dni'] || $errores['nombre'] || $errores['apellido1'] || $errores['apellido2'] || $errores['nombre_usuario'] || $errores['password'] || $errores['telefono_fijo'] || $errores['telefono_movil'] || $errores['correo'] || $errores['web'] || $errores['twitter'] || $errores['blog']) {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Asegurate que todos los campos han sido introducidos correctamente"
                ];
            } else {

                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Tu usuario se registro, estas a la espera de activación"
                ];

                header("Location:" . base_url . "usuario/login");

                $resultModelo = $this->modelo->insert_usuarios($campos);
            }

            $parametros["mensajes"] = $this->mensajes;
        }

        include_once 'views/registro_view.php';
    }

    public function listado() {

        $parametros = [
            "tituloventana" => "Listado de Profesor/Administrador",
            "datos" => NULL,
            "mensajes" => []
        ];

        $resultModelo = $this->modelo->listado_usuarios();

        if ($resultModelo['correcto']) {

            $parametros['datos'] = $resultModelo['datos'];
        } else {

            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!!"
            ];
        }

        $parametros["mensajes"] = $this->mensajes;

        include_once 'views/listado_view.php';
    }

    public function listadoSolicitudes() {

        $parametros = [
            "tituloventana" => "Listado de profesores sin activar",
            "datos" => NULL,
            "mensajes" => []
        ];

        $resulModelo = $this->modelo->listado_sinActivar();

        if ($resulModelo['correcto']) {

            $parametros['datos'] = $resulModelo['datos'];
        } else {

            $this->mensajes[] = [
                "tipo" => "danger",
                "mensaje" => "El listado no pudo realizarse correctamente!!"
            ];
        }

        $parametros["mensajes"] = $this->mensajes;


        include_once 'views/listadoSolicitud_view.php';
    }

    public function delete() {

        if (isset($_GET['dni']) && (is_string($_GET['dni']))) {

            $dni = $_GET['dni'];

            $resultModelo = $this->modelo->borrar_usuario($dni);

            if ($resultModelo["correcto"]) {

                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Se eliminó correctamente el usuario"
                ];
            } else {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "No se eliminó correctamente el usuario"
                ];
            }
        }
        $this->listado();
    }

    public function actSolicitud() {

        if (isset($_GET['dni']) && (is_string($_GET['dni']))) {

            $dni = $_GET['dni'];

            $resultModelo = $this->modelo->actSolicitud($dni);

            if ($resultModelo['correcto']) {

                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Se eliminó correctamente el usuario"
                ];
            } else {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "No se eliminó correctamente el usuario"
                ];
            }
        }
        $this->listado();
    }

    public function actuser() {

        $valdni = "";
        $valnombre = "";
        $valapellido1 = "";
        $valapellido2 = "";
        $valfoto = "";
        $valnick = "";
        $valcontraseña = "";
        $valperfil = "";
        $valfijo = "";
        $valmovil = "";
        $valcorreo = "";
        $valdepartamento = "";
        $valweb = "";
        $valblog = "";
        $valtwitter = "";


        if (isset($_POST['registro'])) {

            $nuevodni = $_POST['dni'];
            $nuevonombre = $_POST['nombre'];
            $nuevoapellido1 = $_POST['apellido1'];
            $nuevoapellido2 = $_POST['apellido2'];
            $nuevofoto = "";
            $nuevonick = $_POST['nombre_usuario'];
            $nuevocontraseña = $_POST['contraseña'];
            $nuevoperfil = 'Profesor';
            $nuevotelefono_fijo = $_POST['telefono_fijo'];
            $nuevotelefono_movil = $_POST['telefono_movil'];
            $nuevocorreo = $_POST['correo'];
            $nuevodepartamento = $_POST['departamento'];
            $nuevoweb = $_POST['web'];
            $nuevoblog = $_POST['blog'];
            $nuevotwitter = $_POST['twitter'];

            $foto = NULL;


            if (isset($_FILES["foto"]) && (!empty($_FILES["foto"]["tmp_name"]))) {

                if (!is_dir("../Assets/img/fotos/")) {
                    $dir = mkdir("fotos", 0777, true);
                } else {
                    $dir = true;
                }

                if ($dir) {

                    $nombrefichimg = time() . "-" . $_FILES["foto"]["name"];

                    $movfichimg = move_uploaded_file($_FILES["foto"]["tmp_name"], "../Assets/img/fotos/" . $nombrefichimg);
                    $foto = $nombrefichimg;

                    if ($movfichimg) {
                        $imagencargada = true;
                    } else {
                        $imagencargada = false;
                        $this->mensajes[] = [
                            "tipo" => "danger",
                            "mensaje" => "Error: La imagen no se cargó correctamente! :("
                        ];
                        $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
                    }
                }
            }

            $nuevofoto = $foto;



            $campos = [
                'dni' => $nuevodni,
                'nombre' => $nuevonombre,
                'apellido1' => $nuevoapellido1,
                'apellido2' => $nuevoapellido2,
                'fotografia' => $foto,
                'nombre_usuario' => $nuevonick,
                'password' => $nuevocontraseña,
                'perfil' => $nuevoperfil,
                'telefono_fijo' => $nuevotelefono_fijo,
                'telefono_movil' => $nuevotelefono_movil,
                'correo' => $nuevocorreo,
                'departamento' => $nuevodepartamento,
                'web' => $nuevoweb,
                'blog' => $nuevoblog,
                'twitter' => $nuevotwitter
            ];

            $errores = filtro($campos);

            if ($errores['dni'] || $errores['nombre'] || $errores['apellido1'] || $errores['apellido2'] || $errores['nombre_usuario'] || $errores['password'] || $errores['telefono_fijo'] || $errores['telefono_movil'] || $errores['correo'] || $errores['web'] || $errores['twitter'] || $errores['blog']) {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Asegurate que todos los campos han sido introducidos correctamente"
                ];
            } else {

                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Actualización de usuario con exito"
                ];

                header("Location:" . base_url . "usuario/inicio");

                $resultModelo = $this->modelo->actualizar_usuario($campos);
            }



            $parametros["mensajes"] = $this->mensajes;

            $valdni = $nuevodni;
            $valnombre = $nuevonombre;
            $valapellido1 = $nuevoapellido1;
            $valapellido2 = $nuevoapellido2;
            $valfoto = $nuevofoto;
            $valnick = $nuevonick;
            $valcontraseña = $nuevocontraseña;
            $valperfil = $nuevoperfil;
            $valfijo = $nuevotelefono_fijo;
            $valmovil = $nuevotelefono_movil;
            $valcorreo = $nuevocorreo;
            $valdepartamento = $nuevodepartamento;
            $valweb = $nuevoweb;
            $valblog = $nuevoblog;
            $valtwitter = $nuevotwitter;
        } else {

            if (isset($_GET['dni']) && (is_string($_GET['dni']))) {

                $dni = $_GET['dni'];

                $resultModelo = $this->modelo->listado_usuario($dni);

                if ($resultModelo['correcto']) {

                    $this->mensajes[] = [
                        "tipo" => "success",
                        "mensaje" => "Los datos del usuario se obtuvieron correctamente"
                    ];
                    $valdni = $resultModelo["datos"]["dni"];
                    $valnombre = $resultModelo["datos"]["nombre"];
                    $valapellido1 = $resultModelo["datos"]["apellido1"];
                    $valapellido2 = $resultModelo["datos"]["apellido2"];
                    $valfoto = $resultModelo["datos"]["fotografia"];
                    $valnick = $resultModelo["datos"]["nombre_usuario"];
                    $valcontraseña = $resultModelo["datos"]["password"];
                    $valperfil = $resultModelo["datos"]["perfil"];
                    $valfijo = $resultModelo["datos"]["telefono_fijo"];
                    $valmovil = $resultModelo["datos"]["telefono_movil"];
                    $valcorreo = $resultModelo["datos"]["correo"];
                    $valdepartamento = $resultModelo["datos"]["departamento"];
                    $valweb = $resultModelo["datos"]["web"];
                    $valblog = $resultModelo["datos"]["blog"];
                    $valtwitter = $resultModelo["datos"]["twitter"];
                } else {

                    $this->mensajes[] = [
                        "tipo" => "danger",
                        "mensaje" => "No se pudieron obtener los datos de usuario"
                    ];
                }
            }
        }

        $parametros = [
            "tituloventana" => "Actualización de Profesores",
            "datos" => [
                "dni" => $valdni,
                "nombre" => $valnombre,
                "apellido1" => $valapellido1,
                "apellido2" => $valapellido2,
                "foto" => $valfoto,
                "nombre_usuario" => $valnick,
                "contraseña" => $valcontraseña,
                "telefono_fijo" => $valfijo,
                "telefono_movil" => $valmovil,
                "correo" => $valcorreo,
                "departamento" => $valdepartamento,
                "web" => $valweb,
                "blog" => $valblog,
                "twitter" => $valtwitter
            ],
            "mensajes" => $this->mensajes
        ];




        include_once 'views/actualizar_view.php';
    }

    public function registroAdmin() {

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
            $foto = NULL;
            $nick = $_POST['nombre_usuario'];
            $contraseña = $_POST['contraseña'];
            $perfil = $_POST['perfil'];
            $telefono_fijo = $_POST['telefono_fijo'];
            $telefono_movil = $_POST['telefono_movil'];
            $correo = $_POST['correo'];
            $departamento = $_POST['departamento'];
            $web = $_POST['web'];
            $blog = $_POST['blog'];
            $twitter = $_POST['twitter'];
            $activo = 1;
            $fecha_alta = date('d/n/Y');


            if (isset($_FILES["foto"]) && (!empty($_FILES["foto"]["tmp_name"]))) {

                if (!is_dir("../Assets/img/fotos/")) {
                    $dir = mkdir("fotos", 0777, true);
                } else {
                    $dir = true;
                }

                if ($dir) {

                    $nombrefichimg = time() . "-" . $_FILES["foto"]["name"];

                    $movfichimg = move_uploaded_file($_FILES["foto"]["tmp_name"], "../Assets/img/fotos/" . $nombrefichimg);
                    $foto = $nombrefichimg;

                    if ($movfichimg) {
                        $imagencargada = true;
                    } else {
                        $imagencargada = false;
                        $this->mensajes[] = [
                            "tipo" => "danger",
                            "mensaje" => "Error: La imagen no se cargó correctamente! :("
                        ];
                        $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
                    }
                }
            }

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

            $errores = filtro($campos);

            if ($errores['dni'] || $errores['nombre'] || $errores['apellido1'] || $errores['apellido2'] || $errores['nombre_usuario'] || $errores['password'] || $errores['telefono_fijo'] || $errores['telefono_movil'] || $errores['correo'] || $errores['web'] || $errores['twitter'] || $errores['blog']) {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Asegurate que todos los campos han sido introducidos correctamente"
                ];
            } else {

                $this->mensajes[] = [
                    "tipo" => "success",
                    "mensaje" => "Tu usuario se registro y se activo"
                ];

                header("Location: " . base_url . "usuario/inicio");

                $resultModelo = $this->modelo->insert_usuariosAdmin($campos);
            }

            $parametros["mensajes"] = $this->mensajes;
        }

        include_once 'views/registroAdmin_view.php';
    }

    public function verperfil() {

        $parametros = [
            "tituloventana" => "Perfil de Profesor",
            "datos" => [],
            "mensajes" => []
        ];


        if (isset($_GET['dni'])) {

            $dni = $_GET['dni'];

            $resultModelo = $this->modelo->listado_usuario($dni);

            if ($resultModelo['correcto']) {

                $parametros['datos'] = $resultModelo['datos'];
            } else {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "El listado no pudo realizarse correctamente!!"
                ];
            }

            $parametros["mensajes"] = $this->mensajes;
        }

        include_once 'views/perfil_view.php';
    }

    public function listadoFM() {

        $parametrosFM = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => ""
        ];

        if (isset($_POST['ensenanzas'])) {

            $resultModelo = $this->modelo->listadoFM($_POST['ensenanzas']);

            if ($resultModelo['correcto']) {

                $parametrosFM['datos'] = $resultModelo['datos'];
            } else {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "El listado no pudo realizarse correctamente!!"
                ];
            }
        }


        $parametros["mensajes"] = $this->mensajes;


        include_once 'views/asignaturas_view.php';
    }

    public function listadoCF() {

        $parametrosCF = [
            "correcto" => FALSE,
            "datos" => NULL,
            "error" => ""
        ];

        if (isset($_POST['familia'])) {

            $resultModelo = $this->modelo->listadoCF($_POST['familia']);

            if ($resultModelo['correcto']) {

                $parametrosCF['datos'] = $resultModelo['datos'];
            } else {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "El listado no pudo realizarse correctamente!!"
                ];
            }
        }


        $parametros["mensajes"] = $this->mensajes;


        include_once 'views/asignaturas_view.php';
    }

    public function enviarMensaje() {

        include_once 'views/enviarMensaje_view.php';
    }

    public function inicio() {

        include_once 'views/inicio_view.php';
    }

    public function opcionesAdmin() {

        include_once 'views/opcionesAdmin_view.php';
    }

    public function cerrar() {

        session_destroy();

        header("Location:" . base_url . "usuario/login");
    }

}
?>

