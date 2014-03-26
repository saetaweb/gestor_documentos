<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>AGREGAR NUEVO USUARIO</h1>
        <br/>
        <small><strong style="color: red;">El campo password debe ser: Entre 5 y 12 caracteres, por lo menos un n&uacute;mero y un alfanum&eacute;rico, y no puede contener caracteres especiales</strong></small>
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
            <h2 style="color: red;">Error en la creacion del usuario</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">El usuario se ha creado exitosamente</h2>
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
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="creausuario" method="post" enctype="multipart/form-data">
            
                    <div class="campoform">
						Perfil
						<br/>
                        <select name="perfil_usuario" required="required">
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
                    <div id="error_perfil_usuario"></div>
                    </div>            
            
					<div class="campoform">
						Nombre
						<br/>
						<input type="text" name="nombre_usuario" placeholder="escribe tu nombre" required="required" size="35" maxlenght="250" onBlur="hikaru(document.creausuario.nombre_usuario.value,'error_nombre_usuario','<?php echo Configuracion::ruta()?>controller/ajax_valida_crear_usuarioController.php')">
                        
<!--onBlur="hikaru(document.creausuario.nombre_usuario.value,'error_nombre_usuario','<?php //echo Configuracion::ruta()?>controller/ajax_valida_crear_usuarioController.php')"-->

					<div id="error_nombre_usuario"></div>
                    </div>
                    
                    <div class="campoform">
						Login
						<br/>
						<input type="text" name="login_usuario" placeholder="escribe tu nombre de usuario" required="required" size="35" maxlenght="250">
                    <div id="error_login_usuario"></div>    
                    </div>
                    
                    <div class="campoform">
						Password
						<br/>
						<input type="password" name="password" required="required" size="35" minlenght="5" maxlenght="6"></div>
                    <div id="error_password"></div>
                    </div>
                    
                    <div class="campoform">
						Repetir Password
						<br/>
						<input type="password" name="password2" required="required" size="35" minlenght="5" maxlenght="6"></div>
                    </div>
                    
                    <div class="campoform">
						Email
						<br/>
						<input type="text" name="email_usuario" placeholder="escribe tu email" required="required" size="35" maxlenght="250">
                    <div id="error_email"></div>
                    </div>
                    
                    
					<br/>
					<div class="campoform">
                    	<input type="hidden" name="de_crearusuario" value="ok"/>
                        
                        <input id="boton_2" type="button" value="Desactivado" title="Desactivado" style="display:none;"/>
                    	<input id="boton" type="button" value="Enviar" title="Enviar" onClick="valida_crear_usuario()"/>
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_creausuario()"/>
                        <!--<input type="submit" />-->
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/footer.php"); ?>