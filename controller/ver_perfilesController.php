<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{	
	require_once("model/perfilesModel.php");
	$objeto = new Perfiles();
	$los_perfiles = $objeto->get_perfiles();
	require_once('view/ver_perfiles.php');
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}



?>