<?php
	$fechaES = "";
	$fechaCA = "";
	$fechaEN = "";

	if ($idRuta != "" && $idRuta != "undefined"){
		$query="select * from rutas where idRuta = ".$idRuta;
		$rutas=mysqli_query ($link, $query);
		$rowruta=mysqli_fetch_array($rutas);

		$fechaES = $rowruta["FechaES"];
		$fechaCA = $rowruta["FechaCA"];
		$fechaEN = $rowruta["FechaEN"];

		mysqli_free_result($rutas);
		$opcion = "U";
	} 

?>
	<form class="col s12" method="post" action="resultados.php">
		<div class="row">
			<div class="col s12" id="rutaFechaES">
				<label>Español</label>
				<input type="text" id="fechaES" name="fechaES" value="<?= $fechaES ?>" />
			</div>
		</div>
		<div class="row">
			<div class="col s12" id="rutaFechaCA">
				<label>Catalan</label>
				<input type="text" id="fechaCA" name="fechaCA" value="<?= $fechaCA ?>" />
			</div>
		</div>
		<div class="row">
			<div class="col s12" id="rutaFechaEN">
				<label>Ingles</label>
				<input type="text" id="fechaEN" name="fechaEN" value="<?= $fechaEN ?>" />
			</div>
		</div>
		<div class="row">
			<div class="col s12" id="botonEnvio">
				<button>Enviar Mensaje</button>
			</div>
		</div>
		<input type="hidden" id="idRuta" name="idRuta" value="<?= $idRuta ?>"/>
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="2"/>
	</form>
