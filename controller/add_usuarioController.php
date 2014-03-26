<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/usuariosModel.php");
	/**/require_once("model/perfilesModel.php");
				
	$objeto = new Usuarios();
	/**/$objeto2 = new Perfiles();
	$los_perfiles = $objeto2->get_perfiles();		
				
	if(isset($_POST['de_crearusuario']) and $_POST['de_crearusuario'] == 'ok')
	{
		$objeto->add_usuario(); 
		exit;
	}
	require_once('view/crear_usuario.php');
				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}	


?>