<?php
	$fechaES = "";
	$fechaCA = "";
	$fechaEN = "";

	if (isset($_POST['fechaES']) && isset($_POST['fechaCA']) && isset($_POST['fechaEN'])){
		$fechaES = str_replace("'", "''", $_POST['fechaES']);
		$fechaCA = str_replace("'", "''", $_POST['fechaCA']);
		$fechaEN = str_replace("'", "''", $_POST['fechaEN']);

		if ($opcion == "N"){
			$query="insert into rutas (FechaES, FechaCA, FechaEN) values ('".$fechaES."', '".$fechaCA."', '".$fechaEN."')";
			mysqli_query ($link, $query);
			print("Insert: ".$query);
		} else if ($opcion == "U"){
			$query="update rutas set FechaES='".$fechaES."', FechaCA='".$fechaCA."', FechaEN='".$fechaEN."' where IdRuta=".$idRuta;
			mysqli_query ($link, $query);
			print("Update: ".$query);
		}
	} 
	
	if ($opcion == "D"){
		$query="delete from rutas where IdRuta=".$idRuta;
		mysqli_query ($link, $query);
		print("Delete: ".$query);
		$idRuta="";
		$opcion="N";
	}
	
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
	<form class="col s12" method="post">
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
				<img src="ajax.gif" class="ajaxgif hide" />
                <div class="msg"></div>
				<button class="boton_envio_ruta">Enviar Mensaje</button>
			</div>
		</div>
		
	</form>
