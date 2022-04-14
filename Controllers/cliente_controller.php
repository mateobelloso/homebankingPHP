<?php
/**
 * 
 */
class ClienteController 
{
	
	public function __construct()
	{
	}

	public function index()
	{
		//session_start();
		require_once("../Views/Cliente/index.php");
		//header("Location: ../Views/Cliente/index.php");
	}
	public function cambioClave()
	{
		require_once('../Views/Cliente/cambioClave.php');
	}
	public function cambiarContraseña($usuario,$contraseñaActual)
	{
		require_once('../Models/Usuario.php');
		session_start();
		//Si la contraseña actual ingresada es igual a la del usuario activo realizo la actualizacion de contraseña
		if($contraseñaActual === $_SESSION['usuario']['clave'])
		{
			$usuario->cambio_clave= 0;
			$usuario->id= $_SESSION['usuario']['id'];
			Usuario::cambiarContraseña($usuario);
			$this->index();
		}else
		{
			//La contraseña actual no coincide
		}
	}


}

//Si me mandaron una accion desde el metodo post
if (isset($_POST['action'])) {
	$controller= new ClienteController();
	//Si la accion es cambio de password
	if ($_POST['action']=='cambio-password')
	{
		//Pregunto si el campo de contraseña actual y contraseña nueva no estan vacios y ademas si las dos contraseñas nuevas coinciden
		if((isset($_POST['contrasena-actual'])) && (isset($_POST['contrasena-nueva'])) && ($_POST['contrasena-nueva'] === $_POST['contrasena-nueva2']))
		{
			require_once("../Models/Usuario.php");
			//Creo un usuario con la nueva clave que se quiere guardar
			$usuario= new Usuario(null,null,null,null,$_POST['contrasena-nueva'],null,null,null);
			//Llamo al metodo cambiarContraseña de la clase del controller
			$controller->cambiarContraseña($usuario,$_POST['contrasena-actual']);
		}else
		{
			//Algun campo esta vacio o las dos contraseñas no son iguales
		}
	}
}
?>

