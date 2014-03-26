 <a href="javascript:void(0);" title="Cerrar" onclick="cerrar();">Cerrar</a>
 <hr />
 <ul>
                  <?php
					for($i = 0; $i < sizeof($los_usuarios); $i++)
					{
						?>
                        
                        <li> * <?php echo $los_usuarios[$i]["nombre"];?></li>
                        
                		<?php	
					}
				  ?>
</ul>