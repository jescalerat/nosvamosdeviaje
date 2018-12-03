<table class="table">
<?php	
	
	$query="select c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="where v.IdVisitado is not null ";
	$query.="and c.IdComunidad=".$idComunidad." and p.IdProvincia=".$idProvincia." ";
	if ($idMunicipio != 0){
		$query.="and m.IdMunicipio=".$idMunicipio." ";
	}
	$query.="order by c.IdComunidad asc, p.IdProvincia asc, m.Municipio asc";

	$municipios=mysqli_query ($link, $query);

	while($municipio=mysqli_fetch_array($municipios, MYSQLI_BOTH))
	{
		$tituloMunicipio=$municipio["Municipio"];
		$idMunicipioVisitado=$municipio["IdVisitado"];
?>
			<tr>
				<td>
					<a href="visitado.php?idVisitado=<?= $idMunicipioVisitado ?>&opcion=U"><?= $tituloMunicipio ?></a>
				</td>
				<td class="text-center">
					<?= $municipio["Fecha"] ?>
				</td>
				<td>
					<a href="resultados.php?idVisitado=<?= $idMunicipioVisitado ?>&opcion=D&idPagina=1">Eliminar</a>
				</td>
			</tr>
<?php			
	}
	mysqli_free_result($municipios);
?>
</table>