<?php
/**/
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/documentosModel.php");
	$objeto = new Documentos();
	$id_documento = $_GET["id_documento"];
	$objeto->delete_documento($id_documento);
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}





?>