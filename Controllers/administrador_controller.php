<?php
/**
 * 
 */
class AdministradorController
{
	public function index()
	{	//Carga la vista de cambio de clave
		require_once('../Views/Administrador/index.php');
	}
	public function altaCliente()
	{	//Carga la vista de cambio de clave
		session_start();
		require_once('../Views/Administrador/altaCliente.php');
	}
	public function agregarCliente($usuario)
	{

		//vERIFICAR QUE EL USUARIO NO EXISTE EN LA BASE DE DATOS

		
		Usuario::agregarCliente($usuario); 		//Se llama al modelo de cambiar contraseña
		$this->index(); //Vuelve al index del usuario
	}
}	

if (isset($_GET['action']))
{
	if($_GET['action']=='alta')
	{
		$controller= new AdministradorController();
		$controller->altaCliente();
	}
}
if (isset($_POST['action'])) {
	$controller= new AdministradorController();
	//Si la accion es alta_cliente
	if ($_POST['action']=='alta_cliente')
	{	
		//
		//
		//
		//Faltan todos los chequeos por parte de PHP


		require_once ($_SERVER['DOCUMENT_ROOT']."/hb/Models/Usuario.php");
		//Creo un usuario para agregarlo a la base de datos	
		$usuario= new Usuario(null,$_POST['nombre_cliente'],$_POST['apellido_cliente'],$_POST['nombre_usuario'],$_POST['clave_cliente'],$_POST['dni_cliente'],"comun",1);
			//Llamo al metodo cambiarContraseña de la clase del controller
		$controller->agregarCliente($usuario);
		
		//if()



	}
}
?>