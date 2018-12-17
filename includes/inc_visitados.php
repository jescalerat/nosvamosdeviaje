<?php
	$idVisitado = $_GET['idVisitado'];

	if ($idioma == 1){
		$comentario = "ComentarioES";
	} else if ($idioma == 2){
		$comentario = "ComentarioCA";
	} else if ($idioma == 3){
		$comentario = "ComentarioEN";
	} else {
		$comentario = "ComentarioEN";
	}

	$query="select ".$comentario ." as Comentario  ";
	$query.="from comentarios c  ";
	$query.="where c.IdVisitado = ".$idVisitado;

	$visitado=mysqli_query ($link, $query);
	$rowvisitado=mysqli_fetch_array($visitado);

	$comentarioText = $rowvisitado["Comentario"];
	mysqli_free_result($visitado);

	$query="select *  ";
	$query.="from visitados v  ";
	$query.="where v.IdVisitado = ".$idVisitado;

	$visitado=mysqli_query ($link, $query);
	$rowvisitado=mysqli_fetch_array($visitado);

	$idMunicipio = $rowvisitado["IdMunicipio"];
	mysqli_free_result($visitado);

	$query="select * ";
	$query.=" from fotos f  ";
	$query.=" where f.IdMunicipio = ".$idMunicipio;
	$query.=" order by f.Orden asc ";
	$fotosVisitados=mysqli_query ($link, $query);
	$filasfotos=mysqli_num_rows($fotosVisitados);

?>
<h1 class="text-center"><?= obtenerMunicipio($link, $idMunicipio, false) ?></h1>
<form class="col">
	<div class="row">
		<div class="col" id="comentario">
			<?= cambiarAcentos($comentarioText) ?>
		</div>
	</div>

<?php 
    $inicio = 0;
    $registros = 10;
    for ($x=0; $x < $filasfotos; $x++){
        if ($x == 0 || $x % $registros == 0){
            require("inc_visitados_galerias.php");
            $inicio = $x + $registros + 1;
        }
    }
    mysqli_free_result($fotosVisitados);
?>

<script>
	function antes (id){
		var posicion = $(id).offset().top - 50;
		$(id).carousel('prev');
		$('html, body').animate({
			scrollTop: posicion
		}, 2000);
	}

	function despues (id){
		var posicion = $(id).offset().top - 50;
		$(id).carousel('next');
		$('html, body').animate({
			scrollTop: posicion
		}, 2000);
	}

</script>
</form>