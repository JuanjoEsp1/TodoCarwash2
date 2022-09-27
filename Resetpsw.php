<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset</title>
</head>
<body>
<div id="recuperarclave">
            <h1 class="text-center mb-5 recuperarPass">
                Recuperar tu Clave
            </h1>
            <form action="RecuperarClave2.php" method="post" enctype="multipart/form-data">
                <div class="field-wrap">
                    <label>Correo</label>
                    <input type="email" name="correo_empresa" required autocomplete="off" />
                </div>
                <input type="submit" class="button button-block miBtn mt-5" name="recuperarClave" value="RECUPERAR CLAVE" />
                <a href="#" id="volver" class="mt-3 mb-4" title="Volver">Volver</a>
                <br><br>
            </form>
        </div>
</body>
</html>