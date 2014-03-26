<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{

	/**/require_once("model/perfilesModel.php");
				
	/**/$objeto2 = new Perfiles();		
				
	if(isset($_POST['de_crearperfil']) and $_POST['de_crearperfil'] == 'ok')
	{
		/*print_r($_POST);*/
		$objeto2->add_perfil(); 
		exit;
	}
	require_once('view/crear_perfil.php');
				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}	


?>