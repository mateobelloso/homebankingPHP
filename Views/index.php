<html>
<head>
	<title>Bienvenido MVC </title>
</head>
<body>
	<h1>¡Bienvenido!</h1>
	<form action="Controllers/usuario_controller" method="post">
		<input type="hidden" name="action" value="sesion">
		<fieldset>
			<legend><h2>Inicie sesion</h2></legend>
			<label for="usuario">Usuario</label>
			<input type="text" name="usuario"><br>
			<label for="contraseña">Contraseña</label>
			<input type="password" name="contraseña"><br>
			<input type="submit" value="Iniciar sesion">
		</fieldset>
	</form>
	
</body>
</html>