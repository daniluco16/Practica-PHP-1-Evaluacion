<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?=base_url?>../Assets/css/opcionesadmin_style.css">

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>
            .texto1, .texto2, .texto3{
                font-family: Poppins-Bold;
                text-align: center;
            }
            .texto2{
                margin-right: 20%;
            }
            .texto3{
                margin-right: 15%;
            }

            .imagen, .fototil{

                width: 150px;
                height: 100px;

            }
        </style>

    </head>
    <body>
        <div class="titulo">
            <div class="imagen"><img class="fototil" src="<?=base_url?>../Assets/img/settings.svg"></div>
            <div><h1>Opciones de Administrador</h1></div>
        </div>
        <div class="grid">
            <div class="menu1">
                <a href="<?=base_url?>usuario/registroAdmin"><img src="<?=base_url?>../Assets/img/browser.svg"></a>
                <div class="texto1"><h1>Añadir</h1></div>
            </div>
            <div class="menu2">
                <a href="<?=base_url?>usuario/listadoSolicitudes"><img src="<?=base_url?>../Assets/img/support.svg"></a>
                <div class="texto2"><h1>Solicitudes</h1></div>
            </div>
            <div class="menu3">           
                <a href="<?=base_url?>usuario/inicio"><img src="<?=base_url?>../Assets/img/exit.svg"></a>
                <div class="texto3"><h1>Cerrar</h1></div>
            </div>
        </div>

        <div class="footer">

        </div>

    </body>
</html>
