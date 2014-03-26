<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/usuariosModel.php");
	$objeto = new Usuarios();
	$objeto->delete_usuario($_GET["id_usuario"]);			
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

?>