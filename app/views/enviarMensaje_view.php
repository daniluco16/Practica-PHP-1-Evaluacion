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
        <title>Registro de Mensajes</title>
        <link rel="stylesheet" href="<?= base_url ?>../Assets/css/enviarMensaje_style.css">

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


    </head>
    <body>

        <div class="contenedor">

            <div class="titulo">
                <h1>Envio de Mensajes</h1>    
            </div>
            <div class="contenido">

                <form action="<?= base_url ?>usuario/crearMensaje" method="post">

                    <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
                        <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensajes"] ?></div>
                    <?php endforeach; ?>
                        
                    <div class="form-group">
                        <label for="usr">Título del Mensaje</label>
                        <input type="text" class="form-control" id="usr" placeholder="Bienvenido a Moodle" name="titulo">
                    </div>

                    <div class="form-group">
                        <label for="usr">Destinatario</label>
                        <input type="text" class="form-control" id="usr" placeholder="Nombre de Usuario" name="destinatario">
                    </div>

                    <div class="form-group">
                        <label for="comment">Mensaje:</label>
                        <textarea class="form-control" rows="5" id="comment" name="contenido"></textarea>
                    </div>
                    <div class="botones">

                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Enviar</button>
                        <a href="<?= base_url ?>usuario/inicio"><button type="button" class="btn btn-danger btn-lg">Cerrar</button></a>

                    </div>
                </form>

            </div>
            <div class="izq">

            </div>

        </div>

    </body>
</html>
