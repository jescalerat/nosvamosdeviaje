<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			$opcion = "N";
			$idFoto = 0;
			if(isset($_GET['idFoto'])){
				$idFoto = $_GET['idFoto'];
			}
			$idMunicipio = 0;
			if(isset($_GET['idMunicipio'])){
				$idMunicipio = $_GET['idMunicipio'];
			}

			require_once("includes/menu.php");
?>
		</div>
		<div class="col s9" id="principal">
<?php					
			require_once("includes/inc_fotos.php");
?>
		</div>
	</div>

	<div class="row">
		<div class="col s12" id="pie">
<?php
			require_once("includes/pie.php");
?>
		</div>
	</div>