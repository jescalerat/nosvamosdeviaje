<?php
	$idRuta = 0;
	if(isset($_GET['idRuta'])){
		$idRuta = $_GET['idRuta'];
	}

	$tituloRuta = "";
	if ($idioma == 1){
	 	$tituloRuta = "FechaES";
	} else if ($idioma == 2){
		$tituloRuta = "FechaCA";
	} else if ($idioma == 3){
		$tituloRuta = "FechaEN";
	} else {
		$tituloRuta = "FechaEN";
	}
	$query="select IdRuta, ".$tituloRuta." as Titulo ";
	$query.="from rutas ";
	$query.="where idRuta = ".$idRuta;

	$ruta=mysqli_query ($link, $query);
	$rowruta=mysqli_fetch_array($ruta);

	$titulo = $rowruta["Titulo"];
?>

<form class="col s12">
	<div class="row">
		<div class="col s12" id="titulo">
			<h1><?= cambiarAcentos(mb_strtoupper($titulo)) ?></h1>
		</div>
	</div>
<?php
	mysqli_free_result($ruta);	
?>
</form>

<div class="row">
	<div class="col s4" id="dia">
		<?= cambiarAcentos(_RUTADIA) ?>
	</div>
	<div class="col s8" id="municipios">
		<?= cambiarAcentos(_RUTAMUNICIPIOS) ?>
	</div>
</div>
