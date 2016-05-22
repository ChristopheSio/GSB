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
