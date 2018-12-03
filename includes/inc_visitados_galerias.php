<?php
$query="select * ";
$query.=" from fotos f  ";
$query.=" where f.IdMunicipio = ".$idMunicipio;
$query.=" order by f.Orden asc ";
$query.=" LIMIT ".$inicio.", ".$registros;
$fotos=mysqli_query ($link, $query);
$fotos2=mysqli_query ($link, $query);

?>
	
	<div class="row">
		<div class="col-3" id="blancoizquierdo<?= $inicio ?>">
			<p class="text-right"><a href="#" onclick="antes('#carouselVisitados<?= $inicio ?>')"><?= _ANTERIOR ?></a></p>
		</div>
		
		<div class="col-6" id="fotos<?= $inicio ?>">
	
        	<div id="carouselVisitados<?= $inicio ?>" class="carousel slide">
                <ol class="carousel-indicators">
<?php
                    $cont = 0;
                    while($foto=mysqli_fetch_array($fotos, MYSQLI_BOTH))
                    {
                        if ($cont == 0){
?>
               				<li data-target="#carouselVisitados<?= $inicio ?>" data-slide-to="0" class="active"></li>
<?php
                        } else {
?>
							<li data-target="#carouselVisitados<?= $inicio ?>" data-slide-to="<?= $cont ?>"></li>
<?php
                        }
                        $cont++;
                    }
?>
            	</ol>
            
            	<div class="carousel-inner">
<?php
                    $cont = 0;
                    while($foto=mysqli_fetch_array($fotos2, MYSQLI_BOTH))
                    {
                        if ($cont == 0){
?>
            				<div class="carousel-item active">
            					<img class="first-slide d-block w-100" src="<?= $foto["Foto"] ?>" alt="<?= $foto["Orden"] ?>" title="<?= $foto["Orden"] ?>">
            				</div>
<?php
                        } else {
?>
            				<div class="carousel-item">
            					<img class="d-block w-100" src="<?= $foto["Foto"] ?>" alt="<?= $foto["Orden"] ?>" title="<?= $foto["Orden"] ?>">
            				</div>
<?php
                        }
                        $cont++;
                    }
                    mysqli_free_result($fotos);
                    mysqli_free_result($fotos2);
?>
				</div>
			</div> <!-- id="carouselVisitados" -->
		</div> <!-- id="fotos" -->
		<div class="col-3" id="blancoderecho<?= $inicio ?>">
			<a href="#" onclick="despues('#carouselVisitados<?= $inicio ?>')"><?= _POSTERIOR ?></a>
		</div>
	</div> <!-- row -->
<script>

	$('#carouselVisitados<?= $inicio ?>').carousel({
		interval: 2000
	});
</script>