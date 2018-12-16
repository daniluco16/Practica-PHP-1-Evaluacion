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


            <form action="<?= base_url ?>usuario/ingresarAsignaturas" method="post" class="form-inline">

                <div class="form-group">
                    <select class="form-control" name="ensenanzas" id="ensenanzas">
                        <option value="">Enseñanzas</option>
                        <option value="ESO" disabled="">ESO</option>
                        <option value="Bachillerato" disabled="">Bachillerato</option>
                        <option value="Ciclo Formativo">Ciclo Formativo</option>
                    </select>
                </div>


                <div class="form-group">               

                    <select class="form-control" name="familia" id="familia">
                        <option value="" id="defaultFM">Familias Profesionales</option>

                    </select>
                </div>

                <div class="form-group">

                    <select class="form-control" name="ciclo" id="ciclo">
                        <option selected="" disabled="">Asignar Ciclos</option>

                    </select>
                </div>

                <div class="form-group">

                    <select class="form-control" name="modulo" id="modulo">
                        <option selected="" disabled="">Asignar Módulo</option>

                    </select>
                </div>

                <div class="form-group">

                    <select class="form-control" name="curso" id="curso">
                        <option selected="" disabled="">Asignar Curso</option>

                    </select>
                </div>

                <div class="form-group">

                    <select class="form-control" name="grupo" id="grupo">
                        <option selected="" disabled="">Asignar Grupo</option>

                    </select>
                </div>

                <input type="hidden" name="pruebaensenanza" id="pruebaensenanza">
                <input type="hidden" name="pruebaFP" id="pruebaFP">
                <input type="hidden" name="pruebaCiclo" id="pruebaCiclo">
                <input type="hidden" name="pruebaModulo" id="pruebaModulo">
                <input type="hidden" name="pruebaCurso" id="pruebaCurso">
                <input type="hidden" name="pruebaGrupo" id="pruebaGrupo">
                
                <div class="botones">
                    <button type="submit" class="btn btn-dark" name="submit">AGREGAR</button>
                    <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger">CERRAR</button></a>
                </div>

            </form>

        </div>


        <script>

            $(document).ready(function () {

                $('#ensenanzas').change(function () {

                    var ensenanzas = $('#ensenanzas').val();

                    if (ensenanzas !== '')
                    {
                        var ensenanzaselec = $('#ensenanzas option:selected').text();

                        document.getElementById('pruebaensenanza').value = ensenanzaselec;

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

                        var familiaselec = $('#familia option:selected').text();

                        document.getElementById('pruebaFP').value = familiaselec;

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
                        var cicloselec = $('#ciclo option:selected').text();

                        document.getElementById('pruebaCiclo').value = cicloselec;

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

                $('#modulo').change(function () {

                    var modulo = $('#modulo').val();

                    if (modulo !== '')
                    {

                        var moduloselec = $('#modulo option:selected').text();

                        document.getElementById('pruebaModulo').value = moduloselec;

                        $.ajax({
                            url: "<?php echo base_url ?>usuario/listadoCurso",
                            method: "POST",
                            data: {modulo: modulo},
                            success: function (data)
                            {
                                $('#curso').html(data);
                            }
                        });
                    } else {
                        $('#curso').html('<option value="">Curso</option>');
                        $('#grupo').html('<option value="">Grupo</option>');
                    }
                });

                $('#curso').change(function () {

                    var curso = $('#curso').val();

                    if (curso !== '')
                    {

                        var cursoselec = $('#curso option:selected').text();

                        document.getElementById('pruebaCurso').value = cursoselec;

                        $.ajax({
                            url: "<?php echo base_url ?>usuario/listadoGrupo",
                            method: "POST",
                            data: {curso: curso},
                            success: function (data)
                            {
                                $('#grupo').html(data);
                            }
                        });
                    } else {
                        $('#grupo').html('<option value="">Grupo</option>');
                    }
                });

                $('#grupo').change(function () {

                    var gruposelec = $('#grupo option:selected').text();

                    document.getElementById('pruebaGrupo').value = gruposelec;


                });



            });

        </script>

    </body>
</html>

