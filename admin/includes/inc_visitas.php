<form class="col s12">
	<div class="row">
		<div class="col s6" id="paises">
			<label>Paises</label>
			<select name="paisSelect" id="paisSelect" class="browser-default"></select>
		</div>
		<div class="col s6" id="comunidades">
			<label>Comunidades</label>
			<select name="comunidadSelect" id="comunidadSelect" class="browser-default"></select>
		</div>
	</div>
	<div class="row">
		<div class="col s6" id="provincias">
			<label>Provincias</label>
			<select name="provinciaSelect" id="provinciaSelect" class="browser-default"></select>
		</div>
		<div class="col s6" id="municipios">
			<label>Municipios</label>
			<select name="municipioSelect" id="municipioSelect" class="browser-default"></select>
		</div>
	</div>

	<div class="row">
		<div class="col s12" id="municipios">
			<div id="recargaMunicipios">
					<?php require_once("recargaMunicipios.php"); ?>
			</div>
		</div>
	</div>
</form>