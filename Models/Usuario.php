<?php

require_once('connection.php');

class Usuario
{

	public $id;
	public $nombre;
	public $apellido;
	public $nombre_usuario;
	public $clave;
	public $dni;
	public $tipo;
	public $cambio_clave;

	function __construct($id,$nombre,$apellido,$nombre_usuario,$clave,$dni,$tipo,$cambio_clave)
	{
		$this->id=$id;
		$this->nombre=$nombre;
		$this->apellido=$apellido;
		$this->nombre_usuario=$nombre_usuario;
		$this->clave=$clave;
		$this->dni=$dni;
		$this->tipo=$tipo;
		$this->cambio_clave=$cambio_clave;
	}

	public static function all()
	{
		$listaUsuarios= [];
		$db= Db::connect();
		$result= mysqli_query($db,"SELECT * FROM usuarios") or die('Query invalido: '.mysqli_error().'\n');
		//mysqli_free_result($result);
		while ($row=mysqli_fetch_array($result)) {
			$listaUsuarios= new Usuario($row['id'],$row['nombre'],$row['apellido'],$row['nombre_usuario'],$row['clave'],$row['dni'],$row['tipo'],$row['cambio_clave']);
		}
		return $listaUsuarios;
	}
}