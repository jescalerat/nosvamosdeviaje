<?php
    session_start();
    unset($_SESSION["pagina"]);
    $_SESSION["pagina"]=4;

	require_once("../includes/conexiones.php");
	require_once("../includes/inc_ruta_dia.php");
	
	if (!isset($_SESSION["admin_web"]))
	{
	    $idRutaDia = $_GET['idRutaDia'];
	    $query="select * ";
	    $query.="from rutas_dias ";
	    $query.="where idRutaDia = ".$idRutaDia;
	    
	    $diaruta=mysqli_query ($link, $query);
	    $rowdiaruta=mysqli_fetch_array($diaruta);
	    
	    $observaciones = $rowdiaruta["Fecha"];
	    mysqli_free_result($diaruta);
	    
	    //Query para insertar los valores en la base de datos
	    $query="insert into paginasvistas (IP,Hora,Fecha,Pagina,Observaciones) values (\"".getRealIP()."\",\"".date("H:i:s")."\",\"".date("Y-m-d")."\",".$_SESSION["pagina"].",\"".$observaciones."\")";
	    mysqli_query($link, $query);
	}
	
?>
