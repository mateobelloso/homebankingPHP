<html>
<head>
	<!--link rel="stylesheet" href="../Views/styles.css"-->
</head>
<body>
	<!--Mensaje de bienvenido PARA EL ADMINISTRADOR una vez se haya iniciado sesion correctamente -->
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hb/Views/header.php"); ?> <!--Se llama al header -->
	<h1>¡Bienvenido ADMINISTRADOR <?php echo $_SESSION['usuario']['nombre_usuario'] ?>!</h1>
	<?php echo $_SESSION['usuario']['nombre'] ?>
	<?php echo $_SESSION['usuario']['apellido'] ?>
	<a href="administrador_controller.php?action=alta">Alta Cliente</a>
	
</body>
</html>