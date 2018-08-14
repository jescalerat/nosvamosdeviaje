<?php
	$municipio = "";
	if ($idMunicipio != 0){
		$municipio = obtenerMunicipio($link, $idMunicipio, false);
	}

?>

<h1><?= $municipio ?></h1>
<form class="col s12" method="post" action="resultados.php">
	<div class="row">
		<div class="input-field col s12">
			<textarea id="fotos" name="fotos" class="materialize-textarea"></textarea>
			<label for="fotos">Fotos</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12" id="botonEnvio">
			<button>Enviar Mensaje</button>
		</div>
	</div>

	<input type="hidden" id="idMunicipio" name="idMunicipio" value="<?= $idMunicipio ?>"/>
	<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
	<input type="hidden" id="idPagina" name="idPagina" value="4"/>	
</form>

<h1>Sin Fotos</h1>
<table>
<?php	
	
	$query="select c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="left join fotos f on f.IdMunicipio=v.IdMunicipio ";
	$query.="where f.IdFoto is null and v.IdVisitado is not null ";
	$query.="order by c.IdComunidad asc, p.IdProvincia asc, m.Municipio asc";

	$municipios=mysqli_query ($link, $query);

	$mostrarTituloComunidad = 1;
	$mostrarTituloProvincia = 1;
	$idComunidadPost = 0;
	$idProvinciaPost = 0;

		
	while($municipio=mysqli_fetch_array($municipios, MYSQLI_BOTH))
	{
		$tituloComunidad=strtoupper($municipio["Comunidad"]);
		$idComunidad=$municipio["IdComunidad"];
		$tituloProvincia=strtoupper($municipio["Provincia"]);
		$idProvincia=$municipio["IdProvincia"];
		$tituloMunicipio=$municipio["Municipio"];
		$idMunicipio=$municipio["IdMunicipio"];
		$idVisitado=$municipio["IdVisitado"];

		if ($idComunidadPost != $idComunidad){
			$mostrarTituloComunidad = 1;
		}

		if ($idProvinciaPost != $idProvincia){
			$mostrarTituloProvincia = 1;
		}

		if ($mostrarTituloComunidad == 1){
			$mostrarTituloComunidad = 0;
			$idComunidadPost = $idComunidad;
?>
		<tr>
			<td colspan="2"><center><?= $tituloComunidad ?></center></td>	
		</tr>
<?php 
		} //if ($mostrarTituloComunidad == 1){

		if ($mostrarTituloProvincia == 1){
			$mostrarTituloProvincia = 0;
			$idProvinciaPost = $idProvincia;
?>
		<tr>
			<td colspan="2"><center><?= $tituloProvincia ?></center></td>	
		</tr>
<?php 
		}  //if ($mostrarTituloProvincia == 1){
?>	
		<tr>
			<td valign="top">
				<a href="fotos.php?idMunicipio=<?= $idMunicipio ?>"><?= $tituloMunicipio ?></a>
 			</td>
			<td valign="top"><?= devolverFecha($municipio["Fecha"]) ?></td>
		</tr>
<?php			
	}
	mysqli_free_result($municipios);
?>
</table>

<h1>Con Fotos</h1>
<table>
<?php	
	
	$query="select distinct c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="left join fotos f on f.IdMunicipio=v.IdMunicipio ";
	$query.="where f.IdFoto is not null and v.IdVisitado is not null ";
	$query.="order by c.IdComunidad asc, p.IdProvincia asc, m.Municipio asc";

	$municipios=mysqli_query ($link, $query);

	$mostrarTituloComunidad = 1;
	$mostrarTituloProvincia = 1;
	$idComunidadPost = 0;
	$idProvinciaPost = 0;

		
	while($municipio=mysqli_fetch_array($municipios, MYSQLI_BOTH))
	{
		$tituloComunidad=strtoupper($municipio["Comunidad"]);
		$idComunidad=$municipio["IdComunidad"];
		$tituloProvincia=strtoupper($municipio["Provincia"]);
		$idProvincia=$municipio["IdProvincia"];
		$tituloMunicipio=$municipio["Municipio"];
		$idMunicipio=$municipio["IdMunicipio"];
		$idVisitado=$municipio["IdVisitado"];

		if ($idComunidadPost != $idComunidad){
			$mostrarTituloComunidad = 1;
		}

		if ($idProvinciaPost != $idProvincia){
			$mostrarTituloProvincia = 1;
		}

		if ($mostrarTituloComunidad == 1){
			$mostrarTituloComunidad = 0;
			$idComunidadPost = $idComunidad;
?>
		<tr>
			<td colspan="3"><center><?= $tituloComunidad ?></center></td>	
		</tr>
<?php 
		} //if ($mostrarTituloComunidad == 1){

		if ($mostrarTituloProvincia == 1){
			$mostrarTituloProvincia = 0;
			$idProvinciaPost = $idProvincia;
?>
		<tr>
			<td colspan="3"><center><?= $tituloProvincia ?></center></td>	
		</tr>
<?php 
		}  //if ($mostrarTituloProvincia == 1){
?>	
		<tr>
			<td valign="top">
				<a href="fotos.php?idMunicipio=<?= $idMunicipio ?>"><?= $tituloMunicipio ?></a>
 			</td>
			<td valign="top"><?= devolverFecha($municipio["Fecha"]) ?></td>
			<td valign="top">
				<a href="resultados.php?idMunicipio=<?= $idMunicipio ?>&opcion=D&idPagina=4">Eliminar</a>
 			</td>
		</tr>
<?php			
	}
	mysqli_free_result($municipios);
?>
</table>