<?php 
    session_start();
    unset($_SESSION["pagina"]);
    $_SESSION["pagina"]=5;

    require_once("../includes/conexiones.php");
	require_once("../includes/inc_visitados.php");
	
	if (!isset($_SESSION["admin_web"]))
	{
	    $idVisitado = $_GET['idVisitado'];
	    $query="select *  ";
	    $query.="from visitados v  ";
	    $query.="where v.IdVisitado = ".$idVisitado;
	    
	    $visitado=mysqli_query ($link, $query);
	    $rowvisitado=mysqli_fetch_array($visitado);
	    
	    $idMunicipio = $rowvisitado["IdMunicipio"];
	    mysqli_free_result($visitado);
	    
	    $observaciones = obtenerMunicipio($link, $idMunicipio, false);
	    
	    //Query para insertar los valores en la base de datos
	    $query="insert into paginasvistas (IP,Hora,Fecha,Pagina,Observaciones) values (\"".getRealIP()."\",\"".date("H:i:s")."\",\"".date("Y-m-d")."\",".$_SESSION["pagina"].",\"".$observaciones."\")";
	    mysqli_query($link, $query);
	}
?>
