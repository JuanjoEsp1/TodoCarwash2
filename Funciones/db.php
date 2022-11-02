<?php

$serverName = "localhost";
$userName = "root";
$password = "Juanjo3474-34";
$database = "todocarwash2";


$conexion=mysqli_connect($serverName,$userName,$password,$database);

if (!$conexion) {
    die("connection failed: ". mysqli_connect_error());
}
?>
