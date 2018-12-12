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
        <title>Listado de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/listado_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">            

        <style>

            @font-face {
                font-family: Poppins-Bold;
                src: url('fonts/Poppins-Bold.ttf'); 
            }

            .footer{

                position: fixed;
                bottom: 0;
                width: 100%;
                height:70px; 
                color: white;
                text-align: center;    
                background-color: #3F3F47;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            th{

                text-align: center;
                font-family:Poppins-Bold;
            }
            .pdf{


                color: #DD0415;
            }
            a{
                font-family:Poppins-Bold;
            }

        </style>

    </head>
    <body>
        <div class="cabecera">
            <h1>Listado de Profesorado</h1>       
        </div>

        <div class="container">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#activo">Usuario Activo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#inactivo">Usuario Inactivo</a>
                </li>
            </ul>


            <div class="tab-content">

                <div class="tab-pane container active" id="activo">
                    <table class="table table-responsive table-striped text-center">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Perfil</th>
                                <th>Foto</th>
                                <th>Fecha Alta</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            $modal = "";
                            ?>


                            <?php foreach ($parametros["datos"] as $datos) : ?>

                                <?php if ($datos['activo'] == 1) { ?>
                                    <?php
                                    $contador++;
                                    $modal = "m" . $contador;
                                    ?>



                                    <?php if ($datos['nombre_usuario'] != $_SESSION['nombre_usuario']) { ?>
                                        <tr>

                                            <td><?= $datos['nombre'] ?></td>
                                            <td><?= $datos['apellido1'] . " " . $datos['apellido2'] ?></td>
                                            <td><?= $datos['nombre_usuario'] ?></td>
                                            <td><?= $datos['correo'] ?></td>
                                            <td><?= $datos['perfil'] ?></td>

                                            <?php if ($datos['fotografia'] != null) : ?>
                                                <td><img src="<?= base_url ?>../Assets/img/fotos/<?= $datos['fotografia'] ?>" width="40"/></td>
                                            <?php else : ?>
                                                <td>----</td>
                                            <?php endif; ?>
                                            <td><?= $datos['fecha_alta'] ?></td>

                                            <td>
                                                <a href="<?= base_url ?>usuario/verperfil&dni=<?= $datos['dni'] ?>">Ver Perfil </a><br>
                                                <?php if ($_SESSION['perfil'] == 'Administrador') { ?>
                                                    <a href="<?= base_url ?>usuario/actuser&dni=<?= $datos['dni'] ?>">Editar </a>&nbsp;
                                                    <a data-toggle="modal" href="#<?= $modal ?>" > Eliminar</a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                    <div class="modal fade" id="<?= $modal ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                    <a class="btn btn-primary" href="<?= base_url ?>usuario/delete&dni=<?= $datos['dni'] ?>">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </tbody>
                                <?php } ?>
                            <?php } endforeach; ?>
                    </table>
                </div>

                <div class="tab-pane container fade" id="inactivo"><table class="table table-responsive table-striped text-center">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Perfil</th>
                                <th>Foto</th>
                                <th>Fecha Alta</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            $modal = "";
                            ?>


                            <?php foreach ($parametros["datos"] as $datos) : ?>
                                <?php if ($datos['activo'] == 0) { ?>
                                    <?php
                                    $contador++;
                                    $modal = "m" . $contador;
                                    ?>



                                    <?php if ($datos['nombre_usuario'] != $_SESSION['nombre_usuario']) { ?>
                                        <tr>

                                            <td><?= $datos['nombre'] ?></td>
                                            <td><?= $datos['apellido1'] . " " . $datos['apellido2'] ?></td>
                                            <td><?= $datos['nombre_usuario'] ?></td>
                                            <td><?= $datos['correo'] ?></td>
                                            <td><?= $datos['perfil'] ?></td>

                                            <?php if ($datos['fotografia'] != null) : ?>
                                                <td><img src="<?= base_url ?>../Assets/img/fotos/<?= $datos['fotografia'] ?>" width="40"/></td>
                                            <?php else : ?>
                                                <td>----</td>
                                            <?php endif; ?>
                                            <td><?= $datos['fecha_alta'] ?></td>
                                        </tr>


                                    </tbody>
                                <?php } ?>
                            <?php } endforeach; ?>
                    </table>
                </div>

            </div>


        </div>

        <div class="contenedor">
            <a class="volver" href="<?= base_url ?>usuario/inicio">Volver al Inicio</a> 
            <a class="pdf" href="<?= base_url ?>usuario/print_pdf">Imprimir en PDF</a>  
        </div> 

        <div class="footer">


        </div>
    </body>
</html>

