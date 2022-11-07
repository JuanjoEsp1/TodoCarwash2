<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Login2.css" type="text/css" />
</head>

<body>
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

                <button class="loginbtn" type="submit" value="INGRESAR">Iniciar Sesion</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
                <span class="psw">ha olvidado la <a href="Resetpsw.php" class="pswname">contrasena?</a></span>
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