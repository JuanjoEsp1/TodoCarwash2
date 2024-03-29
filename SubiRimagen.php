<?php
include("Funciones/db.php");
session_start();
error_reporting(0);
$varsesion = $_SESSION['correo_empresa'];

if ($varsesion == null || $varsesion = '') {
  echo 'Usted no tiene autorizacion';
  die();
}

$correo = $_SESSION['correo_empresa'];
$idEmpresa = $_SESSION['idEmpresa'];

$sql = "SELECT * From empresa WHERE correo_empresa = '$correo'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

$idEmpresa = $row['idEmpresa'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Almacenar imagen en la base de datos MySQL usando PHP</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style type="text/css">
    * {
      font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif
    }

    .main {
      margin: auto;
      border: 1px solid #7C7A7A;
      width: 60%;
      text-align: left;
      padding: 30px;
      background: #85c587
    }

    input[type=submit] {
      background: #6ca16e;
      width: 100%;
      padding: 5px 15px;
      background: #ccc;
      cursor: pointer;
      font-size: 16px;

    }

    input[type=text] {
      width: 40%;
      padding: 5px 15px;
      height: 25px;
      font-size: 16px;

    }

    .form-control {
      padding: 0px 0px;
    }
  </style>
</head>

<body bgcolor="#bed7c0">
  <bR>
  <div class="btn btn-info">
    <h1>Cargar y Almacenar imagen en MySQL PHP</h1>
    <div class="panel panel-primary">
      <div class="panel-body">

        <form name="MiForm" id="MiForm" method="post" action="Funciones/cargarImagen.php" enctype="multipart/form-data">
          <input type="text" name="idEmpresa" value="<?php echo $row['idEmpresa']; ?>" readonly hidden required>
          <h4 class="text-center">Seleccione imagen a cargar</h4>
          <div class="form-group">
            <label class="col-sm-2 control-label">Archivos</label>
            <div class="col-sm-8">
              <input type="file" class="form-control" id="imagen" name="imagen" multiple accept="png,jpg">
            </div>
            <button name="submit" class="btn btn-warning">Cargar Imagen</button>
          </div>
        </form>
        

        <form method="post" action="SubiRimagen.php">
        <input type="text" name="idEmpresa" value="<?php echo $row['idEmpresa']; ?>" readonly hidden required>
        <button name="submit" class="btn btn-warning">ver Imagen</button>
        </form>

 	  </div> 
    </div>
 </div><br>
 <?php
    $sql = mysqli_query($conexion, "SELECT * FROM imagen WHERE Empresa_idEmpresa='$_REQUEST[idEmpresa]'");

    while ($row = mysqli_fetch_assoc($sql)) {

        ?>
    
    
    <img  src="data:imagen/jpg;base64, <?php echo base64_encode($row["imagen"]) ?>" alt="" height="250"
             data-toggle="modal" 
             data-target="#exampleModal" />
  
        <?php } ?>

      </div>
    </div>
  </div>

</body>

</html>