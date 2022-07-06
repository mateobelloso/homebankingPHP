<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>

<!--Chequeo para evitar accesos indebidos de un usuario a las funcionalidades del admin-->
<?php
	if($_SESSION['usuario']['tipo']!='empleado')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>

<?php if(isset($_SESSION['mensaje-cuenta-eliminada']))
		{	?>
			<div><?php echo $_SESSION['mensaje-cuenta-eliminada']; ?></div>
			<?php unset($_SESSION['mensaje-cuenta-eliminada']);
		}	?>

<link rel="stylesheet" type="text/css" href="/hb/Styles/tablas.css">
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
				<td style="text-align: center;" ><br><?php echo $cuenta->nombre ?></td>
				<td style="text-align: center;" ><br><?php echo $cuenta->alias ?></td>
	      		<td style="text-align: center;" ><br><?php echo $cuenta->saldo ?></td>
	      		<td style="text-align: center;" ><br>
	      			<a class="button" href="administrador_controller.php?action=eliminarCuentaPorInactividad&id=<?php echo $cuenta->id ?>" onclick="return confirm('Estas seguro que deseas eliminar la cuenta <?php echo $cuenta->alias ?>')">Eliminar cuenta</a>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>