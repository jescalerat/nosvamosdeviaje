﻿<?php
	if (file_exists("../conf/traduccion.php")){
		require_once("../conf/traduccion.php");
		require_once("../conf/conexion.php");
		require_once("../conf/funciones.php");
		$link=Conectarse();
	}
?>
	<table>
		<tr>
			<th><h1><?php print(cambiarAcentos(strtoupper("Visitados")));?></h1></td>
		</tr>
<?php	
	
	$idPais = 0;
	if(isset($_POST['idPais'])){
		$idPais = $_POST['idPais'];
	}
	$idComunidad = 0;
	if(isset($_POST['idComunidad'])){
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
	
	$query="select c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado  ";
	$query.="from municipios m  ";
	$query.="left join provincias p on m.IdProvincia=p.IdProvincia ";
	$query.="left join comunidades c on p.IdComunidad=c.IdComunidad ";
	$query.="left join paises pa on c.IdPais=pa.IdPais ";
	$query.="left join visitados v on v.IdMunicipio=m.IdMunicipio ";
	$query.="where v.IdVisitado is not null ";
	if ($idPais != 0){
		$query.="and pa.idPais = ".$idPais." ";
	}
	if ($idComunidad != 0){
		$query.="and c.IdComunidad = ".$idComunidad." ";
	}
	if ($idProvincia != 0){
		$query.="and p.IdProvincia = ".$idProvincia." ";
	}
	if ($idMunicipio != 0){
		$query.="and m.IdMunicipio = ".$idMunicipio." ";
	}
	$query.="order by c.IdComunidad asc, p.IdProvincia asc, m.Municipio asc";

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
		$tituloMunicipio=$provincia["Municipio"];

		if ($idComunidadPost != $idComunidad){
			$mostrarTituloComunidad = 1;
		}

		if ($idProvinciaPost != $idProvincia){
			$mostrarTituloProvincia = 1;
		}

		if ($mostrarTituloComunidad == 1){
			$mostrarTituloComunidad = 0;
			$idComunidadPost = $idComunidad;
?>
		<tr>
			<td colspan="2"><center><?= $tituloComunidad ?></center></td>	
		</tr>
<?php 
		} //if ($mostrarTituloComunidad == 1){

		if ($mostrarTituloProvincia == 1){
			$mostrarTituloProvincia = 0;
			$idProvinciaPost = $idProvincia;
?>
		<tr>
			<td colspan="2"><center><?= $tituloProvincia ?></center></td>	
		</tr>
<?php 
		}  //if ($mostrarTituloProvincia == 1){
?>	
		<tr>
			<td valign="top"><?= $tituloMunicipio ?></td>
			<td valign="top"><?= $provincia["Fecha"] ?></td>
		</tr>
<?php			
	}
	mysqli_free_result($provincias);
?>
	</table>