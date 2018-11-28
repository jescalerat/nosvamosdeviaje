<form class="col">
	<div class="row">
		<div class="col-6" id="paises">
			<label><?= cambiarAcentos(mb_strtoupper(_MUNIPAISES)) ?></label>
			<select name="paisSelect" id="paisSelect" class="form-control"></select>
		</div>
		<div class="col-6" id="comunidades">
			<label><?= cambiarAcentos(mb_strtoupper(_MUNICOMUNIDADES)) ?></label>
			<select name="comunidadSelect" id="comunidadSelect" class="form-control"></select>
		</div>
	</div>
	<div class="row">
		<div class="col-6" id="provincias">
			<label><?= cambiarAcentos(mb_strtoupper(_MUNIPROVINCIAS)) ?></label>
			<select name="provinciaSelect" id="provinciaSelect" class="form-control"></select>
		</div>
		<div class="col-6" id="municipios">
			<label><?= cambiarAcentos(mb_strtoupper(_MUNIMUNICIPIOS)) ?></label>
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

	<input type="hidden" id="idPaisH" name="idPaisH"/>
	<input type="hidden" id="idComunidadH" name="idComunidadH"/>
	<input type="hidden" id="idProvinciaH" name="idProvinciaH"/>
	<input type="hidden" id="idMunicipioH" name="idMunicipioH"/>
</form>