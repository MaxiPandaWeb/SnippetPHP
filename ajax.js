// JavaScript Document
function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function actualiza(div_resultado, url_accion, variables)
{
	// Extraigo el valor del combo que se ha cambiado
	var div_control=document.getElementById(div_resultado);
	

		ajax=nuevoAjax();
		// Envio al servidor el valor seleccionado y el combo al cual se le deben poner los datos
		ajax.open("GET", url_accion+"?nocache="+Math.random()+"&"+variables, true);
		var start = new Date().getTime();
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3)
			{
				// Mientras carga elimino la opcion "Elige" y pongo una que dice "Cargando"
				
				//var opcionCargando=document.createElement("option"); opcionCargando.value=0; opcionCargando.innerHTML="Cargando...";
				div_control.innerHTML='<p><strong>... cargando</strong></p>';

				
			}
			if (ajax.readyState==4)
			{
				// Coloco en la fila contenedora los datos que recivo del servidor
				var elapsed = new Date().getTime() - start;//TIEMPO QUE SE DEMORO EN CARGAR LA PÁGINA
				
				try{
					//alert(elapsed);
				div_control.innerHTML=ajax.responseText;
				
				//document.getElementById('detalle').innerHTML=ajax.responseText;
				}catch(err){
				  //Handle errors here
				  
			 	}
			} 
		}
		ajax.send(null);
}