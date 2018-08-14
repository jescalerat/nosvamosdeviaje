<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			$opcion = "N";
			$idComentario = 0;
			if(isset($_GET['idComentario'])){
				$idComentario = $_GET['idComentario'];
			}
			$idVisitado = 0;
			if(isset($_GET['idVisitado'])){
				$idVisitado = $_GET['idVisitado'];
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
			require_once("includes/inc_comentarios.php");
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