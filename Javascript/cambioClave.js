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