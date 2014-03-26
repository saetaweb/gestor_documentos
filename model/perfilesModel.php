<?php
class Perfiles extends Configuracion
{
	private $conexionPDO;
	private $perfiles;
	
	public function __construct()
	{
		/*$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");*/
		$this->conexionPDO = parent::conectarPDO();
		$this->perfiles = array();
	}
	

	private function set_names_UTF8()
    {
        return $this->conexionPDO->query("SET NAMES 'utf8'");    
    }
	
	public function get_perfiles()
	{
		self::set_names_UTF8();
		$sqlconsulta = "select id_perfil, nombre from perfiles";
		
		foreach($this->conexionPDO->query($sqlconsulta) as $registro)
		{
			$this->perfiles[] = $registro;
		}
		
		return $this->perfiles;
		
		$this->conexionPDO = null;		
	}

	public function add_perfil()
	{
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["nombre_perfil"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=add_perfil&msj=1");
			exit;
		}
		
		/*echo "hasta aqui vamos bien 01"; exit;*/
			
		self::set_names_UTF8();
		
		/*verificamos primero que la categoria no este ya en la DB*/
		$sqlconsulta2 = "select count(*) from perfiles where nombre = ?";	
		$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
		$elnombre = Configuracion::guerreras_magicas($_POST["nombre_perfil"]);
		$PDOsoporte2->bindValue(1,$elnombre,PDO::PARAM_STR);
		$PDOsoporte2->execute();
		
		/*si el perfil es nuevo en la DB entonces iniciamos la insercion del nvo registro*/
		if($PDOsoporte2->fetchColumn() == 0)
		{
			$sqlconsulta = "insert into perfiles values (null, ?)";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				
			/*filtramos con guerreras magicas() para evitar ataques xsl*/
			$elnombre = Configuracion::guerreras_magicas($_POST["nombre_perfil"]);
				
			$PDOsoporte->bindValue(1,$elnombre,PDO::PARAM_STR);
					
			if($PDOsoporte->execute())
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=add_perfil&msj=3");	
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=add_perfil&msj=2");		
			}		
		}	
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=add_perfil&msj=2");		
		}				
	}


	public function verifica_nombre_perfil($elnombreperfil, $elperfilid)
	{
		if(isset($elnombreperfil) and isset($elperfilid))
		{
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) from perfiles where id_perfil = ? and nombre = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$el_perfilid = Configuracion::guerreras_magicas($elperfilid);
			$el_nombre = Configuracion::guerreras_magicas($elnombreperfil);
			
			$PDOsoporte->bindValue(1,$el_perfilid,PDO::PARAM_INT);
			$PDOsoporte->bindValue(2,$el_nombre,PDO::PARAM_STR);
			$PDOsoporte->execute();			

			/*si la verificacion es exitosa, entonces la id si existe en la DB...*/
			if($PDOsoporte->fetchColumn() > 0)
			{
				return $el_nombre;
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=error");
				exit;		
			}
		
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
			exit;		
		}
	
	}
	
	
	public function cuenta_dependientes_perfil_usuarios($elperfilid)
	{
		if(isset($elperfilid))
		{
			/*
			echo $elusuarioid; exit;*/
			
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) nombre from perfiles where id_perfil = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$el_perfilid = Configuracion::guerreras_magicas($elperfilid);
			
			$PDOsoporte->bindValue(1,$el_perfilid,PDO::PARAM_INT);
			$PDOsoporte->execute();			

			/*si la verificacion es exitosa, entonces la id si existe en la DB...*/
			if($PDOsoporte->fetchColumn() > 0)
			{
				$sqlconsulta2 = "select count(*) as contados from usuarios where id_perfil = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$el_id_perfil = $el_perfilid;
			
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte2->execute(array($el_id_perfil)))
				{	
					while($registro = $PDOsoporte2->fetch())
					{
						$this->total[]=$registro;
					}
					
					/*$total_noticias = $this->total[0]["contados"];*/
					return $this->total;

					$this->conexionPDO = null;			
				}
				else
				{
					header("Location: " . Configuracion::ruta() . "?controlador=error");		
				}
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=error");		
			}				
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");		
		}	
	}
	
	public function cuenta_dependientes_perfil_documentos($elperfilid)
	{
		if(isset($elperfilid))
		{
			/*
			echo $elusuarioid; exit;*/
			
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) nombre from perfiles where id_perfil = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$el_perfilid = Configuracion::guerreras_magicas($elperfilid);
			
			$PDOsoporte->bindValue(1,$el_perfilid,PDO::PARAM_INT);
			$PDOsoporte->execute();			

			/*si la verificacion es exitosa, entonces la id si existe en la DB...*/
			if($PDOsoporte->fetchColumn() > 0)
			{
				$sqlconsulta2 = "select count(*) as contados2 from documentos where id_perfil = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$el_id_perfil = $el_perfilid;
			
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte2->execute(array($el_id_perfil)))
				{	
					while($registro2 = $PDOsoporte2->fetch())
					{
						$this->total2[]=$registro2;
					}
					
					/*$total_noticias = $this->total[0]["contados"];*/
					return $this->total2;

					$this->conexionPDO = null;			
				}
				else
				{
					header("Location: " . Configuracion::ruta() . "?controlador=error");		
				}
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=error");		
			}				
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");		
		}	
	}



	
	public function delete_perfil($id_perfil)
	{	
		if(isset($id_perfil))
		{
			self::set_names_UTF8();		

			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta2 = "select count(*) from perfiles where id_perfil = ?";
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elidperfil = Configuracion::guerreras_magicas($id_perfil);
			$PDOsoporte2->bindValue(1,$elidperfil,PDO::PARAM_INT);
			$PDOsoporte2->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporte2->fetchColumn() > 0)
			{
				/*aqui eliminamos los demas datos del registro del perfil*/	
				$sqlconsulta = "delete from perfiles where id_perfil = ?";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
				$el_id_perfil = Configuracion::guerreras_magicas($id_perfil);
				
				/*y aqui eliminamos los usuarios asociados con el usuario a eliminar*/
				$sqlconsulta2 = "delete from usuarios where id_perfil = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				$el_id_perfil2 = $el_id_perfil;
				
				/*y aqui eliminamos los documentos asociados con el usuario a eliminar*/
				$sqlconsulta3 = "delete from documentos where id_perfil = ?";
				$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);
				
				$el_id_perfil3 = $el_id_perfil;				


				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte->execute(array($el_id_perfil)) and $PDOsoporte2->execute(array($el_id_perfil2)) and $PDOsoporte3->execute(array($el_id_perfil3)))
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_perfiles&msj=1");
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_perfiles&msj=2");
				}					
			
			}
			else
			{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=ver_perfiles&msj=2");		
			}	
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=ver_perfiles&msj=2");
		}	
	}

	public function get_perfil_por_id($id_perfil)
		{
			if(isset($id_perfil))
			{
				/*echo $categoria_id . "estoy en el metodo"; exit;*/
				
				self::set_names_UTF8();
				
				/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
				$sqlconsulta = "select count(*) from perfiles where id_perfil = ?";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				$elidperfil = Configuracion::guerreras_magicas($id_perfil);
			
				$PDOsoporte->bindValue(1,$elidperfil,PDO::PARAM_INT);
				
				if($PDOsoporte->execute())
				{
					/* echo "aqui vamos bien"; exit;*/
					
					/*si en efecto la id SI esta en la DB y no hay ninguna trampa.. */
					if($PDOsoporte->fetchColumn() > 0)
					{
							$sqlconsulta2 = "select id_perfil, nombre from perfiles where id_perfil = ?";
							$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
							$el_id_perfil = Configuracion::guerreras_magicas($id_perfil);
							
							//COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($el_id_usuario)	
							$PDOsoporte2->execute(array($el_id_perfil));
							while($registro = $PDOsoporte2->fetch())
							{
								$this->perfiles[] = $registro;
							}
							return $this->perfiles;
							$this->conexionPDO=null;				
					}
					else
					{
							$this->conexionPDO=null;
							header("Location: " . Configuracion::ruta() . "?controlador=error");				
					}
	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=error");
				}			
						
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=error");
			}
		}
		
		
	public function edit_perfil()
	{	
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["nombre_perfil"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_perfil&msj=1");
			exit;
		}		
		
		
		
		self::set_names_UTF8();
			
		/*verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa por POST*/
		$sqlconsultaM = "select count(*) from perfiles where id_perfil = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		$elidperfil = Configuracion::guerreras_magicas($_POST["id_perfil"]);
        
        $PDOsoporteM->bindValue(1,$elidperfil,PDO::PARAM_INT);		
		
		$PDOsoporteM->execute();
			
		/*si no se encuentra ningun resultado, entonces el dato que nos viene por POST es malicioso.. */
		if($PDOsoporteM->fetchColumn() == 0)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
			exit;				
		}		
		/**/
		
		/*
		verificamos primero que el nombre no este ya en la DB
		A MENOS QUE.. sea el mismo que ya tenia antes, 
		en cuyo caso el sistema debe permitir conservarlo, actualizando los demas valores
		*/
		
		$sqlconsulta2 = "select count(*) from perfiles where nombre = ? and ? != ?";	
		$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
		$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre_perfil"]);
		$elnombre3 = Configuracion::guerreras_magicas($_POST["antiguo_nombre"]);
		$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
		$PDOsoporte2->bindValue(2,$elnombre2,PDO::PARAM_STR);
		$PDOsoporte2->bindValue(3,$elnombre3,PDO::PARAM_STR);
		$PDOsoporte2->execute();
		
		/*si el nombre es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
		if($PDOsoporte2->fetchColumn() == 0)
		{
			/*echo "hasta aqui vamos bien 02"; exit;*/
			
			$sqlconsulta = "
			
			update perfiles set 
			nombre = ?  
			where id_perfil = ?
			
			";	
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			/*filtramos con guerreras magicas() para evitar ataques xsl*/
			$elnombre = Configuracion::guerreras_magicas($_POST["nombre_perfil"]);
			$elidperfil = Configuracion::guerreras_magicas($_POST["id_perfil"]);
			
			$PDOsoporte->bindValue(1,$elnombre,PDO::PARAM_STR);
			$PDOsoporte->bindValue(2,$elidperfil,PDO::PARAM_INT);
			
			if($PDOsoporte->execute())
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_perfil&msj=3&id_perfil=" . $_POST["id_perfil"]);					
			}
			else
			{
				$this->conexionPDO=null;	
				header("Location: " . Configuracion::ruta() . "?controlador=editar_perfil&msj=2&id_perfil=" . $_POST["id_perfil"]);	
			}
			
		}
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=editar_perfil&msj=4&id_perfil=" . $_POST["id_perfil"]);	
		}			
	}		

