<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>EDITAR DOCUMENTO</h1>
<?php 

if(isset($_GET["msj"]))
{
    switch ($_GET["msj"])
    {
        case '1':
            ?>
            <h2 style="color: red;">Hay campos del formulario sin llenar</h2>
            <?php
        break;
        case '2':
            ?>
            <h2 style="color: red;">Error en la edicion del documento</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">El documento se ha editado exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Este nombre ya esta ocupado, prueba otro.</h2>
            <?php
        break;
        case '5':
            ?>
            <h2 style="color: red;">Si cambia el nombre, debe volver a subir el documento al sistema.</h2>
            <?php
        break;
        case '6':
            ?>
            <h2 style="color: red;">No esta permitido ingresar archivos de tipo imagen.</h2>
            <?php
        break;
    }
}
?>
			<?php /**/print_r($el_documento); ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="editadocumento" method="post" enctype="multipart/form-data">
            
                    <div class="campoform">
						Perfil
						<br/>
                        <select name="perfil_documento" required="required" value="<?php echo $el_documento[0]['id_usuario'];?>" onchange="hikaru_post(this.value,'div_usuario','<?php echo Configuracion::ruta()?>controller/ajax_dependientes_perfil_usuariosController.php');">
                          <option value="0">Seleccione...</option>
                          <?php 
							
							for($i = 0; $i < sizeof($los_perfiles); $i++)
							{
							?>
            <option value="<?php echo $los_perfiles[$i]["id_perfil"];?>" title="<?php echo $los_perfiles[$i]["nombre"];?>"
            
                                	<?php 
									/**/
									if($los_perfiles[$i]["id_perfil"] ==  $el_documento[0]['id_perfil'])
									{
										echo "selected = 'selected'";
									} 
									?>            
              
            ><?php echo $los_perfiles[$i]["nombre"];?></option>
                          
                          
                          <?php	
							}
							
							?>
                        </select>
                    <div id="error_perfil_documento"></div>
                    </div>            
            
            
            		<!--
            		<div class="campoform">
						Usuario
						<br/>
                        <div id="div_usuario">
                        <?php /*echo $el_documento[0]['id_usuario'];*/?>
                        <select name="usuario_documento" required="required">
                          <option value="0">Seleccione...</option>
                        </select>
                        </div>
                    <div id="error_usuario_documento"></div>
                    </div> 
            		-->



            		<div class="campoform">
						Usuario
						<br/>
                        <div id="div_usuario">            
            			<select name="usuario_documento" required="required">
               				<option value="0">Seleccione...</option> 
                  			<?php
							for($i = 0; $i < sizeof($los_usuarios); $i++)
							{
							?>
               					<option value="<?php echo $los_usuarios[$i]["id_usuario"];?>" title="<?php echo $los_usuarios[$i]["nombre"];?>"
                                
                                
                                	<?php 
									/**/
									if($los_usuarios[$i]["id_usuario"] ==  $el_documento[0]['id_usuario'])
									{
										echo "selected = 'selected'";
									} 
									?>                                 
                                
                                
                                
                                > <?php echo $los_usuarios[$i]["nombre"];?></option>
                			<?php	
							}
				  			?>
						</select>
                        </div>
                    <div id="error_usuario_documento"></div>
                    </div>
            
            
            
					<div class="campoform">
						Nombre
						<br/>
						<input type="text" name="nombre_documento" placeholder="nombre del documento" required="required" size="35" maxlenght="250" onblur="hikaru2(document.editadocumento.nombre_documento.value, '<?php echo $el_documento[0]['nombre'];?>' ,'error_nombre_documento','<?php echo Configuracion::ruta()?>controller/ajax_valida_editar_documentoController.php')" value="<?php echo $el_documento[0]['nombre'];?>" />
                        
                        
                        
<!--onblur="hikaru2(document.editadocumento.nombre_documento.value, '<?php //echo $el_documento[0]['nombre'];?>' ,'error_nombre_documento','ajax/valida_editar_documento.php')" value="<?php //echo $el_documento[0]['nombre'];?>"-->
                        
					  <div id="error_nombre_documento"></div>
                    </div>
					<div class="campoform">
						Descripcion
						<br/>
						<textarea cols="30" name="descripcion_documento"  placeholder="descripcion del documento" required="required" rows="10" value="<?php echo $el_documento[0]['descripcion'];?>"><?php echo $el_documento[0]['descripcion'];?></textarea>
                    <div id="error_descripcion_documento"></div>
					</div>
                    
                    <div class="campoform">
						Archivo
						<br/>
						<input type="file" name="archivo_documento">
                        <br/>
                        Archivo actual: <?php echo "<strong>" . $el_documento[0]['archivo'] . "</strong>";?>
                    <div id="error_archivo_documento"></div>
					</div>

                    
                    <br/>
					<div class="campoform">
                    	<input type="hidden" name="de_editardocumento" value="ok"/>
                        <input type="hidden" name="id_documento" value="<?php echo $_GET["id_documento"];?>"> 
                        <input type="hidden" name="antiguo_tipo" value="<?php echo $el_documento[0]["tipo"];?>">
    					<input type="hidden" name="antiguo_archivo" value="<?php echo $el_documento[0]["archivo"];?>">
                        <input type="hidden" name="antiguo_nombre" value="<?php echo $el_documento[0]["nombre"];?>">                        
                        <input id="boton_2" type="button" value="Desactivado" title="Desactivado" style="display:none;"/>
                    	<input id="boton" type="button" value="Enviar" title="Enviar" onClick="valida_editar_documento()"/>
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_editadocumento()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/footer.php"); ?>