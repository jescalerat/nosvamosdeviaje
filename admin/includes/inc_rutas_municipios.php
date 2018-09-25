<?php
	$fechaES = "";
	$fechaCA = "";
	$fechaEN = "";


	if ($idRuta != "" && $idRuta != "undefined"){
		$query="select * from rutas where idRuta = ".$idRuta;
		$rutas=mysqli_query ($link, $query);
		$rowruta=mysqli_fetch_array($rutas);

		$fecha = $rowruta["FechaES"];

		mysqli_free_result($rutas);

		$query="select v.IdVisitado, m.Municipio, v.Fecha ";
		$query.="from visitados v, municipios m ";
		$query.="where v.IdMunicipio=m.idMunicipio ";

		$municipios=mysqli_query ($link, $query);
	} 

?>
	<h1><?= cambiarAcentos($fecha) ?></h1>
	<form class="col s12" method="post" action="resultados.php">
		<div class="row">
			<select name="idVisitado" id="idVisitado" class="browser-default">
				<option value="" disabled selected>Elegir municpio</option>
<?php
				while($municipio=mysqli_fetch_array($municipios, MYSQLI_BOTH))
				{
					$tituloMunicipio=$municipio["Municipio"];
					$idMunicipioVisitado=$municipio["IdVisitado"];
					$fechaMunicipioVisitado=devolverFecha($municipio["Fecha"]);
					$resultado=$tituloMunicipio." ".$fechaMunicipioVisitado;
?>
					<option value="<?= $idMunicipioVisitado ?>"><?= $resultado ?></option>
<?php
				}
				mysqli_free_result($municipios);
?>
			</select>
		</div>
		
		<div class="row">
			<div class="col s12" id="botonEnvio">
				<button>Enviar Mensaje</button>
			</div>
		</div>

		<input type="hidden" id="idRuta" name="idRuta" value="<?= $idRuta ?>"/>
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="5"/>
	</form>

	<h2>Municipios visitados</h2>
<?php
	$query="select v.IdVisitado, m.IdMunicipio, m.Municipio, v.Fecha ";
	$query.="from rutas_municipios rm, visitados v, municipios m ";
	$query.="where rm.IdVisitado=v.idVisitado ";
	$query.="and v.IdMunicipio=m.idMunicipio ";
	$query.="and rm.IdRuta=".$idRuta;

	$rutas_municipios=mysqli_query ($link, $query);
?>

	<table>
		<tr>
			<th>Municipio</th>
			<th>Fecha</th>
			<th>Eliminar</th>
		<tr>

<?php
		while($ruta=mysqli_fetch_array($rutas_municipios, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><?= $ruta["Municipio"] ?></td>
				<td><?= $ruta["Fecha"] ?></td>
				<td><a href="resultados.php?idRuta=<?= $idRuta ?>&idVisitado=<?= $ruta["IdVisitado"] ?>&opcion=D&idPagina=5">Eliminar</a></td>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas_municipios, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas_municipios);
?>