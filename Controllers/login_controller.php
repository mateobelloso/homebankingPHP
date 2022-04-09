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
			$_SESSION['usuario']= array('id' => $usuario->id,'nombre' => $usuario->nombre, 'apellido' => $usuario->apellido, 'nombre_usuario' => $usuario->nombre_usuario, 'dni' => $usuario->dni, 'tipo' => $usuario->tipo, 'cambio_clave' => $usuario->cambio_clave);
			// $_SESSION['id'] = $usuario->id;
			// $_SESSION['nombre'] = $usuario->nombre;
			// $_SESSION['apellido'] = $usuario->apellido;
			// $_SESSION['nombre_usuario'] = $usuario->nombre_usuario;
 		// 	$_SESSION['clave'] = $usuario->clave;
 		// 	$_SESSION['dni'] = $usuario->dni;
 		// 	$_SESSION['tipo'] = $usuario->tipo;
 		// 	$_SESSION['cambio_clave'] = $usuario->cambio_clave;
 			
 			//Determina si el usuario es un admin o un cliente
 			if($_SESSION['usuario']['tipo']="comun")
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
 			}
 			//require_once('../Views/Cliente/index.php');
 			echo"se inicio sesion";
		}else{
			require_once('../index.php');
			echo '<div class="error"><h2>Error al iniciar sesion:</h2><span>- Nombre de usuario o contraseña incorrecta </span></div>';
		}

	}
}

//Si hay una sesion
if(session_status())
{
	session_start();
	//Inicializa la sesion y pregunta si hay un usuario cargado (osea la sesion ya esta iniciada)
	if (isset($_SESSION['usuario']))
	{
		if($_SESSION['usuario']['tipo']="comun")
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

//Si me pasaron un parametro a traves de la url (GET) mira que accion es y ejecuta la funcion correspondiente
if (isset($_GET['action']))
{
	if($_GET['action']=='cerrar')
	{
		unset($_SESSION['usuario']);
		$controller= new LoginController();
		$controller->index();
	}
}

?>