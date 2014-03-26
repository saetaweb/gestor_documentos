<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	/*echo "hasta aqui vamos bien 01"; exit;*/
	
	require_once("model/documentosModel.php");
	require_once("model/perfilesModel.php");
	require_once("model/usuariosModel.php");
	
	$objeto = new Documentos();
	$objeto2 = new Perfiles();
	$objeto3 = new Usuarios();
	
	$los_perfiles = $objeto2->get_perfiles();
	
	$id_documento = $_GET["id_documento"];
	$el_documento = $objeto->get_documento_por_id($id_documento);
	
	$id_perfil = $el_documento[0]['id_perfil'];
	$los_usuarios = $objeto3->get_usuarios_por_id_perfil($id_perfil);
	
	
	if(isset($_POST['de_editardocumento']) and $_POST['de_editardocumento'] == 'ok')
	{
		$objeto->edit_documento(); 
		exit;
	}
	require_once('view/editar_documento.php');
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

?>