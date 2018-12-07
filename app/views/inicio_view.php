<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?=base_url?>../Assets/css/inicio_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand act" href="#">MOODLE</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="act"><a href="#"><span class="glyphicon glyphicon-star"></span>&nbsp;ADMINISTRADOR</a></li>
                    <li class="act"><a href="<?=base_url?>usuario/listadoFM"><span class="glyphicon glyphicon-star-empty"></span>&nbsp;ASIGNATURAS</a></li>
                    <li class="act"><a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;MENSAJES</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="act"><a href="<?=base_url?>usuario/verperfil&dni=<?=$_SESSION['dni']?>"><span class="glyphicon glyphicon-user"></span>&nbsp; <?= $_SESSION['nombre_usuario'] . "(" . $_SESSION['perfil'] . ")"; ?></a></li>
                    <li class="act"><a href="<?=base_url?>usuario/cerrar"><span class="glyphicon glyphicon-off"></span>Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>

        <div class="grid">
            <div class="menu1">
                <a  href= "<?= ($_SESSION['perfil'] == 'Administrador') ? base_url . "usuario/opcionesAdmin" : ""?>"> <img src="<?=base_url?>../Assets/img/admin-with-cogwheels.svg"></a>
                <div class="texto1"><h1>Administrador</h1></div>
            </div>
            <div class="menu2">
                <a href="<?=base_url?>usuario/listado"><img src="<?=base_url?>../Assets/img/classroom.svg"></a>
                <div class="texto2"><h1>Listado de Profesores</h1></div>
            </div>
            <div class="menu3">           
                <a href="<?=base_url?>usuario/enviarMensaje"><img src="<?=base_url?>../Assets/img/envelope.svg"></a>
                <div class="texto3"><h1>Mensajes</h1></div>
            </div>

        </div> 


    </body>
</html>