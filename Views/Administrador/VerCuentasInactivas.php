<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<h1>¡Bienvenido <?php echo ucfirst($_SESSION['usuario']['nombre']) ?>!</h1><br> 

<h3>Cuentas antiguas de clientes:</h3>

<table class="table">
	<thead>
		<tr>
	      <th scope="col">Nombre</th>
	      <th scope="col">Alias</th>
	      <th scope="col">Saldo</th>
          <th scope="col">Fecha Ultima Transaccion</th>
	      <th scope="col">Acciones</th>
	  	</tr>
	</thead>

	<tbody>
	  	<?php foreach ($cuentasInactivas as $cuentaInactiva) {?>	
	  		<tr>	
				<td><?php echo $cuentaInactiva->nombre ?></td>
				<td><?php echo $cuentaInactiva->alias ?></td>
	      		<td><?php echo $cuentaInactiva->saldo ?></td>
                  <td>  <?php echo $cuentaInactiva->fechaUltTransaccion ?></td>
                
	      		<td>
	      			<?php echo '<a href="administrador_controller.php?action=eliminarCuentaPorInactividad&id='.$cuenta->id.'">Eliminar Cuenta</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>