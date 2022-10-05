<?php
if (isset($_POST["submit"])) {
    $revisar = getimagesize($_FILES['imagen']['tmp_name']);
    if ($revisar !== false) {
        $imagen = $_FILES['imagen']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($imagen));

        //Credenciales Mysql
        $Host = 'localhost';
        $Username = 'root';
        $Password = '';
        $dbName = 'todocarwash2';

        //Crear conexion con la abse de datos
        $db = new mysqli($Host, $Username, $Password, $dbName);

        // Cerciorar la conexion
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }


        //Insertar imagen en la base de datos
        $insertar = $db->query("INSERT into imagen(imagen,Empresa_idEmpresa, Fecha) VALUES ('$imgContenido','$_REQUEST[idEmpresa]' , now())");
        // COndicional para verificar la subida del fichero
        if ($insertar) {
            echo "Archivo Subido Correctamente.";
        } else {
            echo "Ha fallado la subida, reintente nuevamente.";
        }
        // Sie el usuario no selecciona ninguna imagen
    } else {
        echo "Por favor seleccione imagen a subir.";
    }
}
?>
<div class="main">
    <h1>Mostrando imagen almacenada en MySQL</h1>
    <div class="panel panel-primary">
        <div class="panel-body">
            <label for="">LAVADO INTERIOR</label><BR></BR>
            <label for="">LAVADO FULL</label> <BR></BR>
            <div class="row justify-content-center text-center">
                <div class="modal-dialog modal-lg modal-dialog-centered justify-content-center text-center" role="document">
                    <img src='vista.php?id=3' alt='Img blob desde MySQL' class="card-img-top" width="250" />
                </div>


            </div>

        </div>
    </div>
</div>