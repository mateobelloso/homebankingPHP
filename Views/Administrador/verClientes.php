<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<!--Chequeo para evitar accesos indebidos de un usuario a las funcionalidades del admin-->
<?php
	if($_SESSION['usuario']['tipo']!='empleado')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>
<link rel="stylesheet" type="text/css" href="/hb/Styles/tablas.css">
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
				<td style="text-align: center;" ><br><?php echo $cliente->nombre ?></td>
				
				<td style="text-align: center;"><br><?php echo $cliente->apellido ?></td>
	      		<td style="text-align: center;" ><br><?php echo $cliente->dni ?></td>
	      		<td style="text-align: center;" ><br>
	      			<?php echo '<a class="button" href="administrador_controller.php?action=verCuentas&id='.$cliente->id.'">Ver cuentas</a>'?>

	      			<?php echo '<a class="button" href="administrador_controller.php?action=agregarCuenta&id='.$cliente->id.'">Agregar cuenta</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>