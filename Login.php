<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>login</title>
</head>

<body>
    <nav>
        <ul class="ul-1">
            <li><a class="a-1" href="Index.php">Principal</a></li>
            <li><a class="a-2" href="">Contacto</a></li>
            <li><a class="a-3" href="">Quienes Somos</a></li>
        </ul>
    </nav>

    <div class="container">

        <div>
            <form action="Validar.php" method="post">
                <h1 class="animate__animated animate__backInLeft">Sistema de login</h1>
                <p>Correo <input type="text" placeholder="ingrese su nombre" name="correo_empresa"></p>
                <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="contrasena"></p>

                <input type="submit" class="button button-block mb-3 mt-5 miBtn mt-3" value="INGRESAR" />

                <a href="#" id="olvidar" title="Recuperar Clave">Recuperar Clave</a>
                <br><br>
            </form>
        </div>



        <div id="recuperarclave">
            <h1 class="text-center mb-5 recuperarPass">
                Recuperar tu Clave
            </h1>



            <form action="RecuperarClave2.php" method="post" enctype="multipart/form-data">
                <div class="field-wrap">
                    <label>Correo</label>
                    <input type="email" name="correo_empresa" required autocomplete="off" />
                </div>

                <input type="submit" class="button button-block miBtn mt-5" name="recuperarClave" value="RECUPERAR CLAVE" />

                <a href="#" id="volver" class="mt-3 mb-4" title="Volver">Volver</a>
                <br><br>
            </form>
        </div>

    </div>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $('#recuperarclave').hide();

        $('#olvidar').on('click', function() {
            $('#signup').hide(); //para ocultar
            $("#recuperarclave").fadeIn("slow"); //mostrar
        });

        $('#volver').on('click', function() {
            $('#recuperarclave').hide(); //para ocultar
            $("#signup").fadeIn("slow"); //mostrar
        });
    </script>
</body>



</html>