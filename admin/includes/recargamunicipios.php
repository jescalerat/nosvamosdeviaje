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
	<table class="table">
		<thead>
    		<tr>
				<th scope="col"><h1 class="text-center"><?= cambiarAcentos(strtoupper("Visitados")) ?></h1></th>
				<th scope="col"><h1 class="text-center"><?= cambiarAcentos(strtoupper("No visitados")) ?></h1></th>
			</tr>
		</thead>
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

?>
		<thead class="thead-dark">
    		<tr>
				<th scope="col" colspan="2"><p class="text-center"><?= $tituloComunidad ?></p></th>
			</tr>
		</thead>
		<thead class="thead-light">
    		<tr>
				<th scope="col" colspan="2"><p class="text-center"><?= $tituloProvincia ?></p></th>
			</tr>
		</thead>
		
		<tr>
			<td style="vertical-align:top"><?php include("visitados.php"); ?></td>
			<td style="vertical-align:top"><?php include("novisitados.php"); ?></td>
		</tr>
<?php			
		} //while($provincia=mysqli_fetch_array($provincias, MYSQLI_BOTH))
		mysqli_free_result($provincias);
	} //if ($idComunidad != 0)
?>
	</table>
