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
function chequeoAltaCliente()
	{debugger
		const regContraseña= /(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/;	//Variable que va a controlar que la contraseña cumpla con el formato pedido
		const regDNI= /^\d{7,8}$/; //Variable de validacion para el DNI
		const regNombre_usuario= /[a-z0-9]{6,}/i; //Variable de validacion para el nombre de usuario

		const nombre_cliente= document.getElementById("nombre_cliente");	//Almacena el elemento html con el id nombre_cliente
		const nombre_usuario= document.getElementById("nombre_usuario");	//Almacena el elemento html con el id nombre_usuario
		const clave_cliente= document.getElementById("clave_cliente");	//Almacena el elemento html con el id clave
		const dni_cliente= document.getElementById("dni_cliente");	//Almacena el elemento html con el id dni
		const apellido_cliente= document.getElementById("apellido_cliente");

		var error= false;	//Variable para controlar si hay error
		
		//Verifica que ningun campo obligatorio este vacio
		if (nombre_cliente.value.length==0)
		{
			nombre_cliente.className= "error-border";
			error=true;
		}
		if(apellido_cliente.value.length==0)
		{
			apellido_cliente.className= "error-border";
			error=true;
		}
		if(nombre_usuario.value.length==0)
		{
			nombre_usuario.className= "error-border";
			error=true;
		}
		if(dni_cliente.value.length==0)
		{
			dni_cliente.className= "error-border";
			error=true;
		}
		if(clave_cliente.value.length==0)
		{
			clave_cliente.className= "error-border";
			error=true;
		}
	
	
		//Verifica que el nombre de usuario sea correcto
		if(regNombre_usuario.test(nombre_usuario.value))
		{
			document.getElementById("error-nombre-usuario-invalido").style.display= "none";
		}else{
			nombre_usuario.className= "error-border";
			document.getElementById("error-nombre-usuario-invalido").style.display= "block";
			error=true;
		}

		//Verifica que el DNI cumpla con las condiciones
		if(regDNI.test(dni_cliente.value))
		{	
			document.getElementById("error-dni-invalido").style.display= "none";
		}
		else{
			dni_cliente.className= "error-border";
			document.getElementById("error-dni-invalido").style.display= "block";
			error=true;
		}

		//Verifica que la contraseña este en el formato adecuado
		if(regContraseña.test(clave_cliente.value))
		{
			document.getElementById("error-clave-erronea").style.display= "none";
		}else{
			clave_cliente.className= "error-border";
			document.getElementById("error-clave-erronea").style.display= "block";
			error=true;
			}

			//En caso de error no se envio el formulario y se imprime un error generico
		if(!error)
		{
			document.getElementById("error-generico").style.display= "none";
			return true;
			
		}else{
			document.getElementById("error-generico").style.display= "block";
			return false;
		}
	}

</script>

<html>
<body>

	<!--Formulario en HTML para el cambio de contraseña  -->

	<h1>Agregar cliente</h1>

	<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" onsubmit="return chequeoAltaCliente()"> 
		<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
		<input type="hidden" name="action" value="alta_cliente">
		<ul>
			<li><label for="nombre_cliente" class="is-required">Nombre</label><li><input type="text" id="nombre_cliente" name="nombre_cliente"></li></li>

			<li><label for="apellido_cliente" class="is-required">Apellido</label><li><input type="text" id="apellido_cliente" name="apellido_cliente"></li></li>

			<li><label for="nombre_usuario" class="is-required">Nombre de usuario</label><li><input type="text" id="nombre_usuario" name="nombre_usuario"></li></li>

			<li><label for="dni" class="is-required">DNI</label><li><input type="text" id="dni_cliente" name="dni_cliente"></li></li>

			<li><label for="clave" class="is-required">Clave<li></label><li><input type="password" id="clave_cliente" name="clave_cliente"></li></li>
			

			<li id="error-nombre-usuario-invalido" style="display: none;"><div class="error-mensajeError"><p>Error en el formato de nombre de usuario</p></div></li>
			
			<li id="error-dni-invalido" style="display: none;"><div class="error-mensajeError"><p>El DNI Ingresado es invalido</p></div></li>

			<li id="error-clave-erronea" style="display: none;"><div class="error-mensajeError"><p>La contraseña no cumple con el formato de contener por lo menos 1 letra mayuscula, 1 letra minuscula y 1 numero o caracter especial</p></div></li>

			<li id="error-generico" style="display: none;"><div class="error-mensajeError"><p>Corregir los campos erroneos antes de reenviar el formulario</p></div></li>

				<!-- Imprimir mensaje de error de la verificacion del alta cliente por PHP-->
			<?php if(isset($_SESSION['error-alta-cliente'])) { 
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

			<li><button type="submit" class="submit">Agregar cliente</button></li>
		</ul>
	</form>
</body>
</html>

