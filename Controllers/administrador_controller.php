<?php
/****************************************************
 * Se definen las funcionalidades del administrador
 ***************************************************/
class AdministradorController
{
	public function index()
	{	//Carga la vista de cambio de clave
		require_once('../Views/Administrador/index.php');
	}

	/******************************
	 * Carga la vista para el alta del cliente
	 ******************************/
	public function altaCliente()
	{	
		session_start();
		require_once('../Views/Administrador/altaCliente.php');
	}

	/******************************************************************
	 * Funcion para agregar clientes verficando que el usuario no exista
	********************************************************************/
	public function agregarCliente($usuario)
	{
		$existe= Usuario::existeUsuario($usuario);
		//VERIFICAR QUE EL USUARIO o EL DNI NO EXISTE EN LA BASE DE DATOS
		if($existe==Usuario::NO_EXISTE_USUARIO)
		{
			Usuario::agregarCliente($usuario); 		//Se llama al modelo de cambiar contraseña
			$this->index(); //Vuelve al index del usuario
		}else
		{
			if($existe==Usuario::EXISTE_NOMBRE_USUARIO)
			{
				$_SESSION['error-alta-cliente']="<p>Error el nombre de usuario ya existe</p>";
				header("Location: /hb/Views/Administrador/altaCliente.php");
				exit;
			}else
			{
				$_SESSION['error-alta-cliente']="<p>Error el DNI ya existe</p>";
				header("Location: /hb/Views/Administrador/altaCliente.php");
				exit;
			}
		}
	}
	/*************************************************************
	*Funcion que carga la vista para visulizar la lista de clientes
	****************************************************************/
	public function verClientes()
	{
		require_once('../Models/Usuario.php');
		$clientes= Usuario::listarClientes();
		require_once('../Views/Administrador/verClientes.php');
	}
	/*************************************************************
	*Funcion que carga la vista para visulizar las cuentas de los clientes
	****************************************************************/
	public function verCuentas($id)
	{
		require_once('../Models/Cuenta.php');
		$cuentas= Cuenta::listarCuentasDeCliente($id);
		require_once('../Views/Administrador/verCuentas.php');
	}
	/*************************************************************
	*Funcion que carga la vista para visulizar el deposito de sueldo
	****************************************************************/
	public function depositarSueldo($idCuentaDestino)
	{
		//AGREGAR VALIDACION DE ID!!!!!!!
		if(empty($idCuentaDestino))
		{
			header("Location: /hb/Controllers/administrador_controller.php?action=verClientes");
			exit;
		}
		require_once('../Views/Administrador/depositarSueldo.php');
	}
	/*************************************************************
	*Funcion que realiza el deposito del sueldo
	****************************************************************/
	public function realizarDeposito($transaccion)
	{
		require_once('../Models/Cuenta.php');
		Transaccion::agregarDeposito($transaccion);
		$this->verCuentas(Cuenta::obtenerIdCliente($transaccion->id_cuenta_destino));
	}
	/**********************************
	*Carga la vista del alta de cuenta
	***********************************/
	public function altaCuenta($id)
	{
		if(empty($id))
		{
			header("Location: /hb/Controllers/administrador_controller.php?action=verClientes");
			exit;
		}
		require_once('../Views/Administrador/altaCuenta.php');
	}

	/*******************************************************************************************
	*Funcion para agregar una cuenta a un cliente, verificando que no exista otra cuenta con ese alias
	*********************************************************************************************/
	public function agregarCuenta($cuenta)
	{
		//Si el alias existe en la base de datos
		if (Cuenta::existeCuentaAlias($cuenta)) 
		{
			$_SESSION['error-existe-alias']= "<p>El alias ya esta en uso </p>";	//Carga el error en SESSION
			header("Location: /hb/controllers/administrador_controller.php?action=agregarCuenta&id=".$cuenta->id_usuario);	//Recarga la pagina del formulario
			exit;
		}else
		{
			Cuenta::agregarCuenta($cuenta);	//Agrega la cuenta a la base de datos
			$this->verClientes();	//Recarga la pagina a la tabla de los clientes	
		}
	}
}	


