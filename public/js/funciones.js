/******************************************************************************************************************/
/*   FUNCIONES GENERALES PÒR DEFECTO    */
/******************************************************************************************************************/
//Valida password
function valida_password(password) 
{
	if (/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{5,12})$/.test(password))
	{
		return true;
	} 
	else 
	{
		return false;
	}
}


function valida_correo(correo) 
{
		  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo))
		  {	
		   return true;
		  } 
		  else 
		  {
		   return false;
		  }
}
//*********************************************************************************************************************************
//valida números
function valida_numero(numero)
{
	if (!/^([0-9])*$/.test(numero))
	{
		return false;
	}
	else
	{
		return true;
	}
}
//*******************************************************************************************************
//función para validar cadenas de solo letras
function valida_cadena(texto)
	{
		var RegExPattern = "[1-9]";
		 if (texto.match(RegExPattern))
		 {
		 	return false;
		 }
		 else
		 {
		 	return true;
		 }
	}


/******************************************************************************************************************/
/*   FUNCIONES PROPIAS DE ESTE DESARROLLO    */
/******************************************************************************************************************/

/*VALIDAMOS EL FORMULARIO PARA CREAR DOCUMENTO*/
function valida_crear_documento()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_01 = document.creadocumento;

		if(piluform_01.perfil_documento.value == 0)
		{
			document.getElementById("error_perfil_documento").innerHTML="<font color='red'>Debe asignar un perfil al documento.</font>";
			piluform_01.perfil_documento.value = "";
			piluform_01.perfil_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_perfil_documento").innerHTML="";
		}


		if(piluform_01.usuario_documento.value == 0)
		{
			document.getElementById("error_usuario_documento").innerHTML="<font color='red'>Debe asignar un usuario al documento.</font>";
			piluform_01.usuario_documento.value = "";
			piluform_01.usuario_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_usuario_documento").innerHTML="";
		}

		if(piluform_01.nombre_documento.value == 0)
		{
			document.getElementById("error_nombre_documento").innerHTML="<font color='red'>Debe escribir el nombre del documento.</font>";
			piluform_01.nombre_documento.value = "";
			piluform_01.nombre_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_documento").innerHTML="";
		}	
	
	
		if(piluform_01.descripcion_documento.value == 0)
		{
			document.getElementById("error_descripcion_documento").innerHTML="<font color='red'>Debe escribir la descripcion del documento.</font>";
			piluform_01.descripcion_documento.value = "";
			piluform_01.descripcion_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_descripcion_documento").innerHTML="";
		}	
	
	
		if(piluform_01.archivo_documento.value == 0)
		{
			document.getElementById("error_archivo_documento").innerHTML="<font color='red'>Debe adjuntar el archivo del documento.</font>";
			piluform_01.archivo_documento.value = "";
			piluform_01.archivo_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_archivo_documento").innerHTML="";
		}	
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_01.submit();		
}

function limpiador_creadocumento()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.creadocumento.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.creadocumento.perfil_documento.focus();
}


/*VALIDAMOS EL FORMULARIO PARA EDITAR DOCUMENTO*/
function valida_editar_documento()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_02 = document.editadocumento;

		if(piluform_02.perfil_documento.value == 0)
		{
			document.getElementById("error_perfil_documento").innerHTML="<font color='red'>Debe asignar un perfil al documento.</font>";
			piluform_02.perfil_documento.value = "";
			piluform_02.perfil_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_perfil_documento").innerHTML="";
		}

		if(piluform_02.usuario_documento.value == 0)
		{
			document.getElementById("error_usuario_documento").innerHTML="<font color='red'>Debe asignar un usuario al documento.</font>";
			piluform_02.usuario_documento.value = "";
			piluform_02.usuario_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_usuario_documento").innerHTML="";
		}

		if(piluform_02.nombre_documento.value == 0)
		{
			document.getElementById("error_nombre_documento").innerHTML="<font color='red'>Debe escribir el nombre del documento.</font>";
			piluform_02.nombre_documento.value = "";
			piluform_02.nombre_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_documento").innerHTML="";
		}	
	
	
		if(piluform_02.descripcion_documento.value == 0)
		{
			document.getElementById("error_descripcion_documento").innerHTML="<font color='red'>Debe escribir la descripcion del documento.</font>";
			piluform_02.descripcion_documento.value = "";
			piluform_02.descripcion_documento.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_descripcion_documento").innerHTML="";
		}		
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_02.submit();		
}

