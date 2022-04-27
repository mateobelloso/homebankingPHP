<?php

require_once('../connection.php');

class Usuario
{

	public $id;
	public $id_usuario;
	public $nombre;
	public $alias;
	public $saldo;
	public $fecha_hora;

	private $db;

	function __construct($id,$id_usuario,$nombre,$alias,$saldo,$fecha_hora)
	{
		$this->id=$id;
		$this->id_usuario=$id_usuario;
		$this->nombre=$nombre;
		$this->alias=$alias;
		$this->saldo=$saldo;
		$this->fecha_hora=$fecha_hora;
		$this->db= Db::connect();
	}

	public static function agregarCuenta($usuario)
	{

	}
}

?>