<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Contacto</title>
</head>

<body>

    <div class="container mt-5 p-5">
        <h4 class="text-center">
            Cómo Enviar Correo con PHP desde un Formulario de Contacto Fácil..!
        </h4>
        <hr>
        <form class="mt-5 p-5" action="/EnviarEmail.php" method="POST">
            <div class="row">
                <div class="col">
                    <label for="exampleFormControlInput1">Nombre del Cliente</label>
                    <input type="text" name="nombreCliente" class="form-control" required>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Email del Cliente</label>
                    <input type="email" name="emailCliente" class="form-control" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Mensaje del Cliente</label>
                        <textarea class="form-control" name="msjCliente" rows="3" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <button type="sutmit" class="btn btn-info">Enviar Formulario de Contacto</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>