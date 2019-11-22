<?php 
    //Query
    $query="select * from contador";
    
    $qcontador=mysqli_query ($link, $query);
    $rowcontador=mysqli_fetch_array($qcontador, MYSQLI_BOTH);
    
    $contador = $rowcontador["Contador"];
    mysqli_free_result($qcontador);

?>

<body>
	<table>
		<tr>
			<td valign="top">
				<h2 class="text-center"><!--<? //$_SESSION['nombre'] ?>--></h2>
				<table>
					<tr>
						<th>
							Administracion
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="bbdd.php">BBDD</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="visitas.php">Visitas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="rutas.php">Rutas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="comentarios.php">Comentarios</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="fotos.php">Fotos</a>
						</td>
					</tr>
					
					<tr>
						<th>
							Consultas
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="comprobar_visitas.php">Comprobar visitas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="comprobar_paginas_vistas.php">Comprobar p&aacute;ginas vistas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="comprobar_correo.php">Comprobar correo</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="info.php">PHP Info</a>
						</td>
					</tr>
					
					<tr>
						<th>
							Privado
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="cambio_pass.php">Cambio contrase&ntilde;a</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a class="admin" href="salir.php">Salir</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	Contador: <?= $contador ?>
</body>
</html>