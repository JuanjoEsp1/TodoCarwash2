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
    <link rel="stylesheet" href="Css/MostrarEmpresas.css">
    <title>Empresas</title>
</head>

<body>
    <div class="nav-bg">
        <?php

        $sql2 = mysqli_query($conexion, "SELECT DISTINCT comuna FROM empresa");

        ?>
        <h2>Lista de Empresas</h2>
        <hr />

        <section class="container">

            <article class="content">

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

    </div>

</body>

</html>