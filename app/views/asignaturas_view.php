<!DOCTYPE html>

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


            <form action="<?=base_url?>usuario/listadoFM" method="post">
                <div class="form-group">
                    <h1>Enseñanzas</h1>
                    <select class="form-control" name="ensenanzas" onchange="this.form.submit()">
                        <option selected="" disabled=""><?= isset($_POST['ensenanzas']) ? $_POST['ensenanzas'] : "Enseñanzas" ?></option>
                        <option value="ESO">ESO</option>
                        <option value="Bachillerato">Bachillerato</option>
                        <option value="Ciclo Formativo">Ciclo Formativo</option>
                    </select>
                </div>
            </form>

                <form action="<?=base_url?>usuario/listadoCF" method="post">
                    <div class="form-group" id="familia">               
                        <h1>Familia Profesional</h1>

                        <select class="form-control" name="familia" onchange="this.form.submit()">
                            <option selected="" disabled=""><?= isset($_POST['familia']) ? $_POST['familia'] : "Asignar Familias Profesionales" ?></option>
                            
                            <?php foreach ($parametrosFM["datos"] as $datos) : ?>
                            
                            <option value="<?= $datos['nombre']?>"><?= $datos['nombre']?></option>
                            
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>


            <form action="" method="post">
                    <div class="form-group" id="ciclo">
                        <h1>Ciclos</h1>

                        <select class="form-control" name="ciclo" onchange="this.form.submit()">
                            <option selected="" disabled="">Asignar Ciclos</option>
                            
                            <?php foreach ($parametrosCF['datos'] as $datos) : ?>
                            
                            <option value="<?= $datos['nombre']?>"><?= $datos['nombre']?></option>
                            
                            <?php endforeach;?>
                        </select>
                    </div>
                </form>


            <form action="" method="post">
                    <div class="form-group" id="modulos">
                        <h1>Módulos</h1>

                        <select class="form-control" name="modulos">
                            <option selected="" disabled="">Asignar Módulos</option>
                        </select>
                    </div>

                </form>

            <form action="" method="post">
                <div class="form-group" id="curso">
                    <h1>Curso</h1>

                    <select class="form-control" name="curso">
                        <option selected="" disabled="">Asignar Curso</option>
                    </select>
                </div>

            </form>

            <form action="" method="post">
                <div class="form-group" id="grupo">
                    <h1>Grupo</h1>

                    <select class="form-control" name="grupo">
                        <option selected="" disabled="">Asignar Grupo</option>
                    </select>
                </div>
            </form>

            <form action="" method="post">
                <div class="form-group" id="asignatura">
                    <h1>Asignaturas</h1>

                    <select class="form-control" name="asignatura">
                        <option selected="" disabled="">Asignar Asignaturas</option>
                    </select>
                </div>
            </form>


        </div>
        <div class="botones">
            <button type="button" class="btn btn-dark" name="submit">AGREGAR</button>
            <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger">CERRAR</button></a>
        </div>


    </body>
</html>

