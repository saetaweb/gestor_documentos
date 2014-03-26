<?php

if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/perfilesModel.php");
	$objeto = new Perfiles();

	$id_perfil = $_GET["id_perfil"];
	$el_perfil = $objeto->get_perfil_por_id($id_perfil);
	
	if(isset($_POST['de_editarperfil']) and $_POST['de_editarperfil'] == 'ok')
	{	
		$objeto->edit_perfil(); 
		exit;
	}
	require_once('view/editar_perfil.php');				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}				

?>