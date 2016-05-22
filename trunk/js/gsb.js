/** 
 * Script de l'application GSB
 * @package default
 * @author Christophe Sonntag
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
