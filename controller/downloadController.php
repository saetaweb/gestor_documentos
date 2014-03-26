<?php
if(isset($_SESSION['id_perfil']))
{
	require_once('view/download.php');
}
else
{
	/*echo "no autorizado";*/
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}




?>