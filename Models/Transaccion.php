<?php

require_once('../connection.php');

class Transaccion
{

	public $id;
	public $id_cuenta_origen;
	public $id_cuenta_destino;
	public $tipo;
	public $monto;
	public $fecha_hora;

	private $db;

	function __construct($id,$id_cuenta_origen,$id_cuenta_destino,$tipo,$monto,$fecha_hora)
	{
		$this->id=$id;
		$this->id_cuenta_origen= $id_cuenta_origen;
		$this->id_cuenta_destino= $id_cuenta_destino;
		$this->tipo= $tipo;
		$this->monto= $monto;
		$this->fecha_hora=$fecha_hora;
		$this->db= Db::connect();
	}

	//Funcion que agrega una transaccion de tipo deposito a la base de datos
	public static function agregarDeposito($transaccion)
	{
		$result= mysqli_query($transaccion->db,"INSERT INTO transacciones (id, id_cuenta_origen, id_cuenta_destino, tipo, monto, fecha_hora) VALUES (NULL, NULL, '$transaccion->id_cuenta_destino', 'deposito', '$transaccion->monto', '$transaccion->fecha_hora');");
		Cuenta::actualizarSaldo($transaccion->id_cuenta_destino,$transaccion->monto);
	}
}

?>