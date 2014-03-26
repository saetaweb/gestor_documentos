<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>EDITAR PERFIL</h1>

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
            <h2 style="color: red;">Error en la edicion del usuario</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">El usuario se ha editado exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Este usuario ya esta ocupado, prueba otro.</h2>
            <?php
        break;
		case '6':
            ?>
            <h2 style="color: red;">Password Invalido.</h2>           
            <?php
        break;
    }
}
?>
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="editaperfil" method="post">
            
					<div class="campoform">
						Nombre
						<br/>
						<input type="text" name="nombre_perfil" placeholder="escribe el nombre de perfil" required="required" size="35" maxlenght="250" value="<?php echo $el_perfil[0]['nombre'];?>" onblur="hikaru2(document.editaperfil.nombre_perfil.value, '<?php echo $el_perfil[0]['nombre'];?>' ,'error_nombre_perfil','<?php echo Configuracion::ruta()?>controller/ajax_valida_editar_perfilController.php')">
                        
                        <!--onblur="hikaru2(document.editaperfil.nombre_perfil.value, '<?php //echo $el_perfil[0]['nombre'];?>' ,'error_nombre_perfil','ajax/valida_editar_perfiles.php')"-->
    
					<div id="error_nombre_perfil"></div>
                    </div>
 
					<br/>
					<div class="campoform">
                    	<input type="hidden" name="de_editarperfil" value="ok"/>
                        <input type="hidden" name="id_perfil" value="<?php echo $_GET["id_perfil"];?>"> 
    					<input type="hidden" name="antiguo_nombre" value="<?php echo $el_perfil[0]["nombre"];?>">

                        
                        <input id="boton_2" type="button" value="Desactivado" title="Desactivado" style="display:none;"/>
                    	<input id="boton" type="button" value="Enviar" title="Enviar" onClick="valida_editar_perfil()"/>
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_editaperfil()"/>
                        <!--<input type="submit" />-->
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/footer.php"); ?>