<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
			<h1>VER LOS USUARIOS</h1>
            <?php /*print_r($las_noticias);*/
			
				if(isset($_GET["msj"]))
				{
					switch ($_GET["msj"])
					{
						case '1':
							?>
							<h2 style="color: green;">Usuario eliminado correctamente</h2>
							<?php
						break;
						case '2':
							?>
							<h2 style="color: red;">Error al eliminar el usuario</h2>
							<?php
						break;
					}
				}
				
				
			if(empty($los_usuarios))
			{
				?>
				<h2 style="color: red;">No se encontraron usuarios.</h2>
				<?php			
			}

			?>
            
            <table border="5" cellpadding="2" cellspacing="10" bordercolor="#0033FF">
            <tr>
			<td valingn="top" align="left" colspan="6">
				<a href="<?php echo Configuracion::ruta(); ?>?controlador=add_usuario" title="Agregar Usuario">Agregar Usuario</a>
				<hr />
			</td>
            </tr>
            <tr>
              <td><strong>Perfil</strong></td>
              <td><strong>Nombre</strong></td>
              <td><strong>Login</strong></td>
              <td><strong>Email</strong></td>
              <td colspan="2"><strong>Opciones</strong></td>
            </tr>
            
            
            
            <?php 
			$impresos=0;
			for($i = 0; $i < sizeof($los_usuarios); $i++)
			{
				$impresos++;
				?>
            	<!--<div class='lineaanuncio'></div>-->
                  <tr>
                    <td><?php echo $los_usuarios[$i]["perfil_nombre"];?></td>
                    <td><?php echo $los_usuarios[$i]["nombre"];?></td>
                    <td><?php echo $los_usuarios[$i]["login"];?></td>
                    <td><?php echo $los_usuarios[$i]["email"];?></td>
                    
                    <td><a href="<?php echo Configuracion::ruta(); ?>?controlador=editar_usuario&id_usuario=<?php echo $los_usuarios[$i]["id_usuario"]?>" title="Editar Usuario <?php echo $los_usuarios[$i]["nombre"]?>">Editar</a></td>
                
                    <td><a href="<?php echo Configuracion::ruta(); ?>?controlador=pre_borrar_usuario&id_usuario=<?php echo $los_usuarios[$i]["id_usuario"]?>&nombre=<?php echo $los_usuarios[$i]["nombre"]?>" title="Eliminar Usuario <?php echo $los_usuarios[$i]["nombre"]?>">Borrar</a></td>
                    
                    <!--<td><a href="javascript:void()" title="Eliminar Usuario <?php //echo $los_usuarios[$i]["nombre"]?>" onclick="eliminar_registro('<?php //echo Configuracion::ruta(); ?>?controlador=borrar_usuario&id_usuario=<?php //echo $los_usuarios[$i]["id_usuario"]?>&nombre=<?php //echo $los_usuarios[$i]["nombre"]?>');">Borrar</a></td>-->
                    
                  </tr>              
                        
			<?php 
			}
			
			?>
            </table>
            <hr />

    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php"); */?>
<?php require_once("public/footer.php"); ?>