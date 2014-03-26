<?php
/**/
require_once("../lib/config.php");
require_once("../model/usuariosModel.php");

$objeto = new Usuarios();
$los_usuarios = $objeto->ajax_dependientes_perfil_usuarios();

require_once("../view/ajax_dependientes_perfil_usuarios.php");
?>