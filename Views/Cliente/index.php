<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>

<?php if(isset($_SESSION['transferencia-exitosa'])) {
	echo $_SESSION['transferencia-exitosa'];
	unset($_SESSION['transferencia-exitosa']);
} ?>
<h1>¡Bienvenido <?php echo ucfirst($_SESSION['usuario']['nombre']) ?>!</h1><br> 

<?php echo '<a href="cliente_controller.php?action=hacerTransferencia">Hacer una transferencia </a>'?>

<h3>Tus cuentas:</h3>

<table class="table">
	<thead>
		<tr>
	      <th scope="col">Nombre</th>
	      <th scope="col">Alias</th>
	      <th scope="col">Saldo</th>
	      <th scope="col">Acciones</th>
	  	</tr>
	</thead>

	<tbody>

	  	<?php foreach ($cuentas as $cuenta) {?>	
	  		<tr>	
				<td><?php echo $cuenta->nombre ?></td>
				<td><?php echo $cuenta->alias ?></td>
	      		<td><?php echo $cuenta->saldo ?></td>
	      		<td>
	      			<?php echo '<a href="cliente_controller.php?action=verHistorial&id='.$cuenta->id.'">Ver historial</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>