<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			require_once("includes/menu.php");
?>
		</div>
		<div class="col s9" id="principal">
			<input type="hidden" id="idPaisH" name="idPaisH"/>
			<input type="hidden" id="idComunidadH" name="idComunidadH"/>
			<input type="hidden" id="idProvinciaH" name="idProvinciaH"/>
			<input type="hidden" id="idMunicipioH" name="idMunicipioH"/>
<?php					
			require_once("includes/inc_visitas.php");
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