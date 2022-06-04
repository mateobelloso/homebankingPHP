<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<h1>¡Bienvenido <?php echo ucfirst($_SESSION['usuario']['nombre']) ?>!</h1><br> 

<h3>Cuentas antiguas de clientes:</h3>

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
	      			<?php echo '<a href="administrador_controller.php?action=eliminarCuentaPorInactividad&id='.$cuenta->id.'">Eliminar Cuenta</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>