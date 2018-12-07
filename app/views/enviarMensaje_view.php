<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviar Mensaje Profesor/Administrador</title>
        <link rel="stylesheet" href="<?=base_url?>../Assets/css/enviarMensaje_style.css">

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

                <form>
                    <div class="form-group">
                        <select class="form-control" id="option">
                            <option value="Profesor">Profesor</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Mensaje:</label>
                        <textarea class="form-control" rows="5" id="comment" ></textarea>
                    </div>
                    <div class="botones">

                        <a href=""><button type="button" class="btn btn-primary btn-lg">Enviar</button></a>
                        <a href="<?=base_url?>usuario/inicio"><button type="button" class="btn btn-danger btn-lg">Cerrar</button></a>

                    </div>
                </form>

            </div>
            <div class="izq">

            </div>

        </div>

    </body>
</html>
