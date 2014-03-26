function getXMLHTTPRequest()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = getXMLHTTPRequest();
//*********************************************************************
function from(id,ide,url){
		//alert(id);
	
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la p�gina en el cach�...
		var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petici�n sea asincr�nica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
							   if (http=="valido")
							   {
								document.getElementById(ide).innerHTML="<font color='red'>El email "+id+" no est� disponible</font>";  
								document.getElementById("boton").style.display="none";
								document.getElementById("boton_2").style.display="block";
								}else
								{
								document.getElementById(ide).innerHTML="<font color='green'>El email "+id+" si se encuentra disponible</font>"; 	
								document.getElementById("boton").style.display="block";
								document.getElementById("boton_2").style.display="none";
								}
							   
							   
                       }
				   }
				   else
				   {
					   //document.getElementById('resultados').style.display="block";
				   	document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";
               }
       }
       miPeticion.send(null);
		
}

//*********************************************************************

/*  ESTA ES MI VERSION DE LA FUNCION AJAX */
function hikaru(campo_form_a_evaluar,div_recibidor,ruta_archivo_ejecuta)
{
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la p�gina en el cach�...
		var vinculo=ruta_archivo_ejecuta+"?el_valor="+campo_form_a_evaluar+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petici�n sea asincr�nica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
							   if (http=="ocupado")
							   {
								document.getElementById(div_recibidor).innerHTML="<font color='red'>El usuario "+campo_form_a_evaluar+" no est&aacute; disponible</font>";  
								document.getElementById("boton").style.display="none";
								document.getElementById("boton_2").style.display="block";
								}
								else
								{
								document.getElementById(div_recibidor).innerHTML="<font color='green'>El usuario "+campo_form_a_evaluar+" si se encuentra disponible</font>"; 	
								document.getElementById("boton").style.display="block";
								document.getElementById("boton_2").style.display="none";
								}	   
                       }
			   }
			   else
			   {
					   //document.getElementById('resultados').style.display="block";
				   	document.getElementById(div_recibidor).innerHTML="<img src='public/images/preloader.gif' title='cargando...' />";
               }
       }
       miPeticion.send(null);
		
}



//*********************************************************************

/*  ESTA ES MI VERSION DE LA FUNCION AJAX CON 4 ARGUMENTOS*/
function hikaru2(campo_form_a_evaluar, campo2_form_a_evaluar, div_recibidor, ruta_archivo_ejecuta){
		//alert(id);
	
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la p�gina en el cach�...
		var vinculo=ruta_archivo_ejecuta+"?el_valor="+campo_form_a_evaluar+"&el_valor2="+campo2_form_a_evaluar+"&rand="+mi_aleatorio;
		
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petici�n sea asincr�nica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
							   if (http=="ocupado")
							   {
								document.getElementById(div_recibidor).innerHTML="<font color='red'>El registro "+campo_form_a_evaluar+" no est&aacute; disponible</font>";  
								document.getElementById("boton").style.display="none";
								document.getElementById("boton_2").style.display="block";
								}
								else
								{
								document.getElementById(div_recibidor).innerHTML="<font color='green'>El registro "+campo_form_a_evaluar+" si se encuentra disponible</font>"; 	
								document.getElementById("boton").style.display="block";
								document.getElementById("boton_2").style.display="none";
								}	   
                       }
			   }
			   else
			   {
					   //document.getElementById('resultados').style.display="block";
				   	document.getElementById(div_recibidor).innerHTML="<img src='public/images/preloader.gif' title='cargando...' />";
               }
       }
       miPeticion.send(null);
		
}
/********************************************/


function cerrar()
{
    document.getElementById("ver_usuarios_ajax").innerHTML="";
}


/*  ESTA ES MI VERSION DE LA FUNCION AJAX */
function hikaru_post(campo_form_a_evaluar,div_recibidor,ruta_archivo_ejecuta)
{	
		var mi_aleatorio=parseInt(Math.random()*99999999);
		var vinculo=ruta_archivo_ejecuta+"?rand="+mi_aleatorio+"&el_valor="+campo_form_a_evaluar;
		miPeticion.open("POST",vinculo,true);	
		miPeticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		miPeticion.send(vinculo);
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function()
		{
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
                               document.getElementById(div_recibidor).innerHTML= http;                               							
                       }
			   }
       }
       miPeticion.send(null);		
}

/*********************************************************************************************************************************/

function teresa_clare(id,ide,url)
{
        //para que no guarde la p�gina en el cach�...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL din�mica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id;
		//alert(vinculo);
		//ponemos true para que la petici�n sea asincr�nica
		miPeticion.open("POST",vinculo,true);
		miPeticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		miPeticion.send(vinculo);
		
		
		//ahora procesamos la informaci�n enviada
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               //alert("ready_State="+miPeticion.readyState);
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       //alert("status ="+miPeticion.status);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               //alert("http="+http);
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }
               
       }
       miPeticion.send(null);
	
}


