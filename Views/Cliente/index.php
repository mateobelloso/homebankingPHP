<html>
<head>
	<title>Bienvenido MVC </title>
</head>
<body>
	<h1>¡Bienvenido <?php echo $_SESSION['nombre_usuario'] ?>!</h1>
	<?php echo $_SESSION['usuario']['nombre'] ?>
	<?php echo $_SESSION['usuario']['apellido'] ?>
	<?php echo $_SESSION['usuario']['dni'] ?>
	<?php echo $_SESSION['usuario']['cambio_clave'] ?>
	<?php echo $_SESSION['usuario']['tipo'] ?>
	<?php echo $_SESSION['usuario']['id'] ?>
	<a href="login_controller.php?action=cerrar">Cerrar Sesion</a>
</body>
</html>