/***** METODOS AJAX ******/		
		
		
	public function ajax_valida_crear_perfil()
	{
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select nombre from perfiles where nombre = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		/*$elvalor = Configuracion::guerreras_magicas($_GET["id"]);*/
		$elvalor = Configuracion::guerreras_magicas($_GET["el_valor"]);
		/*echo $elvalor; exit;*/
        
        $PDOsoporteM->bindValue(1,$elvalor,PDO::PARAM_STR);		
		$PDOsoporteM->execute();
		
		
		while($registro = $PDOsoporteM->fetch())
		{
			$this->perfiles[] = $registro;
		}
		return $this->perfiles;
		$this->conexionPDO = null;		
	}

	public function ajax_valida_editar_perfil()
	{
		self::set_names_UTF8();
		
		/*
		$sql="select nombre from perfiles where 
nombre='" . $_GET["el_valor"] . "' and '" . $_GET["el_valor"] . "' != '" . $_GET["el_valor2"] . "'";
		*/
		
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select nombre from perfiles where nombre = ? and ? != ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		
		/*$elvalor = Configuracion::guerreras_magicas($_GET["id"]);*/
		$elvalor = Configuracion::guerreras_magicas($_GET["el_valor"]);
		$elvalor2 = Configuracion::guerreras_magicas($_GET["el_valor2"]);
		/*echo $elvalor; exit;*/
        
        $PDOsoporteM->bindValue(1,$elvalor,PDO::PARAM_STR);	
		$PDOsoporteM->bindValue(2,$elvalor,PDO::PARAM_STR);
		$PDOsoporteM->bindValue(3,$elvalor2,PDO::PARAM_STR);		
		$PDOsoporteM->execute();
		
		
		while($registro = $PDOsoporteM->fetch())
		{
			$this->perfiles[] = $registro;
		}
		return $this->perfiles;
		$this->conexionPDO = null;		
	}

	

/* este es el fin de la clase  */
}

?>