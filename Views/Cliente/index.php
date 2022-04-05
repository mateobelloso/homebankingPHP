<html>
<head>
	<title>Bienvenido MVC </title>
</head>
<body>
	<h1>¡Bienvenido <?php echo $_SESSION['nombre_usuario'] ?>!</h1>
	<?php echo $_SESSION['nombre'] ?>
	<?php echo $_SESSION['apellido'] ?>
	<?php echo $_SESSION['clave'] ?>
	<?php echo $_SESSION['dni'] ?>
	<?php echo $_SESSION['cambio_clave'] ?>
	<?php echo $_SESSION['tipo'] ?>
	<?php echo $_SESSION['id'] ?>
	<button href="../../Controllers/usuario_controller" action="cerrar">Cerrar Sesion</button>
</body>
</html>