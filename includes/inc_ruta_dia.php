<?php
	$idRutaDia = 0;
	if(isset($_GET['idRutaDia'])){
		$idRutaDia = $_GET['idRutaDia'];
	}

	$query="select * ";
	$query.="from rutas_dias ";
	$query.="where idRutaDia = ".$idRutaDia;

	$diaruta=mysqli_query ($link, $query);
	$rowdiaruta=mysqli_fetch_array($diaruta);

	$titulo = $rowdiaruta["Fecha"];
	mysqli_free_result($diaruta);
?>

<form class="col">
	<div class="row">
		<div class="col" id="titulo">
			<h1 class="text-center"><?= devolverFecha($titulo) ?></h1>
		</div>
	</div>
</form>

<?php
	$comentarioRuta = "";
	if ($idioma == 1){
	 	$comentarioRuta = "ComentarioES";
	} else if ($idioma == 2){
		$comentarioRuta = "ComentarioCA";
	} else if ($idioma == 3){
		$comentarioRuta = "ComentarioEN";
	} else {
		$comentarioRuta = "ComentarioEN";
	}
	$query="select ".$comentarioRuta." as Comentario ";
	$query.=" from rutas_comentarios  ";
	$query.=" where idRutaDia = ".$idRutaDia;

	$comentarioRuta=mysqli_query ($link, $query);
	$rowcomentarioruta=mysqli_fetch_array($comentarioRuta);

	$comentario = $rowcomentarioruta["Comentario"];
	mysqli_free_result($comentarioRuta);
?>

<div class="row">
	<div class="col" id="rutas">
		<?= cambiarAcentos($comentario) ?>
	</div>
</div>

<?php
	$query="select rm.IdVisitado, m.Municipio, p.Provincia ";
	$query.=" from rutas_dias rd  ";
	$query.=" left join rutas_municipios rm on rm.IdRutaDia = rd.IdRutaDia ";
	$query.=" left join visitados v on v.IdVisitado = rm.IdVisitado ";
	$query.=" left join municipios m on m.IdMunicipio = v.IdMunicipio ";	
	$query.=" left join provincias p on p.IdProvincia = m.IdProvincia ";
	$query.=" where rd.idRutaDia = ".$idRutaDia;
	$query.=" order by rm.Orden asc ";

	$visitados=mysqli_query ($link, $query);
?>

<?php
	while($visitado=mysqli_fetch_array($visitados, MYSQLI_BOTH))
	{
		$municipio = $visitado["Municipio"]." (".$visitado["Provincia"].")";
?>
		<a href="#" class="list-group-item" onclick="llamada_prototype('paginas/visitados.php?idVisitado=<?= $visitado['IdVisitado'] ?>','principal');"><?= cambiarAcentos($municipio) ?></a>
<?php
	}		
	mysqli_free_result($visitados);
?>
