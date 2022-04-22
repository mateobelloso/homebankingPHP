<?php
	if(!isset($_SESSION['usuario']))
	{
		header("Location: /hb/index.php");
		exit;
		//header("Location: ".$_SERVER['DOCUMENT_ROOT']."/hb/index.php");
	}else
	{
		if($_SESSION['usuario']['tipo']=="comun")
		{
			if($_SESSION['usuario']['cambio_clave'])
			{
				//header("Location: ".$_SERVER['DOCUMENT_ROOT']."/hb/Views/Cliente/cambioClave.php");
				header("Location: /hb/Views/Cliente/cambioClave.php");
				exit;
			}else
			{
				header("Location: /hb/Views/Cliente/index.php");
				exit;
			}
		}else
		{
			header("Location: /hb/Views/Administrador/index.php");
			exit;
		}
	}
?>