function limpiador_editadocumento()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.editadocumento.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.editadocumento.perfil_documento.focus();
}


function eliminar_registro(ruta)
{
    if(confirm("realmente desea eliminar este registro ?"))
    {
        window.location=ruta;
    }
}


/*VALIDAMOS EL FORMULARIO PARA CREAR USUARIO*/
function valida_crear_usuario()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_03 = document.creausuario;

		if(piluform_03.perfil_usuario.value == 0)
		{
			document.getElementById("error_perfil_usuario").innerHTML="<font color='red'>Debe asignar un perfil al usuario.</font>";
			piluform_03.perfil_usuario.value = "";
			piluform_03.perfil_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_perfil_usuario").innerHTML="";
		}


		if(piluform_03.nombre_usuario.value == 0)
		{
			document.getElementById("error_nombre_usuario").innerHTML="<font color='red'>Debe escribir el nombre del usuario.</font>";
			piluform_03.nombre_usuario.value = "";
			piluform_03.nombre_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_usuario").innerHTML="";
		}	
	
	
		if(piluform_03.login_usuario.value == 0)
		{
			document.getElementById("error_login_usuario").innerHTML="<font color='red'>Debe escribir su login.</font>";
			piluform_03.login_usuario.value = "";
			piluform_03.login_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_usuario").innerHTML="";
		}
		
		if (piluform_03.password.value == 0)
		{
			//alert("Ingrese su Login");
			document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
			piluform_03.password.value="";
			piluform_03.password.focus();
			return false;
		}
		else
		{
			document.getElementById("error_password").innerHTML="";
		}
		
/*INICIO BLOQUE ESPECIAL DE VALIDACION DE PASSWORD********************************************************************************/		

		if (valida_password(piluform_03.password.value)==false)
		{
			/*alert("Por favor ingrese su password");*/
			document.getElementById("error_password").innerHTML="<font color='red'>PASSWORD INVALIDO. Debe ser...<br>Entre 5 y 12 caracteres, <br>por lo menos un n&uacute;mero y un alfanum&eacute;rico, <br>y no puede contener caracteres especiales</font>";
			piluform_03.password.value="";
			piluform_03.password.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_password").innerHTML="";			
		}		
/*FIN BLOQUE ESPECIAL DE VALIDACION DE PASSWORD***********************************************************************************/	

		if (piluform_03.password.value != piluform_03.password2.value)
		{
			document.getElementById("error_password").innerHTML="<font color='red'>Los Password ingresados no coinciden</font>";
			piluform_03.password.value="";
			piluform_03.password2.value="";
			piluform_03.password.focus();		
			return false;
		}
		else
		{
			document.getElementById("error_password").innerHTML="";
		}
		



		if(piluform_03.email_usuario.value == 0)
		{
			document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
			piluform_03.email_usuario.value = "";
			piluform_03.email_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_email").innerHTML="";
		}
	
	
		if (valida_correo(piluform_03.email_usuario.value) == false)
		{
			//alert("Ingrese su Login");
			document.getElementById("error_email").innerHTML="<font color='red'>El E-Mail ingresado no es válido</font><hr>";
			piluform_03.email_usuario.value="";
			piluform_03.email_usuario.focus();
			return false;
		}
		else
		{
			document.getElementById("error_email").innerHTML="";
		}

		piluform_03.password.value = calcMD5(piluform_03.password.value);
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_03.submit();		
}

function limpiador_creausuario()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.creausuario.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.creausuario.perfil_usuario.focus();
}



