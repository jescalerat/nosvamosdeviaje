<form class="col s12">
	<div class="row">
		<div class="col 12" id="titulo">
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

	<ul>
<?php
	while($ruta=mysqli_fetch_array($rutas, MYSQLI_BOTH))
	{
		$titulo=$ruta["Titulo"];
		
?>
		<li><a href="#" onclick="llamada_prototype('paginas/ruta.php?idRuta=<?= $ruta["IdRuta"] ?>','principal');"><?= cambiarAcentos($titulo) ?></a></li>
<?php
	}		
	mysqli_free_result($rutas);
?>
	</ul>
</form>