<?php
	//1 - Visitas
	//2 - Rutas
	//3 - Comentarios
	//4 - Fotos
	//5 - Rutas Municipios
	//6 - Rutas Comentarios
	$idPagina = 0;
	$opcion = 0;

	if (isset($_POST['idPagina'])){
		$idPagina = $_POST['idPagina'];
	} else if (isset($_GET['idPagina'])){
		$idPagina = $_GET['idPagina'];
	}

	if (isset($_POST['opcion'])){
		$opcion = $_POST['opcion'];
	} else if (isset($_GET['opcion'])){
		$opcion = $_GET['opcion'];
	}
	
	$volver = "";

	if ($idPagina == 1){
		$fecha = isset($_POST['fecha'])?$_POST['fecha']:"";
		if ($fecha != ""){
			$fechaArray = explode('/', $fecha);
			$dia = $fechaArray[0];
			$mes = $fechaArray[1];
			$anyo = $fechaArray[2];
			$fechaBBDD = $anyo."-".$mes."-".$dia;
		}
		$titulo = isset($_POST['titulo'])?$_POST['titulo']:"";
		$facebook = isset($_POST['facebook'])?$_POST['facebook']:"";
		$idMunVisitado = isset($_POST['idMunVisitado'])?$_POST['idMunVisitado']:"";
		
		$idRuta = 0;
		if (isset($_POST['idVisitado'])){
			$idVisitado = $_POST['idVisitado'];
		} else if (isset($_GET['idVisitado'])){
			$idVisitado = $_GET['idVisitado'];
		}

		if ($opcion == "N"){
			$query="insert into visitados (IdMunicipio, Fecha, Titulo, Facebook) values (".$idMunVisitado.", '".$fechaBBDD."', '".$titulo."', '".$facebook."')";
			mysqli_query ($link, $query);
			print("Insert: ".$query);
		} else if ($opcion == "U"){
			$query="update visitados set Fecha='".$fechaBBDD."', Titulo='".$titulo."', Facebook='".$facebook."' where IdVisitado=".$idVisitado;
			mysqli_query ($link, $query);
			print("Update: ".$query);
		} else if ($opcion == "D"){
			$query="delete from visitados where IdVisitado=".$idVisitado;
			mysqli_query ($link, $query);
			print("Delete: ".$query);
		}

		$volver = "visitas.php";
	} else if ($idPagina == 2){
		$fechaES = str_replace("'", "''", isset($_POST['fechaES'])?$_POST['fechaES']:"");
		$fechaCA = str_replace("'", "''", isset($_POST['fechaCA'])?$_POST['fechaCA']:"");
		$fechaEN = str_replace("'", "''", isset($_POST['fechaEN'])?$_POST['fechaEN']:"");
		$idRuta = 0;
		if (isset($_POST['idRuta'])){
			$idRuta = $_POST['idRuta'];
		} else if (isset($_GET['idRuta'])){
			$idRuta = $_GET['idRuta'];
		}
		
		if ($opcion == "N"){
			$query="insert into rutas (FechaES, FechaCA, FechaEN) values ('".$fechaES."', '".$fechaCA."', '".$fechaEN."')";
			mysqli_query ($link, $query);
			print("Insert: ".$query);
		} else if ($opcion == "U"){
			$query="update rutas set FechaES='".$fechaES."', FechaCA='".$fechaCA."', FechaEN='".$fechaEN."' where IdRuta=".$idRuta;
			mysqli_query ($link, $query);
			print("Update: ".$query);
		} else if ($opcion == "D"){
			$query="delete from rutas where IdRuta=".$idRuta;
			mysqli_query ($link, $query);
			print("Delete: ".$query);
		}

		$volver = "rutas.php";
	} else if ($idPagina == 3){
		$comentarioES = str_replace("'", "''", isset($_POST['comentarioES'])?$_POST['comentarioES']:"");
		$comentarioCA = str_replace("'", "''", isset($_POST['comentarioCA'])?$_POST['comentarioCA']:"");
		$comentarioEN = str_replace("'", "''", isset($_POST['comentarioEN'])?$_POST['comentarioEN']:"");
		$idComentario = 0;
		if (isset($_POST['idComentario'])){
			$idComentario = $_POST['idComentario'];
		} else if (isset($_GET['idComentario'])){
			$idComentario = $_GET['idComentario'];
		}
		$idVisitado = 0;
		if (isset($_POST['idVisitado'])){
			$idVisitado = $_POST['idVisitado'];
		} 
		
		if ($opcion == "N"){
			$query="insert into comentarios (IdVisitado, ComentarioES, ComentarioCA, ComentarioEN) values (".$idVisitado.", '".$comentarioES."', '".$comentarioCA."', '".$comentarioEN."')";
			mysqli_query ($link, $query);
			print("Insert: ".$query);
		} else if ($opcion == "U"){
			$query="update comentarios set ComentarioES='".$comentarioES."', ComentarioCA='".$comentarioCA."', ComentarioEN='".$comentarioEN."' where IdComentario=".$idComentario;
			mysqli_query ($link, $query);
			print("Update: ".$query);
		} else if ($opcion == "D"){
			$query="delete from comentarios where IdComentario=".$idComentario;
			mysqli_query ($link, $query);
			print("Delete: ".$query);
		}

		$volver = "comentarios.php";
	} else if ($idPagina == 4){
		$fotos = isset($_POST['fotos'])?$_POST['fotos']:"";
		$idFoto = 0;
		if (isset($_POST['idFoto'])){
			$idFoto = $_POST['idFoto'];
		} else if (isset($_GET['idFoto'])){
			$idFoto = $_GET['idFoto'];
		}
		$idMunicipio = 0;
		if (isset($_POST['idMunicipio'])){
			$idMunicipio = $_POST['idMunicipio'];
		} else if (isset($_GET['idMunicipio'])){
			$idMunicipio = $_GET['idMunicipio'];
		}
		
		if ($opcion == "N"){
			$query="select max(Orden) as Orden  ";
			$query.="from fotos f  ";
			$query.="where f.IdMunicipio=".$idMunicipio;
		
			$fotosBBDD=mysqli_query ($link, $query);
			$roworden=mysqli_fetch_array($fotosBBDD);
			$orden = $roworden["Orden"] + 1;

			$fotosArray = explode(';', $fotos);
			print("Insert: ");
			foreach ($fotosArray as $nuevaFoto) {
				if ($nuevaFoto != ""){
					$query="insert into fotos (IdMunicipio, Foto, Orden) values (".$idMunicipio.", '".trim($nuevaFoto)."', ".$orden.")";
					mysqli_query ($link, $query);
					print("<br>".$query.";");
					$orden++;
				}
			}
			mysqli_free_result($fotosBBDD);
		} else if ($opcion == "U"){
			$query="update comentarios set ComentarioES='".$comentarioES."', ComentarioCA='".$comentarioCA."', ComentarioEN='".$comentarioEN."' where IdComentario=".$idComentario;
			mysqli_query ($link, $query);
			print("Update: ".$query);
		} else if ($opcion == "D"){
			$query="delete from fotos where IdMunicipio=".$idMunicipio;
			mysqli_query ($link, $query);
			print("Delete: ".$query);
		}

		$volver = "fotos.php";
	} else if ($idPagina == 5){
		$idRuta = 0;
		if (isset($_POST['idRuta'])){
			$idRuta = $_POST['idRuta'];
		} else if (isset($_GET['idRuta'])){
			$idRuta = $_GET['idRuta'];
		}
		$idVisitado = 0;
		if (isset($_POST['idVisitado'])){
			$idVisitado = $_POST['idVisitado'];
		} else if (isset($_GET['idVisitado'])){
			$idVisitado = $_GET['idVisitado'];
		}
		
		if ($opcion == "N"){
			$query="insert into rutas_municipios (IdRuta, IdVisitado) values (".$idRuta.", ".$idVisitado.")";
			mysqli_query ($link, $query);
			print("<br>".$query.";");
		} else if ($opcion == "D"){
			$query="delete from rutas_municipios where IdRuta=".$idRuta." and IdVisitado=".$idVisitado;
			mysqli_query ($link, $query);
			print("Delete: ".$query);
		}

		$volver = "rutas_municipios.php?idRuta=".$idRuta;
	}  else if ($idPagina == 6){
		$idRutaComentario = 0;
		if (isset($_POST['idRutaComentario'])){
			$idRutaComentario = $_POST['idRutaComentario'];
		} else if (isset($_GET['idRutaComentario'])){
			$idRutaComentario = $_GET['idRutaComentario'];
		}
		$idRuta = 0;
		if (isset($_POST['idRuta'])){
			$idRuta = $_POST['idRuta'];
		} else if (isset($_GET['idRuta'])){
			$idRuta = $_GET['idRuta'];
		}
		$fecha = "";
		if (isset($_POST['fecha'])){
			$fecha = $_POST['fecha'];
		} else if (isset($_GET['fecha'])){
			$fecha = $_GET['fecha'];
		}
		if ($fecha != ""){
			$fechaArray = explode('/', $fecha);
			$dia = $fechaArray[0];
			$mes = $fechaArray[1];
			$anyo = $fechaArray[2];
			$fechaBBDD = $anyo."-".$mes."-".$dia;
		}
		$comentarioES = str_replace("'", "''", isset($_POST['comentarioES'])?$_POST['comentarioES']:"");
		$comentarioCA = str_replace("'", "''", isset($_POST['comentarioCA'])?$_POST['comentarioCA']:"");
		$comentarioEN = str_replace("'", "''", isset($_POST['comentarioEN'])?$_POST['comentarioEN']:"");
		
		
		if ($opcion == "N"){
			$query="select max(IdRutaComentario) as IdRutaComentario  ";
			$query.="from rutas_comentarios  ";
		
			$rutasComentariosBBDD=mysqli_query ($link, $query);
			$rowmaxid=mysqli_fetch_array($rutasComentariosBBDD);
			$idRutaComentario = $rowmaxid["IdRutaComentario"] + 1;

			$query="insert into rutas_comentarios (IdRutaComentario, IdRuta, Fecha, ComentarioES, ComentarioCA, ComentarioEN) values (".$idRutaComentario.", ".$idRuta.", '".$fechaBBDD."', '".$comentarioES."', '".$comentarioCA."', '".$comentarioEN."')";
			mysqli_query ($link, $query);
			print("<br>".$query.";");
			mysqli_free_result($rutasComentariosBBDD);
		} else if ($opcion == "U"){
			$query="update rutas_comentarios set Fecha='".$fechaBBDD."', ComentarioES='".$comentarioES."', ComentarioCA='".$comentarioCA."', ComentarioEN='".$comentarioEN."' where IdRutaComentario=".$idRutaComentario;
			mysqli_query ($link, $query);
			print("Update: ".$query);
		} else if ($opcion == "D"){
			$query="delete from rutas_comentarios where IdRutaComentario=".$idRutaComentario;
			mysqli_query ($link, $query);
			print("Delete: ".$query);
		}

		$volver = "rutas_comentarios.php?idRuta=".$idRuta;
	}


?>
<p/>
<a href="<?= $volver ?>">Volver</a>