<?php 
  	if(session_status() != PHP_SESSION_ACTIVE)
  	{
  		session_start();
  	}
	if( (!isset($_SESSION['usuario'])) && ($_SERVER['PHP_SELF']!='/hb/index.php') )
	{
		header("Location: /hb/index.php");
	}

?>
<html>
  <head>
    <title>Bienvenido a Banco X</title>
    <link rel="stylesheet" href="/hb/Styles/header.css">
  </head>
  <body>
      <header id="main-header">
		
		<a id="logo-header" href="/hb/Controllers/login_controller.php">
			<span class="site-name">BANCO</span>
		</a> <!-- / #logo-header -->

		<nav>
			<ul>
				<li><a href="#">Inicio</a></li>
				<li><a href="#">Acerca de</a></li>
				<li><a href="#">Contacto</a></li>
				<!--Se verifica que el usuario tenga la sesion iniciada para mostrar el cerrar sesion -->
				<?php if(isset($_SESSION['usuario'])) { ?> 
				<li><a id="boton" href="/hb/Controllers/login_controller.php?action=cerrar">Cerrar sesion</a></li>
				<?php } ?>
			</ul>
		</nav><!-- / nav -->

	</header><!-- / #main-header -->
  </body>
</html>