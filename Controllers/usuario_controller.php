<?php 

	require_once('Models/Usuario.php');

	class UsuarioController
	{	
		public function __construct(){}
 
		public function index(){
			require_once('Views/index.php');
			//return $usuarios;
		}

		public function sesion($usuario)
		{



		}
 		public function login($usuario)
		{
		if (isset($_POST['action'])) {
			$controller= new UsuarioController();
			if($_POST['action']=='sesion')
			{
				$usuario= new Usuario(null,$_POST['usuario'],$_POST['contraseña'],null,null,null,null,null);
				$controller->sesion($usuario);
			}
		}
		
	}
}

	// if (isset($_POST['action'])) {
	// 	$controller= new UsuarioController();
	// 	if($_POST['action']=='sesion')
	// 	{
	// 		$usuario= new Usuario(null,$_POST['usuario'],$_POST['contraseña'],null,null,null,null,null);
	// 		$controller->sesion($usuario);
	// 	}
	// }
?>