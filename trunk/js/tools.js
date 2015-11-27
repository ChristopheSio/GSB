/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function changerVisibilite(IdElement,BooleanVisible)
{
    element = document.getElementById(IdElement);
    element.style.visible = "visible";
    
    alert(BooleanVisible);
    
    if(BooleanVisible)
        element.style.visible = "visible";
    else
        element.style.visible = "hidden";
}
