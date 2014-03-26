<?php
/**/
require_once("../lib/config.php");
require_once("../model/usuariosModel.php");

sleep(2);

$objeto = new Usuarios();
$resultado = $objeto->ajax_valida_crear_usuario();

if(empty($resultado))
{
	echo "disponible";
}
else
{
	echo "ocupado";
}
?>