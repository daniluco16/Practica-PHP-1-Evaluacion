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
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/correo_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>

            .form-group{

                width: 300px;
                text-align: center;
                margin: 0 auto;
                padding-top: 20px;
            }

            textarea{
                resize: none;
            }
            th{
                text-align: center;
            }

        </style>
    </head>
    <body>

        <div class="contenedor">

            <div class="cabecera">
                <img src="<?= base_url ?>../Assets/img/gmail.svg" width="100"><h1 class="titulo">Envio de Correo</h1>
            </div>
            <form action="<?= base_url ?>usuario/envioCorreo" method="post" enctype="multipart/form-data">

                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>

<?php foreach ($parametros["datos"] as $datos) : ?>

                            <?php if ($datos['nombre_usuario'] != $_SESSION['nombre_usuario']) { ?>
                                <tr>
                                    <td><?= $datos['nombre'] ?></td>
                                    <td><?= $datos['apellido1'] . " " . $datos['apellido2'] ?></td>
                                    <td><?= $datos['correo'] ?></td>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="check_list[]" value="<?= $datos['correo'] ?>">
                                            </label>
                                        </div>

    <?php } ?>
                                </td>
                            </tr>

                        </tbody>

                        <input type="hidden" name="remitente" value="<?= $_SESSION['correo'] ?>">

<?php endforeach; ?>
                </table>

                <div class="form-group">
                    <label for="usr">Asunto</label>
                    <input type="text" name="asunto" class="form-control" id="usr">
                </div>

                <div class="form-group">
                    <label for="comment">Comentario</label>
                    <textarea class="form-control" rows="5" id="comentario" name="mensaje"></textarea>
                </div>


                <div class="botones">

                    <button type="submit" class="btn btn-primary btn-lg" name="submit">Enviar</button>
                    <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger btn-lg">Cerrar</button></a>
                </div>

            </form>
        </div>
    </body>
</html>
