<?php

if(isset($_GET['perfil']))
{
	/*$lacategoria = Configuracion::guerreras_magicas($_GET['categoria']);*/
	$elperfil = $_GET['perfil'];

		if (!$posicion == 0)
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&perfil=<?php echo $elperfil;?>&pos=0" title="Primero">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/inicio.png"/>
			</a>
			<?php
		}
		else
		{
			?>
		
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		
		/*-------------------------------------------------*/
		
		if ($posicion == 0)
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		else
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&perfil=<?php echo $elperfil;?>&pos=<?php echo $posicion - $paso;?>" title="Anteriores">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/atras.png"/>
			</a>
			<?php
		}
		
		
		/*-------------------------------------------------*/
		
		
		
		if ($impresos == $paso)
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&perfil=<?php echo $elperfil;?>&pos=<?php echo $posicion + $paso;?>" title="Siguientes">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/adelante.png"/>
			</a>
			<?php
		}
		else
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		
		
		/*-------------------------------------------------*/
		
		
		if ($posicion == $ultimo)
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		else
		{ 
		/*echo "ultimo->" . $ultimo . "  ---posicion->" . $posicion . "  ---totaldocumentos->" . $total_documentos . "  ---resto->" . $resto;*/
		?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&perfil=<?php echo $elperfil;?>&pos=<?php echo $ultimo;?>" title="Ultimo">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/final.png"/>
			</a>
		<?php
		}




}
else
{
		if (!$posicion==0)
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&pos=0" title="Primero">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/inicio.png"/>
			</a>
			<?php
		}
		else
		{
			?>
		
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		
		/*-------------------------------------------------*/
		
		if ($posicion==0)
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		else
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&pos=<?php echo $posicion - $paso;?>" title="Anteriores">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/atras.png"/>
			</a>
			<?php
		}
		
		
		/*-------------------------------------------------*/
		
		
		
		if ($impresos == $paso)
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&pos=<?php echo $posicion + $paso;?>" title="Siguientes">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/adelante.png"/>
			</a>
			<?php
		}
		else
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		
		
		/*-------------------------------------------------*/
		
		
		if ($posicion == $ultimo)
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		else
		{
		?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_documentos&pos=<?php echo $ultimo;?>" title="Ultimo">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/final.png"/>
			</a>
		<?php
		}
		
}		
	
		?>
