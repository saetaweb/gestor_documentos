<?php


if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/documentosModel.php");
	require_once("model/perfilesModel.php");
	require_once("model/usuariosModel.php");
				
	$objeto = new Documentos();
	$objeto2 = new Perfiles();
	$objeto3 = new Usuarios();
	
	$los_perfiles = $objeto2->get_perfiles();
	/*$los_usuarios = $objeto3->get_usuarios_por_perfil();*/		
				
	if(isset($_POST['de_creardocumento']) and $_POST['de_creardocumento'] == 'ok')
	{
		$objeto->add_documento(); 
		exit;
	}
	require_once('view/crear_documento.php');
				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}				
				
				


?>