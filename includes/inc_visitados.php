﻿﻿<?php
	$idVisitado = $_GET['idVisitado'];
	
	$idRutaDia = 0;
	if (isset($_GET['idRutaDia'])){
	   $idRutaDia = $_GET['idRutaDia'];
	}
	

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
    if ($filasfotos > 0){
       /* $inicio = 0;
        $registros = 10;
        for ($x=0; $x < $filasfotos; $x++){
            if ($x == 0 || $x % $registros == 0){*/
?>
        <div id="galerias">
<?php  
                require("inc_visitados_galerias.php");
?>
        </div>
<?php 
/*                $inicio = $x + $registros + 1;
            }
        }*/
        mysqli_free_result($fotosVisitados);
    } else {
?>
		<div class="alert alert-warning"><?= cambiarAcentos(_VISITADOSSINFOTOS) ?></div>
<?php        
    }
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

<?php 
    if ($idRutaDia != 0){
?>
    <div class="alert alert-info text-center">
    	<a href="#" class="alert-link" onclick="llamada_prototype('paginas/ruta_dia.php?idRutaDia=<?= $idRutaDia ?>','principal');"><?= cambiarAcentos(_VISITADOSVOLVER) ?></a>
    </div>
<?php 
    }
?>