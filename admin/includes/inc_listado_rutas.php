<?php
	$query="select * from rutas order by Orden desc ";
	$rutas=mysqli_query ($link, $query);

?>
	<table class="table">
		<thead class="thead-dark">
    		<tr>
    			<th>Orden</th>
    			<th>Fecha</th>
    			<th>Eliminar</th>
	    	</tr>
    	</thead>

<?php
		while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><?= $ruta["Orden"] ?></td>
				<td><a href="rutas.php?idRuta=<?= $ruta["IdRuta"] ?>&opcion=U"><?= $ruta["FechaES"] ?></a></td>
				<td><a href="resultados.php?idRuta=<?= $ruta["IdRuta"] ?>&opcion=D&idPagina=2">Eliminar</a></td>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas);
?>