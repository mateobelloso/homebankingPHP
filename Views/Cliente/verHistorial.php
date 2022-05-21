<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
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
				<td><?php echo $movimiento['fechaTransaccion'] ?></td>
				<td><?php echo $movimiento['nombreCuentaOrigen'] ?></td>
				<td><?php echo $movimiento['nombreOrigen'] ?></td>
				<td><?php echo $movimiento['apellidoOrigen'] ?></td>
				<td><?php echo $movimiento['tipo'] ?></td>
				<td><?php echo $movimiento['nombreCuentaDestino'] ?></td>
				<td><?php echo $movimiento['nombreDestino'] ?></td>
				<td><?php echo $movimiento['apellidoDestino'] ?></td>
				<td><?php echo $movimiento['monto'] ?></td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>