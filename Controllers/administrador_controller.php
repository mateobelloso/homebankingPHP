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
}	

if (isset($_GET['action']))
{
	if($_GET['action']=='alta')
	{
		$controller= new AdministradorController();
		$controller->altaCliente();
	}
}
?>