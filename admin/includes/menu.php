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
							Privado
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a class="admin" href="#" onclick="llamada_prototype('cambio_pass.php','principal');">Cambio contrase&ntilde;a</a>
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
</body>
</html>