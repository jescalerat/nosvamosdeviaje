<?php
	$comentarioES = "";
	$comentarioCA = "";
	$comentarioEN = "";

	if ($idComentario != "" && $idComentario != "undefined"){
		$query="select * from comentarios where idComentario = ".$idComentario;
		$comentarios=mysqli_query ($link, $query);
		$rowcomentario=mysqli_fetch_array($comentarios);

		$comentarioES = $rowcomentario["ComentarioES"];
		$comentarioCA = $rowcomentario["ComentarioCA"];
		$comentarioEN = $rowcomentario["ComentarioEN"];

		mysqli_free_result($comentarios);
		$opcion = "U";
	}

	$municipio = "";
	if ($idMunicipio != 0){
		$municipio = obtenerMunicipio($link, $idMunicipio, false);
	}

?>

<h1 class="text-center"><?= $municipio ?></h1>
<form class="form-horizontal" role="form" method="post" action="resultados.php">
	<div class="form-group">
		<label for="comentarioES">Español</label>
		<textarea id="comentarioES" name="comentarioES" class="form-control" rows="3" cols="80"><?= $comentarioES ?></textarea>
	</div>
	<div class="form-group">
		<label for="comentarioCA">Catalan</label>
		<textarea id="comentarioCA" name="comentarioCA" class="form-control" rows="3" cols="80"><?= $comentarioCA ?></textarea>
	</div>
	<div class="form-group">
		<label for="comentarioEN">Ingles</label>
		<textarea id="comentarioEN" name="comentarioEN" class="form-control" rows="3" cols="80"><?= $comentarioEN ?></textarea>
	</div>
	
	<div class="form-group">
        <div class="col">
            <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
        </div>
    </div>

	<input type="hidden" id="idComentario" name="idComentario" value="<?= $idComentario ?>"/>
	<input type="hidden" id="idVisitado" name="idVisitado" value="<?= $idVisitado ?>"/>
	<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
	<input type="hidden" id="idPagina" name="idPagina" value="3"/>	
</form>

<h1 class="text-center">Sin Comentarios</h1>
<table class="table">
<?php	
	
	$query="select c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="left join comentarios co on co.IdVisitado=v.IdVisitado ";
	$query.="where co.IdComentario is null and v.IdVisitado is not null ";
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
				<a href="comentarios.php?idVisitado=<?= $idVisitado ?>&idMunicipio=<?= $idMunicipio ?>"><?= $tituloMunicipio ?></a>
 			</td>
			<td valign="top"><?= devolverFecha($municipio["Fecha"]) ?></td>
		</tr>
<?php			
	}
	mysqli_free_result($municipios);
?>
</table>

<h1 class="text-center">Con Comentarios</h1>
<table class="table">
<?php	
	
	$query="select c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado, co.IdComentario  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="left join comentarios co on co.IdVisitado=v.IdVisitado ";
	$query.="where co.IdComentario is not null ";
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
		$idComentario=$municipio["IdComentario"];

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
				<a href="comentarios.php?idComentario=<?= $idComentario ?>&idVisitado=<?= $idVisitado ?>&idMunicipio=<?= $idMunicipio ?>"><?= $tituloMunicipio ?></a>
 			</td>
			<td valign="top"><?= devolverFecha($municipio["Fecha"]) ?></td>
			<td valign="top">
				<a href="resultados.php?idComentario=<?= $idComentario ?>&opcion=D&idPagina=3">Eliminar</a>
 			</td>
		</tr>
<?php			
	}
	mysqli_free_result($municipios);
?>
</table>