<?php
include("Navbar.php");
?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Registrar.css" type="text/css" />
    <link rel="apple-touch-icon" sizes="180x180" href="Image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Image/favicon-16x16.png">
    <link rel="manifest" href="Image/site.webmanifest">
    <title>Registrar</title>
</head>


<body>


    <div class="container">
        <div class="title">Registro de Empresas</div>
        <div class="content">
            <form action="/Funciones/RegistrarFunc.php" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nombre Empresa</span>
                        <input type="text" name="nombre_empresa" placeholder="ingrese nombre" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Rut Empresa o Dueno</span>
                        <input type="text" id="rut_empresa" name="rut_empresa" required oninput="checkRut(this)" placeholder="Ingrese RUT">
                    </div>
                    <div class="input-box">
                        <span class="details">Direccion</span>
                        <input type="text" name="calle" placeholder="ingrese calle" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Numeracion</span>
                        <input type="number" name="numeracion" maxlength="9" placeholder="1234" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Comuna</span>
                        <select name="comuna">
                            <option value="Buin">Buin</option>
                            <option value="Calera de Tango">Calera de Tango</option>
                            <option value="Cerrillos">Cerrillos</option>
                            <option value="Cerro Navia">Cerro Navia</option>
                            <option value="Colina">Colina</option>
                            <option value="Conchali">Conchalí</option>
                            <option value="El Bosque">El Bosque</option>
                            <option value="Estación Central">Estación Central</option>
                            <option value="Huechuraba">Huechuraba</option>
                            <option value="Independencia">Independencia</option>
                            <option value="La Cisterna">La Cisterna</option>
                            <option value="La Florida">La Florida</option>
                            <option value="La Granja">La Granja</option>
                            <option value="La Pintana">La Pintana</option>
                            <option value="La Reina">La Reina</option>
                            <option value="Lampa">Lampa</option>
                            <option value="Las Condes">Las Condes</option>
                            <option value="Lo Barnechea">Lo Barnechea</option>
                            <option value="Lo Espejo">Lo Espejo</option>
                            <option value="Lo Prado">Lo Prado</option>
                            <option value="Macul">Macul</option>
                            <option value="Maipu">Maipú</option>
                            <option value="Ñuñoa">Ñuñoa</option>
                            <option value="Paine">Paine</option>
                            <option value="Pedro Aguirre Cerda">Pedro Aguirre Cerda</option>
                            <option value="Peñalolen">Peñalolén</option>
                            <option value="Pirque">Pirque</option>
                            <option value="Providencia">Providencia</option>
                            <option value="Pudahuel">Pudahuel</option>
                            <option value="Puente Alto">Puente Alto</option>
                            <option value="Quilicura">Quilicura</option>
                            <option value="Quinta Normal">Quinta Normal</option>
                            <option value="Recoleta">Recoleta</option>
                            <option value="Renca">Renca</option>
                            <option value="San Bernardo">San Bernardo</option>
                            <option value="San Joaquin">San Joaquín</option>
                            <option value="San Jose de Maipo">San José de Maipo</option>
                            <option value="San Miguel">San Miguel</option>
                            <option value="San Ramon">San Ramón</option>
                            <option value="Santiago">Santiago</option>
                            <option value="Til Til">Til Til</option>
                            <option value="Vitacura">Vitacura</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Numero Celular</span>
                        <input class="code" type="text" placeholder="+56" readonly>
                        <input type="tel" name="telefono_empresa" placeholder="912345678" maxlength="8" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Correo electronico</span>
                        <input type="email" name="correo_empresa" placeholder="Ingrese su correo" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contraseña</span>
                        <input type="text" name="contrasena" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>
        </div>
        <div class="button">
            <input type="submit" value="Registrar">
        </div>
        </form>
    </div>
    </div>

</body>
<script src="/js/validarRUT.js"></script>

</html>