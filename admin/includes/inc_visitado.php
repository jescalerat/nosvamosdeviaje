
<?php
	$idVisitado = 0;
	$idMunicipioVisitado = 0;
	if (isset($_GET['idMunicipioVisitado'])){
		$idMunicipioVisitado = $_GET['idMunicipioVisitado'];

		$municipio = obtenerMunicipio($link, $idMunicipioVisitado, false);
	}
	$opcion = $_GET['opcion'];
  
	$dia = "";
	$mes = "";
	$anyo = "";
	$titulo = "";
	$facebook = "";
	$fecha = "";
		
	if (isset($_GET['idVisitado'])){
		$idVisitado = $_GET['idVisitado'];
		$query="select * from visitados where idVisitado = ".$idVisitado;
		$visitado=mysqli_query ($link, $query);
		$rowvisitado=mysqli_fetch_array($visitado);
		
		$fechaArray = explode('-', $rowvisitado["Fecha"]);
		$dia = $fechaArray[2];
		$mes = $fechaArray[1];
		$anyo = $fechaArray[0];
		$fecha = $dia."/".$mes."/".$anyo;
		$titulo = $rowvisitado["Titulo"];
		$facebook = $rowvisitado["Facebook"];
		$idMunicipio = $rowvisitado["IdMunicipio"];

		mysqli_free_result($visitado);

		$municipio = obtenerMunicipio($link, $idMunicipio, false);
	}
?>

<h1 class="text-center"><?= $municipio ?></h1>
<div id="formulario" class="formulario">
	<form class="form-horizontal" role="form" method="post" action="resultados.php">
		<div class="form-group">
        	<label class="col control-label" for="fecha">
        		Fecha
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="date" name="fecha" id="fecha" value="<?= $fecha ?>">
            </div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="titulo">
        		Titulo
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="titulo" id="titulo" value="<?= $titulo ?>">
            </div>
        </div>
        <div class="form-group">
        	<label class="col control-label" for="facebook">
        		Facebook
        	</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="facebook" id="facebook" value="<?= $facebook ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <p class="text-center"><button type="button" class="btn btn-default">Enviar Mensaje</button></p>
            </div>
        </div>

		<input type="hidden" class="idMunVisitado" name="idMunVisitado" value="<?= $idMunicipioVisitado ?>"/>
		<input type="hidden" class="idVisitado" name="idVisitado" value="<?= $idVisitado ?>"/>
		<input type="hidden" class="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="1"/>
	</form>
</div>