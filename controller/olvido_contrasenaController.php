<?php
if(isset($_SESSION))
{
	require_once("model/usuariosModel.php");
	$objeto = new Usuarios();	
	if(isset($_POST['de_olvidocontrasena']) and $_POST['de_olvidocontrasena'] == 'ok')
	{
		$objeto->olvido_contrasena();
		exit;
	}
	require_once('view/olvido_contrasena.php');			
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

?>