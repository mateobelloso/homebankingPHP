function chequeoAltaCliente()
	{	debugger
		const regContraseña= /(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/;	//Variable que va a controlar que la contraseña cumpla con el formato pedido
		const regDNI= /^\d{7,8}$/; //Variable de validacion para el DNI
		const regNombre_usuario= /[a-z0-9]{6,}/i; //Variable de validacion para el nombre de usuario
		const regNombreApe_cliente=/^[a-z]+(\s[a-z]+)*$/i;
		

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
		}else{
			nombre_cliente.className="blank-border"
		}
		if(apellido_cliente.value.length==0)
		{
			apellido_cliente.className= "error-border";
			error=true;
		}else{
			apellido_cliente.className="blank-border"
		}
		if(nombre_usuario.value.length==0)
		{
			nombre_usuario.className= "error-border";
			error=true;
		}else{
			nombre_usuario.className="blank-border"
		}
		if(dni_cliente.value.length==0)
		{
			dni_cliente.className= "error-border";
			error=true;
		}else{
			dni_cliente.className="blank-border"
		}
		if(clave_cliente.value.length==0)
		{
			clave_cliente.className= "error-border";
			error=true;
		}else{
			clave_cliente.className="blank-border"
		}
	
	
		if (regNombreApe_cliente.test(nombre_cliente.value)){
			document.getElementById("error-nombre-invalido").style.display= "none";
		}else{
			nombre_cliente.className= "error-border";
			document.getElementById("error-nombre-invalido").style.display= "block";
			error=true;
		}
		if (regNombreApe_cliente.test(apellido_cliente.value)){
			document.getElementById("error-apellido-invalido").style.display= "none";
		}else{
			apellido_cliente.className= "error-border";
			document.getElementById("error-apellido-invalido").style.display= "block";
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