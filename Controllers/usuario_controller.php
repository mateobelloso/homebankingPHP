<?php 
	class UsuarioController
	{	
		public function __construct(){}
 
		public function index(){
			echo 'index desde UsuarioController';
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