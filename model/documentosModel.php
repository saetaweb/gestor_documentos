<?php
class Documentos extends Configuracion
{
	private $conexionPDO;
	private $documentos;
	private $total;
	
	public function __construct()
	{
		/*$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");*/
		$this->conexionPDO = parent::conectarPDO();
		$this->documentos = array();
		$this->total = array();
	}

	private function set_names_UTF8()
    {	
		/*parent::__construct();*/
        return $this->conexionPDO->query("SET NAMES 'utf8'");    
    }	

	private function myfileformer($original, $prefijo)
		{	
			$explotado = explode('.', $original);
			$finalname = $prefijo . "." . $explotado[1];
			return $finalname;   
		}	

	public function admin_get_documentos($posicion, $paso)
	{
		self::set_names_UTF8();

		if(isset($_GET['perfil']))
		{
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsultaK = "select count(*) from perfiles where id_perfil = ?";
			$PDOsoporteK = $this->conexionPDO->prepare($sqlconsultaK);
			$elperfil = Configuracion::guerreras_magicas($_GET['perfil']);
			$PDOsoporteK->bindValue(1,$elperfil,PDO::PARAM_INT);
			$PDOsoporteK->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporteK->fetchColumn() > 0)
			{
				$sqlconsulta = "
				select doc.id_documento, doc.id_perfil, doc.id_usuario, doc.nombre, doc.descripcion, doc.tipo, doc.archivo, perf.nombre as perfil_nombre
				from documentos as doc, perfiles as perf
				where doc.id_perfil = perf.id_perfil
				and perf.id_perfil = ? 
				limit $posicion, $paso
				";
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				$el_idperfil = Configuracion::guerreras_magicas($_GET['perfil']);
				
				/*OPCION 01 HACIENDOLO CON EL BIND VALUE...*/		
				$PDOsoporte->bindValue(1,$el_idperfil,PDO::PARAM_INT);
				$PDOsoporte->execute();

				while($registro = $PDOsoporte->fetch())
				{
					$this->documentos[] = $registro;
				}
				return $this->documentos;
				$this->conexionPDO=null;				
					
				/*
				OPCION 02 SIN HACERLE EL BIND VALUE
				COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($el_id_perfil)
				if($PDOsoporte->execute(array($el_id_perfil)))
				{	
					while($registro = $PDOsoporte->fetch())
					{
						$this->documentos[]=$registro;
					}
					return $this->documentos;
					$this->conexionPDO = null;			
				}
				*/				
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=error");			
			}
		}
		else
		{
			$sqlconsulta = "
			select doc.id_documento, doc.id_perfil, doc.nombre, doc.descripcion, doc.tipo, doc.archivo, perf.nombre as perfil_nombre
			from documentos as doc, perfiles as perf
			where doc.id_perfil = perf.id_perfil 
			limit $posicion, $paso
			";
			foreach($this->conexionPDO->query($sqlconsulta) as $registro)
			{
				$this->documentos[] = $registro;
			}
			return $this->documentos;
			$this->conexionPDO = null;		
		}	
	}




	public function admin_cuenta_documentos()
	{
			self::set_names_UTF8();	
			
			if(isset($_GET['perfil']))
			{
				/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
				$sqlconsultaK = "select count(*) from perfiles where id_perfil = ?";
				$PDOsoporteK = $this->conexionPDO->prepare($sqlconsultaK);
				$elperfil = Configuracion::guerreras_magicas($_GET['perfil']);
				$PDOsoporteK->bindValue(1,$elperfil,PDO::PARAM_INT);
				$PDOsoporteK->execute();
					
				/*si la verificacion es exitosa, y hay al menos un resultado...*/
				if($PDOsoporteK->fetchColumn() > 0)
				{
					$sqlconsulta = "select count(*) as contados from documentos where id_perfil = ?";	
					$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					$el_idperfil = Configuracion::guerreras_magicas($_GET['perfil']);					
					
					$PDOsoporte->bindValue(1,$el_idperfil,PDO::PARAM_INT);
					$PDOsoporte->execute();

					while($registro = $PDOsoporte->fetch())
					{
						$this->total[] = $registro;
					}
					return $this->total;
					$this->conexionPDO=null;					
					/*	
					foreach($this->conexionPDO->query($sqlconsulta) as $registro)
					{
						$this->total[] = $registro;
					}	
					return $this->total;	
					$this->conexionPDO = null;
					*/				
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=error");				
				}
			}
			else
			{
				$sqlconsulta = "select count(*) as contados from documentos";	
				foreach($this->conexionPDO->query($sqlconsulta) as $registro)
				{
					$this->total[] = $registro;
				}	
				return $this->total;	
				$this->conexionPDO = null;		
			}
	}
		
	public function get_documentos($elidperfil)
	{
		/**/
		self::set_names_UTF8();
		
		/*blindado anti trampa get*/
		$sqlconsulta2 = "select count(*) from perfiles where id_perfil = ?";
				
		$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
		$el_idperfil = Configuracion::guerreras_magicas($elidperfil);
		$PDOsoporte2->bindValue(1,$el_idperfil,PDO::PARAM_INT);
		$PDOsoporte2->execute();
				
		if($PDOsoporte2->fetchColumn() > 0)
		{
			$sqlconsulta = "
			
			select doc.id_documento, doc.id_perfil, doc.id_usuario, doc.nombre, doc.descripcion, doc.tipo, doc.archivo, perf.nombre as perfil_nombre 
	
			from documentos as doc, perfiles as perf
	
			where doc.id_perfil = perf.id_perfil
			
			and doc.id_perfil = ? 
			
			";

			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$el_idperfil = Configuracion::guerreras_magicas($elidperfil);
			$PDOsoporte->bindValue(1,$el_idperfil,PDO::PARAM_INT);
			$PDOsoporte->execute();

			while($registro = $PDOsoporte->fetch())
			{
				$this->documentos[] = $registro;
			}
			return $this->documentos;
			$this->conexionPDO=null;		
		}
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=login");		
		}				
	}

	public function cuenta_documentos($elidperfil)
	{
		
		/**/
		self::set_names_UTF8();
		
		/*blindado anti trampa get*/
		$sqlconsulta2 = "select count(*) from perfiles where id_perfil = ?";
				
		$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
		$el_idperfil = Configuracion::guerreras_magicas($elidperfil);
		$PDOsoporte2->bindValue(1,$el_idperfil,PDO::PARAM_INT);
		$PDOsoporte2->execute();
				
		if($PDOsoporte2->fetchColumn() > 0)
		{
			$sqlconsulta = "select count(*) as contados from documentos where id_perfil = ?";

			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$el_idperfil = Configuracion::guerreras_magicas($elidperfil);
			$PDOsoporte->bindValue(1,$el_idperfil,PDO::PARAM_INT);
			$PDOsoporte->execute();

			while($registro = $PDOsoporte->fetch())
			{
				$this->total[] = $registro;
			}
			return $this->total;
			$this->conexionPDO=null;		
		}
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=login");		
		}		

	}
		
	public function add_documento()
		{
			/*comprobamos que no haya campos sin llenar */
			if(empty($_POST["perfil_documento"]) or empty($_POST["usuario_documento"]) or empty($_POST["nombre_documento"]) or empty($_POST["descripcion_documento"]) or empty($_FILES["archivo_documento"]["name"]))
			{
				header("Location: " . Configuracion::ruta() . "?controlador=add_documento&msj=1");
				exit;
			}
			
			/*AQUI FILTRAMOS PARA NO DEJAR SUBIR ARCHIVOS DE TIPO IMAGEN*/
			if($_FILES['archivo_documento']['type'] == "image/jpeg" or $_FILES['archivo_documento']['type'] == "image/png" or $_FILES['archivo_documento']['type'] == "image/gif")
			{
				header("Location: " . Configuracion::ruta() . "?controlador=add_documento&msj=6");
				exit;
			}
			
			self::set_names_UTF8();
			
			/*AQUI DEBEMOS VERIFICAR QUE EL NOMBRE DEL DOCUMENTO NO ESTA YA OCUPADO*/
			$sqlconsulta2 = "select count(*) from documentos where nombre = ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$el_nombre = Configuracion::guerreras_magicas($_POST["nombre_documento"]);
			$PDOsoporte2->bindValue(1,$el_nombre,PDO::PARAM_STR);
			$PDOsoporte2->execute();
			
			if($PDOsoporte2->fetchColumn() > 0)
			{
				header("Location: " . Configuracion::ruta() . "?controlador=add_documento&msj=4");
				exit;
			}
			
/*print_r($_POST);echo "<hr>";print_r($_FILES);echo "<hr>";echo "<br>";echo $prefijo;*/

			$original = $_FILES["archivo_documento"]["name"];
			$prefijo = $_POST["nombre_documento"];
			
			$archivo = self::myfileformer($original, $prefijo);
			/*echo $archivo;exit;*/						
			/*$lafoto = Configuracion::guerreras_magicas($_POST["nombres"]) . ".jpg";
			$mifilename = Configuracion::guerreras_magicas($_POST["nombre_documento"]);*/
			
			/*subimos el archivo a la aplicacion*/
			copy($_FILES["archivo_documento"]["tmp_name"], "public/myfiles/" . $archivo);
			
			/*OJO QUE EN EL TERECER VALOR LE DEJAMOS "1" SOLO PROVISIONALMENTE!!!*/	
			$sqlconsulta = "insert into documentos values (null,?,?,?,?,?,?)";
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			/*filtramos con guerreras magicas() para evitar ataques xsl*/
			$el_id_perfil = Configuracion::guerreras_magicas($_POST["perfil_documento"]);
			$el_id_usuario = Configuracion::guerreras_magicas($_POST["usuario_documento"]);
			$el_nombre = Configuracion::guerreras_magicas($_POST["nombre_documento"]);
			$la_descripcion = Configuracion::guerreras_magicas($_POST["descripcion_documento"]);
			$el_tipo = Configuracion::guerreras_magicas($_FILES["archivo_documento"]["type"]);
			/*$el_archivo = Configuracion::guerreras_magicas($_POST["archivo_documento"]);*/
			
			$PDOsoporte->bindValue(1,$el_id_perfil,PDO::PARAM_STR);
			$PDOsoporte->bindValue(2,$el_id_usuario,PDO::PARAM_STR);
			$PDOsoporte->bindValue(3,$el_nombre,PDO::PARAM_STR);
			$PDOsoporte->bindValue(4,$la_descripcion,PDO::PARAM_STR);
			$PDOsoporte->bindValue(5,$el_tipo,PDO::PARAM_STR);
			$PDOsoporte->bindValue(6,$archivo,PDO::PARAM_STR);
			
			if($PDOsoporte->execute())
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=add_documento&msj=3");	
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=add_documento&msj=2");		
			}
		}

	public function delete_documento($id_documento)
		{
			if(isset($id_documento))
			{
				self::set_names_UTF8();
	
				/*blindado anti trampa get*/
				$sqlconsulta = "select count(*) from documentos where id_documento = ?";
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				$eliddocumento = Configuracion::guerreras_magicas($id_documento);
				$PDOsoporte->bindValue(1,$eliddocumento,PDO::PARAM_INT);
				$PDOsoporte->execute();
				
				if($PDOsoporte->fetchColumn() > 0)
				{
					
					/*echo "hasta aqui vamos bien 02"; exit;
					basandonos en la id del usuario obtenemos el nombre de su foto asociada*/
					$sqlconsulta3 = "select archivo from documentos where id_documento = ?";
					$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);
					$PDOsoporte3->bindValue(1,$eliddocumento,PDO::PARAM_INT);
					$PDOsoporte3->execute();
					
					/*transformamos el objeto de clase PDO en un array asociativo*/
					$gainax = $PDOsoporte3->fetch();
	
					/*eliminamos la foto de la aplicacion SOLO si NO es la por defecto de la aplicacion*/			

					unlink('public/myfiles/' . $gainax['archivo']);				
				
					$sqlconsulta2 = "delete from documentos where id_documento = ?";
					
					$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
					
					$el_id_documento = Configuracion::guerreras_magicas($id_documento);
			
					/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_noticia)*/
					if($PDOsoporte2->execute(array($el_id_documento)))
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=ver_documentos&msj=1");
					}
					else
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=ver_documentos&msj=2");
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
				header("Location: " . Configuracion::ruta() . "?controlador=ver_documentos&msj=2");
			}
		}
		
		
		
	public function get_documento_por_id($id_documento)
	{
		if(isset($id_documento))
		{
			/*echo "hasta aqui vamos bien 01"; exit;*/
			
			self::set_names_UTF8();
			
			/*blindado anti trampa get*/
			$sqlconsulta = "select count(*) from documentos where id_documento = ?";
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$eliddocumento = Configuracion::guerreras_magicas($id_documento);
        
        	$PDOsoporte->bindValue(1,$eliddocumento,PDO::PARAM_INT);
			
			$PDOsoporte->execute();

			if($PDOsoporte->fetchColumn() > 0)
			{				
					
					/*echo "hasta aqui vamos bien 02"; exit;*/
					
					$sqlconsulta3 = "select id_documento, id_perfil, id_usuario, nombre, descripcion, tipo, archivo from documentos where id_documento = ?";
					$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);		
					$PDOsoporte3->bindValue(1,$eliddocumento,PDO::PARAM_INT);
					$PDOsoporte3->execute();						

					while($registro = $PDOsoporte3->fetch())
					{
						$this->documentos[] = $registro;
					}
					return $this->documentos;
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
			header("Location: " . Configuracion::ruta() . "?controlador=error");
		}
	}
		

	public function edit_documento()
	{
		/*comprobamos que no haya campos sin llenar */
		if(empty($_POST["perfil_documento"]) or empty($_POST["usuario_documento"]) or empty($_POST["nombre_documento"]) or empty($_POST["descripcion_documento"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=1");
			exit;
		}
		
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select count(*) from documentos where id_documento = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		$eliddocumento = Configuracion::guerreras_magicas($_POST["id_documento"]);
        
        $PDOsoporteM->bindValue(1,$eliddocumento,PDO::PARAM_INT);		
		
		$PDOsoporteM->execute();
			
		/*si no se encuentra ningun resultado, entonces el dato que nos viene por POST es malicioso.. */
		if($PDOsoporteM->fetchColumn() == 0)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
			exit;				
		}
		
		/* si el usuario no actualiza el archivo... */
		if(empty($_FILES["archivo_documento"]["name"]))
		{		
			/*ojo que el usuario si cambia el nombre del archivo, obligatoriamente debe volver a subir el archivo*/
			if($_POST["antiguo_nombre"] != $_POST["nombre_documento"])
			{
				/*header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=5");*/
				header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=5&id_documento=" . $_POST["id_documento"]);
				exit;			
			}
						
			/*
			verificamos primero que el nombre no este ya en la DB
			A MENOS QUE.. sea el mismo que ya tenia antes, 
			en cuyo caso el sistema debe permitir conservarlo, actualizando los demas valores
			*/
			
			$sqlconsulta2 = "select count(*) from documentos where nombre = ? and ? != ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre"]);
			$elnombre3 = Configuracion::guerreras_magicas($_POST["antiguo_nombre"]);
			$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(2,$elnombre2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(3,$elnombre3,PDO::PARAM_STR);
			$PDOsoporte2->execute();

			/*si el nombre es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
			if($PDOsoporte2->fetchColumn() == 0)
			{	
				
				self::set_names_UTF8();	
				$sqlconsulta = "
				
				update documentos set 
				id_perfil = ?, 
				id_usuario = ?,
				nombre = ?, 
				descripcion = ?, 
				tipo = ?, 
				archivo = ? 
				where id_documento = ?
				
				";	
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$elidperfil = Configuracion::guerreras_magicas($_POST["perfil_documento"]);
				$elidusuario = Configuracion::guerreras_magicas($_POST["usuario_documento"]);
				$elnombre = Configuracion::guerreras_magicas($_POST["nombre_documento"]);
				$ladescripcion = Configuracion::guerreras_magicas($_POST["descripcion_documento"]);
				$eltipo = Configuracion::guerreras_magicas($_POST["antiguo_tipo"]);
				$elarchivo = Configuracion::guerreras_magicas($_POST["antiguo_archivo"]);
				$eliddocumento = Configuracion::guerreras_magicas($_POST["id_documento"]);
				
				$PDOsoporte->bindValue(1,$elidperfil,PDO::PARAM_INT);
				$PDOsoporte->bindValue(2,$elidusuario,PDO::PARAM_INT);
				$PDOsoporte->bindValue(3,$elnombre,PDO::PARAM_STR);
				$PDOsoporte->bindValue(4,$ladescripcion,PDO::PARAM_STR);
				$PDOsoporte->bindValue(5,$eltipo,PDO::PARAM_STR);
				$PDOsoporte->bindValue(6,$elarchivo,PDO::PARAM_STR);
				$PDOsoporte->bindValue(7,$eliddocumento,PDO::PARAM_INT);
				
				if($PDOsoporte->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=3&id_documento=" . $_POST["id_documento"]);	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=2&id_documento=" . $_POST["id_documento"]);
				}
						
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=4&id_documento=" . $_POST["id_documento"]);
			}		
		
		}
		/*si por el contrario, el usuario si actualiza el archivo...*/
		else
		{
			
			/*AQUI FILTRAMOS PARA NO DEJAR SUBIR ARCHIVOS DE TIPO IMAGEN*/
			if($_FILES['archivo_documento']['type'] == "image/jpeg" or $_FILES['archivo_documento']['type'] == "image/png" or $_FILES['archivo_documento']['type'] == "image/gif")
			{
				header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=6&id_documento=" . $_POST["id_documento"]);
				exit;
			}




			/*
			verificamos primero que el nombre no este ya en la DB
			A MENOS QUE.. sea el mismo que ya tenia antes, 
			en cuyo caso el sistema debe permitir conservarlo, actualizando los demas valores
			*/
			
			$sqlconsulta2 = "select count(*) from documentos where nombre = ? and ? != ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre"]);
			$elnombre3 = Configuracion::guerreras_magicas($_POST["antiguo_nombre"]);
			$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(2,$elnombre2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(3,$elnombre3,PDO::PARAM_STR);
			$PDOsoporte2->execute();		
		
			/*si el nombre es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
			if($PDOsoporte2->fetchColumn() == 0)
			{	

				/*eliminamos el viejo archivo de la aplicacion*/
				$viejo_archivo = Configuracion::guerreras_magicas($_POST["antiguo_archivo"]);			
				unlink('public/myfiles/' . $viejo_archivo);	


				/*usamos nuestra funcion para armar el nvo nombre del archivo*/
				$original = $_FILES["archivo_documento"]["name"];
				$prefijo = $_POST["nombre_documento"];
			
				$archivo = self::myfileformer($original, $prefijo);
				

				/*subimos el archivo a la aplicacion*/
				copy($_FILES["archivo_documento"]["tmp_name"], 'public/myfiles/' . $archivo);

				/*y actualizamos los demas datos*/
				$sqlconsulta = "
				
				update documentos set 
				id_perfil = ?, 
				id_usuario = ?,
				nombre = ?, 
				descripcion = ?, 
				tipo = ?, 
				archivo = ? 
				where id_documento = ?
				
				";	
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$elidperfil = Configuracion::guerreras_magicas($_POST["perfil_documento"]);
				$elidusuario = Configuracion::guerreras_magicas($_POST["usuario_documento"]);
				$elnombre = Configuracion::guerreras_magicas($_POST["nombre_documento"]);
				$ladescripcion = Configuracion::guerreras_magicas($_POST["descripcion_documento"]);
				$eltipo = Configuracion::guerreras_magicas($_FILES["archivo_documento"]["type"]);
				/*$elarchivo = Configuracion::guerreras_magicas($archivo);*/
				$eliddocumento = Configuracion::guerreras_magicas($_POST["id_documento"]);
				
				$PDOsoporte->bindValue(1,$elidperfil,PDO::PARAM_INT);
				$PDOsoporte->bindValue(2,$elidusuario,PDO::PARAM_INT);
				$PDOsoporte->bindValue(3,$elnombre,PDO::PARAM_STR);
				$PDOsoporte->bindValue(4,$ladescripcion,PDO::PARAM_STR);
				$PDOsoporte->bindValue(5,$eltipo,PDO::PARAM_STR);
				$PDOsoporte->bindValue(6,$archivo,PDO::PARAM_STR);
				$PDOsoporte->bindValue(7,$eliddocumento,PDO::PARAM_INT);
				
				if($PDOsoporte->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=3&id_documento=" . $_POST["id_documento"]);	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=2&id_documento=" . $_POST["id_documento"]);
				}										
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_documento&msj=4&id_documento=" . $_POST["id_documento"]);
			}
		}
	}
		
/***** METODOS AJAX ******/		
		
		
	public function ajax_valida_crear_documento()
	{
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select nombre, descripcion from documentos where nombre = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		/*$elvalor = Configuracion::guerreras_magicas($_GET["id"]);*/
		$elvalor = Configuracion::guerreras_magicas($_GET["el_valor"]);
		/*echo $elvalor; exit;*/
        
        $PDOsoporteM->bindValue(1,$elvalor,PDO::PARAM_STR);		
		$PDOsoporteM->execute();
		
		
		while($registro = $PDOsoporteM->fetch())
		{
			$this->documentos[] = $registro;
		}
		return $this->documentos;
		$this->conexionPDO = null;		
	}		


	public function ajax_valida_editar_documento()
	{
		self::set_names_UTF8();
		
		/*
		$sql="select nombre from documentos where 
nombre='" . $_GET["el_valor"] . "' and '" . $_GET["el_valor"] . "' != '" . $_GET["el_valor2"] . "'";
		*/
		
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select nombre from documentos where nombre = ? and ? != ?";
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
			$this->documentos[] = $registro;
		}
		return $this->documentos;
		$this->conexionPDO = null;		
	}
	
	
		
		
/*********************************************************************************************************************************/


}

?>