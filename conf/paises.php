<?php					
	require_once("conexion.php");
	$link=Conectarse();

	$query="select *  ";
	$query.="from paises p  ";
	$query.="order by p.Pais asc";

	$paisesOption=mysqli_query ($link, $query);

	$items = array();
	while($paisOption=mysqli_fetch_array($paisesOption, MYSQLI_BOTH))
	{
		$option = array("id" => $paisOption["IdPais"], "value" => htmlentities($paisOption["Pais"]));
		$items[] = $option;
	}

	$data = json_encode($items);
	// Convertimos en formato JSON, luego imprimimos la data
	$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
	echo($response);
?>