
<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->

<script>
	//Chequea que los valores ingresados en el formulario cumplan el formato
	function chequeoAltaCuenta()
	{
		debugger
		const regNombreCuenta= /[^a-z]/gi;	//Expresion regular para el nombre de cuenta
		const regAlias= /[^a-z]/gi;	//Expresion regular para el alias
		const nombreCuenta= document.getElementById("nombre-cuenta").value.replace(regNombreCuenta,"");	//Obtiene el valor de lo ingresado como nombre cuenta
		const alias= document.getElementById("alias").value.replace(regAlias,"");	//Obtiene el valor de lo ingresado en el alias
		let error= false;	//Variable para controlar si hay algun error


		//Si el nombre de cuenta no cumple su formato
		if (nombreCuenta.length < 5) 
		{
			document.getElementById("error-nombre-cuenta").style.display= "block";	//Muestra el error
			error= true;
		}else
		{
			document.getElementById("error-nombre-cuenta").style.display= "none";	//Caso contrario lo oculta
		}

		//Si el alias no cumple el formato
		if (alias.length < 8) 
		{
			document.getElementById("error-alias").style.display= "block";	//Muestra el error
			error= true;
		}else
		{
			document.getElementById("error-alias").style.display= "none";	//Caso contrario lo oculta
		}

		//Si hubo un error
		if (error) 
		{
			return false;	//Evita que el formulario se envie
		}else
		{
			return true;	//Deja enviar el formulario
		}

	}
</script>
	<h1>Agregar una cuenta:</h1>

	<form name="formulario" action="/hb/Controllers/administrador_controller.php" method="post" onsubmit="return chequeoAltaCuenta()"> 
		<!--Return Chequeo: Llama a la funcion chequeo que verifica las validaciones necesarias para enviar el forumalario al cliente controller -->
		<input type="hidden" name="action" value="alta_cuenta">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<ul>
			<li><label for="nombre-cuenta">Nombre de la cuenta:</label><input type="text" id="nombre-cuenta" name="nombre-cuenta"></li>
			<li><label for="contrasena-nueva">Alias:</label><input type="text" id="alias" name="alias"></li>
			<li><button type="submit" class="submit">Crear cuenta </button></li>
			<!-- Errores del lado del cliente y del servidor para el alta de cuenta de un cliente -->
			<li id="error-nombre-cuenta" style="display: none;">El nombre de cuenta debe contener por lo menos 5 caracteres alfabeticos</li>
			<li id="error-alias" style="display: none;">El alias debe contener por lo menos 8 caracteres alfabeticos</li>
			<?php if(isset($_SESSION['error-nombre-cuenta'])) { ?>
				<li id="error-nombre-cuenta">El nombre de cuenta debe contener por lo menos 5 caracteres alfabeticos</li>
				<?php unset($_SESSION['error-nombre-cuenta']); ?>
			<?php } ?>
			<?php if(isset($_SESSION['error-alias'])) { ?>
				<li id="error-alias">El alias debe contener por lo menos 8 caracteres alfabeticos</li>
				<?php unset($_SESSION['error-alias']); ?>
			<?php } ?>
			<?php if(isset($_SESSION['error-existe-alias'])) { ?>
				<li id="error-existe-alias">El alias ingresado ya esta en uso</li>
				<?php unset($_SESSION['error-existe-alias']); ?>
			<?php } ?>
		</ul>
	</form>