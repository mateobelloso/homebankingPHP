<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
<link rel="stylesheet" type="text/css" href="/hb/Styles/form.css">
<script type="text/javascript" src="/hb/Javascript/chequeoTransferencia.js"></script>
<!--Chequeo para evitar accesos indebidos de un admin a las funcionalidades del cliente-->
<?php
	if($_SESSION['usuario']['tipo']!='comun')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>
<h1>Hacer una transferencia:</h1>

<table class="table">
	<thead>
		<th>Cuenta origen</th>
		<th>Alias de cuenta destino</th>
		<th>Monto</th>
	</thead>

	<tbody>
		<form name="formulario" action="/hb/Controllers/cliente_controller.php" method="post" onsubmit="return chequeoTransferencia()">
			<input type="hidden" name="action" value="hacer-transferencia">
			<tr>
				<td><select name="misCuentas" id="cuenta-origen">
				<?php foreach ($misCuentas as $cuenta){ ?>
					<option value="<?php echo $cuenta->id.' - '.$cuenta->saldo ?>"><?php echo $cuenta->nombre." - ".$cuenta->alias." - Saldo: $".$cuenta->saldo ?></option>
				<?php } ?>
			</select></td>
				<td><input type="text" id="alias-destino" name="alias-destino"></td>
				<td><input type="number" id="monto" name="monto"></td>
			</tr>
	</tbody>
</table>
	<button type="submit" class="submit">Hacer transferencia</button>
	<ul>
		<!-- Errores del lado del cliente y del servidor para el alta de cuenta de un cliente -->
		<li id="error-monto-invalido" style="display: none;"><div class="error-mensajeError">El monto a transferir tiene que ser mayor a 0</div></li>
		<li id="error-saldo-insuficiente" style="display: none;"><div class="error-mensajeError">El saldo de su cuenta es insuficiente para el monto que desea transferir</div></li>
		<?php if(isset($_SESSION['error-alias-vacio'])) { ?>
			<li><div class="error-mensajeError"><?php echo $_SESSION['error-alias-vacio'] ?></div></li>
			<?php unset($_SESSION['error-alias-vacio']); ?>
		<?php } ?>
		<?php if(isset($_SESSION['error-monto-invalido'])) { ?>
			<li><div class="error-mensajeError"><?php echo $_SESSION['error-monto-invalido'] ?></div></li>
			<?php unset($_SESSION['error-monto-invalido']); ?>
		<?php } ?>
		<?php if(isset($_SESSION['error-saldo-insuficiente'])) { ?>
			<li><div class="error-mensajeError"><?php echo $_SESSION['error-saldo-insuficiente'] ?></div></li>
			<?php unset($_SESSION['error-saldo-insuficiente']); ?>
		<?php } ?>
		<?php if(isset($_SESSION['error-alias-no-existe'])) { ?>
			<li><div class="error-mensajeError"><?php echo $_SESSION['error-alias-no-existe'] ?></div></li>
			<?php unset($_SESSION['error-alias-no-existe']); ?>
		<?php } ?>
	</ul>
</form>