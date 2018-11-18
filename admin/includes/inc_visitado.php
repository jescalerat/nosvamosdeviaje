
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

<h1><?= $municipio ?></h1>
<div id="formulario" class="formulario">
	<form class="col s12" method="post" action="resultados.php">
        <fieldset>
			<div class="row">
				<div class="input-field col s12 m6">
					<input type="text" class="datepicker" name="fecha" id="fecha" value="<?= $fecha ?>">
					<label>Fecha</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="titulo" id="titulo" value="<?= $titulo ?>">
					<label for="titulo">Titulo</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" name="facebook" id="facebook" value="<?= $facebook ?>">
					<label for="titulo">Facebook</label>
				</div>
			</div>

			<div class="row">
				<div class="col s12" id="botonEnvio">
					<button>Enviar Mensaje</button>
				</div>
			</div>
        </fieldset>
		<input type="hidden" class="idMunVisitado" name="idMunVisitado" value="<?= $idMunicipioVisitado ?>"/>
		<input type="hidden" class="idVisitado" name="idVisitado" value="<?= $idVisitado ?>"/>
		<input type="hidden" class="opcion" name="opcion" value="<?= $opcion ?>"/>
		<input type="hidden" id="idPagina" name="idPagina" value="1"/>
     </form>
</div>