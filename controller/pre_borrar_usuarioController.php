<?php
if(isset($_SESSION) and $_SESSION['id_perfil'] == 1)
{
	require_once("model/usuariosModel.php");
	$objeto = new Usuarios();
	$elusuarioid = $_GET["id_usuario"];
	$elnombreusuario = $_GET["nombre"];
	
	
	$verificado_nombre_usuario = $objeto->verifica_nombre_usuario($elnombreusuario, $elusuarioid);
	$cuantos_documentos = $objeto->cuenta_dependientes_usuario_documentos($elusuarioid);
	$total_documentos = $cuantos_documentos[0]["contados"];
	require_once('view/pre_borrar_usuario.php');				
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}				






?>