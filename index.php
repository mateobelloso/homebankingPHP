<style>
	.error {
		color: red;
		background-color: #F1948A;
		padding: 0;
		margin-left: 25vw;
		text-align: left;
		width: 50vw;
	}

	form {
		margin: 0;
		width: 50vw;
		padding: 1em;
		border: 5px solid blue;
		border-radius: 1em;
		margin-left: 25vw;
	}

	button {
		border-radius: 50px;
		background-color: #2980B9;
		color: white;
		padding: 1em;
		margin-left: 20vw;
	}

	ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	form li + li {
		margin-top: 1em;
	}

	label {
		display: inline-block;
		width: 125px;
		text-align: left;
	}

	#mostrar-contraseña {
		margin-left: 20vw;
	}

</style>

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

<html>
<head>
	<!--link rel="stylesheet" href="Views/styles.css"-->
</head>
<body>
	<?php require_once("Views/header.php"); ?>
	<h1>¡Bienvenido!</h1>
	<form action="Controllers/login_controller.php" method="post">
		<input type="hidden" name="action" value="sesion">
		<fieldset>
			<legend><h2>Iniciar sesión</h2></legend>
			<ul>
				<li><label for="usuario">Usuario</label>
				<input type="text" name="usuario" minlength="6" required>
				</li>
				<li><label for="contraseña">Contraseña</label>
				<input type="password" id="contrasena" name="contraseña" required pattern= "(?=.*[0-9#$%@])(?=.*[a-z])(?=.*[A-Z]).{6,}" title="La contraseña debe contener al menos una letra mayuscula,una letra minuscula y un numero o un caracter especial.">
				</li>
				<li id="mostrar-contraseña"><input id="checkbox" type="checkbox" onclick="mostrarContrasena()" name="mostrar-contraseña">
				<label for="mostrar-contraseña">Mostrar contraseña</label>
				</li>
				<li><button class="button" type="submit">Iniciar sesion </button> </li>
			</ul>
		</fieldset>
	</form>
	<!--span class="error">Probando el error</span-->
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