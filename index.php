<html>
<head>
	<title>Bienvenido MVC </title>
</head>
<body>
	<h1>¡Bienvenido!</h1>
	<form action="Controllers/login_controller.php" method="post">
		<input type="hidden" name="action" value="sesion">
		<fieldset>
			<legend><h2>Inicie sesion</h2></legend>
			<label for="usuario">Usuario</label>
			<input type="text" name="usuario" minlength="6"><br>
			<label for="contraseña">Contraseña</label>
			<input type="password" id="contrasena" name="contraseña" required minlength="6" pattern="[A-Z]{1}[a-z]{1}[0-9]|[@#$%]{1}"><br>
			<label for="mostrar-contraseña">Mostrar contraseña</label>
			<input type="checkbox" onclick="mostrarContrasena()" name="mostrar-contraseña">
			<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>
			<input type="submit" value="Iniciar sesion">
		</fieldset>
	</form>
	<?//php $controller= 'login'; 
	//require_once('routes.php');
	?>
	
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