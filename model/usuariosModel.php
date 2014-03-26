<?php
class Usuarios extends Configuracion
{
	private $conexionPDO;
	private $usuarios;
	private $estado;
	private $autenticado;
	
	public function __construct()
	{
		/*$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");*/
		$this->conexionPDO = parent::conectarPDO();
		$this->usuarios = array();
		$this->autenticado = array();
	}
	

	private function set_names_UTF8()
    {
        return $this->conexionPDO->query("SET NAMES 'utf8'");    
    }
	
	public function login()
	{
			/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
			if(empty($_POST["login"]) or empty($_POST["password"]))
			{
				header("Location: " . Configuracion::ruta() . "?controlador=login&msj=1");
				exit;
			}
				
				self::set_names_UTF8();		
	
				/*verificamos si los datos del usuario estan en la DB*/
				$sqlconsulta2 = "
				
				select usus.id_usuario, usus.id_perfil, usus.nombre, usus.login, usus.email, perf.nombre as elperfil
				from usuarios as usus, perfiles as perf
				where usus.id_perfil = perf.id_perfil
				and login = ?
				and passwordjsphp = ?
				
				";
					
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
	
				$ellogin = Configuracion::guerreras_magicas($_POST["login"]);
				$elpassword = md5(Configuracion::guerreras_magicas($_POST["password"]));
	
	
				$PDOsoporte2->bindValue(1,$ellogin,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(2,$elpassword,PDO::PARAM_STR);
	
				$PDOsoporte2->execute();
	
				if($autenticado = $PDOsoporte2->fetch())
				{	
					
					/*print_r($this->autenticado); exit;*/
	
					$_SESSION['id_usuario'] = $autenticado['id_usuario'];
					$_SESSION['id_perfil'] = $autenticado['id_perfil'];
					$_SESSION['nombre'] = $autenticado['nombre'];
					$_SESSION['login'] = $autenticado['login'];
					$_SESSION['email'] = $autenticado['email'];
					$_SESSION['perfil_nombre'] = $autenticado['elperfil'];
					
					header("Location: " . Configuracion::ruta() . "?controlador=ver_documentos");
					exit;
					
		
				}
				else
				{
					header("Location: " . Configuracion::ruta() . "?controlador=login&msj=2");
					exit;
				}
	}
	
	public function logout()
	{
			session_destroy();
			header("Location: " . Configuracion::ruta()."?controlador=login");
			exit;
	}	
	
	public function get_usuarios()
	{
		self::set_names_UTF8();	
		$sqlconsulta = "
		
		select usu.id_usuario, usu.id_perfil, usu.nombre, usu.login, usu.passwordjs, usu.passwordjsphp, usu.email, 
		per.nombre as perfil_nombre 
		
		from usuarios as usu, perfiles as per 
		
		where usu.id_perfil = per.id_perfil
		
		";
			
		foreach($this->conexionPDO->query($sqlconsulta) as $registro)
		{
			$this->usuarios[] = $registro;
		}
		
		return $this->usuarios;
		
		$this->conexionPDO = null;
	}

	public function add_usuario()
	{
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["perfil_usuario"]) or empty($_POST["nombre_usuario"]) or empty($_POST["login_usuario"]) or empty($_POST["password"]) or empty($_POST["password2"]) or empty($_POST["email_usuario"]) or Configuracion::valida_correo($_POST["email_usuario"]) == false)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=add_usuario&msj=1");
			exit;
		}
		
		/*
		$error_password = "";		
		if(self::validar_password($_POST["password"], &$error_password) == false)
		{
			//header("Location: " . Configuracion::ruta() . "?controlador=add_usuario&msj=7&passerror=" . $mierror_password);
			header("Location: " . Configuracion::ruta() . "?controlador=add_usuario&msj=6");
			exit;		
		}*/

				/*verificamos primero que el nombre no este ya en la DB*/
				$sqlconsulta2 = "select count(*) from usuarios where nombre = ?";	
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre"]);
				$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
				$PDOsoporte2->execute();
				
				/*si el nombre es nuevo en la DB entonces iniciamos la insercion del nvo registro*/
				if($PDOsoporte2->fetchColumn() == 0)
				{
					
					self::set_names_UTF8();	
					$sqlconsulta = "insert into usuarios values (null, ?, ?, ?, ?, ?, ?)";
					$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
					/*filtramos con guerreras magicas() para evitar ataques xsl*/
					$elidperfil = Configuracion::guerreras_magicas($_POST["perfil_usuario"]);
					$elnombre = Configuracion::guerreras_magicas($_POST["nombre_usuario"]);
					$ellogin = Configuracion::guerreras_magicas($_POST["login_usuario"]);
					$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
					$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
					$elemail = Configuracion::guerreras_magicas($_POST["email_usuario"]);
					
					$PDOsoporte->bindValue(1,$elidperfil,PDO::PARAM_INT);
					$PDOsoporte->bindValue(2,$elnombre,PDO::PARAM_STR);
					$PDOsoporte->bindValue(3,$ellogin,PDO::PARAM_STR);
					$PDOsoporte->bindValue(4,$elpassword,PDO::PARAM_STR);
					$PDOsoporte->bindValue(5,$elpassword2,PDO::PARAM_STR);
					$PDOsoporte->bindValue(6,$elemail,PDO::PARAM_STR);
					
					if($PDOsoporte->execute())
					{					
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=add_usuario&msj=3");	
					}
					else
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=add_usuario&msj=2");		
					}					
	
				}
				else
				{
					header("Location: " . Configuracion::ruta() . "?controlador=add_usuario&msj=4");
					exit;				
				}
	}
	
	public function verifica_nombre_usuario($elnombreusuario, $elusuarioid)
	{
		if(isset($elnombreusuario) and isset($elusuarioid))
		{
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) from usuarios where id_usuario = ? and nombre = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$el_usuarioid = Configuracion::guerreras_magicas($elusuarioid);
			$el_nombre = Configuracion::guerreras_magicas($elnombreusuario);
			
			$PDOsoporte->bindValue(1,$el_usuarioid,PDO::PARAM_INT);
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

	public function cuenta_dependientes_usuario_documentos($elusuarioid)
	{
		if(isset($elusuarioid))
		{
			/*
			echo $elusuarioid; exit;*/
			
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) nombre from usuarios where id_usuario = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$el_usuarioid = Configuracion::guerreras_magicas($elusuarioid);
			
			$PDOsoporte->bindValue(1,$el_usuarioid,PDO::PARAM_INT);
			$PDOsoporte->execute();			

			/*si la verificacion es exitosa, entonces la id si existe en la DB...*/
			if($PDOsoporte->fetchColumn() > 0)
			{
				$sqlconsulta2 = "select count(*) as contados from documentos where id_usuario = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$el_id_usuario = $el_usuarioid;
			
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte2->execute(array($el_id_usuario)))
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
	
	public function delete_usuario($id_usuario)
	{	
		if(isset($id_usuario))
		{
			self::set_names_UTF8();		

			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta2 = "select count(*) from usuarios where id_usuario = ?";
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elidusuario = Configuracion::guerreras_magicas($id_usuario);
			$PDOsoporte2->bindValue(1,$elidusuario,PDO::PARAM_INT);
			$PDOsoporte2->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporte2->fetchColumn() > 0)
			{
				/*aqui eliminamos los demas datos del registro del usuario*/	
				$sqlconsulta = "delete from usuarios where id_usuario = ?";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
				$la_id_usuario = Configuracion::guerreras_magicas($id_usuario);
				
				/*y aqui eliminamos los documentos asociados con el usuario a eliminar*/
				$sqlconsulta2 = "delete from documentos where id_usuario = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				$la_id_usuario2 = $la_id_usuario;

				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte->execute(array($la_id_usuario)) and $PDOsoporte2->execute(array($la_id_usuario2)))
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=1");
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");
				}					
			
			}
			else
			{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");		
			}	
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");
		}	
	}
	
	public function get_usuario_por_id($id_usuario)
	{
		if(isset($id_usuario))
		{
			/*echo $usuario_id . "estoy en el metodo"; exit;*/
			
			self::set_names_UTF8();
			
			/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
			$sqlconsulta = "select count(*) from usuarios where id_usuario = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$elidusuario = Configuracion::guerreras_magicas($id_usuario);
        
        	$PDOsoporte->bindValue(1,$elidusuario,PDO::PARAM_INT);
			$PDOsoporte->execute();

			/*si en efecto la id SI esta en la DB y no hay ninguna trampa.. */
			if($PDOsoporte->fetchColumn() > 0)
			{
					$sqlconsulta2 = "select id_usuario, id_perfil, nombre, login, email from usuarios where id_usuario = ?";
					$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
					$el_id_usuario = Configuracion::guerreras_magicas($id_usuario);
					
					//COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($el_id_usuario)	
					$PDOsoporte2->execute(array($el_id_usuario));
					while($registro = $PDOsoporte2->fetch())
					{
						$this->usuarios[] = $registro;
					}
					return $this->usuarios;
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
	
	public function edit_usuario()
	{	
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["perfil_usuario"]) or empty($_POST["nombre_usuario"]) or empty($_POST["login_usuario"]) or empty($_POST["password"]) or empty($_POST["password2"]) or empty($_POST["email_usuario"]) or Configuracion::valida_correo($_POST["email_usuario"]) == false)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=1");
			exit;
		}		
		
		/*echo "hasta aqui vamos bien"; exit;*/
		
		self::set_names_UTF8();
			
		/*verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa por POST*/
		$sqlconsultaM = "select count(*) from usuarios where id_usuario = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		$elidusuario = Configuracion::guerreras_magicas($_POST["id_usuario"]);
        
        $PDOsoporteM->bindValue(1,$elidusuario,PDO::PARAM_INT);		
		
		$PDOsoporteM->execute();
			
		/*si no se encuentra ningun resultado, entonces el dato que nos viene por POST es malicioso.. */
		if($PDOsoporteM->fetchColumn() == 0)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
			exit;				
		}		
		
		/*
		verificamos primero que el nombre no este ya en la DB
		A MENOS QUE.. sea el mismo que ya tenia antes, 
		en cuyo caso el sistema debe permitir conservarlo, actualizando los demas valores
		*/
		
		$sqlconsulta2 = "select count(*) from usuarios where nombre = ? and ? != ?";	
		$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
		$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre_usuario"]);
		$elnombre3 = Configuracion::guerreras_magicas($_POST["antiguo_nombre"]);
		$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
		$PDOsoporte2->bindValue(2,$elnombre2,PDO::PARAM_STR);
		$PDOsoporte2->bindValue(3,$elnombre3,PDO::PARAM_STR);
		$PDOsoporte2->execute();
		
		/*si el nombre es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
		if($PDOsoporte2->fetchColumn() == 0)
		{
			$sqlconsulta = "
			
			update usuarios set 
			id_perfil = ?, 
			nombre = ?, 
			login = ?, 
			passwordjs = ?, 
			passwordjsphp = ?,
			email = ? 
			where id_usuario = ?
			
			";	
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			/*filtramos con guerreras magicas() para evitar ataques xsl*/
			$elidperfil = Configuracion::guerreras_magicas($_POST["perfil_usuario"]);
			$elnombre = Configuracion::guerreras_magicas($_POST["nombre_usuario"]);
			$ellogin = Configuracion::guerreras_magicas($_POST["login_usuario"]);
			$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
			$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
			$elemail = Configuracion::guerreras_magicas($_POST["email_usuario"]);
			$elidusuario = Configuracion::guerreras_magicas($_POST["id_usuario"]);
			
			$PDOsoporte->bindValue(1,$elidperfil,PDO::PARAM_INT);
			$PDOsoporte->bindValue(2,$elnombre,PDO::PARAM_STR);
			$PDOsoporte->bindValue(3,$ellogin,PDO::PARAM_STR);
			$PDOsoporte->bindValue(4,$elpassword,PDO::PARAM_STR);
			$PDOsoporte->bindValue(5,$elpassword2,PDO::PARAM_STR);
			$PDOsoporte->bindValue(6,$elemail,PDO::PARAM_STR);
			$PDOsoporte->bindValue(7,$elidusuario,PDO::PARAM_INT);
			
			if($PDOsoporte->execute())
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=3&id_usuario=" . $_POST["id_usuario"]);					
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=2&id_usuario=" . $_POST["id_usuario"]);		
			}
			
		}
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=4&id_usuario=" . $_POST["id_usuario"]);	
		}			
			

	}
	
	public function get_usuarios_por_perfil($id_perfil)
	{
		if(isset($id_perfil))
		{
			self::set_names_UTF8();
			
			/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
			$sqlconsulta = "select count(*) from usuarios where id_perfil = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$elidperfil = Configuracion::guerreras_magicas($id_perfil);
        
        	$PDOsoporte->bindValue(1,$elidperfil,PDO::PARAM_INT);
			$PDOsoporte->execute();

			/*si en efecto la id SI esta en la DB y no hay ninguna trampa.. */
			if($PDOsoporte->fetchColumn() > 0)
			{
					$sqlconsulta2 = "select id_usuario, id_perfil, nombre, login, email from usuarios where id_perfil = ?";
					$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
					$el_idperfil = Configuracion::guerreras_magicas($id_perfil);
					
					//COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($el_id_usuario)	
					$PDOsoporte2->execute(array($el_idperfil));
					while($registro = $PDOsoporte2->fetch())
					{
						$this->usuarios[] = $registro;
					}
					return $this->usuarios;
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
	
	public function olvido_contrasena()
	{
		if(empty($_POST["email"]) or Configuracion::valida_correo($_POST["email"])==false)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=olvido_contrasena&msj=3");
			exit;
		}
			self::set_names_UTF8();			
		
			/*verificamos si los datos del usuario estan en la DB*/
			$sqlconsulta = "select * from usuarios where email = ?";	
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
	
			$elemail = Configuracion::guerreras_magicas($_POST["email"]);
			
			/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)
			if($PDOsoporte->execute(array($elemail)))
			
				$autenticado = $PDOsoporte->fetch();*/
				
			$PDOsoporte->execute(array($elemail));
			$autenticado = $PDOsoporte->fetch();
				
			if(!empty($autenticado))
			{
				

				/*print_r($autenticado); exit;*/
				
				$elnombre = $autenticado["nombre"];
				$elidusuario = $autenticado["id_usuario"];
				$elemail = $autenticado["email"]; 
				
				/*echo $elnombre . " - " . $elidusuario . " - " . $elemail; exit;*/
				
		/*si la insercion a la DB del nuevo usuario es exitosa, entonces le mandamos un correo a su email...*/	
					
						$fecha=date("d-m-Y");
						$hora=date("H:m:s");
						$correo=$elemail;
						$remitente="Remitente <noreply@mastinseguridad.com>";
						$asunto="Restauracion de contrasena en mastinseguridad.com";
						$cuerpo="
						<div align='left'>
						Estimado (a) $elnombre 
						<br>
						<br>
						Por favor haga clic en el siguiente link para renovar tu contrasena:
						<br>
						<br>
<a href='http://www.apps.saetaweb.com/mastin/?controlador=restablecer_contrasena&tokem=".base64_encode($id_usuario)."&f=$fecha&h=$hora'>
http://www.apps.saetaweb.com/mastin/?controlador=restablecer_contrasena&tokem=".base64_encode($id_usuario)."&f=$fecha&h=$hora
						</a>
						<br>
						<br>
						Si lo prefiere tome el link y péguelo en la barra de direcciones de su navegador favorito
						<br>
						<br>
						Atentamente, equipo de: apps.saetaweb.com
						</div>
						";
						$sheader="From:".$remitente."\nReply-To:".$remitente."\n";
						$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
						$sheader=$sheader."Mime-Version: 1.0\n";
						$sheader=$sheader."Content-Type: text/html";
						
						mail($correo,$asunto,$cuerpo,$sheader);		
					
		/*fin de la gestion del email*/
		
								
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=olvido_contrasena&msj=2");					
			}

			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=olvido_contrasena&msj=1");
				exit;
			}			
	}
	
	public function restablecer_contrasena()
	{
		if(empty($_POST["password"]) or empty($_POST["password2"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=restablecer_contrasena&msj=1");
			exit;
		}	
			self::set_names_UTF8();	
			
			/*verificamos si los datos del usuario estan en la DB*/
			$sqlconsulta = "select id_usuario from usuarios where id_usuario = ?";	
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
	
			$elidusuario = Configuracion::guerreras_magicas(base64_decode($_POST["tokem"]));
			
			
			$PDOsoporte->execute(array($elidusuario));
			$autenticado = $PDOsoporte->fetch();
				
			if(!empty($autenticado))
			{	
				$sqlconsulta2 = "
				
					update usuarios set  
					passwordjs = ?, 
					passwordjsphp = ?
					where id_usuario = ?
					
					";	
			
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
				$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
				
				$PDOsoporte2->bindValue(1,$elpassword,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(2,$elpassword2,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(3,$elidusuario,PDO::PARAM_INT);
				
				if($PDOsoporte2->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=login&msj=3");	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=restablecer_contrasena&msj=2");			
				}					
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=restablecer_contrasena&msj=1");
				exit;			
			}		

	}
	
	
/***** METODOS AJAX ******/		
		
		
	public function ajax_valida_crear_usuario()
	{
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select nombre from usuarios where nombre = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		/*$elvalor = Configuracion::guerreras_magicas($_GET["id"]);*/
		$elvalor = Configuracion::guerreras_magicas($_GET["el_valor"]);
		/*echo $elvalor; exit;*/
        
        $PDOsoporteM->bindValue(1,$elvalor,PDO::PARAM_STR);		
		$PDOsoporteM->execute();
		
		
		while($registro = $PDOsoporteM->fetch())
		{
			$this->usuarios[] = $registro;
		}
		return $this->usuarios;
		$this->conexionPDO = null;		
	}	
	
	public function ajax_valida_editar_usuario()
	{
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select nombre from usuarios where nombre = ? and ? != ?";
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
			$this->usuarios[] = $registro;
		}
		return $this->usuarios;
		$this->conexionPDO = null;		
	}	
	
	
	public function ajax_dependientes_perfil_usuarios()
	{
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select id_usuario, nombre from usuarios where id_perfil = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		
		/*$elvalor = Configuracion::guerreras_magicas($_GET["id"]);*/
		$elvalor = Configuracion::guerreras_magicas($_POST["el_valor"]);
		/*echo $elvalor; exit;*/
        
        $PDOsoporteM->bindValue(1,$elvalor,PDO::PARAM_INT);			
		$PDOsoporteM->execute();
		
		
		while($registro = $PDOsoporteM->fetch())
		{
			$this->usuarios[] = $registro;
		}
		
		return $this->usuarios;
		$this->conexionPDO = null;		
	}		
	
	public function get_usuarios_por_id_perfil($id_perfil)
	{
		self::set_names_UTF8();
			
		/* verificamos primero que la id que nos llega por POST si esta en la DB y no es trampa */
		$sqlconsultaM = "select id_usuario, nombre from usuarios where id_perfil = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		
		/*$elvalor = Configuracion::guerreras_magicas($_GET["id"]);*/
		$elvalor = Configuracion::guerreras_magicas($id_perfil);
		/*echo $elvalor; exit;*/
        
        $PDOsoporteM->bindValue(1,$elvalor,PDO::PARAM_INT);			
		$PDOsoporteM->execute();
		
		
		while($registro = $PDOsoporteM->fetch())
		{
			$this->usuarios[] = $registro;
		}
		
		return $this->usuarios;
		$this->conexionPDO = null;		
	}	
	
	
	
	
	
/* este es el fin de la clase  */
}

?>