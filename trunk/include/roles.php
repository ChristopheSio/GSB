<?php
// Include dependant class
include_once 'include/enumeration.class.php';

/*
 * Permet de connaitre d'avantage sur l'utilisateur
 */


function estConnecte()
{
	return isset($_SESSION["login"]);
}

/* 
 * Permet de d'accorder les bons droit d'accés
 */

abstract class  extends BasicEnum {
    const Sunday = 0;
    const Monday = 1;
    const Tuesday = 2;
    const Wednesday = 3;
    const Thursday = 4;
    const Friday = 5;
    const Saturday = 6;
}

//function es