/*******************************************************************************************
*Chequeo de si se accedio al archivo con un pedido de GET(Pedido por URL), en caso afirmativo verifica que accion se desea realizar
*********************************************************************************************/
if (isset($_GET['action']))
{
	$controller= new AdministradorController();
	if($_GET['action']=='alta') //Accion de altaCliente
	{
		$controller->altaCliente();
	}else
	{
		if ($_GET['action']=='verClientes')	//Accion de ver los clientes
		{
			$controller->verClientes();
		}else
		{
			if ($_GET['action']=='agregarCuenta') //Accion de agregar una cuenta
			{
				$controller->altaCuenta($_GET['id']);
			}
			else
			{
				if ($_GET['action']=='verCuentas')//Accion de ver las cuentas de los clientes
				{
					$controller->verCuentas($_GET['id']);
				}
				else
				{
					if ($_GET['action']=='depositarSueldo') //Accion de depostitar el sueldo a un cliente
					{
						$controller->depositarSueldo($_GET['id']);
					}
				}
			}
		}
	}
}
/*******************************************************************************************
*Chequeo de si se accedio al archivo con un pedido de POST(pedido de formulario), en caso afirmativo verifica que accion se desea realizar
*********************************************************************************************/
if (isset($_POST['action'])) 
{
	$controller= new AdministradorController();
	//Si la accion es alta_cliente
	/*
	Recibe el alta de un cliente por formulario
	*/
	if ($_POST['action']=='alta_cliente')	
	{	
		session_start();
		chequeoAltaCliente();	//Funcion que chequea el alta cliente
		require_once ($_SERVER['DOCUMENT_ROOT']."/hb/Models/Usuario.php");
		//Creo un usuario para agregarlo a la base de datos	
		$usuario= new Usuario(null,$_POST['nombre_cliente'],$_POST['apellido_cliente'],$_POST['nombre_usuario'],$_POST['clave_cliente'], $_POST['dni_cliente'],"comun",1);
		//Llamo al metodo cambiarContraseña de la clase del controller
		$controller->agregarCliente($usuario);
	}else
	{
		/*
		Recibe el alta de una cuenta por formulario 
		*/
		if ($_POST['action']=='alta_cuenta')	
		{
			session_start();
			chequeoAltaCuenta();	//Funcion que chequea el alta de una cuenta
			require_once($_SERVER['DOCUMENT_ROOT']."/hb/Models/Cuenta.php");
			$fecha= date('Y-m-d H:i:s');	//Formato datetime para la base de datos
			$cuenta= new Cuenta(null,$_POST['id'],$_POST['nombre-cuenta'],$_POST['alias'],0,$fecha);
			$controller->agregarCuenta($cuenta);	//Llama al metodo que se va a encargar de agregar la cuenta
		}else
		{
			/*
			*Recibe el formulario de depositar sueldo
			*/ 
			if ($_POST['action']=='deposito_sueldo')
			{
				session_start();
				chequeoDepositoSueldo(); //Funcion que chequea el deposito de sueldo
				require_once($_SERVER['DOCUMENT_ROOT']."/hb/Models/Transaccion.php");
				$transaccion=new Transaccion(null,null,$_POST['id_cuenta_destino'],'deposito',$_POST['monto'],date('Y-m-d H:i:s'));
				$controller->realizarDeposito($transaccion);
			}
		}
	}
}

	/***************************************************
	*Chequeo por parte del servidor del alta de un cliente
	***************************************************/
	function chequeoAltaCliente()
	{
		$formatoNombre_Usuario="/[a-z0-9]{6,}/i";  //Formato Nombre de usuario
		$formatoDni_Cliente="/^\d{7,8}$/";//Formato DNI
		$formatoClave_Cliente="/(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/";//Formato contraseña
		$formatoNombreApe="/^[a-z]+(\s[a-z]+)*$/i";
		$error=0; //Verifica si se produce algun error
		//Chequeo campos vacios
		if ($_POST['nombre_cliente']=='')
		{
			$_SESSION['error-alta-cliente-nombre-vacio']= "<p>Error en el campo nombre, no puede estar vacio</p>";
			$error=1;	
		}
		if($_POST['apellido_cliente']=='')
		{
			$_SESSION['error-alta-cliente-apellido-vacio']= "<p>Error en el campo apellido, no puede estar vacio</p>";
			$error=1;	
		}
		if($_POST['nombre_usuario']=='')
		{
			$_SESSION['error-alta-cliente-nombre_usuario-vacio']= "<p>Error en el campo nombre de usuario, no puede estar vacio</p>";
			$error=1;	
		}
		if($_POST['dni_cliente']=='')
		{
			$_SESSION['error-alta-cliente-dni-vacio']= "<p>Error en el campo dni, no puede estar vacio</p>";
			$error=1;	
		}
		if(($_POST['clave_cliente']==''))
		{
			$_SESSION['error-alta-cliente-clave-vacio']= "<p>Error en el campo clave, no puede estar vacio</p>";
			$error=1;	
		}

		//Verifica que el nombre de usuario sea correcto
		if(!preg_match($formatoNombre_Usuario, $_POST['nombre_usuario']))
		{ 
			$_SESSION['error-alta-cliente-formato-nombre']= "<p>Error de formato en el campo nombre de usuario, debe contener por lo menos 6 caracteres y que sean alfanumericos</p>";
			$error=1;	
		}
		if(!preg_match($formatoNombreApe, $_POST['nombre_cliente']))
		{
			$_SESSION['error-alta-cliente-formato-nombre_cliente']= "<p>Error de formato en el campo nombre del cliente, el nombre contiene caracteres que no son alfabéticos </p>";
			$error=1;	
		}
		if(!preg_match($formatoNombreApe, $_POST['apellido_cliente']))
		{
			$_SESSION['error-alta-cliente-formato-apellido']= "<p>Error de formato en el campo apellido, el apellido contiene caracteres que no son alfabéticos </p>";
			$error=1;	
		}

		//Verifica que el DNI cumpla con las condiciones
		if(!preg_match($formatoDni_Cliente, $_POST['dni_cliente']))
		{	
			$_SESSION['error-alta-cliente-formato-dni']= "<p>Error de formato en el campo DNI, el debe solo debe contener entre 7 y 8 caracteres numericos</p>";
			$error=1;	
		}

		//Verifica que la contraseña este en el formato adecuado
		if(!preg_match($formatoClave_Cliente, $_POST['clave_cliente']))
		{
			$_SESSION['error-alta-cliente-formato-clave']= "<p>Error de formato en el campo contraseña, la contraseña debe contener al menos 6 caracteres, mayusculas y minusculas, por lo menos un simbolo y un numero </p>";
			$error=1;	
		}
		if ($error)
		{
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}

	}
	/*********************************************************************
	*Chequeo por parte del servidor del alta de una cuenta para un cliente
	**********************************************************************/
	function chequeoAltaCuenta()
	{
		$regNombreCuenta= "/[^a-z]/i";	//Expresion regular del nombre de la cuenta
		$regAlias= "/[^a-z]/i";	//Expresion regular del alias

		$id= isset($_POST['id']) ? $_POST['id'] : "";

		$nombreCuenta= preg_replace($regNombreCuenta,"",$_POST['nombre-cuenta']);
		$alias= preg_replace($regAlias,"",$_POST['alias']);
		$error=0; 
		//Si el nombre de cuenta no cumple el formato
		if(strlen($nombreCuenta)<5)
		{
			$_SESSION['error-nombre-cuenta']= "<p> El nombre de la cuenta no puede estar vacio y debe contener por lo menos 5 caracteres alfabeticos</p>";	//Carga un error en SESSION		
			$error=1;	
		}
		//Si no hay ningun id de cliente
		if (strlen($id)==0) {
			$_SESSION['error-no-hay-id']= "<p> Se produjo un error. Intente nuevamente</p>";
			$error= 1;
		}

		//Si el alias no cumple el formato
		if (strlen($alias)<8) 
		{
			$_SESSION['error-alias']= "<p> El alias de la cuenta no puede estar vacio y debe contener por lo menos 8 caracteres alfabeticos</p>";	//Carga un error en SESSION
			$error=1;
		}
		if ($error)//Si se produce un error recarga el formulario par ael alta de una cuenta
		{
			if(strlen($id)!=0)
			{
				var_dump($id);
				header("Location: /hb/Views/Administrador/altaCuenta.php?action=agregarCuenta&id=".$id);	//Recarga la pagina del formulario
				exit;
			}else
			{
				header("Location: /hb/Controllers/administrador_controller.php?action=verClientes");
				exit;
			}
		}

	}
	/*********************************************************************
	*Chequo por parte del servidor del deposito de sueldo, debe ser mayor a 0
	**********************************************************************/
	function chequeoDepositoSueldo()
	{
		//AGREGAR QUE LLEGA UN ID!!!!
		$id= isset($_POST['id_cuenta_destino']) ? $_POST['id_cuenta_destino'] : "";

		if (strlen($id)) 
		{
			header("Location: /hb/Controllers/administrador_controller.php?action=verClientes");
			exit;
		}

		if ($_POST['monto'] <= 0) 
		{
			$_SESSION['error-monto']= "<p>El monto debe ser mayor que cero.</p>";
			header("Location: /hb/Controllers/administrador_controller.php?action=depositarSueldo&id=".$_POST['id_cuenta_destino']);
			exit;
		}
	}
?>
