<?php
/**/
require_once("../lib/config.php");
require_once("../model/documentosModel.php");

sleep(2);

$objeto = new Documentos();
$resultado = $objeto->ajax_valida_crear_documento();

if(empty($resultado))
{
	echo "disponible";
}
else
{
	echo "ocupado";
}
?>