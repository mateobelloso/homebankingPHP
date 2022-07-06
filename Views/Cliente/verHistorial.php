<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<!--Chequeo para evitar accesos indebidos de un admin a las funcionalidades del cliente-->
<?php
	if($_SESSION['usuario']['tipo']!='comun')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>

<h1>¡Bienvenido <?php echo ucfirst($_SESSION['usuario']['nombre']) ?>!</h1><br> 
<h3>Tus cuentas:</h3>

<table class="table">
	<thead>
		<tr>
	      <th scope="col">Fecha de transaccion</th>
	      <th scope="col">Nombre de cuenta origen</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Apellido</th>
	      <th scope="col">Tipo</th>
	      <th scope="col">Nombre de cuenta destino</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Apellido</th>
	      <th scope="col">Monto</th>
	  	</tr>
	</thead>

	<tbody>

	  	<?php foreach ($movimientos as $movimiento) {?>	
	  		<tr>	
				<td style="text-align: center;" ><?php echo $movimiento['fechaTransaccion'] ?></td>
				<td style="text-align: center;" ><?php echo $movimiento['nombreCuentaOrigen'] ?></td>
				<td style="text-align: center;" ><?php echo $movimiento['nombreOrigen'] ?></td>
				<td style="text-align: center;" ><?php echo $movimiento['apellidoOrigen'] ?></td>
				<td style="text-align: center;" ><?php echo $movimiento['tipo'] ?></td>
				<td style="text-align: center;"><?php echo $movimiento['nombreCuentaDestino'] ?></td>
				<td style="text-align: center;" ><?php echo $movimiento['nombreDestino'] ?></td>
				<td style="text-align: center;" > <?php echo $movimiento['apellidoDestino'] ?></td>
				<td style="text-align: center;" ><?php echo $movimiento['monto'] ?></td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>