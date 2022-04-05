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


}
?>

