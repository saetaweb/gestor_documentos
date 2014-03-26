<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
			<h1>ADMINISTRACION DE DOCUMENTOS</h1>
            <?php /*print_r($las_noticias);*/
			
				if(isset($_GET["msj"]))
				{
					switch ($_GET["msj"])
					{
						case '1':
							?>
							<h2 style="color: green;">Documento eliminado correctamente</h2>
							<?php
						break;
						case '2':
							?>
							<h2 style="color: red;">Error al eliminar el documento</h2>
							<?php
						break;
					}
				}
				
				
			if(empty($los_documentos))
			{
				?>
				<h2 style="color: red;">No se encontraron documentos.</h2>
				<?php			
			
			}

			?>
            
            <table border="5" cellpadding="2" cellspacing="10" bordercolor="#0033FF">
            
            <tr>
              <td><strong>Perfil</strong></td>
              <td><strong>Nombre</strong></td>
              <td><strong>Descripcion</strong></td>
              <td><strong>Tipo</strong></td>
              <td><strong>Opciones</strong></td>
              </tr>
            
            
            
            <?php 
			$impresos=0;
			for($i = 0; $i < sizeof($los_documentos); $i++)
			{
				$impresos++;
				?>
            	<!--<div class='lineaanuncio'></div>-->
                  <tr>
                  	<td><?php echo $los_documentos[$i]["perfil_nombre"]?></td>
                    <td><?php echo $los_documentos[$i]["nombre"]?></td>
                    <td><?php echo $los_documentos[$i]["descripcion"]?></td>
                    <td><?php echo $los_documentos[$i]["tipo"]?></td>
                    <td>
                    	<a href="<?php echo Configuracion::ruta() . 'public/myfiles/' . $los_documentos[$i]["archivo"]; ?>" target="_blank">Descargar</a>
                        
                        <!--
                        
                        ESTE ENLACE ES MEJOR POR QUE LLAMA UN ARCHIVO ESPECIAL CON HEADERS QUE FORZAN LA DESCARGA, 
                        LASTIMOSAMENTE AL PASARLO A MVC NO NOS FUNCIONA POR AHORA :(  :(
                        
                        <a href="<?php //echo Configuracion::ruta();?>?controlador=download&file=<?php //echo $los_documentos[$i]["archivo"];?>">Descargar</a>--></td>
                  	
                  </tr>              
                      
			<?php 
			}
			
			?>
            </table>
<hr />
            
            <?php /*
			if(!empty($los_documentos))
				{*/
			?>
                    <!--<div class="paginador">
					<?php //require_once("public/navigator_ver_documentos.php"); ?>
					</div>-->
			<?php		
				/*}*/
			?>

    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php"); */?>
<?php require_once("public/footer.php"); ?>