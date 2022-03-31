<html>
<head>
	<title>Bienvenido MVC </title>
</head>
<body>
	<table>
		<tr>			
			<td>Ingresar Usuarios</td>
			<td>Ver Usuarios</td>
			<?php foreach ($usuarios as $usuario) { ?>
			<td><?php echo $usuario->nombre; ?></td>
		<?php } ?>
		</tr>
	</table>
	
</body>
</html>