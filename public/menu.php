<!-- SECCION BODY HEADER -->

<body>
	<header>
    	<a href="<?php echo Configuracion::ruta();?>">
			<img src="<?php echo Configuracion::ruta();?>public/images/cabecera.jpg" style="width:100%;" alt="Charlotte Blog" border="0">
        </a>
            
    <nav>
<!----><div style="width:100%; clear:both;"><?php /*if(isset($_SESSION['id_perfil'])){print_r($_SESSION);}else{echo "NO HAY VARIABLE DE SESION!!!";}*/?></div>
        <div class="navegadorizquierda">
        
        <?php 
		
		if(isset($_SESSION['id_perfil']))
		{
			/*si esta registrado como usuario admin muestra lo siguiente...*/
			if($_SESSION['id_perfil'] == 1)
			{
				?>
				
				<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos" class="enlacenav">Adm. Documentos</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=ver_usuarios" class="enlacenav">Adm. Usuarios</a> |
                <a href="<?php echo Configuracion::ruta();?>?controlador=ver_perfiles" class="enlacenav">Adm. Perfiles</a> |
                <a href="<?php echo Configuracion::ruta();?>?controlador=olvido_contrasena" class="enlacenav">Cambiar Password</a>
				<?php 		
			}
			else
			{
				?>
				<a href="<?php echo Configuracion::ruta();?>?controlador=olvido_contrasena" class="enlacenav">Cambiar Password</a>
				<?php 			
			}		
		}


		?>               
        </div>		
        
        <div class="navegadorderecha">
        
        <?php
        if(isset($_SESSION['id_perfil']))
		{	
			?>
			
			<a href="<?php echo Configuracion::ruta();?>?controlador=logout" class="enlacenav">Salir</a>
            
			<?php 	
		}


		?>

		</div>

        <div style="width:100%; clear:both;">
        
        
        	<?php
			if(isset($_SESSION['id_perfil']))
			{
				?>
					<div style="width:100%; clear:both; height:15px;"></div>
					<div class="muestrausuario">
					Bienvenido:
					<b><?php echo $_SESSION['nombre'];?></b>&nbsp;&nbsp;

					Perfil: 
					<b><?php echo $_SESSION['perfil_nombre'];?></b>
                    
					</div>
				<?php 			
			}
 
            ?>         
        
        
        </div>
	</nav>
    
	</header>
    
    
<!-- SECCION BODY HEADER FIN --> 
