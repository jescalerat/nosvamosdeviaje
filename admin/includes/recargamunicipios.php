<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	unset($_SESSION["pagina"]);
	$_SESSION["pagina"]=0;
	if (file_exists("../../conf/traduccion.php")){
		require_once("../../conf/traduccion.php");
		require_once("../../conf/conexion.php");
		require_once("../../conf/funciones.php");
		$link=Conectarse();
	}
?>
	<table border="1" class="w100">
		<tr>
			<th class="w50" align="center"><h1><?php print(cambiarAcentos(strtoupper("Visitados")));?></h1></td>
			<th class="w50" align="center"><h1><?php print(cambiarAcentos(strtoupper("No visitados")));?></h1></td>
		</tr>
<?php	
	
	$idPais = 0;
	$idComunidad = 0;
	if(isset($_POST['idPais']) && ""!=$_POST['idPais']
	   && isset($_POST['idComunidad'])){
		$idPais = $_POST['idPais'];
		$idComunidad = $_POST['idComunidad'];
	}
	$idProvincia = 0;
	if(isset($_POST['idProvincia'])){
		$idProvincia = $_POST['idProvincia'];
	}
	$idMunicipio = 0;
	if(isset($_POST['idMunicipio'])){
		$idMunicipio = $_POST['idMunicipio'];
	}
	
	$query="select distinct c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join paises pa on c.IdPais=pa.IdPais ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="where 1=1 ";
	$query.="and pa.IdPais = ".$idPais." ";

	if ($idComunidad != 0){
		$query.="and c.IdComunidad = ".$idComunidad." ";
	}
	if ($idProvincia != 0){
		$query.="and p.IdProvincia = ".$idProvincia." ";
	}
	if ($idMunicipio != 0){
		$query.="and m.IdMunicipio = ".$idMunicipio." ";
	}
	$query.="order by pa.Pais asc, c.IdComunidad asc, p.IdProvincia asc, m.Municipio asc";

	if ($idComunidad != 0){
		$provincias=mysqli_query ($link, $query);

		$mostrarTituloComunidad = 1;
		$mostrarTituloProvincia = 1;
		$idComunidadPost = 0;
		$idProvinciaPost = 0;

			
		while($provincia=mysqli_fetch_array($provincias, MYSQLI_BOTH))
		{
			$tituloComunidad=strtoupper($provincia["Comunidad"]);
			$idComunidad=$provincia["IdComunidad"];
			$tituloProvincia=strtoupper($provincia["Provincia"]);
			$idProvincia=$provincia["IdProvincia"];
				
			//Cambiar ids por el nombre del equipo
			/*$equipo1=$principal["Equipo1"];
			$equipo2=$principal["Equipo2"];

			$query="select * from equipos where IdEquipo=".$equipo1;
			$q_equipo1=mysqli_query($link, $query);
			$rowequipo1=mysqli_fetch_array($q_equipo1);

			$query="select * from equipos where IdEquipo=".$equipo2;
			$q_equipo2=mysqli_query($link, $query);
			$rowequipo2=mysqli_fetch_array($q_equipo2);
			
			$equipos=cambiarAcentos($rowequipo1["NombreEquipo"])." ".$principal["SubCategoriaLocal"]." - ".cambiarAcentos($rowequipo2["NombreEquipo"])." ".$principal["SubCategoriaVisitante"];

			$resultados=$principal["ResultEquipo1"]."-".$principal["ResultEquipo2"];*/

?>
		<tr>
			<td colspan="2" class="w100"><center><?php print($tituloComunidad);?></center></td>	
		</tr>
		<tr>
			<td colspan="2" class="w100"><center><?php print($tituloProvincia);?></center></td>	
		</tr>
		<tr>
			<td class="w50" valign="top"><?php include("visitados.php"); ?></td>
			<td class="w50" valign="top"><?php include("novisitados.php"); ?></td>
		</tr>
<?php			
		} //while($provincia=mysqli_fetch_array($provincias, MYSQLI_BOTH))
		mysqli_free_result($provincias);
	} //if ($idComunidad != 0)
?>
	</table>
