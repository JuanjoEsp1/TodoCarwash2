<?php
session_start();
require('Funciones/db.php');


if(isset($_POST) && !empty($_POST['id'])){

	   // select image to delete    
	   $sql_select = "SELECT image FROM images WHERE id = ".$_POST['id'];
	   $select_result = $conexion->query($sql_select);
	    $row = $select_result->fetch_row();
		$image_name = $row[0];

		// code to unlink(delete)  image physically from folder 
		$unl = unlink("./uploads/".$image_name);

		$sql = "DELETE FROM images WHERE id = ".$_POST['id'];
		$conexion->query($sql);


		$_SESSION['success'] = 'Image Deleted successfully.';
		header("Location: ./subirimagen2.php");
}else{
	$_SESSION['error'] = 'Please Select Image or Write title';
	header("Location: ./subirimagen2.php");
}


?>