<?php

require_once('../connection.php');

class Usuario
{

	const NO_EXISTE_USUARIO= 1;
	const EXISTE_NOMBRE_USUARIO= 2;
	const EXISTE_DNI= 3;

	public $id;
	public $nombre;
	public $apellido;
	public $nombre_usuario;
	public $clave;
	public $dni;
	public $tipo;
	public $cambio_clave;

	private $db;

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
		$this->db= Db::connect();
	}

	public static function listarClientes()
	{
		$listaUsuarios= [];
		$db= Db::connect();
		$result= mysqli_query($db,"SELECT * FROM usuarios WHERE tipo='comun'");
		//mysqli_free_result($result);
		while ($row=mysqli_fetch_array($result)) {
			$listaUsuarios[]= new Usuario($row['id'],$row['nombre'],$row['apellido'],$row['nombre_usuario'],$row['clave'],$row['dni'],$row['tipo'],$row['cambio_clave']);
		}
		return $listaUsuarios;
	}

	public static function autenticacionInicioSesion($usuario)
	{
		//$db= Db::connect();
		$result= mysqli_query($usuario->db,"SELECT * FROM usuarios 
			WHERE
			(nombre_usuario='$usuario->nombre_usuario') AND (clave='$usuario->clave')");
		$result= mysqli_fetch_object($result);

		if ($result!=null){
			return new Usuario($result->id,$result->nombre,$result->apellido,$result->nombre_usuario,$result->clave,$result->dni,$result->tipo,$result->cambio_clave);
		}
		return null;
	}
	// Funcion que actualiza la clave una vez se valido el formulario de cambio de contraseña
	public static function cambiarContraseña($usuario)
	{
		//$db= Db::connect();
		if(!mysqli_query($usuario->db,"UPDATE usuarios SET clave = '$usuario->clave', cambio_clave = '$usuario->cambio_clave' WHERE usuarios.id = '$usuario->id'"))
		{
			echo "Error en base de datos al actualizar contraseña";
		}
	}
	public static function agregarCliente($usuario)
	{
		
		$sqlAgregar = mysqli_query( $usuario->db,"INSERT INTO usuarios (nombre, apellido, nombre_usuario, clave, dni, tipo, cambio_clave) VALUES ('$usuario->nombre','$usuario->apellido','$usuario->nombre_usuario','$usuario->clave','$usuario->dni','$usuario->tipo','$usuario->cambio_clave')");
		if(!$sqlAgregar)
		{
			echo "Error en base de datos al Agregar";
		}

	}
	public static function existeUsuario($usuario)
	{
		//VERIIFICA EN LA BASE DE DATOS QUE NO EXISTA UN USUARIO CON EL MISMO NOMBRE DE USUARIO O DNI
		$sqlnombreusuarioExiste= mysqli_query( $usuario->db, "SELECT * FROM usuarios
												WHERE 
												nombre_usuario= '$usuario->nombre_usuario' ");
		

		//Preguntar
		$sqlnombreusuarioExiste= mysqli_fetch_object($sqlnombreusuarioExiste);


		if($sqlnombreusuarioExiste != null)
		{
			return Usuario::EXISTE_NOMBRE_USUARIO;	//EL USUARIO YA EXISTE
		}

		$sqldniExiste= mysqli_query( $usuario->db, "SELECT * FROM usuarios
												WHERE 
												dni= '$usuario->dni' ");
		$sqldniExiste= mysqli_fetch_object($sqldniExiste);
		if ($sqldniExiste!=null) {
			return Usuario::EXISTE_DNI;	//EL DNI YA EXISTE
		}else
		{
			return Usuario::NO_EXISTE_USUARIO;	//NO EXISTE EL DNI NI EL USUARIO
		}


	}
}