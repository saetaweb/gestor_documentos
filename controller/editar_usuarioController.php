<?php

if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/usuariosModel.php");
	require_once("model/perfilesModel.php");
	$objeto = new Usuarios();
	$id_usuario = $_GET["id_usuario"];
	$objeto2 = new Perfiles();
	$los_perfiles = $objeto2->get_perfiles();
	$el_usuario = $objeto->get_usuario_por_id($id_usuario);
	if(isset($_POST['de_editarusuario']) and $_POST['de_editarusuario'] == 'ok')
	{	
		$objeto->edit_usuario(); 
		exit;
	}
	require_once('view/editar_usuario.php');				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}				

?>