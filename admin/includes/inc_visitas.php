<form class="col">
	<div class="row">
		<div class="col-6" id="paises">
			<label>Paises</label>
			<select name="paisSelect" id="paisSelect" class="form-control"></select>
		</div>
		<div class="col-6" id="comunidades">
			<label>Comunidades</label>
			<select name="comunidadSelect" id="comunidadSelect" class="form-control"></select>
		</div>
	</div>
	<div class="row">
		<div class="col-6" id="provincias">
			<label>Provincias</label>
			<select name="provinciaSelect" id="provinciaSelect" class="form-control"></select>
		</div>
		<div class="col-6" id="municipios">
			<label>Municipios</label>
			<select name="municipioSelect" id="municipioSelect" class="form-control"></select>
		</div>
	</div>

	<div class="row">
		<div class="col" id="municipios">
			<div id="recargaMunicipios">
					<?php require_once("recargaMunicipios.php"); ?>
			</div>
		</div>
	</div>
</form>