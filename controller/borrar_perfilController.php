<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/perfilesModel.php");
	$objeto = new Perfiles();
	$objeto->delete_perfil($_GET["id_perfil"]);			
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

?>