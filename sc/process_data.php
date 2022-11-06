<?php

//process_data.php

$serverName = "localhost";
$userName = "root";
$password = "Juanjo3474-34";
$database = "todocarwash2";

$connect=mysqli_connect($serverName,$userName,$password,$database);

if(isset($_POST["query"]))
{	

	$data = array();

	$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);

	$query = "
	SELECT comuna FROM empresa 
		WHERE comuna LIKE '%".$condition."%' 
		ORDER BY comuna DESC 
		LIMIT 1
	";

	$result = $connect->query($query);

	$replace_string = '<b>'.$condition.'</b>';

	foreach($result as $row)
	{
		$data[] = array(
			'comuna'		=>	str_ireplace($condition, $replace_string, $row["comuna"])
		);
	}

	echo json_encode($data);
}
?>