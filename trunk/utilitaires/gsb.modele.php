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

    /** Destructeur
	  */
    //public function __destruct() {
    //   GsbModele::$pdo = null;
    //}

    /** retourne l'unique objet de la classe PdoExemple
	  */
    public static function getGsbModele() {
        if (GsbModele::$pdoGsb == null) {
            GsbModele::$pdoGsb = new GsbModele();
        }
        return GsbModele::$pdoGsb;
    }

    // getInfosVisiteur : retourne un tableau associatif contenant le visiteur
    public static function getInfosVisiteur($login, $mdp) {
        $sth = GsbModele::$pdo->prepare("select * from visiteur where VIS_LOGIN=:login and VIS_MDP=:mdp");
        $sth->execute(array("login" => $login, "mdp" => $mdp));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // getLesVisiteurs : retourne un tableau associatif contenant tous les visiteurs
    public static function getLesVisiteurs() {
        $rs = GsbModele::$pdo->query("select VIS_MATRICULE, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE from visiteur");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    // getLesMedicaments : retourne un tableau associatif contenant tous les Medicaments
    public static function getLesMedicaments() {
        $sth = GsbModele::$pdo->query("select * from medicament order by MED_NOMCOMMERCIAL");
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // getInfoMedicament : retourne un tableau associatif contenant un medicament
    public static function getInfoMedicament($DEPOTLEGAL) {
        $sth = GsbModele::$pdo->prepare("select * from medicament where MED_DEPOTLEGAL=:DEPOTLEGAL");
        $sth->execute(array("DEPOTLEGAL" => $DEPOTLEGAL));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // getLesPraticiens : ...
    public static function getLesPraticiens() {
        $rs = GsbModele::$pdo->query("SELECT PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE FROM praticien ORDER BY PRA_NOM");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getLePraticienDetailNom($num) {
        $rs = GsbModele::$pdo->prepare("SELECT praticien.PRA_NUM, praticien.PRA_NOM, praticien.PRA_PRENOM, praticien.PRA_ADRESSE, praticien.PRA_CP, praticien.PRA_VILLE, praticien.PRA_COEFNOTORIETE, type_praticien.TYP_LIBELLE, type_praticien.TYP_LIEU FROM praticien, type_praticien WHERE type_praticien.TYP_CODE=praticien.TYP_CODE AND PRA_NUM=:NUM");
        $rs->execute(array("NUM" => $num));
        return $rs->fetch(PDO::FETCH_ASSOC);
    }

    public static function listePraticiens() {
        $rs = GsbModele::$pdo->query("SELECT PRA_NOM, PRA_PRENOM FROM praticien");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    // getLesComptesRendus : ...
    public static function getLesComptesRendus() {
        $rs = GsbModele::$pdo->query("select * from rapport_visite");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public static function getLesComptesRendusDuVisiteur($matricule) {
        $rs = GsbModele::$pdo->prepare("SELECT * FROM rapport_visite WHERE VIS_MATRICULE=:MATRICULE");
        $rs->execute(array("MATRICULE" => $matricule));
        return $rs->fetchAll(PDO::FETCH_ASSOC);
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
			COMMIT;"
    );
 }
}