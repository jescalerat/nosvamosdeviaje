<div class="row">
	<form class="col" method="post" action="paginas/contactar2.php">
		<div class="row">
			<div class="input-field col">
				<h1><?= strtoupper(_TITULO) ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="input-field col">
				<input id="nombre" type="text" class="validate">
				<label for="nombre"><?= cambiarAcentos(_INTRODUCENOMBRE) ?></label>
				<span class="helper-text" data-error="<?= cambiarAcentos(_ERROR) ?>" data-success="<?= cambiarAcentos(_CORRECTO) ?>"></span>
			</div>
		</div>
		<div class="row">
			<div class="input-field col">
				<input id="email" type="email" class="validate">
				<label for="email"><?= cambiarAcentos(_EMAIL) ?></label>
				<span class="helper-text" data-error="<?= cambiarAcentos(_ERROR) ?>" data-success="<?= cambiarAcentos(_CORRECTO) ?>"></span>
			</div>
		</div>
		<div class="row">
			<div class="input-field col">
				<textarea id="mensaje" name="mensaje" class="materialize-textarea"></textarea>
				<label for="mensaje"><?= cambiarAcentos(_MENSAJE) ?></label>
				<span class="helper-text" data-error="<?= cambiarAcentos(_ERROR) ?>" data-success="<?= cambiarAcentos(_CORRECTO) ?>"></span>
			</div>
		</div>
		<div class="row">
			<div class="col" id="botonEnvio">
				<button><?= cambiarAcentos(_ENVIAR) ?></button>
			</div>
		</div>
	</form>
</div>

