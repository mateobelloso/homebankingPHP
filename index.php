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
			<input type="text" name="usuario" minlength="6" required><br>
			<label for="contraseña">Contraseña</label>
			<input type="password" id="contrasena" name="contraseña" required pattern= "(?=.*[0-9#$%@])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos una letra mayuscula,una letra minuscula y un numero o un caracter especial."><br>
			<label for="mostrar-contraseña">Mostrar contraseña</label>
			<input id="checkbox" type="checkbox" onclick="mostrarContrasena()" name="mostrar-contraseña">
			<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("checkbox");
      var aux = document.getElementById("contrasena")
      if(tipo.checked == true){
          aux.type = "text";
      }else{
          aux.type = "password";
      }
  }
</script>
			<input type="submit" value="Iniciar sesion">
		</fieldset>
	</form>
	<?//php $controller= 'cliente';
	//$action= 'index'; 
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