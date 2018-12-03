<form class="col">
	<div class="row">
		<div class="col" id="titulo">
			<h1><?= cambiarAcentos(mb_strtoupper(_RUTASTITULO)) ?></h1>
		</div>
	</div>
<?php
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

	$rutas=mysqli_query ($link, $query);
?>

	<div class="collection">
<?php
	while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
	{
		$titulo=$ruta["Titulo"];
		
?>
		<a href="#" class="collection-item" onclick="llamada_prototype('paginas/ruta.php?idRuta=<?= $ruta["IdRuta"] ?>','principal');"><?= cambiarAcentos($titulo) ?></a>
<?php
	}		
	mysqli_free_result($rutas);
?>
	</div>
</form>