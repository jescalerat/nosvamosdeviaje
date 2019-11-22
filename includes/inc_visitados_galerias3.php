<?php
    $query="select * ";
    $query.=" from fotos f  ";
    $query.=" where f.IdMunicipio = ".$idMunicipio;
    $query.=" order by f.Orden asc ";
    $query.=" LIMIT ".$inicio.", ".$registros;
    $fotos=mysqli_query ($link, $query);
?>
	
	<div class="row">
		<div class="col-md-12">

			<div id="mdb-lightbox-ui"></div>

				<div class="mdb-lightbox">
<?php 
                    while($foto=mysqli_fetch_array($fotos, MYSQLI_BOTH))
                    {
?>
    					<figure class="col-md-4">
    						<a href="<?= $foto["Foto"] ?>" data-size="1600x1067">
    							<img src="<?= $foto["Foto"] ?>" alt="picture" title="<?= $foto["Orden"] ?>" class="img-fluid">
    						</a>
    					</figure>
<?php 
                    }
?>
				</div>
		</div>
	</div>
	
<?php 
    mysqli_free_result($fotos);
?>

<script>
    //MDB Lightbox Init
    $(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    });
</script>