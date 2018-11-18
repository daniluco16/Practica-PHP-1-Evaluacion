<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login de Profesor/Administrador</title>
        <link rel="stylesheet" href="../Assets/css/login_style.css">
        <link rel="stylesheet" href="../Assets/css/login_style2.css">
        <link rel="stylesheet" href="../Assets/css/animate.css">

        <link rel="icon" type="image/png" href="../Assets/img/favicon.ico"/>

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

                    <form class="login100-form validate-form">
                        <span class="login100-form-title">
                            Login de miembros
                        </span>

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="nombre_usuario" placeholder="Usuario">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="password" name="contraseña" placeholder="Contraseña">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>


                        <div class="text-center p-t-136">
                            <a class="txt2" href="#">
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
