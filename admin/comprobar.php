<?
	session_start();
	//Conexión a base de datos
	require_once($_SESSION["ruta"]."conf/conexion.php");
	$link=Conectarse();

	//En principio suponemos que el usuario no esta registrado
	$registrado=0;

	//Cogemos los datos que nos envian del indice y comprobamos si el usuario esta registrado
	if (!empty($_POST['usuario'])&&!empty($_POST['password']))
	{
		$usuario=$_POST['usuario'];
		$password=$_POST['password'];
		
		$query="select * from usuarios where Usuario=\"".$usuario."\" and  Password=\"".$password."\"";
		$q=mysql_query($query,$link);
		$registrado=mysql_num_rows($q);
		
		$_SESSION["registrado"]=$registrado;
		$_SESSION["usuario"]=$usuario;
		if ($registrado != 0)
		{
			$_SESSION["tipo_usuario"]=mysql_result($q,0,"Tipo");
			$_SESSION["nombre"]=mysql_result($q,0,"Nombre");
		}
	}
	else
	{
		session_destroy();
		header("Location:login.php");	
	}

	//Si no esta registrado se volverá a la página index y aparecerá el error.
	//En caso de que este registrado iremos a la página principal.
	
	if ($registrado != 0)
	{
		header("Location:index.php");
	}
	else
	{
		session_destroy();
		header("Location:login.php");	
	}
?>
