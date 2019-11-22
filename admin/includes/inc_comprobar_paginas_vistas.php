<?php
	

	if (isset($_GET['ideliminar']))
	{
		$query="delete from paginas_vistas where IdPaginasVistas=".$_GET['ideliminar'];
		mysqli_query($link,$query);
	}

	$titulo = "";
	$parametros = "";
	if (isset($_GET['IP']))
	{
	    $query="select * from paginasvistas where IP=\"".$_GET['IP']."\" and Fecha=\"".$_GET['fecha']."\" order by Fecha desc, Hora, IP";
	    $titulo = "Fecha: ".$_GET['fecha']." IP: ".$_GET['IP'];
	    $parametros .= "&IP=".$_GET['IP']."&fecha=".$_GET['fecha'];
	}
	else if (isset($_GET['fecha']))
	{
	    $query="select * from paginasvistas where Fecha=\"".$_GET['fecha']."\" order by Fecha desc, Hora, IP";
	    $titulo = "Fecha: ".devolverFechaBBDD($_GET['fecha']);
	    $parametros .= "&fecha=".$_GET['fecha'];
	}
	else
	{
	    $query="select * from paginasvistas order by Fecha desc, Hora, IP limit 500";
	}
	
	//Query para comprobar las visitas que tengo
	$query_paginas_vistas=mysqli_query($link, $query);
?>

	<h1 class="text-center">Paginas vistas en Nos vamos de viaje</h1>
<?php 
    if ($titulo != ""){
?>
		<h3 class="text-center"><?= $titulo ?></h3>
<?php
    }
?>	
	
	<table class="table table-bordered">
   		<thead class="thead-dark">
	   		<tr class="d-flex">
				<th class="col-2 text-center">Eliminar</th>
	       		<th class="col-2 text-center">IP</th>
	       		<th class="col-2 text-center">Hora</th>
	       		<th class="col-2 text-center">Fecha</th>
	       		<th class="col-2 text-center">Pagina</th>
	       		<th class="col-2 text-center">Observaciones</th>
	       	</tr>
		</thead>
		
<?php 
        //Mostrar los valores de la base de datos
        while($paginas=mysqli_fetch_array($query_paginas_vistas, MYSQLI_BOTH))
        {
            $ip_usuario=$paginas["IP"];
            
            $pagina_vista="";
            $estilo = "";
            $jornada_equipo = "0";
            if ($paginas["Pagina"]==1)
            {
                $pagina_vista="Inicio";
            }
            else if ($paginas["Pagina"]==2)
            {
                $pagina_vista="Rutas";
            }
            else if ($paginas["Pagina"]==3)
            {
                $pagina_vista="Ruta";
            }
            else if ($paginas["Pagina"]==4)
            {
                $pagina_vista="Dia ruta";
            }
            else if ($paginas["Pagina"]==5)
            {
                $pagina_vista="Municipio visitado";
            }
            else if ($paginas["Pagina"]==6)
            {
                $pagina_vista="Municipios";
            }
            else if ($paginas["Pagina"]==7)
            {
                $pagina_vista="Contactar";
                $estilo = "bgcolor=\"red\"";
            }
            else if ($paginas["Pagina"]==72)
            {
                $pagina_vista="Contactar enviado";
                $estilo = "bgcolor=\"red\"";
            }
            
            $observaciones = "";
            if ($paginas["Pagina"]==3 || $paginas["Pagina"]==4 || $paginas["Pagina"]==5){
                $observaciones = $paginas["Observaciones"];
            }

?>
			<tr class="d-flex" <?php if ($estilo!="") {print($estilo);} ?>>
				<td class="col-2"><a href="comprobar_paginas_vistas.php?ideliminar=<?= $paginas["IdPaginasVistas"].$parametros ?>">Eliminar</a></td>
	       		<td class="col-2 text-center"><?= $ip_usuario ?></td>
	       		<td class="col-2 text-center"><?= $paginas["Hora"] ?></td>
	       		<td class="col-2 text-center"><?= devolverFechaBBDD($paginas["Fecha"]) ?></td>
	       		<td class="col-2 text-center"><?= $pagina_vista ?></td>
	       		<td class="col-2 text-center"><?= $observaciones ?></td>
	       	</tr>

<?php             
        }

        mysqli_free_result($query_paginas_vistas);
?>
	</table>