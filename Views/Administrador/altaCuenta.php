
<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->

<h1>Vas a agregar una cuenta al id: <?php echo $id ?></h1>
	<h1>Agregar una cuenta:</h1>

	<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" onsubmit="return chequeo()"> 
		<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
		<input type="hidden" name="action" value="alta-cuenta">
		<ul>
			<li><label for="nombre-cuenta">Nombre de la cuenta:</label><input type="text" id="nombre-cuenta" name="nombre-cuenta"></li>
			<li><label for="contrasena-nueva">Alias:</label><input type="text" id="alias" name="alias"></li>
			<li><button type="submit" class="submit">Crear cuenta </button></li>
		</ul>
	</form>