<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <div style="text-align:center;">
			<h1>CONFIRMACION DE ELIMINACI&Oacute;N</h1>
			<br/><br/>
            
            <p>Esta usted seguro??</p>
            
            <p>El perfil: <b><font color="#FF0000"><?php echo $verificado_nombre_perfil;?></font></b> que usted va a eliminar, <br/>tiene asociados: <b><font color="#FF0000"><?php echo $total_usuarios;?></font></b> usuarios y tambien tiene asociados <b><font color="#FF0000"><?php echo $total_documentos;?></font></b> documentos que tambien seran eliminados.  </p>
            
            <br /><br />
            
            <hr />

            
            <a href="<?php echo Configuracion::ruta();?>?controlador=borrar_perfil&id_perfil=<?php echo $elperfilid;?>">CONFIRMAR BORRADO</a><br />
            <a href="<?php echo Configuracion::ruta();?>?controlador=ver_perfiles">CANCELAR</a>
            

            <hr />
        </div>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php");*/ ?>
<?php require_once("public/footer.php"); ?>