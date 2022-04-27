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
	      			<a href="">Ver cuentas</a>
	      			<a href="">Agregar cuenta</a>
	      		</td>
	    	</tr>
	    <?php } ?>
	</tbody>
</table>