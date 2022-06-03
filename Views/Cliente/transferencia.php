<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
<link rel="stylesheet" type="text/css" href="/hb/Styles/form.css">
<script type="text/javascript" src="/hb/Javascript/chequeoTransferencia.js"></script>

<h1>Hacer una transferencia:</h1>

<form name="formulario" action="/hb/Controllers/cliente_controller.php" method="post" onsubmit="return chequeoTransferencia()" > 
	<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
	<input type="hidden" name="action" value="alta_cuenta">

	<input type="hidden" name="id" value="<?php echo $id ?>">
	<ul>
		<li><label for="cuenta-origen">Cuenta origen</label>
			<select name="misCuentas" id="cuenta-origen">
				<?php foreach ($misCuentas as $cuenta){ ?>
					<option value="<?php echo $cuenta->id.' - '.$cuenta->saldo ?>"><?php echo $cuenta->nombre." - ".$cuenta->alias." - Saldo: $".$cuenta->saldo ?></option>
				<?php } ?>
			</select>
		</li>
		<li><label for="cuenta-destino">Alias de cuenta destino</label><input type="text" id="alias-destino" name="alias-destino"></li>
		<li><label for="monto">Monto</label><input type="number" id="monto" name="monto"></li>
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