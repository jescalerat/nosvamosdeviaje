<style type="text/css">
  .thumb{
            margin-bottom: 30px;
        }
        
        .page-top{
            margin-top:85px;
        }

   
img.zoom {
    width: 100%;
    height: 200px;
    border-radius:5px;
    object-fit:cover;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
}
        
 
.transition {
    -webkit-transform: scale(1.2); 
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
    .modal-header {
   
     border-bottom: none;
}
    .modal-title {
        color:#000;
    }
    .modal-footer{
      display:none;  
    }
</style>
<?php

    //---------------------------------------------------------------------------------------------------------------
    //Paginación
    $registros = 12;
    
    if (!isset($_GET['paginacion'])) {
        $inicio = 0;
        $pagina = 1;
    }
    else {
        $pagina=$_GET['paginacion'];
        $inicio = ($pagina - 1) * $registros;
    }
    //Fin paginación
    //---------------------------------------------------------------------------------------------------------------

    if (isset($_GET['idMunicipioPag'])){
        $idMunicipio = $_GET['idMunicipioPag'];
        require_once("../conf/funciones.php");
        idiomaPagina();
        require_once("../conf/traduccion.php");
        require_once("../conf/conexion.php");
        $link=Conectarse();
    }
    
    $query="select * ";
    $query.=" from fotos f  ";
    $query.=" where f.IdMunicipio = ".$idMunicipio;
    $query.=" order by f.Orden asc ";
    //$query.=" LIMIT ".$inicio.", ".$registros;
    $queryPaginacion = $query." LIMIT ".$inicio.", ".$registros;
    $fotos=mysqli_query ($link, $query);
    
    $totalfotos=mysqli_num_rows($fotos);
    mysqli_free_result($fotos);
    
    //Querys paginacion
    $resultados = mysqli_query($link, $queryPaginacion);
    $total_paginas = ceil($totalfotos / $registros);
    
?>
	
	<div class="row">
<?php 
        while($foto=mysqli_fetch_array($resultados, MYSQLI_BOTH))
        {
?>
			<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="<?= $foto["Foto"] ?>" class="fancybox" rel="ligthbox">
                    <img  src="<?= $foto["Foto"] ?>" class="zoom img-fluid"  alt="<?= $foto["Orden"] ?>" title="<?= $foto["Orden"] ?>" >
                   
                </a>
            </div>
<?php 
        }
?>
	</div>
	
<?php 
        mysqli_free_result($resultados);
?>

    		<p>
    
    		<nav aria-label="Page navigation example">
				<ul class="pagination pagination-sm justify-content-center">
<?php
    			if(($pagina - 1) > 0)
    			{
?>				
    				<li class="page-item">
    					<a class="page-link" href="javascript:llamada_prototype('includes/inc_visitados_galerias.php?paginacion=<?= ($pagina-1) ?>&idMunicipioPag=<?= $idMunicipio ?>','galerias');"><?= cambiarAcentos(_ANTERIOR) ?></a>
    				</li>
<?php				
                }
				
                for ($i=1; $i<=$total_paginas; $i++){ 
				    if ($pagina == $i)
			     	{
?>					
						<li class="page-item active"><a class="page-link" href="#"><?= $pagina ?></a></li>
<?php					
				    }
				    else
				    {
?>					
    					<li class="page-item">
    						<a class="page-link" href="javascript:llamada_prototype('includes/inc_visitados_galerias.php?paginacion=<?= ($i) ?>&idMunicipioPag=<?= $idMunicipio ?>','galerias');"> <?= ($i) ?> </a>
    					</li>
<?php
    				}
	       		}
			  
                if(($pagina + 1)<=$total_paginas)
                {
?>				
    				<li class="page-item">
    					<a class="page-link" href="javascript:llamada_prototype('includes/inc_visitados_galerias.php?paginacion=<?= ($pagina+1) ?>&idMunicipioPag=<?= $idMunicipio ?>','galerias');"><?= cambiarAcentos(_SIGUIENTE) ?></a>
    				</li>
<?php				
				}
?>			
				</ul>
			</nav>


<script>
	$(document).ready(function(){
	  $(".fancybox").fancybox({
	        openEffect: "none",
	        closeEffect: "none"
	    });
	    
	    $(".zoom").hover(function(){
			
			$(this).addClass('transition');
		}, function(){
	        
			$(this).removeClass('transition');
		});
	});
</script>