<?php

class LoginController()
{
	public function __construct()
	{}

	public function autenticacion($usuario)
	{

	}
}


if (issset($_FORM['action'])) {
		$controller= new LoginController();
		if($form['action']=='autenticacion')
		{
			$usuario= new Usuario(null,$_POST['usuario'],$_POST['contraseña'],null,null,null,null,null);
			$controller->autenticacion($usuario);
		}
}