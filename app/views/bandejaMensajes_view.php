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
        <title>Listado de Mensajes</title>
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/bandejaMensajes_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/css/mdb.min.css" rel="stylesheet">




        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    </head>

    <body>
        <div class="contenedor">

            <div class="cabecera">

                <h1>Bandeja de Mensajes</h1>

            </div>

            <div class="tabla">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Título Mensaje</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">NIF del remitente</th>
                            <th scope="col">Fecha del Mensaje</th>
                            <th scope="col">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $contador = 0;
                        $modal = "";
                        ?>
                        <?php foreach ($parametros["datos"] as $datos) : ?>

                            <?php
                            $contador++;
                            $modal = "s" . $contador;
                            ?>

                            <tr>
                                <td><?= $datos['titulo'] ?></td>
                                <td><?= $datos['contenido'] ?></td>
                                <td><?= $datos['Usuarios_dni'] ?></td>
                                <td><?= $datos['fecha_mensaje'] ?></td>
                                <td>
                                    <a data-toggle="modal" href="#<?= $modal ?>">Eliminar Mensaje </a><br>




                                </td>
                            </tr>




                        </tbody>
                        <!-- Modal -->
                        <div class="modal fade" id="<?= $modal ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
                            <div class="modal-dialog modal-dialog-centered" role="document">


                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a type="button" class="btn btn-primary" href="<?= base_url ?>usuario/eliminarMensajes&codMensaje=<?= $datos['codMensaje'] ?>">Save changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="botones">
                <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger">CERRAR</button> </a>         
            </div>

        </div>

    </body>
</html>

