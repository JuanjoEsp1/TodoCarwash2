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
    <title>Imagenes</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <style type="text/css">
        .gallery {
            display: inline-block;
            margin-top: 20px;
        }

        .close-icon {
            border-radius: 50%;
            position: absolute;
            right: 5px;
            top: -10px;
            padding: 5px 8px;
        }

        .form-image-upload {
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
        }

        .carousel-inner>.item>a>img,
        .carousel-inner>.item>img,
        .img-responsive,
        .thumbnail a>img,
        .thumbnail>img {
            width: 300px !important;
            height: 160px !important;
        }
    </style>
</head>

<body>


    <div class="container">

        <h3 style="text-align: center; font-size: 35px;" ><i><b>Imagenes</b></i></h3>

        <form action="./imageUpload.php" class="form-image-upload" method="POST" enctype="multipart/form-data">
        <input type="text" name="idEmpresa" value="<?php echo $row['idEmpresa']; ?>" readonly hidden required>
            <!-- code to show error message -->
            <?php if (!empty($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <li><?php echo $_SESSION['error']; ?></li>
                    </ul>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <!-- code to show success message  -->
            <?php if (!empty($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo $_SESSION['success']; ?></strong>
                </div>
            <?php unset($_SESSION['success']);
            } ?>

            <div class="row">
                
                <div class="col-md-5">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="col-md-5">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-2">
                    <br />
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
        </form>


        <div class="row">
            <div class='list-group gallery' style="width:100%;">
                <?php

                $sql = "SELECT * FROM images WHERE EMPRESA_idEmpresa ='$idEmpresa' ";
                $images = $conexion->query($sql);

                while ($image = $images->fetch_assoc()) {

                ?>
                    <div class='col-sm-3' style="float: left;">

                        <a class="thumbnail fancybox" rel="ligthbox" href="./uploads/<?php echo $image['image'] ?>">
                        
                            <img alt="" src="./uploads/<?php echo $image['image'] ?>" />
                            <div class='text-center'>
                                <small class='text-muted'><?php echo $image['title'] ?></small>
                            </div> <!-- text-center / end -->
                        </a>

                        <!-- form to delete image -->
                        <form action="./imageDelete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $image['id'] ?>">
                            <button onclick="return confirm('Esta seguro de eliminar la imagen?')" type="submit" title="delete" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>

                    </div> <!-- col-6 / end -->
                <?php } ?>

            </div> <!-- list-group / end -->
        </div> <!-- row / end -->
    </div> <!-- container / end -->
</body>
</html>



<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none",
        });
    });
</script>