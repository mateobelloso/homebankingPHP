<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<?php if(isset($_SESSION['mensaje-cuenta-eliminada']))
		{	?>
			<div><?php echo $_SESSION['mensaje-cuenta-eliminada']; ?></div>
			<?php unset($_SESSION['mensaje-cuenta-eliminada']);
		}	?>

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
	  	<?php foreach ($cuentasInactivas as $cuenta) {?>	
	  		<tr>	
				<td><?php echo $cuenta->nombre ?></td>
				<td><?php echo $cuenta->alias ?></td>
	      		<td><?php echo $cuenta->saldo ?></td>
	      		<td>
	      			<a href="administrador_controller.php?action=eliminarCuentaPorInactividad&id=<?php echo $cuenta->id ?>" onclick="return confirm('Estas seguro que deseas eliminar la cuenta <?php echo $cuenta->alias ?>')">Eliminar cuenta</a>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>