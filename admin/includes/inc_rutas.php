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
	<form class="form-horizontal" role="form" method="post" action="resultados.php">
		<div class="form-group">
        	<label class="col control-label" for="rutaFechaES">
        		Español
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="fechaES" id="fechaES" value="<?= $fechaES ?>">
            </div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="rutaFechaCA">
        		Catalan
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="fechaCA" id="fechaCA" value="<?= $fechaCA ?>">
            </div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="rutaFechaEN">
        		Ingles
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="fechaEN" id="fechaEN" value="<?= $fechaEN ?>">
            </div>
        </div>
		
<?php		
		if ($idRuta != "" && $idRuta != "undefined"){
?>
			<div class="row">
				<div class="col" id="addDias">
					<a href="rutas_dias.php?idRuta=<?= $idRuta ?>">Añadir dias</a>
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
		<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="2"/>
	</form>
