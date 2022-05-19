<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<h1>Clientes</h1>

<table class="table">
	<thead>
		<tr>
	      <th scope="col">Nombre</th>
	      <th scope="col">Apellido</th>
	      <th scope="col">DNI</th>
	      <th scope="col">Acciones</th>
	  	</tr>
	</thead>

	<tbody>

	  	<?php foreach ($clientes as $cliente) {?>	
	  		<tr>	
				<td><?php echo $cliente->nombre ?></td>
				<td><?php echo $cliente->apellido ?></td>
	      		<td><?php echo $cliente->dni ?></td>
	      		<td>
	      			<?php echo '<a href="administrador_controller.php?action=verCuentas&id='.$cliente->id.'">Ver cuentas</a>'?>
	      			<?php echo '<a href="administrador_controller.php?action=agregarCuenta&id='.$cliente->id.'">Agregar cuenta</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>