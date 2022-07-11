<?php
include("Funciones/db.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/MostrarEmpresas.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <title>Lista de empresas</title>
</head>

<body>

    <nav>
        <ul class="ul-1">
            <li><a class="a-1" href="Index.php">Principal</a></li>
            <li><a class="a-3" href="">Contacto</a></li>
            <li><a class="a-4" href="">Quienes Somos</a></li>
            <li><a class="a-5" href="Registrar.php">Registrar</a></li>
            <li><a class="a-6" href="Login.php">Iniciar Sesion</a></li>
        </ul>
    </nav>
    <?php

    $sql2 = mysqli_query($conexion, "SELECT DISTINCT comuna FROM empresa");

    ?>
    <section class="container">

        <article class="content">
            <h2>Lista de Empresas</h2>
            <hr />
            <form name="Buscarcomuna" action="MostrarEmpresas.php" method="POST">
                Comunas:
                <select name="search">
                    <?php while ($row = $sql2->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['comuna']; ?>"><?php echo $row['comuna']; ?></option>
                    <?php } ?>
                </select>

                <input type="submit" name="buscar" value="Buscar Comuna">
                <input type=submit value="Reset" name="btnReset">
            </form><br>


            <?php
            if (isset($_GET['aksi'])) {

                $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));
                $cek = mysqli_query($conexion, "SELECT * FROM empresa WHERE idEmpresa='$nik'");
            }
            ?>
            <br>
            <article class="table-responsive">
                <table class="table table-striped table-hover" aria-describedby="Empresas">
                    <tr>
                        <th>Nombre</th>
                        <th>Calle</th>
                        <th>Numeracion</th>
                        <th>Comuna</th>
                        <th>Teléfono</th>
                    </tr>
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
                            echo '
						<tr>
							<td><a href="DetalleEmpresa.php?nik=' . $row['idEmpresa'] . '"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . $row['nombre_empresa'] . '</a></td>
                            <td>' . $row['calle'] . '</td>
                            <td>' . $row['numeracion'] . '</td>
							<td>' . $row['comuna'] . '</td>
                            <td>' . $row['telefono_empresa'] . '</td>						
						</tr>
						';
                        }
                    }

                    ?>
                </table>
            </article>
        </article>
    </section>
</body>

</html>