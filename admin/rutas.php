<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			$opcion = "N";
			$idRuta = 0;
			if(isset($_GET['idRuta'])){
				$idRuta = $_GET['idRuta'];
			}

			require_once("includes/menu.php");
?>
		</div>
		<div class="col s9" id="principal">
<?php					
			require_once("includes/inc_rutas.php");
?>
			<div id="listado_rutas">
<?php
				require_once("includes/inc_listado_rutas.php");
?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12" id="pie">
<?php
			require_once("includes/pie.php");
?>
		</div>
	</div>