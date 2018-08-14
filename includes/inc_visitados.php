<?php
	$idVisitado = $_GET['idVisitado'];
	$idMunicipio = $_GET['idMunicipio'];

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

	$query="select * ";
	$query.=" from fotos f  ";
	$query.=" where f.IdMunicipio = ".$idMunicipio;
	$query.=" order by f.Orden asc ";
	$fotos=mysqli_query ($link, $query);
	
?>
<form class="col s12">
	<div class="row">
		<div class="col s12" id="comentario">
			<?= cambiarAcentos(mb_strtoupper($comentarioText)) ?>
		</div>
	</div>
	<div class="row">
		<div class="col s3" id="espacio1">
		</div>
		<div class="input-field col s6" id="fotos">
			<div class="slider">
				<ul class="slides">
<?php
					while($foto=mysqli_fetch_array($fotos, MYSQLI_BOTH))
					{
?>
						<li>
							<img src="<?= $foto["Foto"] ?>" width="250px" height="580px">
						</li>
					  
<?php
					} //while($foto=mysqli_fetch_array($fotos, MYSQLI_BOTH))
?>
				</ul>
			</div>
		</div>
		<div class="col s3" id="espacio2">
		</div>
	</div>
</form>