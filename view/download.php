<?php  

$carpeta = "myfiles";

/*$carpeta = Configuracion::ruta() . 'public/myfiles';*/



$file = $_GET['file'];

/*echo $carpeta . "/$file"; exit;*/

if(file_exists($carpeta . "/$file")) 
{
	/*echo "encontrado";*/
	
	$data = fopen($carpeta . "/$file", "r");
	$size = filesize($carpeta . "/$file");
	$type= filetype($carpeta . "/$file");
	$file_content = fread($data,$size);
	
	header("Content-type: $type");
	header("Content-length: $size");
	header("Content-Disposition: attachment; filename=$file");
	header("Content-Description: PHP Generated Data");
	
	echo $file_content;
	
} 
else 
{
	echo "<script languaje='javascript'>alert('EL ARCHIVO NO SE ENCUENTRA');</script>";
} 


?>


<a href="" target="_blank">Descargar</a>

