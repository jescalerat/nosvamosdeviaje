<?php
	$fechaForm = "";
	$comentarioES = "";
	$comentarioCA = "";
	$comentarioEN = "";


	if ($idRuta != "" && $idRuta != "undefined"){
		$query="select * from rutas where idRuta = ".$idRuta;
		$rutas=mysqli_query ($link, $query);
		$rowruta=mysqli_fetch_array($rutas);

		$fecha = $rowruta["FechaES"];

		mysqli_free_result($rutas);

		if ($opcion == "U"){
			$query="select * from rutas_comentarios ";
			$query.="where idRutaComentario = ".$idRutaComentario;
			$rutas=mysqli_query ($link, $query);
			$rowcomentario=mysqli_fetch_array($rutas);

			$fechaForm = $rowcomentario["Fecha"];
			$comentarioES = $rowcomentario["ComentarioES"];
			$comentarioCA = $rowcomentario["ComentarioCA"];
			$comentarioEN = $rowcomentario["ComentarioEN"];
		}
	} 

?>
	<h1><?= cambiarAcentos($fecha) ?></h1>
	<form class="col s12" method="post" action="resultados.php">
		<div class="row">
			<div class="input-field col s12 m6">
				<input type="text" class="datepicker" name="fecha" id="fecha" value="<?= $fechaForm ?>">
				<label>Fecha</label>
			</div>
		</div>
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

		<input type="hidden" id="idRuta" name="idRuta" value="<?= $idRuta ?>"/>
		<input type="hidden" id="idRutaComentario" name="idRutaComentario" value="<?= $idRutaComentario ?>"/>
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="6"/>
	</form>

	<h2>Comentarios realizados</h2>
<?php
	$query="select rc.IdRuta, rc.IdRutaComentario, rc.Fecha, rc.ComentarioES ";
	$query.="from rutas_comentarios rc ";
	$query.="where rc.IdRuta=".$idRuta;

	$rutas_comentarios=mysqli_query ($link, $query);
?>

	<table>
		<tr>
			<th>Fecha</th>
			<th>Comentario</th>
			<th>Eliminar</th>
		<tr>

<?php
		while($ruta=mysqli_fetch_array($rutas_comentarios, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><a href="rutas_comentarios.php?idRutaComentario=<?= $ruta["IdRutaComentario"] ?>&idRuta=<?= $ruta["IdRuta"] ?>&opcion=U&idPagina=6"><?= $ruta["Fecha"] ?></a></td>
				<td><?= $ruta["ComentarioES"] ?></td>
				<td><a href="resultados.php?idRutaComentario=<?= $ruta["IdRutaComentario"] ?>&idRuta=<?= $idRuta ?>&opcion=D&idPagina=6">Eliminar</a></td>
			</tr>
<?php
		} //while($ruta=mysqli_fetch_array($rutas_municipios, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas_comentarios);
?>