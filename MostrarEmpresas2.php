<?php
include("Funciones/db.php");
include("Navbar.php");
include("Login2.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Css/MostrarEmpresas2.css">
    <title>Empresas</title>
</head>

<body>
    <?php

    $sql2 = mysqli_query($conexion, "SELECT DISTINCT comuna FROM empresa");

    ?>
    <h2>Lista de Empresas</h2>

    <form name="Buscarcomuna" action="MostrarEmpresas2.php" method="POST" class="formB">
        <label>Comuna</label>
        <select name="search">
            <?php while ($row = $sql2->fetch_assoc()) {
            ?>
                <option value="<?php echo $row['comuna']; ?>"><?php echo $row['comuna']; ?></option>
            <?php } ?>
        </select>

        <input type="submit" name="buscar" value="Buscar">
        <input type=submit value="Reset" name="btnReset">
    </form><br>

    <?php
    if (isset($_GET['aksi'])) {

        $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));
        $cek = mysqli_query($conexion, "SELECT * FROM empresa WHERE idEmpresa='$nik'");
    }
    ?>

    <main>
        <?php

        $sql = mysqli_query($conexion, "SELECT * FROM empresa idEmpresa");

        if (isset($_POST['buscar'])) {

            $buscarComuna = strval($_POST['search']);
            $sql = mysqli_query($conexion, "SELECT * FROM empresa WHERE comuna = '$buscarComuna' ");
        }
        if (mysqli_num_rows($sql) == 0) {
            echo '<tr><td colspan="8">No hay datos.</td></tr>';
        } else {
            while ($row = mysqli_fetch_assoc($sql)) {

        ?>

                <div class="card">
                    <div class="image">
                        <img src="IMG/logo2.jpg" alt="">
                    </div>
                    <div class="caption">
                        <p class="nombre_empresa"><?php echo $row["nombre_empresa"]; ?></p>
                        <p class="Direccion"><?php echo $row["direccion"]; ?></p>
                    </div>

                    <a href="DetalleEmpresa2.php?nik=<?php echo $row['idEmpresa']; ?>">
                        <button class="button-18">Visitar</button>
                    </a>
                </div>
                
                <header>
                    <div class="burbujas">
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                        <div class="burbuja"></div>
                    </div>
                </header>

        <?php

            }
        }
        ?>

    </main>


</body>

</html>