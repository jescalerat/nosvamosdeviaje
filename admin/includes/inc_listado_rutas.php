<?php
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
				<td><a href="resultados.php?idRuta=<?= $ruta["IdRuta"] ?>&opcion=D&idPagina=2">Eliminar</a>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas);
?>