<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/perfilesModel.php");
	$objeto = new Perfiles();
	$elperfilid = $_GET["id_perfil"];
	$elnombreperfil = $_GET["nombre"];
	
	
	$verificado_nombre_perfil = $objeto->verifica_nombre_perfil($elnombreperfil, $elperfilid);
	
	$cuantos_usuarios = $objeto->cuenta_dependientes_perfil_usuarios($elperfilid);
	$total_usuarios = $cuantos_usuarios[0]["contados"];
	
	$cuantos_documentos = $objeto->cuenta_dependientes_perfil_documentos($elperfilid);
	$total_documentos = $cuantos_documentos[0]["contados2"];	
	
	require_once('view/pre_borrar_perfil.php');				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}				






?>