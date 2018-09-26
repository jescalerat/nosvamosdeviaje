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

<?php
	$query="select v.*, m.Municipio, p.Provincia ";
	$query.=" from rutas_municipios rm ";
	$query.=" left join visitados v on v.IdVisitado = rm.IdVisitado ";
	$query.=" left join municipios m on m.IdMunicipio = v.IdMunicipio ";
	$query.=" left join provincias p on p.IdProvincia = m.IdProvincia ";
	$query.=" where rm.idRuta = ".$idRuta;
	$query.=" order by v.Fecha asc, rm.Orden asc ";

	$visitados=mysqli_query ($link, $query);

	$fechaTemp = "";
	$mismaFecha = false;
	while($visitado=mysqli_fetch_array($visitados, MYSQLI_BOTH))
	{
		$municipio = $visitado["Municipio"]." (".$visitado["Provincia"].")";
		if ($fechaTemp != $visitado["Fecha"]){
			$fechaTemp = $visitado["Fecha"];
			$mismaFecha = false;
		} else {
			$mismaFecha = true;
		}
		
		if (!$mismaFecha){
			$arrayMunicipios[$visitado["Fecha"]] = $municipio."</br>";
		} else {
			$arrayMunicipios[$visitado["Fecha"]] .= $municipio."</br>";
		}
	}
?>

<div class="row">
	<div class="col s12" id="rutas">
		<table>
			<tr>
				<th>		
					<?= cambiarAcentos(_RUTADIA) ?>
				</th>
				<th>		
					<?= cambiarAcentos(_RUTAMUNICIPIOS) ?>
				</th>
			</tr>
<?php
		foreach($arrayMunicipios as $fechas => $municipio)
		{
?>
			<tr>
				<td>
				<a href="#" onclick="llamada_prototype('paginas/ruta.php?idRuta=<?= $ruta["IdRuta"] ?>','principal');"><?= devolverFecha($fechas) ?></a>
				</td>
				<td>
					<?= cambiarAcentos($municipio) ?>
				</td>
			</tr>
<?php
		}		
		mysqli_free_result($visitados);
?>
		</table>
	</div>
</div>
