<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
<style>
	
	/*Estitica del formulario*/
	form {
		margin: 0;
		width: 30vw;
		padding: 1em;
		margin-left: 1vw;
		margin-top: 1vw;
	}
	/*Estitica del boton de cambiar contraseña*/
	button {
		border-radius: 50px;
		background-color: #2980B9;
		color: white;
		padding: 1em;
		margin-left: 15vw;
	}

	ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	form li + li {
		margin-top: 1em;
	}
	/*Ordenacion del formulario */
	label {
		display: inline-block;
		width: 180px;
		text-align: left;
	}
	/*Estilo ROJO para el campo INCORRECTO, si ingresan algun valor*/
	.error-border {
		background-color: #F86157;
		border-color: #900;
	}
	/*Estilo VERDE para campo CORRECTO, si ingresan algun valor*/
	.correcto-border {
		background-color: #5CF06C;
		border-color: #00A411;
	}
	/*Estilo ROJO para campo INCORRECTO, 
	"Las contraseñas no son iguales o no cumplen con el formato de contener por lo menos 1 letra mayuscula, 1 letra minuscula y 1 numero o caracter especial"*/
	.error-mensajeError {
		color: black;
		background-color: #FDD;
		font-size: 12px;
		padding: 0;
		border: 3px solid red;
		width: 90%;
	}
	.is-required:after {
 	 content: '*';
 	 margin-left: 2px;
	  color: red;
 	 font-weight: bold;
	}
	
</style>
<script>
		function chequeoDepositoSueldo()
		{


		}


</script>



	<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" onsubmit="return chequeoDepositoSueldo()"> 
		<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
		<input type="hidden" name="action" value="alta_cliente">
		<ul>
			<li><label for="monto" class="is-required">Nombre</label><li><input type="text" id="monto" name="monto"></li></li>

			
			<!--Error de nombre de usuario invalido -->
			<li id="error-monto-invalido" style="display: none;"><div class="error-mensajeError"><p>Error en monto ingresado</p></div></li>

				<!-- Imprimir mensaje de error de la verificacion del alta cliente por PHP-->
			<?php if(isset($_SESSION['error-monto-php'])) { 
			?>
			
					<li> 
					<div class="error-mensajeError">
					<?php 
				 		echo $_SESSION['error-alta-cliente'];
				 		unset($_SESSION['error-alta-cliente']); 
				 	?> 
				 	</div>
					</li>

					<?php }?>

			<li><button type="submit" class="submit">Depositar Sueldo</button></li>
		</ul>
	</form>