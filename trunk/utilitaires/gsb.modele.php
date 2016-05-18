<?php
/** 
 * Modèle d'accès aux données pour l'application GSB
 * @package default
 * @author Cheri Bibi released by Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class GsbModele 
{
	/** Permet de se connecter en pdo, ressemble a "mysql:host=<host>;dbname=<database>"
	 */
    private static $driver = null;
	
	/** PHP Data Objects (PDO) définit une excellente interface pour accéder à  une base de données depuis PHP (php.net)
	 */
    private static $pdo = null;

   /** Constructeur du modèle
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée pour toutes les méthodes de la classe
	 */
    public static function seConnecter() {
        try {
            GsbModele::$driver = GsbConfig::$BdType . ':host=' . GsbConfig::$BdServeur . ';dbname=' . GsbConfig::$BdBase ;
			GsbModele::$pdo = new PDO( GsbModele::$driver, GsbConfig::$BdUtilisateur, GsbConfig::$BdMotDePasse );
            GsbModele::$pdo->query("SET CHARACTER SET utf8"); // règle les problème d'encodage
        } 
		catch (Exception $e) {
            throw new Exception("Erreur de connexion \n" . $e->getMessage());
        }
    }
	
	/** Visiteur 
	 */

    // getInfosVisiteur : retourne un tableau associatif contenant le visiteur
    public static function getInfosVisiteur($login, $mdp) {
        $sth = GsbModele::$pdo->prepare("select * from visiteur where VIS_LOGIN=:login and VIS_MDP=:mdp");
        $sth->execute(array("login" => $login, "mdp" => $mdp));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
	// getInfosVisiteur : retourne un tableau associatif contenant le visiteur
    public static function getInfosVisiteurMatricule($matricule) {
        $sth = GsbModele::$pdo->prepare("select * from visiteur v LEFT JOIN secteur s ON v.SEC_CODE=s.SEC_CODE LEFT JOIN labo l ON l.LAB_CODE=v.LAB_CODE where VIS_MATRICULE=:matricule");
        $sth->execute(array("matricule" => $matricule));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    // getLesVisiteurs : retourne un tableau associatif contenant tous les visiteurs
    public static function getLesVisiteurs() {
        $rs = GsbModele::$pdo->query("select VIS_MATRICULE, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE from visiteur");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	// getLesVisiteursRoles : retourne un tableau associatif contenant le roles de tous les visiteurs
    public static function getLesVisiteursRoles() {
        $rs = GsbModele::$pdo->query("select t1.VIS_MATRICULE, t1.TRAV_DATETIME, t1.REG_CODE, t1.ROLE_CODE, r.SEC_CODE, r.REG_NOM, s.SEC_LIBELLE from travailler t1 LEFT JOIN region r ON t1.REG_CODE = r.REG_CODE LEFT JOIN secteur s ON r.SEC_CODE = s.SEC_CODE where t1.TRAV_DATETIME IN( select MAX(t2.TRAV_DATETIME) from travailler t2 where t1.VIS_MATRICULE=t2.VIS_MATRICULE )");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	// getLeVisiteurRole : retourne un tableau associatif contenant le role d'un visiteurs
    public static function getLeVisiteurRole($matricule) {
        $sth = GsbModele::$pdo->prepare("select t1.VIS_MATRICULE, t1.TRAV_DATETIME, t1.REG_CODE, t1.ROLE_CODE, r.SEC_CODE, r.REG_NOM, s.SEC_LIBELLE from travailler t1 LEFT JOIN region r ON t1.REG_CODE = r.REG_CODE LEFT JOIN secteur s ON r.SEC_CODE = s.SEC_CODE where t1.TRAV_DATETIME IN( select MAX(t2.TRAV_DATETIME) from travailler t2 where t1.VIS_MATRICULE=t2.VIS_MATRICULE ) AND t1.VIS_MATRICULE=:matricule");
        $sth->execute(array("matricule" => $matricule));
		return $sth->fetch(PDO::FETCH_ASSOC);
    }

	/** Medicament
	 */
		
    // getLesMedicaments : retourne un tableau associatif contenant tous les Medicaments
    public static function getLesMedicaments() {
        $sth = GsbModele::$pdo->query("select MED_DEPOTLEGAL,MED_NOMCOMMERCIAL from medicament order by MED_NOMCOMMERCIAL");
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
	
    // getInfoMedicament : retourne un tableau associatif contenant un medicament
    public static function getLeMedicamentDetails($DEPOTLEGAL) {
        $sth = GsbModele::$pdo->prepare("select * from medicament where MED_DEPOTLEGAL=:DEPOTLEGAL");
        $sth->execute(array("DEPOTLEGAL" => $DEPOTLEGAL));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

	/** Praticien
	 */
	
    // getLesPraticiens : ...
    public static function getLesPraticiens() {
        $rs = GsbModele::$pdo->query("SELECT PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE FROM praticien ORDER BY PRA_NOM, PRA_PRENOM");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getLesPraticiensPourCompteRendu() {
        $rs = GsbModele::$pdo->query("SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM praticien ORDER BY PRA_NOM, PRA_PRENOM");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getLePraticienDetails($num) {
        // Old Method, basic joint : $rs = GsbModele::$pdo->prepare("SELECT praticien.PRA_NUM, praticien.PRA_NOM, praticien.PRA_PRENOM, praticien.PRA_ADRESSE, praticien.PRA_CP, praticien.PRA_VILLE, praticien.PRA_COEFNOTORIETE, type_praticien.TYP_LIBELLE, type_praticien.TYP_LIEU FROM praticien, type_praticien WHERE type_praticien.TYP_CODE=praticien.TYP_CODE AND PRA_NUM=:NUM");
        $rs = GsbModele::$pdo->prepare("SELECT * FROM praticien INNER JOIN type_praticien ON type_praticien.TYP_CODE=praticien.TYP_CODE WHERE PRA_NUM=:NUM");
        $rs->execute(array("NUM" => $num));
        return $rs->fetch(PDO::FETCH_ASSOC);
    }
    public static function listePraticiens() {
        $rs = GsbModele::$pdo->query("SELECT PRA_NOM, PRA_PRENOM FROM praticien");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /** Compte Rendu
	 */
	
    // getLesComptesRendus : ...
    public static function getLesComptesRendus() {
        $rs = GsbModele::$pdo->query("select * from rapport_visite");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public static function getLesComptesRendusDuVisiteur($matricule) {
        // Old Method, basic joint : $rs = GsbModele::$pdo->prepare("SELECT * FROM rapport_visite, praticien WHERE VIS_MATRICULE=:MATRICULE AND rapport_visite.PRA_NUM=praticien.PRA_NUM");
        $rs = GsbModele::$pdo->prepare("SELECT r.*, p.* FROM rapport_visite r INNER JOIN praticien p ON r.PRA_NUM=p.PRA_NUM WHERE VIS_MATRICULE=:MATRICULE ORDER BY r.RAP_NUM DESC");
        $rs->execute(array("MATRICULE" => $matricule));
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public static function getLesComptesRendusDeLaRegion($codeRegion) {
        $rs = GsbModele::$pdo->prepare("SELECT DISTINCT r.*, p.*, v.VIS_MATRICULE,v.VIS_NOM,v.VIS_PRENOM  FROM rapport_visite r INNER JOIN praticien p ON r.PRA_NUM=p.PRA_NUM INNER JOIN travailler t ON t.VIS_MATRICULE=r.VIS_MATRICULE INNER JOIN visiteur v ON v.VIS_MATRICULE=r.VIS_MATRICULE WHERE t.REG_CODE=:region ORDER BY v.VIS_NOM, v.VIS_PRENOM ,r.RAP_NUM DESC");
        $rs->execute(array("region" => $codeRegion));
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public static function getCompteRenduLeDernierNumeroDuVisiteur($matricule) {
        $rs = GsbModele::$pdo->prepare("SELECT MAX(RAP_NUM) as RAP_MAX_NUM WHERE VIS_MATRICULE=:MATRICULE");
        $rs->execute(array("MATRICULE" => $matricule));
        return $rs->fetch(PDO::FETCH_ASSOC)["RAP_MAX_NUM"];
    }

    public static function setCompteRendu() {
        $stmt = $dbh->prepare("INSERT INTO rapport_visite VALUES (:VIS_MATRICULE, :RAP_NUM, :PRA_NUM, :RAP_DATE, :RAP_BILAN, :RAP_MOTIF)");
        $stmt->bindParam(':VIS_MATRICULE', $matricule);
        $stmt->bindParam(':RAP_NUM', $numero_rapport);
        $stmt->bindParam(':PRA_NUM', $numero_praticien);
        $stmt->bindParam(':RAP_DATE', $date);
        $stmt->bindParam(':RAP_BILAN', $bilan);
        $stmt->bindParam(':RAP_MOTIF', $motif);
    }
	public static function insererCompteRendu(){
		$rs = GsbModele::$pdo->prepare(
			"START TRANSACTION;
			SELECT @A:=SUM(salary) FROM table1 WHERE type=1;
			UPDATE table2 SET summary=@A WHERE type=1;
			COMMIT;");
	}
	
    /** Statistiques
	 */
    
    //La prochaine requête consiste à calculer le pourcentage de médicament par famille sur le total de médicament
    public static function statFamilleMedicament() {
        $rs1 = GsbModele::$pdo->query("SELECT count(*) as total from medicament");
        $result1 = $rs1->fetch(PDO::FETCH_ASSOC);
        $rs2 = GsbModele::$pdo->query("SELECT m.FAM_CODE, f.FAM_LIBELLE, count(*) as nb, (count(*)*100/".$result1["total"].") as pourcentage from medicament m inner join famille f on m.FAM_CODE=f.FAM_CODE group by m.FAM_CODE ");
        $result2 = $rs2->fetchAll(PDO::FETCH_ASSOC);
        return array("total"=>$result1["total"],"stat"=>$result2);
    }
    
    public static function statPraticienType(){
        $res1 = GsbModele::$pdo->query("SELECT count(*) AS totPraticien FROM praticien");
        $tot = $res1->fetch(PDO::FETCH_ASSOC);
        $res2 = GsbModele::$pdo->query("SELECT p.TYP_CODE, t.TYP_LIBELLE, count(*) AS nb, (count(*)*100/".$tot["totPraticien"].") AS pourcentage FROM praticien p INNER JOIN type_praticien t ON p.TYP_CODE=t.TYP_CODE GROUP BY p.TYP_CODE");
        $stat = $res2->fetchAll(PDO::FETCH_ASSOC);
        return array("total"=>$tot["totPraticien"],"stat"=>$stat);
    }
    
    public static function statVisiteLabo(){
        $res1 = GsbModele::$pdo->query("SELECT count(*) AS totVisiteur FROM visiteur");
        $tot = $res1->fetch(PDO::FETCH_ASSOC);
        $res2 = GsbModele::$pdo->query("SELECT v.LAB_CODE, l.LAB_NOM, count(*) AS nb, (count(*)*100/".$tot["totVisiteur"].") AS pourcentage FROM visiteur v INNER JOIN labo l ON v.LAB_CODE=l.LAB_CODE GROUP BY v.LAB_CODE");
        $stat = $res2->fetchAll(PDO::FETCH_ASSOC);
        return array("total"=>$tot["totVisiteur"],"stat"=>$stat);
    }
	
}

///** Destructeur
//*/
//public function __destruct() {
//   GsbModele::$pdo = null;
//}
///** retourne l'unique objet de la classe PdoExemple
//  */
//public static function getGsbModele() {
//    if (GsbModele::$pdoGsb == null) {
//        GsbModele::$pdoGsb = new GsbModele();
//     }
//    return GsbModele::$pdoGsb;
// }