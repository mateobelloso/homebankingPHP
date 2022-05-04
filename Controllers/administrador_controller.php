<?php
/**
 * 
 */
class AdministradorController
{
	public function index()
	{	//Carga la vista de cambio de clave
		require_once('../Views/Administrador/index.php');
	}
	public function altaCliente()
	{	//Carga la vista de cambio de clave
		session_start();
		require_once('../Views/Administrador/altaCliente.php');
	}
	public function agregarCliente($usuario)
	{
		$existe= Usuario::existeUsuario($usuario);

		//vERIFICAR QUE EL USUARIO o EL DNI NO EXISTE EN LA BASE DE DATOS
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
	public function verClientes()
	{
		require_once('../Models/Usuario.php');
		$clientes= Usuario::listarClientes();
		require_once('../Views/Administrador/verClientes.php');
	}
	public function altaCuenta($id)
	{
		require_once('../Views/Administrador/altaCuenta.php');
	}
	public function agregarCuenta($cuenta)
	{
		//Si el alias existe en la base de datos
		if (Cuenta::existeCuentaAlias($cuenta)) 
		{
			$_SESSION['error-existe-alias']= "<p>El alias ya esta en uso </p>";	//Carga el error en SESSION
			header("Location: /hb/Views/Administrador/altaCuenta.php");	//Recarga la pagina del formulario
			exit;
		}else
		{
			Cuenta::agregarCuenta($cuenta);	//Agrega la cuenta a la base de datos
			$this->verClientes();	//Recarga la pagina a la tabla de los clientes	
		}
	}
}	

if (isset($_GET['action']))
{
	$controller= new AdministradorController();
	if($_GET['action']=='alta')
	{
		$controller->altaCliente();
	}else
	{
		if ($_GET['action']=='verClientes') {
			$controller->verClientes();
		}else
		{
			if ($_GET['action']=='agregarCuenta') {
				$controller->altaCuenta($_GET['id']);
			}
		}
	}
}
if (isset($_POST['action'])) 
{
	$controller= new AdministradorController();
	//Si la accion es alta_cliente
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
		if ($_POST['action']=='alta_cuenta')
		{
			session_start();
			chequeoAltaCuenta();	//Funcion que chequea el alta de una cuenta
			require_once($_SERVER['DOCUMENT_ROOT']."/hb/Models/Cuenta.php");
			$fecha= date('Y-m-d H:i:s');	//Formato datetime para la base de datos
			$cuenta= new Cuenta(null,$_POST['id'],$_POST['nombre-cuenta'],$_POST['alias'],0,$fecha);
			$controller->agregarCuenta($cuenta);	//Llama al metodo que se va a encargar de agregar la cuenta
		}
	}
}


	function chequeoAltaCliente()
	{
		$formatoNombre_Usuario="/[a-z0-9]{6,}/i";  //Formato Nombre de usuario
		$formatoDni_Cliente="/^\d{7,8}$/";//Formato DNI
		$formatoClave_Cliente="/(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/";//Formato contraseña
		$formatoNombreApe="/^[a-z]+(\s[a-z]+)*$/i";
		//Chequeo campos vacios
		if ($_POST['nombre_usuario']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campos vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;	
		}
		if($_POST['apellido_cliente']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campos vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;	
		}
		if($_POST['nombre_usuario']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campos vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		if($_POST['dni_cliente']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campos vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		if(($_POST['clave_cliente']==''))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campos vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		//Verifica que el nombre de usuario sea correcto
		if(!preg_match($formatoNombre_Usuario, $_POST['nombre_usuario']))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre,apellido,nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		if(!preg_match($formatoNombreApe, $_POST['nombre_cliente']))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre,apellido,nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		if(!preg_match($formatoNombreApe, $_POST['apellido_cliente']))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre,apellido,nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}

		//Verifica que el DNI cumpla con las condiciones
		if(!preg_match($formatoDni_Cliente, $_POST['dni_cliente']))
		{	
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre,apellido,nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}

		//Verifica que la contraseña este en el formato adecuado
		if(!preg_match($formatoClave_Cliente, $_POST['clave_cliente']))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre,apellido,nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
	}

	function chequeoAltaCuenta()
	{
		$regNombreCuenta= "/[^a-z]/i";	//Expresion regular del nombre de la cuenta
		$regAlias= "/[^a-z]/i";	//Expresion regular del alias

		$nombreCuenta= str_replace($regNombreCuenta,"",$_POST['nombre-cuenta']);
		$alias= str_replace($regAlias,"",$_POST['alias']);

		//Si el nombre de cuenta no cumple el formato
		if(strlen($nombreCuenta)<5)
		{
			$_SESSION['error-nombre-cuenta']= "<p> El nombre de la cuenta no puede estar vacio y debe contener por lo menos 5 caracteres alfabeticos</p>";	//Carga un error en SESSION
			header("Location: /hb/Views/Administrador/altaCuenta.php");	//Recarga la pagina del formulario
			exit;
		}

		//Si el alias no cumple el formato
		if (strlen($alias)<8) 
		{
			$_SESSION['error-alias']= "<p> El alias de la cuenta no puede estar vacio y debe contener por lo menos 8 caracteres alfabeticos</p>";	//Carga un error en SESSION
			header("Location: /hb/Views/Administrador/altaCuenta.php");	//Recarga la pagina del formulario
			exit;
		}

	}
?>
