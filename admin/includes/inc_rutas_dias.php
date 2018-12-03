<?php
	$fechaForm = "";

	if ($idRuta != "" && $idRuta != "undefined"){
		$query="select * from rutas where idRuta = ".$idRuta;
		$rutas=mysqli_query ($link, $query);
		$rowruta=mysqli_fetch_array($rutas);

		$fecha = $rowruta["FechaES"];

		mysqli_free_result($rutas);

		if ($opcion == "U"){
			$query="select * from rutas_dias where idRutaDia = ".$idRutaDia;
			$rutasdias=mysqli_query ($link, $query);
			$rowrutadia=mysqli_fetch_array($rutasdias);

			$fechaForm = $rowrutadia["Fecha"];

			mysqli_free_result($rutasdias);
		}
	} 

?>
	<h1 class="text-center"><?= cambiarAcentos($fecha) ?></h1>
	<form class="form-horizontal" role="form" method="post" action="resultados.php">
		<div class="form-group">
        	<label class="col control-label" for="fecha">
        		Fecha
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="date" name="fecha" id="fecha" value="<?= $fecha ?>">
            </div>
        </div>
	
<?php		
		if ($idRutaDia != "" && $idRutaDia != "undefined"){
?>
			<div class="row">
				<div class="col-6" id="addMunicipios">
					<a href="rutas_municipios.php?idRutaDia=<?= $idRutaDia ?>">Añadir municipios</a>
				</div>
				<div class="col-6" id="addComentarios">
					<a href="rutas_comentarios.php?idRutaDia=<?= $idRutaDia ?>">Añadir comentarios</a>
				</div>
			</div>
<?php
		}
?>
		<div class="form-group">
            <div class="col">
                <p class="text-center"><button type="button" class="btn btn-default">Enviar Mensaje</button></p>
            </div>
        </div>
		<input type="hidden" id="idRuta" name="idRuta" value="<?= $idRuta ?>"/>
		<input type="hidden" id="idRutaDia" name="idRutaDia" value="<?= $idRutaDia ?>"/>
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="7"/>
	</form>

	<h2 class="text-center">Dias realizados</h2>
<?php
	$query="select * ";
	$query.="from rutas_dias ";
	$query.="where IdRuta=".$idRuta;

	$rutas_dias=mysqli_query ($link, $query);
?>

	<table class="table">
		<thead class="thead-dark">
    		<tr>
    			<th>Fecha</th>
    			<th>Eliminar</th>
    		</tr>
    	</thead>

<?php
		while($dia=mysqli_fetch_array($rutas_dias, MYSQLI_BOTH))
		{
?>
			<tr>
				<td><a href="rutas_dias.php?idRutaDia=<?= $dia["IdRutaDia"] ?>&idRuta=<?= $dia["IdRuta"] ?>&opcion=U&idPagina=7"><?= $dia["Fecha"] ?></a></td>
				<td><a href="resultados.php?idRutaDia=<?= $dia["IdRutaDia"] ?>&idRuta=<?= $idRuta ?>&opcion=D&idPagina=7">Eliminar</a></td>
			</tr>
<?php
		} //while($dia=mysqli_fetch_array($rutas_dias, MYSQLI_BOTH))
?>
	</table>
<?php
	mysqli_free_result($rutas_dias);
?>