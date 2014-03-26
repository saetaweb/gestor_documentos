<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
			<h1>VER LOS PERFILES</h1>
            <?php /*print_r($las_noticias);*/
			
				if(isset($_GET["msj"]))
				{
					switch ($_GET["msj"])
					{
						case '1':
							?>
							<h2 style="color: green;">Perfil eliminado correctamente</h2>
							<?php
						break;
						case '2':
							?>
							<h2 style="color: red;">Error al eliminar el perfil</h2>
							<?php
						break;
					}
				}
				
				
			if(empty($los_perfiles))
			{
				?>
				<h2 style="color: red;">No se encontraron perfiles.</h2>
				<?php			
			}

			?>
            
            <table border="5" cellpadding="2" cellspacing="10" bordercolor="#0033FF">
            <tr>
			<td valingn="top" align="left" colspan="6">
				<a href="<?php echo Configuracion::ruta(); ?>?controlador=add_perfil" title="Agregar Perfil">Agregar Perfil</a>
				<hr />
			</td>
            </tr>
            <tr>
              <td><strong>Perfil</strong></td>
              <td><strong>Usuarios</strong></td>
              <td colspan="2"><strong>Opciones</strong></td>
            </tr>
            
            
            
            <?php 
			for($i = 0; $i < sizeof($los_perfiles); $i++)
			{
				?>
            	<!--<div class='lineaanuncio'></div>-->
                  <tr>
                    <td><?php echo $los_perfiles[$i]["nombre"];?></td>
                    <td><a href="javascript:void(0);" title="Ver Usuarios de <?php echo $los_perfiles[$i]["nombre"];?>" onclick="hikaru_post('<?php echo $los_perfiles[$i]["id_perfil"]?>', 'ver_usuarios_ajax', 'ajax/ajax_detalle_usuarios.php');">Ver</a></td>
                    
                    
                    <!--'ajax/ajax_detalle_usuarios.php'-->
                    
                    <td><a href="<?php echo Configuracion::ruta(); ?>?controlador=editar_perfil&id_perfil=<?php echo $los_perfiles[$i]["id_perfil"]?>" title="Editar Perfil <?php echo $los_perfiles[$i]["nombre"]?>">Editar</a></td>
                
                    <td><a href="<?php echo Configuracion::ruta(); ?>?controlador=pre_borrar_perfil&id_perfil=<?php echo $los_perfiles[$i]["id_perfil"]?>&nombre=<?php echo $los_perfiles[$i]["nombre"]?>" title="Eliminar Perfil <?php echo $los_perfiles[$i]["nombre"]?>">Borrar</a></td>
                    
                    <!--<td><a href="javascript:void()" title="Eliminar Usuario <?php //echo $los_usuarios[$i]["nombre"]?>" onclick="eliminar_registro('<?php //echo Configuracion::ruta(); ?>?controlador=borrar_usuario&id_usuario=<?php //echo $los_usuarios[$i]["id_usuario"]?>&nombre=<?php //echo $los_usuarios[$i]["nombre"]?>');">Borrar</a></td>-->
                    
                  </tr>              
                        
			<?php 
			}
			
			?>
            </table>
            <hr />
            
            <div id="ver_usuarios_ajax"></div>

    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php"); */?>
<?php require_once("public/footer.php"); ?>