<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
if (!isset($_SESSION["nombre_usuario"])) {

    header("Location:" . base_url . "usuario/login");
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>
            th{

                background-color: black;
                color: white;

            }
            td{

                text-align: center;

            }
            .contenedor{
                
                width: 80%;
                margin: 0 auto;
                margin-top: 3%;
            }
            .footer{
                width: 100px;
                height: 100px;
            }

        </style>
    </head>
    <body>

        
        
        <div class="contenedor">
            <table class="table">
                <thead class="black white-text text-center">
                    <tr>
                        <th scope="col">USUARIO</th>
                        <th scope="col">PERFIL</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">ACTIVIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($parametros["datos"] as $datos) : ?>
                    <tr>
                        <td><?= $datos['usuario']?></td>
                        <td><?= $datos['perfil']?></td>
                        <td><?= $datos['fechayhora']?></td>
                        <td><?= $datos['actividad']?></td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="footer">
            
            <a href="<?= base_url ?>usuario/inicio"><img src="<?= base_url ?>../Assets/img/next.svg"></a>
            
        </div>


    </body>
</html>