/*VALIDAMOS EL FORMULARIO PARA EDITAR USUARIO*/
function valida_editar_usuario()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_04 = document.editausuario;

		if(piluform_04.perfil_usuario.value == 0)
		{
			document.getElementById("error_perfil_usuario").innerHTML="<font color='red'>Debe asignar un perfil al usuario.</font>";
			piluform_04.perfil_usuario.value = "";
			piluform_04.perfil_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_perfil_usuario").innerHTML="";
		}


		if(piluform_04.nombre_usuario.value == 0)
		{
			document.getElementById("error_nombre_usuario").innerHTML="<font color='red'>Debe escribir el nombre del usuario.</font>";
			piluform_04.nombre_usuario.value = "";
			piluform_04.nombre_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_usuario").innerHTML="";
		}	
	
	
		if(piluform_04.login_usuario.value == 0)
		{
			document.getElementById("error_login_usuario").innerHTML="<font color='red'>Debe escribir su login.</font>";
			piluform_04.login_usuario.value = "";
			piluform_04.login_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_usuario").innerHTML="";
		}
		
		if (piluform_04.password.value == 0)
		{
			//alert("Ingrese su Login");
			document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
			piluform_04.password.value="";
			piluform_04.password.focus();
			return false;
		}
		else
		{
			document.getElementById("error_password").innerHTML="";
		}
		
/*INICIO BLOQUE ESPECIAL DE VALIDACION DE PASSWORD********************************************************************************/		

		if (valida_password(piluform_04.password.value)==false)
		{
			/*alert("Por favor ingrese su password");*/
			document.getElementById("error_password").innerHTML="<font color='red'>PASSWORD INVALIDO. Debe ser...<br>Entre 5 y 12 caracteres, <br>por lo menos un n&uacute;mero y un alfanum&eacute;rico, <br>y no puede contener caracteres especiales</font>";
			piluform_04.password.value="";
			piluform_04.password.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_password").innerHTML="";			
		}		
/*FIN BLOQUE ESPECIAL DE VALIDACION DE PASSWORD***********************************************************************************/	

		if (piluform_04.password.value != piluform_04.password2.value)
		{
			document.getElementById("error_password").innerHTML="<font color='red'>Los Password ingresados no coinciden</font>";
			piluform_04.password.value="";
			piluform_04.password2.value="";
			piluform_04.password.focus();		
			return false;
		}
		else
		{
			document.getElementById("error_password").innerHTML="";
		}
		



		if(piluform_04.email_usuario.value == 0)
		{
			document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
			piluform_04.email_usuario.value = "";
			piluform_04.email_usuario.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_email").innerHTML="";
		}
	
	
		if (valida_correo(piluform_04.email_usuario.value) == false)
		{
			//alert("Ingrese su Login");
			document.getElementById("error_email").innerHTML="<font color='red'>El E-Mail ingresado no es válido</font><hr>";
			piluform_04.email_usuario.value="";
			piluform_04.email_usuario.focus();
			return false;
		}
		else
		{
			document.getElementById("error_email").innerHTML="";
		}

		piluform_04.password.value = calcMD5(piluform_04.password.value);
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_04.submit();		
}

function limpiador_editausuario()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.editausuario.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.editausuario.perfil_usuario.focus();
}


/*VALIDAMOS EL FORMULARIO PARA CREAR PERFIL*/
function valida_crear_perfil()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_05 = document.creaperfil;

		if(piluform_05.nombre_perfil.value == 0)
		{
			document.getElementById("error_nombre_perfil").innerHTML="<font color='red'>Debe escribir el nombre del perfil.</font>";
			piluform_05.nombre_perfil.value = "";
			piluform_05.nombre_perfil.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_perfil").innerHTML="";
		}	
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_05.submit();		
}

function limpiador_creaperfil()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.creaperfil.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.creadocumento.nombre_perfil.focus();
}


