<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{	
	require_once("model/usuariosModel.php");
	$objeto = new Usuarios();
	$los_usuarios = $objeto->get_usuarios();
	require_once('view/ver_usuarios.php');
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}



?>