/** 
 * Script de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

function changerInputActifParSelectChoix(elementSelect,idElementEtatChanger,valeurSelect)
{
    var elementEtatChanger = document.getElementById(idElementEtatChanger);
	//
	var choix = elementSelect.selectedIndex;
	var valeurChoix = elementSelect.options[choix].value;
	//
	elementEtatChanger.disabled = (valeurChoix!=valeurSelect);
    //elementEtatChanger.style.visible = "visible";
}

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

$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();
        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
  	$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});