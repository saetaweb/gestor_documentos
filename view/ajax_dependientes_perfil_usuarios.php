<select name="usuario_documento" required="required">
               <option value="0">Seleccione...</option> 
                  <?php
					for($i = 0; $i < sizeof($los_usuarios); $i++)
					{
						?>
               			<option value="<?php echo $los_usuarios[$i]["id_usuario"];?>" title="<?php echo $los_usuarios[$i]["nombre"];?>"> <?php echo $los_usuarios[$i]["nombre"];?></option>
                		<?php	
					}
				  ?>
</select>