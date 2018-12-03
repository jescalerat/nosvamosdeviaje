﻿<?php
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
	$query="select rd.IdRutaDia, rd.Fecha ";
	$query.=" from rutas r  ";
	$query.=" left join rutas_dias rd on rd.IdRuta = r.IdRuta ";
	$query.=" where r.idRuta = ".$idRuta;
	$query.=" order by rd.Fecha asc ";

	$diasRuta=mysqli_query ($link, $query);
?>

<div class="row">
	<div class="col" id="rutas">
		<table class="table">
			<tr>
				<th>		
					<?= cambiarAcentos(_RUTADIA) ?>
				</th>
				<th>		
					<?= cambiarAcentos(_RUTAMUNICIPIOS) ?>
				</th>
			</tr>
<?php
			while($dia=mysqli_fetch_array($diasRuta, MYSQLI_BOTH))
			{
				$idRutaDia = $dia["IdRutaDia"];
?>
				<tr>
					<td>
						<a href="#" onclick="llamada_prototype('paginas/ruta_dia.php?idRutaDia=<?= $dia['IdRutaDia'] ?>','principal');"><?= devolverFecha($dia["Fecha"]) ?></a>
					</td>
					<td>
						<?php require("../includes/inc_ruta_municipios.php"); ?>
					</td>
				</tr>
<?php
			}		
			mysqli_free_result($diasRuta);
?>
		</table>
	</div>
</div>
