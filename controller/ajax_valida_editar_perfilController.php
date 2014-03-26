<?php
/**/
require_once("../lib/config.php");
require_once("../model/perfilesModel.php");

sleep(2);

$objeto = new Perfiles();
$resultado = $objeto->ajax_valida_editar_perfil();

if(empty($resultado))
{
	echo "disponible";
}
else
{
	echo "ocupado";
}
?>