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

            <hr />
            <h2>selecciona por perfil</h2>
            <select id="selector" onchange="enviarperfil()">
            	<option value="0">Seleccione...</option>
            <?php 
			for($i = 0; $i < sizeof($los_perfiles); $i++)
			{
			?>             
                    <?php
                    if(isset($_GET['perfil']))
                    {
                        if($_GET['perfil'] == $los_perfiles[$i]["id_perfil"])
                        {
                    ?>
                                <option value="<?php echo $los_perfiles[$i]["id_perfil"];?>" title="<?php echo $los_perfiles[$i]["nombre"];?>" selected="selected"><?php echo $los_perfiles[$i]["nombre"];?></option>
                                
                        <?php
                        }
                        else
                        {
                        ?>
                                <option value="<?php echo $los_perfiles[$i]["id_perfil"];?>" title="<?php echo $los_perfiles[$i]["nombre"];?>"><?php echo $los_perfiles[$i]["nombre"];?></option>
                                
                        <?php
                        }
                    }
                    else
                    {
                    ?>
                        <option value="<?php echo $los_perfiles[$i]["id_perfil"];?>" title="<?php echo $los_perfiles[$i]["nombre"];?>"><?php echo $los_perfiles[$i]["nombre"];?></option>
                        
                    <?php
                    }
                    ?>    
                        
                        
            <?php 
			}
			?>            
            </select>
            <hr />
            <table border="5" cellpadding="2" cellspacing="10" bordercolor="#0033FF">
            <tr>
			<td valingn="top" align="left" colspan="7">
				<a href="<?php echo Configuracion::ruta(); ?>?controlador=add_documento" title="Agregar Usuario">Agregar Documento</a>
				<hr />
			</td></tr>
            <tr>
              <td><strong>Perfil</strong></td>
              <td><strong>Nombre</strong></td>
              <td><strong>Descripcion</strong></td>
              <td><strong>Tipo</strong></td>
              <td colspan="3"><strong>Opciones</strong></td>
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
                    
                    	<a href="<?php echo Configuracion::ruta() . 'public/myfiles/' . $los_documentos[$i]["archivo"]; ?>" target="_blank">VER</a>
                        
                        
                        
                     <!--   
                     	ESTE ENLACE ES MEJOR POR QUE LLAMA UN ARCHIVO ESPECIAL CON HEADERS QUE FORZAN LA DESCARGA, 
                        LASTIMOSAMENTE AL PASARLO A MVC NO NOS FUNCIONA POR AHORA :(  :(
                        
                        <a href="<?php //echo Configuracion::ruta();?>?controlador=download&file=<?php //echo $los_documentos[$i]["archivo"];?>">Descargar</a> --
                        
                        
                        <a href="<?php //echo Configuracion::ruta();?>controller/downloadController.php?file=<?php //echo $los_documentos[$i]["archivo"];?>">Descargar</a>
                        -->
                        
                    </td>
                        
                        
                  	<td><a href="<?php echo Configuracion::ruta(); ?>?controlador=editar_documento&id_documento=<?php echo $los_documentos[$i]["id_documento"]?>" title="Editar Documento <?php echo $los_documentos[$i]["nombre"]?>">Editar</a></td>
                
                    <td><a href="javascript:void()" title="Eliminar Documento <?php echo $los_documentos[$i]["nombre"]?>" onclick="eliminar_registro('<?php echo Configuracion::ruta(); ?>?controlador=borrar_documento&id_documento=<?php echo $los_documentos[$i]["id_documento"]?>');">Borrar</a></td>
                  </tr>              
                      
			<?php 
			}
			
			?>
            </table>
<hr />
            
            <?php /**/
			if(!empty($los_documentos))
				{
			?>
                    <div class="paginador">
					<?php require_once("public/navigator_ver_documentos.php"); ?>
					</div>
			<?php		
				}
			?>

    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php"); */?>
<?php require_once("public/footer.php"); ?>