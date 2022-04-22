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

		//vERIFICAR QUE EL USUARIO NO EXISTE EN LA BASE DE DATOS
		if(!Usuario::existeUsuario($usuario))
		{
			Usuario::agregarCliente($usuario); 		//Se llama al modelo de cambiar contraseña
			$this->index(); //Vuelve al index del usuario
		}else
		{
			$_SESSION['error-alta-cliente']="<p>Error el nombre de usuario ya existe</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");
			exit;
		}
	}
}	

if (isset($_GET['action']))
{
	if($_GET['action']=='alta')
	{
		$controller= new AdministradorController();
		$controller->altaCliente();
	}
}
if (isset($_POST['action'])) 
{
	$controller= new AdministradorController();
	//Si la accion es alta_cliente
	if ($_POST['action']=='alta_cliente')
	{	
		session_start();
		$formatoNombre_Usuario="/[a-z0-9]{6,}/i";  //Formato Nombre de usuario
		$formatoDni_Cliente="/^\d{7,8}$/";//Formato DNI
		$formatoClave_Cliente="/(?=.*[\W|\d_])(?=.*[a-z])(?=.*[A-Z]).{6,}/";//Formato contraseña

		//Chequeo campos vacios
		if ($_POST['nombre_usuario']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campo vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;	
		}
		if($_POST['apellido_cliente']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campo vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;	
		}
		if($_POST['nombre_usuario']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campo vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		if($_POST['dni_cliente']=='')
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campo vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		if(($_POST['clave_cliente']==''))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de campo vacio</p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		//Verifica que el nombre de usuario sea correcto
		if(!preg_match($formatoNombre_Usuario, $_POST['nombre_usuario']))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}

		//Verifica que el DNI cumpla con las condiciones
		if(!preg_match($formatoDni_Cliente, $_POST['dni_cliente']))
		{	
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}

		//Verifica que la contraseña este en el formato adecuado
		if(!preg_match($formatoClave_Cliente, $_POST['clave_cliente']))
		{
			$_SESSION['error-alta-cliente']= "<p>Error de formato de nombre usuario, DNI o contraseña </p>";
			header("Location: /hb/Views/Administrador/altaCliente.php");//imprimir y borrar el error en la vista
			exit;
		}
		require_once ($_SERVER['DOCUMENT_ROOT']."/hb/Models/Usuario.php");
		//Creo un usuario para agregarlo a la base de datos	
		$usuario= new Usuario(null,$_POST['nombre_cliente'],$_POST['apellido_cliente'],$_POST['nombre_usuario'],$_POST['clave_cliente'], $_POST['dni_cliente'],"comun",1);
		//Llamo al metodo cambiarContraseña de la clase del controller
		$controller->agregarCliente($usuario);
	}
}
?>
