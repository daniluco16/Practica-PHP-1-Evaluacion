<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>

<?php
if (!isset($_SESSION["nombre_usuario"])) {

    header("Location:" . base_url . "usuario/login");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/registro_style.css">

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>

            .cabecera{

                border-style: outset;
            }
            button{
                margin-left: 30px;
            }
            #option{
                width: 200px;
            }
            .contenedor{

                background-color: #fff;
            }



        </style>
    </head>
    <body>

        <div class="cabecera">
            <div class="imagen"><img src="<?= base_url ?>../Assets/img/teacher.svg"></div>
            <div><h1 class="titulo">Registro de Profesores y Activación</h1></div>
        </div>

        <form action="<?= base_url ?>usuario/registroAdmin" method="post" enctype="multipart/form-data">
            <div class="contenedor">

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                    <input id="dni" type="text" class="form-control" name="dni" placeholder="DNI">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="apellido1" type="text" class="form-control" name="apellido1" placeholder="Apellido 1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="apellido2" type="text" class="form-control" name="apellido2" placeholder="Apellido 2">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                    <input id="foto" type="file" class="form-control" name="foto">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
                    <input id="nick" type="text" class="form-control" name="nombre_usuario" placeholder="Alias">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="contraseña" type="password" class="form-control" name="contraseña" placeholder="Contraseña">
                </div>

                <div class="form-group">
                    <select class="form-control" id="option" name="perfil">
                        <option value="Profesor">Profesor</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                    <input id="telefono_fijo" type="text" class="form-control" name="telefono_fijo" placeholder="Teléfono Fijo">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input id="telefono_movil" type="text" class="form-control" name="telefono_movil" placeholder="Teléfono Movil">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="correo" type="email" class="form-control" name="correo" placeholder="Correo">
                </div>
                <div class="form-group">
                    <select class="form-control" id="option" name="departamento">
                        <option value="Informática">Informática</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                    <input id="web" type="text" class="form-control" name="web" placeholder="Web  http o https">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                    <input id="blog" type="text" class="form-control" name="blog" placeholder="Blog">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                    <input id="twitter" type="text" class="form-control" name="twitter" placeholder="Twitter  @....">
                </div>

                <div class="input-group">

                </div>

                <div class="input-group">
                    <button type="submit" class="btn btn-success" name="registro">REGISTRAR</button>
                </div>

                <div class="input-group">
                    <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-info" name="submit_volver">VOLVER AL INICIO</button></a>
                </div>

                <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
                    <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                <?php endforeach; ?>


            </div>
        </form>

    </body>
</html>



