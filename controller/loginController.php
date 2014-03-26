<?php
if(isset($_SESSION["id_usuario"]))
{
	header("Location: " . Configuracion::ruta() . "?controlador=ver_documentos");
	
	/*echo $_SESSION["usuario_id"];*/
}

require_once("model/usuariosModel.php");
$objeto = new Usuarios();

if(isset($_POST['de_login']) and $_POST['de_login'] == 'ok')
{
	$objeto->login();				
	exit;
				

}

require_once('view/login.php');





?>