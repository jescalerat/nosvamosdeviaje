<?php

	if (file_exists("../../conf/traduccion.php")){
		require_once("../../conf/traduccion.php");
		require_once("../../conf/conexion.php");
		require_once("../../conf/funciones.php");
		$link=Conectarse();
	}

	$query="select * from rutas ";
	$rutas=mysqli_query ($link, $query);

?>
	<table>
		<tr>
			<th>Fecha</th>
			<th>Eliminar</th>
		<tr>

<?php
		while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><a href="rutas.php?idRuta=<?= $ruta["IdRuta"] ?>&opcion=U"><?= $ruta["FechaES"] ?></a>
				<td><a href="rutas.php?idRuta=<?= $ruta["IdRuta"] ?>&opcion=D">Eliminar</a>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas);
?>