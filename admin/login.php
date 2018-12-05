<?
	session_start();
?>
<body onload="login.usuario.focus();">
<?
  $ruta = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));
  $ruta2 = substr($ruta, 0, strrpos($ruta, '/'));
	$_SESSION["ruta"] = $ruta2.="/";

	print ("<form name=login method=post action=comprobar.php>");
		print ("<p>&nbsp;</p>");
		print ("<p>&nbsp;</p>");
		print ("<h1><center>ADMINISTRACIÓN USUARIOS</center></h1>");
		print ("<table border=0 class=index width=20% align=center>");
			print ("<tr>");
				print ("<td width=11% valign=top align=center>");
					print ("<img src=\"imagenes/hospitalense.gif\"/>");
			print ("<tr>");
				print ("<td width=11% valign=top align=center>");
					print ("<fieldset>"); //Etiqueta para mostrar un recuadro dentro del cual están los input box del Usuario y la Contraseña
						print ("Usuario:");
						print ("<br>");
						print ("<input type=text name=usuario size=15 maxlength=10>");
						print ("<br>");
						print ("Contrase&ntilde;a:");
						print ("<br>");
						print ("<input type=password name=password size=15 maxlength=15>");
				print ("</fieldset>");
				print ("<center><button type=submit name=boton_index>Entrar</button>");
				print ("<input type=hidden name=abrirpagina value=".$_GET["abrirpagina"].">");
				print ("</form>"); //Final del formulario de introducir Usuario y password
		print ("</table>");
?>