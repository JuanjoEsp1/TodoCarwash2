<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Index.css" type="text/css" />
    <link rel="apple-touch-icon" sizes="180x180" href="Image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Image/favicon-16x16.png">
    <link rel="manifest" href="Image/site.webmanifest">
    <link rel="stylesheet" href="Css/Login2.css" type="text/css" />
    <title>Inicio</title>


</head>

<body>
    <nav>
        <ul class="ul-1">
            <li><a class="a-1" href="Index.php">Principal</a></li>
            <li><a class="a-2" href="MostrarEmpresas.php">Empresas de Lavado</a></li>
            <li><a class="a-3" href="Contacto.php">Contacto</a></li>
            <li><a class="a-4" href="">Quienes Somos</a></li>
            <li><a class="a-5" href="Registrar.php">Registrar</a></li>
            <li><a class="a-6" href="Login.php">Iniciar Sesion</a></li>
            <li><a class="a-6" href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Iniciar Sesion2</a></li>
        </ul>
    </nav>
    <img src="IMG/logo2.jpg" alt="logo" />
    <h1>Bienvenido</h1>

    <!--- Modal Login -->
    <div id="id01" class="modal">

        <form class="modal-content animate" action="Validar.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="image/img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="correo_empresa"><b>Correo electronico</b></label>
                <input type="text" placeholder="Ingrese Correo" name="correo_empresa" required>

                <label for="contrasena"><b>Contraseña</b></label>
                <input type="password" placeholder="Ingrese Contraseña" name="contrasena" required>
                
                <button type="submit" value="INGRESAR">Login</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>
<!---  -->
</body>

<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>