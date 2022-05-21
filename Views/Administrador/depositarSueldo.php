<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
<link rel="stylesheet" type="text/css" href="/hb/Styles/form.css">
<script type="text/javascript" src="/hb/Javascript/chequeoDepositoSueldo.js"></script>

<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" onsubmit="return chequeoDepositoSueldo()"> 
	<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al administrador controller -->
	<input type="hidden" name="action" value="deposito_sueldo">
	<input type="hidden" name="id_cuenta_destino" value="<?php echo $idCuentaDestino ?>">
	<ul>
		<li><label for="monto" class="is-required">Monto</label><li><input type="number" id="monto" name="monto"> $</li></li>

		
		<!--Error de nombre de usuario invalido -->
		<li id="error-monto-invalido" style="display: none;"><div class="error-mensajeError"><p>Error en monto ingresado: El monto debe ser mayor que 0.</p></div></li>

			<!-- Imprimir mensaje de error de la verificacion del alta cliente por PHP-->
		<?php if(isset($_SESSION['error-monto'])) { 
		?>
		
				<li> 
				<div class="error-mensajeError">
				<?php 
			 		echo $_SESSION['error-monto'];
			 		unset($_SESSION['error-monto']); 
			 	?> 
			 	</div>
				</li>

				<?php }?>

		<li><button type="submit" class="submit">Depositar Sueldo</button></li>
	</ul>
</form>