/*VALIDAMOS EL FORMULARIO PARA EDITAR PERFIL*/
function valida_editar_perfil()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_06 = document.editaperfil;

		if(piluform_06.nombre_perfil.value == 0)
		{
			document.getElementById("error_nombre_perfil").innerHTML="<font color='red'>Debe escribir el nombre del perfil.</font>";
			piluform_06.nombre_perfil.value = "";
			piluform_06.nombre_perfil.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_nombre_perfil").innerHTML="";
		}	
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_06.submit();		
}

function limpiador_editaperfil()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.editaperfil.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.editadocumento.nombre_perfil.focus();
}

/* FUNCION PARA EL SELECT DINAMICO DEL PERFIL EN EL SIDEBAR*/
function enviarperfil()
{
	/*alert('pelusa');*/
	
	var elperfil = document.getElementById('selector').value;
	if(elperfil >= 1)
	{
		window.location = "?controlador=ver_documentos&perfil=" + elperfil;
	}
	
}



/*VALIDAMOS EL FORMULARIO DE LOGIN*/
function valida_login()
{
	var piluform_06 = document.formulario_login;	
	
	if(piluform_06.login.value == 0)
	{
		document.getElementById("error_login").innerHTML="<font color='red'>Debe escribir su Login.</font>";
		piluform_06.login.value = "";
		piluform_06.login.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_login").innerHTML="";
	}
	
	if (piluform_06.password.value == 0)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
		piluform_06.password.value="";
		piluform_06.password.focus();
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}	
	
	piluform_06.password.value = calcMD5(piluform_06.password.value);
	piluform_06.submit();
		
}

function limpiador_login()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.formulario_login.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.formulario_login.login.focus();
}




/*VALIDAMOS EL FORMULARIO DE OLVIDO CONTRASEÑA*/
function valida_olvido_contrasena()
{
	var piluform_07 = document.olvido_contrasena;	
	
	if(piluform_07.email.value == 0)
	{
		document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
		piluform_07.email.value = "";
		piluform_07.email.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_email").innerHTML="";
	}
	
	if (valida_correo(piluform_07.email.value) == false)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_email").innerHTML="<font color='red'>El E-Mail ingresado no es v&Aacute;lido</font><hr>";
		piluform_07.email.value="";
		piluform_07.email.focus();
		return false;
	}
	else
	{
		document.getElementById("error_email").innerHTML="";
	}	
	
	piluform_07.submit();
		
}

function limpiador_olvido_contrasena()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.olvido_contrasena.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.olvido_contrasena.email.focus();
}


/*VALIDAMOS EL FORMULARIO DE OLVIDO CONTRASEÑA*/
function valida_restablecer_contrasena()
{
	var piluform_08 = document.restablecer_contrasena;	
	
	if (piluform_08.password.value == 0)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
		piluform_08.password.value="";
		piluform_08.password.focus();
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}
	
/*INICIO BLOQUE ESPECIAL DE VALIDACION DE PASSWORD********************************************************************************/		

		if (valida_password(piluform_08.password.value)==false)
		{
			/*alert("Por favor ingrese su password");*/
			document.getElementById("error_password").innerHTML="<font color='red'>PASSWORD INVALIDO. Debe ser...<br>Entre 5 y 12 caracteres, <br>por lo menos un n&uacute;mero y un alfanum&eacute;rico, <br>y no puede contener caracteres especiales</font>";
			piluform_08.password.value="";
			piluform_08.password.focus();
			return false;
		}
		else
		{
			/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
			document.getElementById("error_password").innerHTML="";			
		}		
/*FIN BLOQUE ESPECIAL DE VALIDACION DE PASSWORD***********************************************************************************/	
	
	
	
	if (piluform_08.password.value != piluform_08.password2.value)
	{
		document.getElementById("error_password").innerHTML="<font color='red'>Los Password ingresados no coinciden</font>";
		piluform_08.password.value="";
		piluform_08.password2.value="";
		piluform_08.password.focus();		
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}

	piluform_08.password.value = calcMD5(piluform_08.password.value);
	piluform_08.submit();
		
}

function limpiador_restablecer_contrasena()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.restablecer_contrasena.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.restablecer_contrasena.password.focus();
}







/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

