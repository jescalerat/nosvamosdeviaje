<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col-3" id="menu">
<?php					
			$opcion = "N";
			$idRutaDia = 0;
			$idRutaComentario = 0;
			if(isset($_GET['idRutaDia'])){
				$idRutaDia = $_GET['idRutaDia'];
			}
			if(isset($_GET['opcion'])){
				$opcion = $_GET['opcion'];
			}
			if(isset($_GET['idRutaComentario'])){
				$idRutaComentario = $_GET['idRutaComentario'];
			}

			require_once("includes/menu.php");
?>
		</div>
		<div class="col-9" id="principal">
<?php					
			require_once("includes/inc_rutas_comentarios.php");
?>
		</div>
	</div>

	<div class="row">
		<div class="col" id="pie">
<?php
			require_once("includes/pie.php");
?>
		</div>
	</div>