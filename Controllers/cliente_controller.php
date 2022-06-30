<?php
/**
 * 
 */
class ClienteController 
{
	
	public function __construct()
	{
	}
	/********************************************
	* Carga la vista de las cuentas de los clientes
	****************************************/
	public function index()
	{
		//Carga la vista 
		require_once('../Models/Cuenta.php');
		$cuentas= Cuenta::listarCuentasDeCliente($_SESSION['usuario']['id']);
		require_once("../Views/Cliente/index.php");
	}
	public function cambioClave()
	{	//Carga la vista de cambio de clave
		require_once('../Views/Cliente/cambioClave.php');
	}
	
	/********************************************
	* Cambia la contraseñadel cliente verificando que no ingrese la misma que la actual o que las contraseñas no coincidan
	****************************************/
	public function cambiarContraseña($usuario,$contraseñaActual)
	{
		require_once('../Models/Usuario.php');
		session_start();
		//Si la contraseña actual ingresada es igual a la del usuario activo realizo la actualizacion de contraseña
		if($contraseñaActual === $_SESSION['usuario']['clave'])
		{
			$_SESSION['usuario']['cambio_clave']= 0;		//Se cambia el valor de cambio de clave una vez se actualizo
			$usuario->cambio_clave= 0;
			$usuario->id= $_SESSION['usuario']['id'];
			Usuario::cambiarContraseña($usuario); 	//Se llama al modelo de cambiar contraseña
			$this->index(); //Vuelve al index del usuario
		}else
		{
			//La contraseña actual no coincide
			require_once('../Views/Cliente/cambioClave.php');
			echo "<script> mensajeErrorContraseñaIncorrecta() </script>";
		}
	}

	public function verHistorial($idCuenta)
	{
		require_once('../Models/Transaccion.php');
		$movimientos= Transaccion::listarHistorialCuenta($idCuenta);
		require_once('../Views/Cliente/verHistorial.php');
	}

	//VISTA DE REALIZAR UNA TRANSFERENCIA
	public function transferencia()
	{
		require_once('../Models/Cuenta.php');
		$misCuentas= Cuenta::listarCuentasDeCliente($_SESSION['usuario']['id']);
		require_once('../Views/Cliente/transferencia.php');
	}

	public function hacerTransferencia($idCuentaOrigen,$aliasDestino,$monto)
	{
		require_once('../Models/Cuenta.php');
		$cuentaDestino= Cuenta::obtenerCuenta($aliasDestino);
		if ($cuentaDestino != null)
		{
			require_once('../Models/Transaccion.php');
			$fecha= date('Y-m-d H:i:s');
			$transferencia= new Transaccion(NULL,$idCuentaOrigen,$cuentaDestino->id,'transferencia',$monto,$fecha);
			Transaccion::agregarTransferencia($transferencia);
			$_SESSION['transferencia-exitosa']= "<p>Su transferencia se realizo correctamente</p>";
			$this->index();
		}else
		{
			$_SESSION['error-alias-no-existe']= "<p>El alias al que desea transferir no existe.</p>";
			header("Location: /hb/Controllers/cliente_controller.php?action=hacerTransferencia");
			exit;
		}
	}


}

//Si me mandaron una accion desde el metodo post
if (isset($_POST['action'])) {
	$controller= new ClienteController();
	//Si la accion es cambio de password
	if ($_POST['action']=='cambio-password')
	{
		//Pregunto si el campo de contraseña actual y contraseña nueva no estan vacios y ademas si las dos contraseñas nuevas coinciden
		$formatoContraseña= "/(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/";
		if(($_POST['contrasena-actual']!="") && ($_POST['contrasena-nueva']!="") && ($_POST['contrasena-nueva'] === $_POST['contrasena-nueva2']) && (preg_match($formatoContraseña, $_POST['contrasena-nueva'])))
		{
			require_once("../Models/Usuario.php");
			//Creo un usuario con la nueva clave que se quiere guardar
			$usuario= new Usuario(null,null,null,null,$_POST['contrasena-nueva'],null,null,null);
			//Llamo al metodo cambiarContraseña de la clase del controller
			$controller->cambiarContraseña($usuario,$_POST['contrasena-actual']);
		}else
		{
			//Algun campo esta vacio o las dos contraseñas no son iguales
			session_start();
			$_SESSION['error-cambio-clave']= "<p>El campo de contraseña actual no puede estar vacio y las contraseñas deben ser iguales y cumplir el formato de contener por lo menos una letra mayuscula, una letra minuscula y un numero o caracter especial</p>";
			header('Location: ../Views/Cliente/cambioClave.php');
			exit;
		}
	}else
	{
		if ($_POST['action'] == 'hacer-transferencia')
		{
			session_start();
			//Me quedo solo con el id de la cuenta origen del campo select del formulario
			$idCuentaOrigen= explode(" ", $_POST['misCuentas'])[0];
			chequeoCamposTransferencia($idCuentaOrigen);
			$controller->hacerTransferencia($_POST['misCuentas'],$_POST['alias-destino'],$_POST['monto']);
		}
	}
}
/***************
*Si se envio el pedido por url (Ver historial)
*/
if (isset($_GET['action'])) 
{
	$controller= new ClienteController();
	if ($_GET['action'] == 'verHistorial') 
	{
		session_start();
		$controller->verHistorial($_GET['id']);
	}else
	{
		if ($_GET['action'] == 'hacerTransferencia') 
		{
			session_start();
			$controller->transferencia();
		}
	}
}

function chequeoCamposTransferencia($idCuentaOrigen)
{
	$error= false;

	if (!strlen($_POST['alias-destino']))
	{
		$_SESSION['error-alias-vacio']= "<p>El campo de alias destino no puede estar vacio </p>";
		$error= true;
	}

	if ($_POST['monto'] <= 0)
	{
		$_SESSION['error-monto-invalido']= "<p>El monto a transferir tiene que ser mayor a 0<p>";
		$error= true;
	}

	require_once('../Models/Cuenta.php');
	if ($_POST['monto'] > Cuenta::obtenerSaldo($idCuentaOrigen))
	{
		$_SESSION['error-saldo-insuficiente']= "<p>El saldo de su cuenta es insuficiente para el monto que desea transferir</p>";
		$error= true;
	}

	if($error)
	{
		header("Location: /hb/Controllers/cliente_controller.php?action=hacerTransferencia");
		exit;
	}
}
?>