<?php

require_once('../connection.php');

class Cuenta
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

	//Funcion que agrega una cuenta a la base de datos
	public static function agregarCuenta($cuenta)
	{
		$result= mysqli_query($cuenta->db,"INSERT INTO cuentas (id_usuario, nombre, alias, saldo, fecha_hora) VALUES ('$cuenta->id_usuario', '$cuenta->nombre', '$cuenta->alias', '$cuenta->saldo', '$cuenta->fecha_hora');");
	}

	//Funcion que chequea si el alias ya existe en la base de datos
	public static function existeCuentaAlias($cuenta)
	{
		$result= mysqli_query($cuenta->db,"SELECT * FROM cuentas WHERE alias='$cuenta->alias';");
		if (mysqli_num_rows($result)==0) 
		{
			return false;			
		}else
		{
			return true;
		}
	}
}

?>