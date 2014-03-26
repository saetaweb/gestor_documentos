<?php

if(isset($_SESSION))
{
		if (isset($_GET["pos"]))
		{
			$posicion=$_GET["pos"];
		}
		else
		{
			$posicion=0;
		}
		
		require_once("model/documentosModel.php");
		require_once("model/perfilesModel.php");
		$objeto = new Documentos();
		$objeto2 = new Perfiles();
		
		if($_SESSION['id_perfil'] == 1)
		{	
			/*seteamos el PASO, que nos dice de a cuantos registros vamos a hacer la paginacion*/
			$paso = 2;
			$los_documentos = $objeto->admin_get_documentos($posicion, $paso);
			$cuantos_documentos = $objeto->admin_cuenta_documentos();
			$total_documentos = $cuantos_documentos[0]["contados"];
			$resto=$total_documentos % $paso;
			$ultimo=$total_documentos-$resto;
			
			$los_perfiles = $objeto2->get_perfiles();
			
			require_once('view/admin_ver_documentos.php');
		}
		else
		{
			$elidperfil = $_SESSION['id_perfil'];
			
			$los_documentos = $objeto->get_documentos($elidperfil, $posicion);
			
			/*
			$cuantos_documentos = $objeto->cuenta_documentos($elidperfil);
			$total_documentos = $cuantos_documentos[0]["contados"];
			$resto=$total_documentos % 2;
			$ultimo=$total_documentos-$resto;
			*/
			
			require_once('view/ver_documentos.php');
		}

}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}







?>