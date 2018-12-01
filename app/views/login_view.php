
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login de Profesor/Administrador</title>
        <link rel="stylesheet" href="../Assets/css/login_style.css">

        <link rel="stylesheet" href="../Assets/css/animate.css">

        <link rel="icon" type="image/png" href="../../Assets/img/favicon.ico"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img class="animated flip" src="../Assets/img/img-01.png" alt="IMG">
                    </div>

                    <form action="index.php?controller=usuario&action=login" method="post" class="login100-form validate-form">
                        <span class="login100-form-title">
                            Login de miembros
                        </span>
                        <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
                            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
                        <?php endforeach; ?>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="nombre_usuario" placeholder="Usuario">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="password" name="clave" placeholder="Contraseña">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for="check">
                                <input type="checkbox" class="form-check-input" id="check" name="recuerdame">Recuerdame
                            </label>
                        </div>

                        <div class="container-login100-form-btn">
                            <button name="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>


                        <div class="text-center p-t-136">
                            <a name="registro" class="txt2" href="index.php?controller=usuario&action=adduser">
                                Crear una cuenta nueva?
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
