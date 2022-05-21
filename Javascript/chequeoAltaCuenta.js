//Chequea que los valores ingresados en el formulario cumplan el formato
	function chequeoAltaCuenta()
	{
		debugger
		const regNombreCuenta= /[^a-z]/gi;	//Expresion regular para el nombre de cuenta
		const regAlias= /[^a-z]/gi;	//Expresion regular para el alias
		const nombreCuenta= document.getElementById("nombre-cuenta");	//Obtiene el valor de lo ingresado como nombre cuenta
		const nombreCuentaFormato= nombreCuenta.value.replace(regNombreCuenta,"");
		const alias= document.getElementById("alias");
		const aliasFormato= alias.value.replace(regAlias,"");	//Obtiene el valor de lo ingresado en el alias
		let error= false;	//Variable para controlar si hay algun error

		//Si los campos estan vacios los pone en rojo
		if (nombreCuenta.value.length == 0) 
		{
			nombreCuenta.className= "error-border";
			error= true;
		}else
		{
			nombreCuenta.className= "blank-border";
		}
		if (alias.value.length == 0) 
		{
			alias.className= "error-border";
			error= true;
		}else
		{
			alias.className= "blank-border";
		}


		//Si el nombre de cuenta no cumple su formato
		if (nombreCuentaFormato.length < 5) 
		{
			document.getElementById("error-nombre-cuenta").style.display= "block";	//Muestra el error
			error= true;
		}else
		{
			document.getElementById("error-nombre-cuenta").style.display= "none";	//Caso contrario lo oculta
		}

		//Si el alias no cumple el formato
		if (aliasFormato.length < 8) 
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