<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
<link rel="stylesheet" type="text/css" href="/hb/Styles/cambioClave.css">
<script type="text/javascript" src="/hb/Javascript/cambioClave.js"></script>
<!--Chequeo para evitar accesos indebidos de un admin a las funcionalidades del cliente-->
<?php
	if($_SESSION['usuario']['tipo']!='comun')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>

<!--Estilo para los botones -->
<link rel="stylesheet" type="text/css" href="/hb/Styles/form.css">
	<!--Formulario en HTML para el cambio de contraseña  -->
	<h1>Cambie su contraseña</h1>

	<form name="formulario" action="/hb/Controllers/cliente_controller.php" method="post" onsubmit="return chequeo()"> 
		<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
		<input type="hidden" name="action" value="cambio-password">
		<ul>
			<li><label for="contrasena-actual">Contraseña Actual:</label><input type="password" id="contrasena-actual" name="contrasena-actual"></li>
			<li><label for="contrasena-nueva">Contraseña Nueva:</label><input type="password" id="contrasena-nueva" name="contrasena-nueva"></li>
			<li><label for="contrasena-nueva2">Repita la contraseña nueva:</label><input type="password" id="contrasena-nueva2" name="contrasena-nueva2"></li>
			
			<li id="error-contrasena-distintas" style="display: none;"><div class="error-contraseñas"><p>Las contraseñas no son iguales o no cumplen con el formato de contener por lo menos 1 letra mayuscula, 1 letra minuscula y 1 numero o caracter especial</p></div></li>

			<li id="error-contraseña-incorrecta" style="display: none;"><div class="error-contraseñas"><h3>La contraseña actual es incorrecta</h3></div></li>

			<?php if(isset($_SESSION['error-cambio-clave'])){ ?>
				<li><div class="error-contraseñas">
				<?php echo $_SESSION['error-cambio-clave'];
							unset($_SESSION['error-cambio-clave']); ?>
				</div></li>		
			<?php } ?>

			<li><button type="submit" class="submit">Cambiar contraseña </button></li>
		</ul>
	</form>