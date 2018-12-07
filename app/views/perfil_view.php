
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Perfil de Profesor/Administrador</title>
        <link rel="stylesheet" href="<?=base_url?>../Assets/css/perfil_style.css"/>

        <link rel="icon" type="image/png" href="<?= base_url ?>../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">            

    </head>
    <body>

        <div class="container">
            <div class="titulo">
                <h2>Perfil del usuario</h2>    
            </div>
            
                <div class="card" style="width:400px">

                    <?php if ($parametros['datos']['fotografia'] != null) : ?>

                        <img class="card-img-top" src="<?=base_url?>../Assets/img/fotos/<?= $parametros['datos']['fotografia'] ?>" alt="Card image" style="width:100%"/>
                    <?php else : ?>
                        <p>EMPTY</p>
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title"><?= $parametros['datos']['nombre'] . " " . $parametros['datos']['apellido1'] . " " . $parametros['datos']['apellido2'] ?></h4>
                        <p class="card-text">Nick: <?= $parametros['datos']['nombre_usuario'] ?>||Departamento:<?= $parametros['datos']['departamento'] ?></p>
                        <p class="card-text">NIF: <?= $parametros['datos']['dni'] ?></p>
                        <p class="card-text"><?= $parametros['datos']['correo'] ?></p>
                        <p class="card-text">Tlf de Contacto: <?= $parametros['datos']['telefono_fijo'] . "|" . $parametros['datos']['telefono_movil'] ?></p>
                        <p class="card-text">Web: <?= $parametros['datos']['web'] ?></p>
                        <p class="card-text">Blog: <?= $parametros['datos']['blog'] ?></p>
                        <p class="card-text">Twitter: <?= $parametros['datos']['twitter'] ?></p>
                        <a href="<?=base_url?>usuario/inicio" class="btn btn-primary">Volver al inicio</a>
                        <a href="<?=base_url?>usuario/actuser&dni=<?= $parametros['datos']['dni']?>" class="btn btn-warning">Editar</a>
                    </div>

                </div>

        </div> 
        <div class="footer">

            <h3>IES SAN SEBASTIAN</h3>

        </div>
    </body>
</html>

