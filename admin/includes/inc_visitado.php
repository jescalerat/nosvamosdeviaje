
<?php
	$idMunicipioVisitado = 0;
	if (isset($_GET['idMunicipioVisitado'])){
		$idMunicipioVisitado = $_GET['idMunicipioVisitado'];

		$municipio = obtenerMunicipio($link, $idMunicipioVisitado, false);
	}
	$opcion = $_GET['opcion'];
  
	$dia = "";
	$mes = "";
	$anyo = "";
	$titulo = "";
	$facebook = "";
		
	if (isset($_GET['idVisitado'])){
		$idVisitado = $_GET['idVisitado'];
		$query="select * from visitados where idVisitado = ".$idVisitado;
		$visitado=mysqli_query ($link, $query);
		$rowvisitado=mysqli_fetch_array($visitado);
		
		$fechaArray = explode('-', $rowvisitado["Fecha"]);
		$dia = $fechaArray[2];
		$mes = $fechaArray[1];
		$anyo = $fechaArray[0];
		$titulo = $rowvisitado["Titulo"];
		$facebook = $rowvisitado["Facebook"];
		$idMunicipio = $rowvisitado["IdMunicipio"];

		mysqli_free_result($visitado);

		$municipio = obtenerMunicipio($link, $idMunicipio, false);
	}
?>

<h1><?= $municipio ?></h1>
<div id="formulario" class="formulario">
	<form method="post" class="contacto">
        <fieldset>
            <div><label>Fecha:</label><input type="text" class="dia" name="dia" value="<?= $dia ?>" /><input type="text" class="mes" name="mes" value="<?= $mes ?>"/><input type="text" class="anyo" name="anyo" value="<?= $anyo ?>" /></div>
            <div><label>Titulo:</label><input type="text" class="titulo" name="titulo" value="<?= $titulo ?>" /></div>
            <div><label>Facebook:</label><input type="text" class="facebook" name="facebook" value="<?= $facebook ?>" /></div>
            <div class="ultimo">
                <img src="ajax.gif" class="ajaxgif hide" />
                <div class="msg"></div>
                <button class="boton_envio">Enviar Mensaje</button>
            </div>
        </fieldset>
		<input type="hidden" class="idMunVisitado" name="idMunVisitado" value="<?= $idMunicipioVisitado ?>"/>
		<input type="hidden" class="idVisitado" name="idVisitado" value="<?= $idVisitado ?>"/>
		<input type="hidden" class="opcion" name="opcion" value="<?= $opcion ?>"/>
     </form>
</div>

<?php
	if (isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['anyo']) && isset($_POST['titulo']) && isset($_POST['facebook']) && isset($_POST['idMunVisitado'])){
		$dia = $_POST['dia'];
		$mes = $_POST['mes'];
		$anyo = $_POST['anyo'];
		$fecha = $anyo."-".$mes."-".$dia;
		$titulo = $_POST['titulo'];
		$facebook = $_POST['facebook'];
		$idMunVisitado = $_POST['idMunVisitado'];
		$idVisitado = $_POST['idVisitado'];
		
		if (isset($_POST['opcion']) && $_POST['opcion'] == 'N'){		
			$query="insert into visitados (IdMunicipio, Fecha, Titulo, Facebook) values (".$idMunVisitado.", '".$fecha."', '".$titulo."', '".$facebook."')";
			mysqli_query ($link, $query);
		}else if (isset($_POST['opcion']) && $_POST['opcion'] == 'U'){		
			$query="update visitados set Fecha='".$fecha."', Titulo='".$titulo."', Facebook='".$facebook."' where IdVisitado=".$idVisitado;
			mysqli_query ($link, $query);
		}
	}
?>