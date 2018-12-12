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
        <title>Inicio de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/asignaturas_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js%22%3E"></script>



    </head>
    <body>
        <div class="contenedor">
            <h1>Asignar Asignaturas</h1>        
        </div>
        <div class="contenido">


            <form action="<?= base_url ?>usuario/listadoAsignaturas" method="post" class="form-inline">

                <div class="form-group">
                    <select class="form-control" name="ensenanzas" id="ensenanzas">

<?php if ($enseñanzas == "") { ?>

                            <option selected="" disabled="">Enseñanzas</option>

<?php } else { ?>

                            <option selected="" disabled=""><?= $enseñanzas ?></option>

<?php } ?>

                        <option value="ESO">ESO</option>
                        <option value="Bachillerato">Bachillerato</option>
                        <option value="Ciclo Formativo">Ciclo Formativo</option>
                    </select>
                </div>


                <div class="form-group" id="familia">               

                    <select class="form-control" name="familia">
<?php if ($familia == "") { ?>

                            <option selected="" disabled="">Familias Profesionales</option>

<?php } else { ?>

                            <option selected="" disabled=""><?= $familia ?></option>

<?php } ?>

                        <?php foreach ($familiasProf as $datos) : ?>

                            <option value="<?= $datos['nombre'] ?>"><?= $datos['nombre'] ?></option>

<?php endforeach; ?>
                    </select>
                </div>




                <div class="form-group" id="ciclo">

                    <select class="form-control" name="ciclo">
                        <option selected="" disabled="">Asignar Ciclos</option>

<?php foreach ($parametrosCF['datos'] as $datos) : ?>

                            <option value="<?= $datos['nombre'] ?>"><?= $datos['nombre'] ?></option>

<?php endforeach; ?>
                    </select>
                </div>



                <!--                <div class="form-group" id="modulos">
                
                                    <select class="form-control" name="modulos">
                                        <option selected="" disabled="">Asignar Módulos</option>
                                    </select>
                                </div>
                
                
                
                
                                <div class="form-group" id="curso">
                
                                    <select class="form-control" name="curso">
                                        <option selected="" disabled="">Asignar Curso</option>
                                    </select>
                                </div>
                
                                <div class="form-group" id="grupo">
                
                                    <select class="form-control" name="grupo">
                                        <option selected="" disabled="">Asignar Grupo</option>
                                    </select>
                                </div>
                
                                <div class="form-group" id="asignatura">
                
                                    <select class="form-control" name="asignatura">
                                        <option selected="" disabled="">Asignar Asignaturas</option>
                                    </select>
                                </div>-->



            </form>

            <script>


                $("document").ready(function () {

                    $("#ensenanzas").change(function ()
                    {
                        alert("hola");
                        var $form = $(this).closest('form');

                        $form.find('input[type=submit][name="submit"]').click();

                    });

                    $("h1").click(function () {

                        alert("titulo");

                    });


                });


            </script>

            <input type="submit" value="Enviar" name="submit" style="display: none">

        </div>
        <div class="botones">
            <button type="button" class="btn btn-dark" name="submit">AGREGAR</button>
            <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger">CERRAR</button></a>
        </div>


    </body>
</html>

