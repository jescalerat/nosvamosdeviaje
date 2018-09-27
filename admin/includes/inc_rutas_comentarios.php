<?php
	$comentarioES = "";
	$comentarioCA = "";
	$comentarioEN = "";


	if ($idRutaDia != "" && $idRutaDia != "undefined"){
		$query="select * from rutas_dias where idRutaDia = ".$idRutaDia;
		$rutasdias=mysqli_query ($link, $query);
		$rowrutadia=mysqli_fetch_array($rutasdias);

		$fecha = $rowrutadia["Fecha"];

		mysqli_free_result($rutasdias);

		if ($opcion == "U"){
			$query="select * from rutas_comentarios ";
			$query.="where idRutaComentario = ".$idRutaComentario;
			$rutas=mysqli_query ($link, $query);
			$rowcomentario=mysqli_fetch_array($rutas);

			$comentarioES = $rowcomentario["ComentarioES"];
			$comentarioCA = $rowcomentario["ComentarioCA"];
			$comentarioEN = $rowcomentario["ComentarioEN"];
		}
	} 

?>
	<h1><?= devolverFecha($fecha) ?></h1>
	<form class="col s12" method="post" action="resultados.php">
		<div class="row">
			<div class="input-field col s12">
				<textarea id="comentarioES" name="comentarioES" class="materialize-textarea"><?= $comentarioES ?></textarea>
				<label for="comentarioES">Español</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<textarea id="comentarioCA" name="comentarioCA" class="materialize-textarea"><?= $comentarioCA ?></textarea>
				<label for="comentarioCA">Catalan</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<textarea id="comentarioEN" name="comentarioEN" class="materialize-textarea"><?= $comentarioEN ?></textarea>
				<label for="comentarioEN">Ingles</label>
			</div>
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
		<input type="hidden" id="idRutaComentario" name="idRutaComentario" value="<?= $idRutaComentario ?>"/>
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="6"/>
	</form>

	<h2>Comentarios realizados</h2>
<?php
	$query="select rc.IdRutaComentario, rc.IdRutaDia, rc.ComentarioES ";
	$query.="from rutas_comentarios rc ";
	$query.="where rc.IdRutaDia=".$idRutaDia;

	$rutas_comentarios=mysqli_query ($link, $query);
?>

	<table>
		<tr>
			<th>Comentario</th>
			<th>Eliminar</th>
		<tr>

<?php
		while($ruta=mysqli_fetch_array($rutas_comentarios, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><a href="rutas_comentarios.php?idRutaComentario=<?= $ruta["IdRutaComentario"] ?>&idRutaDia=<?= $ruta["IdRutaDia"] ?>&opcion=U&idPagina=6"><?= $ruta["ComentarioES"] ?></a></td>
				<td><a href="resultados.php?idRutaComentario=<?= $ruta["IdRutaComentario"] ?>&opcion=D&idPagina=6">Eliminar</a></td>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas_municipios, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas_comentarios);
?>