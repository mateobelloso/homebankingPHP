<script>
	function chequeo()
	{
		debugger
		const contrasena= document.getElementById("contrasena-nueva").value;
		const contrasena2= document.getElementById("contrasena-nueva2").value;
		var error= false;

		if (document.getElementById("contrasena-actual").value.length === 0) 
		{
			//document.getElementById("error-contrasena-vacia").style.visibility= "visible";
			error= true;
		}else
		{
			//document.getElementById("error-contrasena-vacia").style.visibility= "hidden";
		}

		if (contrasena === contrasena2) 
		{
			document.getElementById("error-contrasena-distintas").style.visibility= "hidden";
		}else
		{
			document.getElementById("error-contrasena-distintas").style.visibility= "visible";
			error= true;
		}

		if (error) 
		{
			return false;
		}else
		{
			return true;
		}
	}	
</script>

<html>
<body>
	<?php require_once('../Views/header.php'); ?>
	<h1>Cambie su contraseña</h1>
	<form name="formulario" action="cliente_controller.php" method="post" onsubmit="return chequeo()">
		<input type="hidden" name="action" value="cambio-password">
		<label>Contraseña Actual:<input type="password" id="contrasena-actual" name="contrasena-actual"></label><br>
		<label>Contraseña Nueva:<input type="password" id="contrasena-nueva" name="contrasena-nueva"></label><br>
		<label>Repita la contraseña nueva:<input type="password" id="contrasena-nueva2" name="contrasena-nueva2"></label><br>
		<button type="submit" class="submit">Cambiar contraseña </button>
		<h3 id="error-contrasena-distintas" style="visibility: hidden;">Las contraseñas no son iguales</h3>
	</form>

</body>
</html>