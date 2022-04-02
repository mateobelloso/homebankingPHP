 
	<html>
<head>
	<title>Bienvenido MVC </title>
</head>
<body>
	<h1>¡Bienvenido!</h1>
	<form action="Controllers/login_controller" method="post">
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

<?php
	// la variable controller guarda el nombre del controlador y action guarda la acción por ejemplo registrar 
	//si la variable controller y action son pasadas por la url desde layout.php entran en el if
	// if (isset($_GET['controller'])&&isset($_GET['action'])) {
	// 	$controller=$_GET['controller'];
	// 	$action=$_GET['action'];
	// } else {
	// 	$controller='usuario';
	// 	$action='index';
	// }	
	// //carga la vista layout.php
	// require_once('Views/routes.php');
?>