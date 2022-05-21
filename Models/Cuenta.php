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

	//Fucion que retorna una lista de las cuentas del cliente pasado como parametro el id del cliente
	public static function listarCuentasDeCliente($id)
	{
		$db= Db::connect();
		$listaCuentas= [];
		$result= mysqli_query($db,"SELECT * FROM cuentas WHERE id_usuario = '$id'");
		while($row=mysqli_fetch_array($result))
		{
			$listaCuentas[]= new Cuenta($row['id'],$row['id_usuario'],$row['nombre'],$row['alias'],$row['saldo'],$row['fecha_hora']);
		}
		return $listaCuentas;
	}

	public static function actualizarSaldo($idCuenta,$monto)
	{
		$db= Db::connect();
		$result= mysqli_query($db,"UPDATE cuentas SET saldo = saldo + '$monto' WHERE cuentas.id = '$idCuenta';");
	}

	//Obtiene el id de un cliente a traves de un id de una cuenta pasado como parametro
	public static function obtenerIdCliente($idCuenta)
	{
		$db= Db::connect();
		$result= mysqli_query($db,"SELECT id_usuario FROM cuentas WHERE id = '$idCuenta'");
		$result= mysqli_fetch_array($result);
		return $result['id_usuario'];
	}
}

?>