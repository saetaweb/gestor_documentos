<select name="usuario_documento" required="required">
               <option value="0">Seleccione...</option> 
                  <?php
				  	require_once("conexion.php");
					$sql="select id_usuario, nombre from usuarios where id_perfil = '" . $_POST["el_valor"] . "'";
					$res=mysql_query($sql, $con);
					while ($los_usuarios=mysql_fetch_assoc($res))
					{
					?>
               		<option value="<?php echo $los_usuarios["id_usuario"];?>" title="<?php echo $los_usuarios["nombre"];?>"> <?php echo $los_usuarios["nombre"];?></option>
                	<?php	
					}
				  ?>
</select>