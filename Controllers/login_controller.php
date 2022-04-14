<?php

//require_once('index.php');

class LoginController
{
	public function __construct()
	{}

	public function index()
	{
		header("Location: ../index.php");
	}

	public function autenticacion($user)
	{
		//require_once('index.php');
		$usuario= Usuario::autenticacionInicioSesion($user);
		if ($usuario!= null)
		{
			//Se inicia sesion y se almacenan las variables del usuario en $_SESSION['usuario']
			//session_start();
			$_SESSION['usuario']= array('id' => $usuario->id,'nombre' => $usuario->nombre, 'apellido' => $usuario->apellido, 'nombre_usuario' => $usuario->nombre_usuario,'clave' => $usuario->clave, 'dni' => $usuario->dni, 'tipo' => $usuario->tipo, 'cambio_clave' => $usuario->cambio_clave);
 			
 			//Determina si el usuario es un admin o un cliente
 			if($_SESSION['usuario']['tipo']=="comun")
 			{
 				//Determina si es el primer inicio de sesion y debe cambiar la clave
 				if($_SESSION['usuario']['cambio_clave'])
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
 			}else
 				{	
 					require_once 'administrador_controller.php';
 					$administrador= new AdministradorController();
 					$administrador->index();

 				}

 			//require_once('../Views/Cliente/index.php');
		}else{
			//require_once('../index.php');

			//Se imprime el mensaje de error de inicio de sesion con 
			$_SESSION['error-inicio']= "<script> mensajeError(); </script>";
			header("Location: ../index.php");
			
			//Otra forma de imprimir el error

			//echo '<div class="error"><h2>Error al iniciar sesion:</h2><span>- Nombre de usuario o contraseña incorrecta </span></div>';
		}

	}
}

//Si me pasaron un parametro a traves de la url (GET) mira que accion es y ejecuta la funcion correspondiente
if (isset($_GET['action']))
{
	if($_GET['action']=='cerrar')
	{
		//Sesion start para solucionar el error de guardar el valor anterior
		session_start();
		unset($_SESSION['usuario']);	//Se borra la informacion del usuario que inicio sesion (Cierra su sesion) 
		$controller= new LoginController();
		$controller->index();
	}
}

//Si hay una sesion
if(session_status())
{
	session_start();
	//Inicializa la sesion y pregunta si hay un usuario cargado (osea la sesion ya esta iniciada)
	if (isset($_SESSION['usuario']))
	{
		if($_SESSION['usuario']['tipo']=="comun")
	 	{
	 		//Determina si es el primer inicio de sesion y debe cambiar la clave
	 		if($_SESSION['usuario']['cambio_clave'])
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
	 			// $controller= 'cliente';
	 			// $action= 'index';
	 			// require_once('../routes.php');
			}
		}else
 			{	
 			require_once 'administrador_controller.php';
 			$administrador= new AdministradorController();
 			$administrador->index();
 			}
	}else{
		//Se hace asi para evitar un error, en caso de apretar el inicio del banco recarga la pagina de inicio

		if(!isset($_POST['action']))
		{
			header("Location: ../index.php");
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