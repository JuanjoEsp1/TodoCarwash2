<?php
require("../Funciones/db.php");


function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


// Select all the rows in the markers table
$query = "SELECT * FROM empresa WHERE idEmpresa = '18'";
$result = mysqli_query($conexion,$query);
if (!$result) {
  die('Invalid query: ');
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'idEmpresa="' . $row['idEmpresa'] . '" ';
  echo 'nombre_empresa="' . parseToXML($row['nombre_empresa']) . '" ';
  echo 'direccion="' . parseToXML($row['direccion']) . '" ';
  echo 'latitude="' . $row['latitude'] . '" ';
  echo 'longitude="' . $row['longitude'] . '" ';
  echo 'type="' . 'restaurant' . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>