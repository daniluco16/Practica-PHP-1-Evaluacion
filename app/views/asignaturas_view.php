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
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/asignaturas_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <?php include 'links.php'; ?>

    </head>
    <body>
        <div class="contenedor">
            <h1>Asignar Asignaturas</h1>        
        </div>
        <div class="contenido">


            <form action="<?= base_url ?>usuario/listadoAsignaturas" method="post" class="form-inline">

                <div class="form-group">
                    <select class="form-control" name="ensenanzas" id="ensenanzas">
                        <option value="">Enseñanzas</option>
                        <option value="ESO">ESO</option>
                        <option value="Bachillerato">Bachillerato</option>
                        <option value="Ciclo Formativo">Ciclo Formativo</option>
                    </select>
                </div>


                <div class="form-group">               

                    <select class="form-control" name="familia" id="familia">

                        <option value="">Familias Profesionales</option>

                    </select>
                </div>

                <div class="form-group">

                    <select class="form-control" name="ciclo" id="ciclo">
                        <option selected="" disabled="">Asignar Ciclos</option>

                    </select>
                </div>

            </form>


        </div>
        <div class="botones">
            <button type="button" class="btn btn-dark" name="submit">AGREGAR</button>
            <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger">CERRAR</button></a>
        </div>

        <script>

            $(document).ready(function () {

                $('#ensenanzas').change(function () {

                    var ensenanzas = $('#ensenanzas').val();

                    if (ensenanzas !== '')
                    {

                        $.ajax({

                            url: "<?php echo base_url ?>usuario/listadoFM",
                            method: "POST",
                            data: {ensenanzas: ensenanzas},
                            success: function (data)
                            {
                                $('#familia').html(data);

                            }
                        });

                    } else {

                        $('#familia').html('<option value="">Seleccionar familia profesional</option>');
                        $('#ciclo').html('<option value="">Seleccionar ciclo</option>');
                        $('#modulo').html('<option value="">Seleccionar módulo</option>');
                        $('#curso').html('<option value="">Curso</option>');
                        $('#grupo').html('<option value="">Grupo</option>');
                    }
                });

                $('#familia').change(function () {

                    var familia = $('#familia').val();

                    if (familia !== '')
                    {

                        $.ajax({

                            url: "<?php echo base_url ?>usuario/listadoCF",
                            method: "POST",
                            data: {familia: familia},
                            success: function (data)
                            {
                                $('#ciclo').html(data);
                            }
                        });

                    } else {
                        $('#ciclo').html('<option value="">Seleccionar ciclo</option>');
                        $('#modulo').html('<option value="">Seleccionar módulo</option>');
                        $('#curso').html('<option value="">Curso</option>');
                        $('#grupo').html('<option value="">Grupo</option>');
                    }
                });
                $('#ciclo').change(function () {

                    var ciclo = $('#ciclo').val();

                    if (ciclo !== '')
                    {

                        $.ajax({

                            url: "<?php echo base_url ?>usuario/listadoModulo",
                            method: "POST",
                            data: {ciclo: ciclo},
                            success: function (data)
                            {
                                $('#modulo').html(data);
                            }
                        });

                    } else {
                        $('#modulo').html('<option value="">Seleccionar módulo</option>');
                        $('#curso').html('<option value="">Curso</option>');
                        $('#grupo').html('<option value="">Grupo</option>');
                    }
                });



            });

        </script>

    </body>
</html>

