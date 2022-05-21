<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?>
<link rel="stylesheet" type="text/css" href="/hb/Styles/login.css">
<script type="text/javascript" src="/hb/Javascript/login.js"></script>

<form action="/hb/Controllers/login_controller.php" method="post" onsubmit="return chequeo()" >
	<input type="hidden" name="action" value="sesion">
	<fieldset>
		<legend><h2>Iniciar sesión</h2></legend>
		<ul>
			<li><label for="usuario">Usuario</label>
			<input id="usuario" type="text" name="usuario">
			</li>
			<li><label for="contraseña">Contraseña</label>
			<input type="password" id="contrasena" name="contraseña">
			</li>
			<li id="mostrar-contraseña"><input id="checkbox" type="checkbox" onclick="mostrarContrasena()" name="mostrar-contraseña">

			<label id="label-mostrar-contraseña" for="mostrar-contraseña">Mostrar contraseña</label>
			</li>
			<li><button class="button" type="submit">Iniciar sesion </button> </li>
		</ul>
	</fieldset>
</form>
<div id="error" style="display: none;">
	<h2>Error al iniciar sesion:</h2>
	<span>- Nombre de usuario o contraseña incorrecta </span>
</div>
<div class='error' id="error-campos-vacios" style="display: none;"><p>Los campos no pueden ser vacios</p></div>

<?php 
	
	//Si tengo un parametro de error de inicio en SESSION significa que ya quisieron ingresar y fallo. Muestro el mensaje de error
	if(isset($_SESSION['error-inicio']))
	{
		echo $_SESSION['error-inicio'];
		unset($_SESSION['error-inicio']);
	}
?>