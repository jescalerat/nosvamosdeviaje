<?php
	$municipio = "";
	if ($idMunicipio != 0){
		$municipio = obtenerMunicipio($link, $idMunicipio, false);
	}

?>

<h1 class="text-center"><?= $municipio ?></h1>
<form class="form-horizontal" role="form" method="post" action="resultados.php">
	<div class="form-group">
		<label for="comentarioES">Fotos</label>
		<textarea id="fotos" name="fotos" class="form-control" rows="3" cols="80"></textarea>
	</div>
	
	<div class="form-group">
        <div class="col">
            <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
        </div>
    </div>

	<input type="hidden" id="idMunicipio" name="idMunicipio" value="<?= $idMunicipio ?>"/>
	<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
	<input type="hidden" id="idPagina" name="idPagina" value="4"/>
</form>

<h1 class="text-center">Sin Fotos</h1>
<table class="table">
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
			<thead class="thead-dark">
        		<tr>
        			<th scope="col" colspan="2"><p class="text-center"><?= $tituloComunidad ?></p></th>	
        		</tr>
        	</thead>
<?php 
		} //if ($mostrarTituloComunidad == 1){

		if ($mostrarTituloProvincia == 1){
			$mostrarTituloProvincia = 0;
			$idProvinciaPost = $idProvincia;
?>
			<thead class="thead-light">
    			<tr>
        			<th scope="col" colspan="2"><p class="text-center"><?= $tituloProvincia ?></p></th>	
        		</tr>
        	</thead>
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

<h1 class="text-center">Con Fotos</h1>
<table class="table">
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
			<thead class="thead-dark">
        		<tr>
        			<th scope="col" colspan="3"><p class="text-center"><?= $tituloComunidad ?></p></th>	
        		</tr>
        	</thead>
<?php 
		} //if ($mostrarTituloComunidad == 1){

		if ($mostrarTituloProvincia == 1){
			$mostrarTituloProvincia = 0;
			$idProvinciaPost = $idProvincia;
?>
			<thead class="thead-light">
        		<tr>
        			<th scope="col" colspan="3"><p class="text-center"><?= $tituloProvincia ?></p></th>	
        		</tr>
        	</thead>
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