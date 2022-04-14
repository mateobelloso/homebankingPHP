<style >
	#main-header {
		background: #13026F;
		color: #ECF0F1;
		height: 80px;
		
		width: 100%; /* hacemos que la cabecera ocupe el ancho completo de la página */
		left: 0; /* Posicionamos la cabecera al lado izquierdo */
		top: 0; /* Posicionamos la cabecera pegada arriba */
		position: flex; /* Hacemos que la cabecera tenga una posición fija */
	}	
	#main-header a {
		color: white;
	}

	/*
	 * Logo
	 */
	#logo-header {
		float: left;
		padding: 15px 0 0 20px;
		text-decoration: none;
	}
		#logo-header:hover {
			color: #0b76a6;
		}
		
		#logo-header .site-name {
			display: block;
			font-weight: 1000;
			font-size: 3em;
		}
		

	/*
	 * Navegación
	 */
	nav {
		float: right;
	}
		nav ul {
			margin: 0;
			padding: 0;
			list-style: none;
		}
		
			nav ul li {
				display: inline-block;
				line-height: 80px;
			}
				
				nav ul li a {
					display: block;
					padding: 0 10px;
					text-decoration: none;
				}
				
					nav ul li a:hover {
						background: #0b76a6;
					}

					nav #boton:hover {
						background: red;
					}
	}
</style>
<html>
  <head>
    <title>Bienvenido a Banco X</title>
    <!--link rel="stylesheet" href="styles.css" /-->
  </head>
  <body>
      <header id="main-header">
		
		<a id="logo-header" href="#">
			<span class="site-name">BANCO</span>
		</a> <!-- / #logo-header -->

		<nav>
			<ul>
				<li><a href="#">Inicio</a></li>
				<li><a href="#">Acerca de</a></li>
				<li><a href="#">Contacto</a></li>
				<?php if(isset($_SESSION['usuario'])) { ?>
				<li><a id="boton" href="login_controller.php?action=cerrar">Cerrar sesion</a></li>
				<?php } ?>
			</ul>
		</nav><!-- / nav -->

	</header><!-- / #main-header -->
  </body>
</html>