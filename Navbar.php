<?php include("Login2.php")
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="Css/Navbar.css" type="text/css" />
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <!--<div class="logo"><a href="Index.php"><img src="/IMG/logo3.png"></a></div> --->
        <label class="logo" href="Index.php">TodoCarwash</label>
        <ul>
            <li><a class="active" href="Index.php">Home</a></li>
            <li><a href="MostrarEmpresas2.php">Empresas de Lavado</a></li>
            <li><a href="Contacto.php">Contacto</a></li>
            <li><a href="">Quienes Somos</a></li>
            <li><a href="Registrar.php">Registrar</a></li>
            <li class="login"><a href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Iniciar Sesion</a></li>
        </ul>
    </nav>

</body>

</html>