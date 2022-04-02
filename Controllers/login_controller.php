<?php

//require_once('index.php');

class LoginController
{
	public function __construct()
	{}

	public function autenticacion($usuario)
	{
		//require_once('index.php');
		if (Usuario::autenticacionInicioSesion($usuario)!= null)
		{
			//Se inicia sesion y se almacenan las variables del usuario en $_SESSION
			session_start();
			$_SESSION['id'] = $usuario->id;
			$_SESSION['nombre'] = $usuario->nombre;
			$_SESSION['apellido'] = $usuario->apellido;
			$_SESSION['nombre_usuario'] = $usuario->nombre_usuario;
 			$_SESSION['clave'] = $usuario->clave;
 			$_SESSION['dni'] = $usuario->dni;
 			$_SESSION['tipo'] = $usuario->tipo;
 			$_SESSION['cambio_clave'] = $usuario->cambio_clave;
 			
 			//Determina si el usuario es un admin o un cliente
 			if($_SESSION['tipo']="comun")
 			{
 				echo "aca";
 				//Determina si es el primer inicio de sesion y debe cambiar la clave
 				if($_SESSION['cambio_clave'])
 				{	
 					require_once 'cliente_controller.php';
 					$cliente= new ClienteController();
 					$cliente->cambioClave();

 				}else

 				//Muestra el inicio de sesion general
 				{
 					require_once 'cliente_controller.php';
 					$cliente= new ClienteController();
 					$cliente->index();

 				}
 			}
 			//require_once('../Views/Cliente/index.php');
 			echo"se inicio sesion";
		}else{
			echo "error al validar contraseña";
		}

	}
}


// Se inicializa el login controler y se llama a autentificar usuario pasandole el usuario y la contraseña
if (isset($_POST['action'])) {
		$controller= new LoginController();
		require_once('../Models/Usuario.php');
		if($_POST['action']=='sesion')
		{
			$usuario= new Usuario(null,null,null,$_POST['usuario'],$_POST['contraseña'],null,null,null);
			$controller->autenticacion($usuario);
		}
}
?>