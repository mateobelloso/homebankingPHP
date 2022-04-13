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
	public function cambiarContraseña()
	{
		require_once('../Models/Usuario.php');
		echo "Llegue aca";
	}


}


if (isset($_POST['action'])) {
	$controller= new ClienteController();
	if ($_POST['action']=='cambio-password') {
		$controller->cambiarContraseña();
	}
}
?>

