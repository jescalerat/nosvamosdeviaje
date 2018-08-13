<?php					
	require_once("includes/cabecera.php");
?>
	<div class="row">
		<div class="col s3" id="menu">
<?php					
			$idRuta = "";
			$opcion = "N";
			if (isset($_GET['idRuta'])){
				$idRuta = $_GET['idRuta'];
			}
			if (isset($_POST['idRuta'])){
				$idRuta = $_POST['idRuta'];
			}
			if (isset($_GET['opcion'])){
				$opcion = $_GET['opcion'];
				print("Opciong GET: ".$opcion);
			}
			if (isset($_POST['opcion'])){
				$opcion = $_POST['opcion'];
				print("<br>Opciong POST: ".$opcion);
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
			<input type="hidden" id="idRuta" name="idRuta" value="<?= $idRuta ?>"/>
			<input type="hidden" id="opcion" name="opcion" value="<?= $opcion ?>"/>
<?php					print("Opcion: ".$opcion);
			require_once("includes/pie.php");
?>
		</div>
	</div>