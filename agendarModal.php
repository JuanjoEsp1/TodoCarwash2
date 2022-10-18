<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/agendarModal.css" type="text/css" />
</head>

<body>

    <div id="id02" class="modal">

        <form class="modal-content animate" action="Funciones/Agendar.php" method="post">


            <div class="container">
                <label for="nomCLIENTE"><b>Nombres</b></label>
                <input type="text" placeholder="Ingrese su nombre" name="nomCLIENTE" required>

                <label for="apellCLIENTE"><b>Apellidos</b></label>
                <input type="text" placeholder="Ingrese su apellido" name="apellCLIENTE" required>

                <label for="rutCLIENTE"><b>Rut</b></label>
                <input type="text" placeholder="Ingrese su Rut" name="rutCLIENTE" required>

                <label for="dirCLIENTE"><b>direccion</b></label>
                <input type="text" placeholder="Ingrese su Direccion" name="dirCLIENTE" required>

                <label for="numCLIENTE"><b>Numero Celular</b></label>
                <input type="tel" name="numCLIENTE" placeholder="12345678" maxlength="8" required>

                <label for="emailCLIENTE"><b>Correo electronico</b></label>
                <input type="email" name="emailCLIENTE" placeholder="correo@gmail.com" required>


            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="Resetpsw.php">password?</a></span>
            </div>
        </form>

    </div>

</body>

<script>
    // Get the modal
    var modal = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>