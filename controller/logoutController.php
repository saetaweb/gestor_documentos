<?php
if(isset($_SESSION))
{
	/**/require_once("model/usuariosModel.php");
	$objeto = new Usuarios();
	$objeto->logout(); 
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}




?>