<?php 
    session_start();
    unset($_SESSION["pagina"]);
    $_SESSION["pagina"]=3;

	require_once("../includes/conexiones.php");
	require_once("../includes/inc_ruta.php");
	
	if (!isset($_SESSION["admin_web"]))
	{
	    $idRuta = $_GET['idRuta'];
	    $query="select IdRuta, FechaES as Titulo ";
	    $query.="from rutas ";
	    $query.="where idRuta = ".$idRuta;
	    
	    $ruta=mysqli_query ($link, $query);
	    $rowruta=mysqli_fetch_array($ruta);
	    
	    $observaciones = $rowruta["Titulo"];
	    mysqli_free_result($ruta);
	    
	    //Query para insertar los valores en la base de datos
	    $query="insert into paginasvistas (IP,Hora,Fecha,Pagina,Observaciones) values (\"".getRealIP()."\",\"".date("H:i:s")."\",\"".date("Y-m-d")."\",".$_SESSION["pagina"].",\"".$observaciones."\")";
	    mysqli_query($link, $query);
	}
?>
