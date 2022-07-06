
	<!--Mensaje de bienvenido PARA EL ADMINISTRADOR una vez se haya iniciado sesion correctamente -->
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
	
	<!--Chequeo para evitar accesos indebidos de un usuario a las funcionalidades del admin-->
<?php
	if($_SESSION['usuario']['tipo']!='empleado')
	{
		header("Location: /hb/Controllers/login_controller.php");
	} 
?>
<link rel="stylesheet" type="text/css" href="/hb/Styles/tablas.css">

	<h1>¡Bienvenido ADMINISTRADOR <?php echo $_SESSION['usuario']['nombre_usuario'] ?>!</h1>
	<h3>¿Que desea hacer?</h3>
	<a class= "button" href="administrador_controller.php?action=alta">Alta Cliente</a>
	<a class= "button" href="administrador_controller.php?action=verClientes">Ver clientes</a>
	<a class= "button" href="administrador_controller.php?action=verCuentasInactivas">Ver Cuentas Inactivas</a>