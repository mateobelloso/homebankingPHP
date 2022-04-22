<html>
<head>
	<!--link rel="stylesheet" href="../Views/styles.css"-->
</head>
<body>
	<!--Mensaje de bienvenido PARA EL CLIENTE una vez se haya iniciado sesion correctamente -->
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
	<?php
		// if(!isset($_SESSION['usuario']))
		// 	{
		// 		header("Location: /hb/index.php");
		// 		exit;
		// 		//header("Location: ".$_SERVER['DOCUMENT_ROOT']."/hb/index.php");
		// 	}else
		// 	{
		// 		if($_SESSION['usuario']['tipo']=="comun")
  // 			{
		// 			if($_SESSION['usuario']['cambio_clave'])
		// 			{
		// 				//header("Location: ".$_SERVER['DOCUMENT_ROOT']."/hb/Views/Cliente/cambioClave.php");
		// 				header("Location: /hb/Views/Cliente/cambioClave.php");
		// 				exit;
		// 			}else
		// 			{
		// 				header("Location: /hb/Views/Cliente/index.php");
		// 				exit;
		// 			}
		// 		}else
		// 		{
		// 			header("Location: /hb/Views/Administrador/index.php");
		// 			exit;
		// 		}
		// 	}
	?>
	<h1>¡Bienvenido <?php echo $_SESSION['usuario']['nombre_usuario'] ?>!</h1>
	<?php echo $_SESSION['usuario']['nombre'] ?>
	<?php echo $_SESSION['usuario']['apellido'] ?>
	<?php echo $_SESSION['usuario']['dni'] ?>
	<?php echo $_SESSION['usuario']['cambio_clave'] ?>
	<?php echo $_SESSION['usuario']['tipo'] ?>
	<?php echo $_SESSION['usuario']['id'] ?>
	<a href="login_controller.php?action=cerrar">Cerrar Sesion</a>
</body>
</html>