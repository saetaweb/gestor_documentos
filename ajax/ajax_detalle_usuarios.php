 <a href="javascript:void(0);" title="Cerrar" onclick="cerrar();">Cerrar</a>
 <hr />
 <ul>
                  <?php
				  	require_once("conexion.php");
					$sql="select id_usuario, nombre from usuarios where id_perfil = '" . $_POST["el_valor"] . "'";
					/*
					$sql="select id_usuario, nombre from usuarios where id_perfil = '" . $_POST["id"] . "'";
					$sql="select id_usuario, nombre from usuarios where id_perfil = 2";
					*/
					$res=mysql_query($sql, $con);
					while ($los_usuarios=mysql_fetch_assoc($res))
					{
					?>
                    	<li> * <?php echo $los_usuarios["nombre"];?></li>
                	<?php	
					}
				  ?>
</ul>