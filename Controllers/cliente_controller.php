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
		//Carga la vista 
		require_once("../Views/Cliente/index.php");
	}
	public function cambioClave()
	{	//Carga la vista de cambio de clave
		require_once('../Views/Cliente/cambioClave.php');
	}
	
	public function cambiarContraseña($usuario,$contraseñaActual)
	{
		require_once('../Models/Usuario.php');
		session_start();
		//Si la contraseña actual ingresada es igual a la del usuario activo realizo la actualizacion de contraseña
		if($contraseñaActual === $_SESSION['usuario']['clave'])
		{
			$_SESSION['usuario']['cambio_clave']= 0;		//Se cambia el valor de cambio de clave una vez se actualizo
			$usuario->cambio_clave= 0;
			$usuario->id= $_SESSION['usuario']['id'];
			Usuario::cambiarContraseña($usuario); 	//Se llama al modelo de cambiar contraseña
			$this->index(); //Vuelve al index del usuario
		}else
		{
			//La contraseña actual no coincide
			require_once('../Views/Cliente/cambioClave.php');
			echo "<script> mensajeErrorContraseñaIncorrecta() </script>";
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
		$formatoContraseña= "/(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/";
		if((isset($_POST['contrasena-actual'])) && (isset($_POST['contrasena-nueva'])) && ($_POST['contrasena-nueva'] === $_POST['contrasena-nueva2']) && (preg_match($formatoContraseña, $_POST['contrasena-nueva'])))
		{
			require_once("../Models/Usuario.php");
			//Creo un usuario con la nueva clave que se quiere guardar
			$usuario= new Usuario(null,null,null,null,$_POST['contrasena-nueva'],null,null,null);
			//Llamo al metodo cambiarContraseña de la clase del controller
			$controller->cambiarContraseña($usuario,$_POST['contrasena-actual']);
		}else
		{
			//Algun campo esta vacio o las dos contraseñas no son iguales
			require_once('../Views/Cliente/cambioClave.php');
			echo "<div class='error-contraseñas'><p>El campo de contraseña actual no puede estar vacio y las contraseñas deben ser iguales y cumplir el formato de contener por lo menos una letra mayuscula, una letra minuscula y un numero o caracter especial</p></div>";
		}
	}
}
?>