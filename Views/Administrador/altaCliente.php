	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
	<link rel="stylesheet" type="text/css" href="/hb/Styles/form.css">
	<script type="text/javascript" src="/hb/Javascript/chequeoAltaCliente.js"></script>

<h1>Agregar cliente</h1>

<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" onsubmit="return chequeoAltaCliente()"> 
	<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
	<input type="hidden" name="action" value="alta_cliente">
	<ul>
		<li><label for="nombre_cliente" class="is-required">Nombre</label><li><input type="text" id="nombre_cliente" name="nombre_cliente"></li></li>

		<li><label for="apellido_cliente" class="is-required">Apellido</label><li><input type="text" id="apellido_cliente" name="apellido_cliente"></li></li>

		<li><label for="nombre_usuario" class="is-required">Nombre de usuario</label><li><input type="text" id="nombre_usuario" name="nombre_usuario"></li></li>

		<li><label for="dni" class="is-required">DNI</label><li><input type="text" id="dni_cliente" name="dni_cliente"></li></li>

		<li><label for="clave" class="is-required">Clave<li></label><li><input type="text" id="clave_cliente" name="clave_cliente"></li></li>
		
		<li id="error-nombre-invalido" style="display: none;"><div class="error-mensajeError"><p>Error en el formato de nombre de cliente</p></div></li>

		<li id="error-apellido-invalido" style="display: none;"><div class="error-mensajeError"><p>Error en el formato de apellido de cliente</p></div></li>

		<!--Error de nombre de usuario invalido -->
		<li id="error-nombre-usuario-invalido" style="display: none;"><div class="error-mensajeError"><p>Error en el formato de nombre de usuario</p></div></li>

		<!--Error de DNI invalido -->
		<li id="error-dni-invalido" style="display: none;"><div class="error-mensajeError"><p>El DNI Ingresado es invalido</p></div></li>

		<!--Error en el formato de la contraseña -->
		<li id="error-clave-erronea" style="display: none;"><div class="error-mensajeError"><p>La contraseña no cumple con el formato de contener por lo menos 1 letra mayuscula, 1 letra minuscula y 1 numero o caracter especial</p></div></li>
		<!--Error generico de algun campo erroneo -->
		<li id="error-generico" style="display: none;"><div class="error-mensajeError"><p>Corregir los campos erroneos antes de reenviar el formulario</p></div></li>

				<!-- Imprimir mensaje de error de la verificacion del alta cliente por PHP-->
			<?php if(isset($_SESSION['error-alta-cliente-nombre-vacio'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-nombre-vacio'];unset($_SESSION['error-alta-cliente-nombre-vacio']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-apellido-vacio'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-apellido-vacio'];unset($_SESSION['error-alta-cliente-apellido-vacio']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-nombre_usuario-vacio'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-nombre_usuario-vacio'];unset($_SESSION['error-alta-cliente-nombre_usuario-vacio']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-dni-vacio'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-dni-vacio'];unset($_SESSION['error-alta-cliente-dni-vacio']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-clave-vacio'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-clave-vacio'];unset($_SESSION['error-alta-cliente-clave-vacio']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-formato-nombre'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-formato-nombre'];unset($_SESSION['error-alta-cliente-formato-nombre']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-formato-nombre_cliente'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-formato-nombre_cliente'];unset($_SESSION['error-alta-cliente-formato-nombre_cliente']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-formato-apellido'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-formato-apellido'];unset($_SESSION['error-alta-cliente-formato-apellido']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-formato-dni'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-formato-dni'];unset($_SESSION['error-alta-cliente-formato-dni']); ?> </div></li><?php }?>
			<?php if(isset($_SESSION['error-alta-cliente-formato-clave'])) {?><li> <div class="error-mensajeError"><?php echo $_SESSION['error-alta-cliente-formato-clave'];unset($_SESSION['error-alta-cliente-formato-clave']); ?> </div></li><?php }?>
			<li><button type="submit" class="submit">Agregar cliente</button></li>
		</ul>
	</form>