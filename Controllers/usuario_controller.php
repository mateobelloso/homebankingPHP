<?php 

	require_once('Models/Usuario.php');

	class UsuarioController
	{	
		public function __construct(){}
 
		public function index(){
			$usuarios= Usuario::all();
			echo "Controlador";
			require_once('Views/index.php');
			//return $usuarios;
		}
 
		public function register(){
			echo 'register desde UsuarioConroller';
		}
 
		public function update(){
			echo 'update desde UsuarioConroller';
 
		}
 
		public function delete(){
			echo 'delete desde UsuarioConroller';
		}
		
		public function error(){
			require_once('Views/Usuario/error.php');
		} 
	}
?>