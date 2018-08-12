<table border="1" class="w100">
<?php	
	
	if (isset($_GET['opcion']) && $_GET['opcion'] == 'D'){
		$query="delete from visitados where IdVisitado = ".$_GET['idVisitado'];
		mysqli_query ($link, $query);
	}
	
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
				<td class="w40" valign="top">
					<a class="admin" href="visitado.php?idVisitado=<?= $idMunicipioVisitado ?>&opcion=U"><?= $tituloMunicipio ?></a>
				</td>
				<td class="w30">
					<center><?= $municipio["Fecha"] ?></center>
				</td>
				<td class="w30">
					<a class="admin" href="visitas.php?idVisitado=<?= $idMunicipioVisitado ?>&opcion=D">Eliminar</a>
				</td>
			</tr>
<?php			
	}
	mysqli_free_result($municipios);
?>
</table>