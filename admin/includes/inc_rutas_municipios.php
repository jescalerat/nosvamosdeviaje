<?php
	$fechaES = "";
	$fechaCA = "";
	$fechaEN = "";


	if ($idRutaDia != "" && $idRutaDia != "undefined"){
		$query="select * from rutas_dias where idRutaDia = ".$idRutaDia;
		$rutasdias=mysqli_query ($link, $query);
		$rowrutadia=mysqli_fetch_array($rutasdias);

		$fecha = $rowrutadia["Fecha"];

		mysqli_free_result($rutasdias);

		$query="select v.IdVisitado, m.IdMunicipio, m.Municipio, v.Fecha ";
		$query.="from visitados v, municipios m ";
		$query.="where v.IdMunicipio=m.idMunicipio ";

		$municipios=mysqli_query ($link, $query);
	} 

?>
	<h1><?= devolverFecha($fecha) ?></h1>
	<form class="col s12" method="post" action="resultados.php">
		<div class="row">
			<select name="idVisitado" id="idVisitado" class="browser-default">
				<option value="" disabled selected>Elegir municipio</option>
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

		<div class="row">
			<div class="col s12" id="volverDias">
				<a href="rutas_dias.php?idRuta=<?= $rowrutadia["IdRuta"] ?>">Volver</a>
			</div>
		</div>

		<input type="hidden" id="idRutaDia" name="idRutaDia" value="<?= $idRutaDia ?>"/>
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="5"/>
	</form>

	<h2>Municipios visitados</h2>
<?php
	$query="select rm.IdRutaMunicipio, rm.IdRutaDia, m.IdMunicipio, m.Municipio ";
	$query.="from rutas_municipios rm, visitados v, municipios m ";
	$query.="where rm.IdVisitado=v.IdVisitado ";
	$query.="and v.IdMunicipio=m.IdMunicipio ";
	$query.="and rm.IdRutaDia=".$idRutaDia;

	$rutas_municipios=mysqli_query ($link, $query);
?>

	<table>
		<tr>
			<th>Municipio</th>
			<th>Eliminar</th>
		<tr>

<?php
		while($ruta=mysqli_fetch_array($rutas_municipios, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><?= $ruta["Municipio"] ?></td>
				<td><a href="resultados.php?idRutaMunicipio=<?= $ruta["IdRutaMunicipio"] ?>&idRutaDia=<?= $ruta["IdRutaDia"] ?>&opcion=D&idPagina=5">Eliminar</a></td>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas_municipios, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas_municipios);
?>