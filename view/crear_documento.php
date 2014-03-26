<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>AGREGAR NUEVO DOCUMENTO</h1>
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
            <h2 style="color: red;">Error en la creacion del documento</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">El documento se ha creado exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Este nombre ya esta ocupado, prueba otro.</h2>
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
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="creadocumento" method="post" enctype="multipart/form-data">
            
                    <div class="campoform">
						Perfil
						<br/>
                        <select name="perfil_documento" required="required" onchange="hikaru_post(this.value,'div_usuario','<?php echo Configuracion::ruta()?>controller/ajax_dependientes_perfil_usuariosController.php');">
                        
                        <!--onchange="hikaru_post(this.value,'div_usuario','ajax/ajax_usuarios.php');"-->
                        
                          <option value="0">Seleccione...</option>
                          <?php 
							
							for($i = 0; $i < sizeof($los_perfiles); $i++)
							{
							?>
                          <option value="<?php echo $los_perfiles[$i]["id_perfil"];?>" 
                                title="<?php echo $los_perfiles[$i]["nombre"];?>"> <?php echo $los_perfiles[$i]["nombre"];?></option>
                          <?php	
							}
							
							?>
                        </select>
                    <div id="error_perfil_documento"></div>
                    </div> 
                    
                    <div class="campoform">
						Usuario
						<br/>
                        <div id="div_usuario">
                        <select name="usuario_documento" required="required">
                          <option value="0">Seleccione...</option>
                        </select>
                        </div>
                    <div id="error_usuario_documento"></div>
                    </div>           
            
					<div class="campoform">
						Nombre
						<br/>
						<input type="text" name="nombre_documento" placeholder="nombre del documento" required="required" size="35" maxlenght="250" onBlur="hikaru(document.creadocumento.nombre_documento.value,'error_nombre_documento','<?php echo Configuracion::ruta()?>controller/ajax_valida_crear_documentoController.php')">
                        
<!--onBlur="hikaru(document.creadocumento.nombre_documento.value,'error_nombre_documento','ajax/valida_crear_documento.php')"-->                        
<!---->
                       
					<div id="error_nombre_documento"></div>
                    </div>
					<div class="campoform">
						Descripcion
						<br/>
						<textarea cols="30" name="descripcion_documento"  placeholder="descripcion del documento" required="required" rows="10"></textarea>
                    <div id="error_descripcion_documento"></div>
					</div>
                    
                    <div class="campoform">
						Archivo
						<br/>
						<input type="file" name="archivo_documento">
                    <div id="error_archivo_documento"></div>
					</div>

                    
                    <br/>
					<div class="campoform">
                    	<input type="hidden" name="de_creardocumento" value="ok"/>
                        
                        <input id="boton_2" type="button" value="Desactivado" title="Desactivado" style="display:none;"/>
                    	<input id="boton" type="button" value="Enviar" title="Enviar" onClick="valida_crear_documento()"/>
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_creadocumento()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/footer.php"); ?>