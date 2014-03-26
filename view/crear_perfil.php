<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>AGREGAR NUEVO PERFIL</h1>

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
            <h2 style="color: red;">Error en la creacion del perfil</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">El perfil se ha creado exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Este nombre ya esta ocupado, prueba otro.</h2>
            <?php
        break;
    }
}
?>
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="creaperfil" method="post">
					<div class="campoform">
						Nombre
						<br/>
						<input type="text" name="nombre_perfil" placeholder="escribe el nombre del perfil" required="required" size="35" maxlenght="250" onBlur="hikaru(document.creaperfil.nombre_perfil.value,'error_nombre_perfil','<?php echo Configuracion::ruta()?>controller/ajax_valida_crear_perfilController.php')">
<!--onBlur="hikaru(document.creaperfil.nombre_perfil.value,'error_nombre_perfil','ajax/valida_crear_perfiles.php')"-->
					<div id="error_nombre_perfil"></div>
                    </div>
                    
                    
					<div class="campoform">
                    	<input type="hidden" name="de_crearperfil" value="ok"/>
                        
                        <input id="boton_2" type="button" value="Desactivado" title="Desactivado" style="display:none;"/>
                    	<input id="boton" type="button" value="Enviar" title="Enviar" onClick="valida_crear_perfil()"/>
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_creaperfil()"/>
                        <!--<input type="submit" />-->
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/footer.php"); ?>