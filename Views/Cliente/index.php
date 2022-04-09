<html>
<head>
	<!--link rel="stylesheet" href="../Views/styles.css"-->
</head>
<body>
	<?php require_once("../Views/header.php"); ?>
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