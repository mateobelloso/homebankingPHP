<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
<link rel="stylesheet" type="text/css" href="/hb/Styles/form.css">
<script type="text/javascript" src="/hb/Javascript/chequeoAltaCuenta.js"></script>

<!--Chequeo para evitar accesos indebidos de un usuario a las funcionalidades del admin-->
<?php
	if($_SESSION['usuario']['tipo']!='empleado')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>

<h1>Agregar una cuenta:</h1>

<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" > 
	<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
	<input type="hidden" name="action" value="alta_cuenta">

	<input type="hidden" name="id" value="<?php echo $id ?>">
	<ul>
		<li><label for="nombre-cuenta">Nombre de la cuenta:</label><input type="text" id="nombre-cuenta" name="nombre-cuenta"></li>
		<li><label for="contrasena-nueva">Alias:</label><input type="text" id="alias" name="alias"></li>
		<li><button type="submit" class="submit">Crear cuenta </button></li>
		<!-- Errores del lado del cliente y del servidor para el alta de cuenta de un cliente -->
		<li id="error-nombre-cuenta" style="display: none;"><div class="error-mensajeError">El nombre de cuenta debe contener por lo menos 5 caracteres alfabeticos</div></li>
		<li id="error-alias" style="display: none;"><div class="error-mensajeError">El alias debe contener por lo menos 8 caracteres alfabeticos</div></li>
		<?php if(isset($_SESSION['error-nombre-cuenta'])) { ?>
			<li id="error-nombre-cuenta"><div class="error-mensajeError">El nombre de cuenta debe contener por lo menos 5 caracteres alfabeticos</div></li>
			<?php unset($_SESSION['error-nombre-cuenta']); ?>
		<?php } ?>
		<?php if(isset($_SESSION['error-alias'])) { ?>
			<li id="error-alias"><div class="error-mensajeError">El alias debe contener por lo menos 8 caracteres alfabeticos</div></li>
			<?php unset($_SESSION['error-alias']); ?>
		<?php } ?>
		<?php if(isset($_SESSION['error-no-hay-id'])) { ?>
			<li id="error-no-hay-id"><div class="error-mensajeError">Hubo un error. Intente nuevamente.</div></li>
			<?php unset($_SESSION['error-no-hay-id']); ?>
		<?php } ?>
		<?php if(isset($_SESSION['error-existe-alias'])) { ?>
			<li id="error-existe-alias"><div class="error-mensajeError">El alias ingresado ya esta en uso</div></li>
			<?php unset($_SESSION['error-existe-alias']); ?>
		<?php } ?>
	</ul>
</form>