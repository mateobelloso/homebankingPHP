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
	/***********
	*Constructor de cuenta (Modelo de la base de datos)
	************/ 
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
	/*Actualiza el saldo de una cuenta en la base de datos*/
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

	public static function obtenerCuenta($alias)
	{
		$db= Db::connect();
		$result= mysqli_query($db,"SELECT * FROM cuentas WHERE alias = '$alias'");
		if(mysqli_num_rows($result) != 0)
		{
			$result= mysqli_fetch_array($result);
			$cuenta= new Cuenta($result['id'],$result['id_usuario'],$result['nombre'],$result['alias'],$result['saldo'],$result['fecha_hora']);
			return $cuenta;
		}else
		{
			return null;
		}
	}

	public static function obtenerCuentaPorId($id)
	{
		$db= Db::connect();
		$result= mysqli_query($db,"SELECT * FROM cuentas WHERE id = '$id'");
		if(mysqli_num_rows($result) != 0)
		{
			$result= mysqli_fetch_array($result);
			$cuenta= new Cuenta($result['id'],$result['id_usuario'],$result['nombre'],$result['alias'],$result['saldo'],$result['fecha_hora']);
			return $cuenta;
		}else
		{
			return null;
		}
	}

	public static function obtenerSaldo($id)
	{
		$db= Db::connect();
		$result= mysqli_query($db,"SELECT saldo FROM cuentas WHERE id = '$id'");
		$result= mysqli_fetch_array($result);
		return $result['saldo'];
	}

	public static function ObtenerTodasLasCuentas()
	{
		$db= Db::connect();
		$listaCuentas= [];
		$result= mysqli_query($db,"SELECT * FROM cuentas");
		while($row=mysqli_fetch_array($result))
		{
			$listaCuentas[]= new Cuenta($row['id'],$row['id_usuario'],$row['nombre'],$row['alias'],$row['saldo'],$row['fecha_hora']);
		}
		return $listaCuentas;
	}

	//IDEA DE LA FUNCION PRIMERO OBTENGO TODAS LAS CUENTAS ACTIVAS CON UNA SENTENCIA SQL, DESPUES OBTENGO TODAS LAS CUENTAS QUE EXISTEN, Y POR ULTIMO RECORRO EL LISTADO CON TODAS LAS CUENTAS QUE EXISTEN Y VOY PREGUNTANDO SI ESA CUENTA NO SE ENCUENTRA EN EL LISTADO DE CUENTAS ACTIVAS, SI NO SE ENCUENTRA LO AGREGO EN LA LISTA DE CUENTAS INACTIVAS. POR ULTIMO RETORNO ESE LISTADO DE CUENTAS INACTIVAS
 	public static function verCuentasAntiguas ()
  	{	
 		$db= Db::connect();
 		$listaCuentasInactivas= [];
 		$listaCuentasActivas= [];
 		$fechaActual= date('Y-m-d H:i:s');
 		$fecha_antigua= date('Y-m-d H:i:s',strtotime($fechaActual."- 3 month"));
 		$result= mysqli_query($db,"SELECT DISTINCT c.id as id, c.id_usuario as id_usuario, c.nombre as nombre, c.alias as alias, c.saldo as saldo, c.fecha_hora as fecha_hora
 									FROM cuentas c
 									INNER JOIN transacciones tor ON tor.id_cuenta_origen = c.id
 									WHERE tor.fecha_hora > '$fecha_antigua'
 									UNION
 									SELECT DISTINCT c.id as id, c.id_usuario as id_usuario, c.nombre as nombre, c.alias as alias, c.saldo as saldo, c.fecha_hora as fecha_hora
 									FROM cuentas c
 									INNER JOIN transacciones tde ON tde.id_cuenta_destino = c.id
 									WHERE tde.fecha_hora > '$fecha_antigua'");
 		while($row=mysqli_fetch_array($result))
 		{
 			$listaCuentasActivas[]= new Cuenta($row['id'],$row['id_usuario'],$row['nombre'],$row['alias'],$row['saldo'],$row['fecha_hora']);
 		}
 		$listaCuentas = Cuenta::ObtenerTodasLasCuentas();
 		foreach ($listaCuentas as $cuenta) 
 		{
 			if(!in_array($cuenta, $listaCuentasActivas))
 			{
 				$listaCuentasInactivas[]= $cuenta;
 			}
 		}

 		return $listaCuentasInactivas;

 	}

 	public static function eliminarCuenta($id)
 	{
 		$db= Db::connect();
 		$result= mysqli_query($db,"SELECT * FROM cuentas WHERE id = '$id'");
 		$result= mysqli_fetch_array($result);
 		if($result != null)
 		{
 			require_once('Transaccion.php');
 			Transaccion::eliminarTransacciones($id);
 			$result= mysqli_query($db,"DELETE FROM cuentas WHERE id = '$id'");
 			return 1;
 		}else
 		{
 			return null;
 		}
 	}
}

?>