<?php
include('Funciones/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php
    $sql = mysqli_query($conexion, "SELECT * FROM imagen WHERE Empresa_idEmpresa='$_REQUEST[idEmpresa]'");

    while ($row = mysqli_fetch_assoc($sql)) {

    ?>
        <div class="image">
            <img src="data:imagen/jpg;base64, <?php echo base64_encode($row["imagen"]) ?>" alt="">
        </div>
    <?php } ?>
</body>

</html>