<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<h1>Cuentas del cliente:</h1>

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
	      			<?php echo '<a href="administrador_controller.php?action=depositarSueldo&id='.$cuenta->id.'">Depositar sueldo</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>