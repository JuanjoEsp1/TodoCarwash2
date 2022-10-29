<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/resetPsw.css" type="text/css" />
    <title>reset</title>
</head>

<body>
    <div id="recuperarclave" class="container">
        <form action="RecuperarClave2.php" method="post" enctype="multipart/form-data">
            <div class="title">Recuperar clave</div>
            <div class="field-wrap">
                <label>Correo</label>
                <input type="email" name="correo_empresa" required autocomplete="off" />
            </div>
            <input type="submit" class="buttonRec" name="recuperarClave" value="RECUPERAR CLAVE" />
            <a href="Index.php" id="volver" class="mt-3 mb-4" title="Volver">Volver</a>
            <br><br>
        </form>
    </div>
</body>

</html>