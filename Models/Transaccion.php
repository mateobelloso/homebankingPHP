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

	public static function listarHistorialCuenta($idCuenta)
	{
		$db= Db::connect();
		$listaHistorial= [];
		$result= mysqli_query($db,"SELECT t.fecha_hora as fechaTransaccion, cor.nombre as nombreCuentaOrigen, uor.nombre as nombreOrigen, uor.apellido as apellidoOrigen, t.tipo as tipo, cde.nombre as nombreCuentaDestino, ude.nombre as nombreDestino, ude.apellido as apellidoDestino, t.monto as monto FROM transacciones t INNER JOIN cuentas cor ON t.id_cuenta_origen = cor.id INNER JOIN cuentas cde ON t.id_cuenta_destino = cde.id INNER JOIN usuarios uor ON cor.id_usuario = uor.id INNER JOIN usuarios ude ON cde.id_usuario = ude.id WHERE cor.id = '$idCuenta' OR cde.id= '$idCuenta';");
		while ($row= mysqli_fetch_array($result)) 
		{	
			$listaHistorial[]= array('fechaTransaccion' => $row['fechaTransaccion'],'nombreCuentaOrigen' => $row['nombreCuentaOrigen'],'nombreOrigen' => $row['nombreOrigen'],'apellidoOrigen' => $row['apellidoOrigen'],'tipo' => $row['tipo'],'nombreCuentaDestino' => $row['nombreCuentaDestino'],'nombreDestino' => $row['nombreDestino'],'apellidoDestino' => $row['apellidoDestino'], 'monto' => $row['monto']);
		}
		return $listaHistorial;
	}
}

?>