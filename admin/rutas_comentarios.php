<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			$opcion = "N";
			$idRuta = 0;
			$idRutaComentario = 0;
			if(isset($_GET['idRuta'])){
				$idRuta = $_GET['idRuta'];
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
		<div class="col s9" id="principal">
<?php					
			require_once("includes/inc_rutas_comentarios.php");
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