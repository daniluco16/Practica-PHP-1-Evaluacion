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

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style>

            th{

                background-color: black;
                text-align: center;
                color: white;

            }

        </style>


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
                            <th scope="col">NIF del remitente</th>
                            <th scope="col">Fecha del Mensaje</th>
                            <th scope="col">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $contador = 0;
                        $modal = "";
                        
                        $modal2 = "";
                        ?>
                        <?php foreach ($parametros["datos"] as $datos) : ?>

                            <?php
                            $contador++;
                            $modal = "s" . $contador;
                            $modal2 = "m" . $contador;
                            ?>

                            <tr>
                                <td><?= $datos['titulo'] ?></td>
                                <td><?= $datos['Usuarios_dni'] ?></td>
                                <td><?= $datos['fecha_mensaje'] ?></td>
                                <td>
                                    <a data-toggle="modal" href="#<?= $modal ?>">Ver Contenido</a>
                                    <a data-toggle="modal" href="#<?= $modal2 ?>">Eliminar Mensaje</a><br>
                                </td>
                            </tr>


                        <div class="modal fade" id="<?= $modal ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Contenido del Mensaje</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $datos['contenido']?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </tbody>
                        <!-- Modal -->
                        <div class="modal fade" id="<?= $modal2 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Profesor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro que quieres eliminar a este Profesor?
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-primary" href="<?= base_url ?>usuario/eliminarMensajes&codMensaje=<?= $datos['codMensaje'] ?>">Eliminar</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>          
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

