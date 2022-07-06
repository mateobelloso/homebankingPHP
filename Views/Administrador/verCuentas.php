<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hb/Views/header.php'); ?>
<!--Chequeo para evitar accesos indebidos de un usuario a las funcionalidades del admin-->
<?php
	if($_SESSION['usuario']['tipo']!='empleado')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>
<link rel="stylesheet" type="text/css" href="/hb/Styles/tablas.css">
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
				<td><br><?php echo $cuenta->nombre ?></td>
				<td><br><?php echo $cuenta->alias ?></td>
	      		<td><br><?php echo $cuenta->saldo ?></td>
	      		<td><br>
	      			<?php echo '<a class="button"  href="administrador_controller.php?action=depositarSueldo&id='.$cuenta->id.'">Depositar sueldo</a>'?>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>