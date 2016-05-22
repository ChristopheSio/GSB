
function getXMLHTTP() // Récupére l'instance AJAX
{
	var xhr=null;
	if(window.XMLHttpRequest)		xhr = new XMLHttpRequest(); // Firefox et autres
	else if(window.ActiveXObject)	xhr = new ActiveXObject("Microsoft.XMLHTTP"); // Internet Explorer
	else alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); // XMLHttpRequest non support? par le navigateur
	return xhr;
}


function XhrSelect(elementSELECT, varNamePOST, pathPagePOST, idNameRECEPT)
{
	var xhr = getXMLHTTP(); // objet Ajax
	var selectionValue = elementSELECT.options[elementSELECT.selectedIndex].value;

	xhr.onreadystatechange = function() {   
		if(xhr.readyState == 4) 
			document.getElementById( idNameRECEPT ).innerHTML = xhr.responseText; 
	}
	xhr.open("POST",pathPagePOST,true);  
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');  // entête pour le post (comme si c'était un formulaire)
	xhr.send(varNamePOST+"="+selectionValue);  
}

function XhrSend(elementToReceive, urlToAjaxPost, postDataLine)
{
	if(elementToReceive==null) return;
	//
	var xhr = getXMLHTTP(); // objet Ajax
	xhr.onreadystatechange = function() {   
		if(xhr.readyState == 4)  { // Reception
			elementToReceive.innerHTML = xhr.responseText;
		}	
		else { // Chargement
			elementToReceive.innerHTML = '<i class="fa fa-spinner fa-pulse"></i>';
		}
	}
	xhr.open("POST",urlToAjaxPost,true);  
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');  // entête pour le post (comme si c'était un formulaire)
	xhr.send( (postDataLine==null)?"":postDataLine );  
}