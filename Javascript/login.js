// Funcion para mostrar la contraseña 
function mostrarContrasena(){
  var tipo = document.getElementById("checkbox");
  var aux = document.getElementById("contrasena")
  if(tipo.checked == true){
      aux.type = "text";
  }else{
      aux.type = "password";
  }
}
// Mensaje de error de inicio de sesion
function mensajeError(){
	var error= document.getElementById("error");
	error.style.display= "block";
}

function chequeo()
{
	const usuario= document.getElementById("usuario");
	const contraseña= document.getElementById("contrasena");
	if ((usuario.value.length == 0) || (contraseña.value.length == 0)) 
	{
		document.getElementById("error-campos-vacios").style.display= "block";
		return false;
	}
	return true;
}