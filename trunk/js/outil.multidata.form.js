/** 
 * Script de l'application GSB
 * @package default
 * @author Christophe Sonntag
 * @version 1.1
 */

function multidataInit(multidataId) {
	var multidata = eval("multidata_"+multidataId);
	var elementMultidataTable = document.getElementById("multidata_"+multidataId+"_table");
	if(multidata==null || elementMultidataTable==null) {
		alert("Script multidata error, please contact an administrator");
		return;
	}
	//
	var sizeReload = 0;
	var postLineGen = null;
	var place = null;
	for(var idRow in multidata["values"]) {
		place = sizeReload;
		postLineGen = "MD_Id="+multidataId+"&MD_Place="+place;
		for(var idProperty in multidata["properties"]) {
			postLineGen += "&"+multidata["properties"][idProperty]+'='+multidata["values"][idRow][multidata["properties"][idProperty]];
		}
		var newRow = document.createElement('tr');
		newRow.id = "multidata_"+multidataId+"_data_"+place+"_row";
		//
		XhrSend(newRow, multidata["url"], postLineGen);
		elementMultidataTable.appendChild(newRow);
		//
		sizeReload++;
	}
	multidata["overlySize"] = sizeReload;
	multidata["size"] = sizeReload;
	//
	multidataRefresh(multidataId);
}
function multidataAdd(multidataId) {
	var multidata = eval("multidata_"+multidataId);
	var elementMultidataTable = document.getElementById("multidata_"+multidataId+"_table");
	if(multidata==null || elementMultidataTable==null) {
		alert("Script multidata error, please contact an administrator");
		return;
	}
	//
	if(multidata["size"]>=multidata["max"]) return;
	//
	var place = multidata["overlySize"];
	multidata["overlySize"]++;
	multidata["size"]++;
	var newRow = document.createElement('tr');
	newRow.id = "multidata_"+multidataId+"_data_"+place+"_row";
	//
	XhrSend(newRow, multidata["url"], "MD_Id="+multidataId+"&MD_Place="+place);
	elementMultidataTable.appendChild(newRow);
	//
	multidataRefresh(multidataId);
}
function multidataPop(multidataId,place) {
	var multidata = eval("multidata_"+multidataId);
	var elementMultidataTable = document.getElementById("multidata_"+multidataId+"_table");
	var elementMultidataTableRowPlace = document.getElementById("multidata_"+multidataId+"_data_"+place+"_row");
	if( multidata==null || elementMultidataTable==null || elementMultidataTableRowPlace==null) {
		alert("Script multidata error, please contact an administrator");
		return;
	}
	//
	if(multidata["size"]==0) return;
	//
	elementMultidataTable.removeChild(elementMultidataTableRowPlace);
	if(multidata["size"]>0) multidata["size"]--;
	if(multidata["size"]==0) multidata["overlySize"] = 0;
	//
	multidataRefresh(multidataId);
}
function multidataPopAll(multidataId) {
	var multidata = eval("multidata_"+multidataId);
	var elementMultidataTable = document.getElementById("multidata_"+multidataId+"_table");
	if( multidata==null || elementMultidataTable==null) {
		alert("Script multidata error, please contact an administrator");
		return;
	}
	if(multidata["size"]==0) return;
	//
	while (elementMultidataTable.firstChild)
		elementMultidataTable.removeChild(elementMultidataTable.firstChild);
	multidata["size"] = 0;
	multidata["overlySize"] = 0;
	multidataRefresh(multidataId);
}
function multidataRefresh(multidataId) {
	var multidata = eval("multidata_"+multidataId);
	var elementMultidataInputSize = document.getElementById("multidata_"+multidataId+"_size");
	var elementMultidataInputOverlySize = document.getElementById("multidata_"+multidataId+"_overlysize");
	var elementMultidataBtAppend = document.getElementById("multidata_"+multidataId+"_append");
	var elementMultidataBtPopAll = document.getElementById("multidata_"+multidataId+"_popall");
	if( multidata==null || elementMultidataBtAppend==null || elementMultidataBtPopAll==null || elementMultidataInputSize==null || elementMultidataInputOverlySize==null) {
		alert("Script multidata error, please contact an administrator");
		return;
	}
	//
	elementMultidataInputSize.value = multidata["size"];
	elementMultidataInputOverlySize.value = multidata["overlySize"];
	//
	if(multidata["size"]>=multidata["max"])	elementMultidataBtAppend.setAttribute("disabled","disabled");
	else									elementMultidataBtAppend.removeAttribute("disabled");
	if(multidata["size"]==0)	elementMultidataBtPopAll.setAttribute("disabled","disabled");
	else						elementMultidataBtPopAll.removeAttribute("disabled");
}




