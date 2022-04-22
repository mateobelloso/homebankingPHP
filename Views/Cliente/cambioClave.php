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
	"Las contraseñas no son iguales o no cumplen con el formato de contener por lo menos 1 letra mayuscula, 1 letra minuscula y 1 numero o caracter especial, mensaje"*/
	.error-contraseñas {
		color: black;
		background-color: #FDD;
		font-size: 12px;
		padding: 0;
		border: 3px solid red;
		width: 90%;
	}
</style>
<script>
	//Funcion que chequea todos los parametros que debe cumplir la contraseña 

	function chequeo()
	{	
		const regContraseña= /(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/;	//Variable que va a controlar que la contraseña cumpla con el formato pedido
		const contrasena= document.getElementById("contrasena-nueva");	//Almacena el elemento html con el id contrasena-nueva
		const contrasena2= document.getElementById("contrasena-nueva2");	//Almacena el elemento html con el id contrasena-nueva2
		const contrasenaActual= document.getElementById("contrasena-actual");	//Almacena el elemento html con el id contrasena-actual
		var error= false;	//Variable para controlar si hay error

		//Si el campo de contraseña actual es vacio marco el error
		if (contrasenaActual.value.length === 0)
		{
			contrasenaActual.className= "error-border";
			//document.getElementById("error-contrasena-vacia").style.visibility= "visible";
			error= true;
		}else
		{
			//document.getElementById("error-contrasena-vacia").style.visibility= "hidden";
		}

		//Si las dos contraseñas nuevas son iguales y cumplen con el formato pongo el input en colorsito verde y oculto el error
		if ((contrasena.value === contrasena2.value) && (regContraseña.test(contrasena.value))) 
		{
			document.getElementById("error-contrasena-distintas").style.display= "none";
			contrasena.className= "correcto-border";
			contrasena2.className= "correcto-border";
		}else 	//Caso contrario pongo el input en color rojo y hago visible el error
		{
			contrasena.className= "error-border";
			contrasena2.className= "error-border";
			document.getElementById("error-contrasena-distintas").style.display= "block";
			error= true;
		}

		if (error)	//Si hubo error retorno falso para que el formulario no se envie caso contrario retorno true
		{
			return false;
		}else
		{
			return true;
		}
	}

	function mensajeErrorContraseñaIncorrecta()
	{
		document.getElementById("error-contraseña-incorrecta").style.display= "block";
	}
</script>

<html>
<head>
</head>
<body>

	<!--Formulario en HTML para el cambio de contraseña  -->
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
	<h1>Cambie su contraseña</h1>

	<form name="formulario" action="/hb/Controllers/cliente_controller.php" method="post" > 
		<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
		<input type="hidden" name="action" value="cambio-password">
		<ul>
			<li><label for="contrasena-actual">Contraseña Actual:</label><input type="password" id="contrasena-actual" name="contrasena-actual"></li>
			<li><label for="contrasena-nueva">Contraseña Nueva:</label><input type="password" id="contrasena-nueva" name="contrasena-nueva"></li>
			<li><label for="contrasena-nueva2">Repita la contraseña nueva:</label><input type="password" id="contrasena-nueva2" name="contrasena-nueva2"></li>
			
			<li id="error-contrasena-distintas" style="display: none;"><div class="error-contraseñas"><p>Las contraseñas no son iguales o no cumplen con el formato de contener por lo menos 1 letra mayuscula, 1 letra minuscula y 1 numero o caracter especial</p></div></li>

			<li id="error-contraseña-incorrecta" style="display: none;"><div class="error-contraseñas"><h3>La contraseña actual es incorrecta</h3></div></li>

			<?php if(isset($_SESSION['error-cambio-clave'])){ ?>
				<li><div class="error-contraseñas">
				<?php echo $_SESSION['error-cambio-clave'];
							unset($_SESSION['error-cambio-clave']); ?>
				</div></li>		
			<?php } ?>

			<li><button type="submit" class="submit">Cambiar contraseña </button></li>
		</ul>
	</form>

</body>
</html>