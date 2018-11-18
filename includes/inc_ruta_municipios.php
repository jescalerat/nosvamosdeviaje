<?php
	$query="select m.Municipio, p.Provincia ";
	$query.=" from rutas_dias rd  ";
	$query.=" left join rutas_municipios rm on rm.IdRutaDia = rd.IdRutaDia ";
	$query.=" left join visitados v on v.IdVisitado = rm.IdVisitado ";
	$query.=" left join municipios m on m.IdMunicipio = v.IdMunicipio ";
	$query.=" left join provincias p on p.IdProvincia = m.IdProvincia ";
	$query.=" where rd.idRutaDia = ".$idRutaDia;
	$query.=" order by rm.Orden asc ";

	$visitados=mysqli_query ($link, $query);
?>
	<table>
<?php
	while($visitado=mysqli_fetch_array($visitados, MYSQLI_BOTH))
	{
		$municipio = $visitado["Municipio"]." (".$visitado["Provincia"].")";
?>
		<tr>
			<td>
				<?= cambiarAcentos($municipio) ?>
			</td>
		</tr>
<?php
	}		
	mysqli_free_result($visitados);
?>
	</table>