/*
function AjaxMultipleDonneesAjouter(nomDeDonnee,urlDeLaVueAjax,maxDonnees,postDonnees)
{
	var elementInputSize = document.getElementById(nomDeDonnee+"_Size");
	var elementInputOverlySize = document.getElementById(nomDeDonnee+"_OverlySize");
	var elementMultipleDonneesContents = document.getElementById("MD-"+nomDeDonnee);
	if( elementInputSize==null || elementInputOverlySize==null || elementMultipleDonneesContents==null) {
		alert("Script error, please contact an administrator");
		return;
	}
	//
	var newOverlyIdDonnnes = parseInt(elementInputOverlySize.value);
	var size = parseInt(elementInputSize.value);
	if((size+1)>=maxDonnees) // desactive ajouter pour le prochainne fois
		AjaxMultipleDonneesEtatAjouter(nomDeDonnee,false);
	elementInputOverlySize.value = newOverlyIdDonnnes+1;
	elementInputSize.value = size+1;
	//
	var ajaxDonneesBlock = document.createElement("div");
	ajaxDonneesBlock.id = "MD-"+nomDeDonnee+"-"+newOverlyIdDonnnes;
	var ajaxDonneesContent = document.createElement("span");
	ajaxDonneesContent.id = "MD-"+nomDeDonnee+"-"+newOverlyIdDonnnes+"-content";
	ajaxDonneesContent.className = 'form-inline';
	var ajaxDonneesDelete = document.createElement("a");
	ajaxDonneesDelete.id = "MD-"+nomDeDonnee+"-"+newOverlyIdDonnnes+"-delete";
	ajaxDonneesDelete.onclick = function(){
		elementMultipleDonneesContents.removeChild(ajaxDonneesBlock);
		var newOverlyIdDonnnes = parseInt(elementInputOverlySize.value);
		var size = parseInt(elementInputSize.value);
		AjaxMultipleDonneesEtatAjouter(nomDeDonnee,((size-1)<maxDonnees));
		elementInputSize.value = size-1;
	};
	ajaxDonneesDelete.className = 'btn btn-warning';
	ajaxDonneesDelete.innerHTML = '<i class="fa fa-minus-circle fa-fw"></i> Supprimer';
	//
	XhrSend(ajaxDonneesContent, urlDeLaVueAjax, postDonnees);
	//
	ajaxDonneesBlock.appendChild(ajaxDonneesContent);
	ajaxDonneesBlock.appendChild(ajaxDonneesDelete);
	elementMultipleDonneesContents.appendChild(ajaxDonneesBlock);
}
function AjaxMultipleDonneesAjouterListe(nomDeDonnee,urlDeLaVueAjax,maxDonnees,postDonneesList) {
	var i=0;
	for (key in postDonneesList) {
		if(i>=maxDonnees) {
			AjaxMultipleDonneesEtatAjouter(nomDeDonnee,false);
			break;
		}
		if(postDonneesList[key]==null) continue;
		AjaxMultipleDonneesAjouter(nomDeDonnee,urlDeLaVueAjax,maxDonnees,postDonneesList[key]);
		i++;
	}
}
function AjaxMultipleDonneesEtatAjouter(nomDeDonnee,etat) {
	var ajaxDonneesAppend = document.getElementById("MD-"+nomDeDonnee+"-append");
	ajaxDonneesAppend.disabled = !etat;
}
*/