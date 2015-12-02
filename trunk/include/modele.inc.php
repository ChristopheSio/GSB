<?php

/**
 * Classe d'accès aux données. 

 * Utilise les services de la classe PDO
 * pour l'application exempleMVC du cours sur la bdd bddemployés
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdo qui contiendra l'unique instance de la classe
 * @package default
 * @author AP
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
class PdoGsb {

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=gsb_visiteurs_g2';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoGsb = null;

    // __construct ::  Constructeur privé, crée l'instance de PDO qui sera sollicitée pour toutes les méthodes de la classe
    private function __construct() {
        try {
            PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
            PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            throw new Exception("Erreur de connexion \n" . $e->getMessage());
        }
    }

    // __destruct : Destructeur
    public function __destruct() {
        PdoGsb::$monPdo = null;
    }

    // getPdoGsb : retourne l'unique objet de la classe PdoExemple
    public static function getPdoGsb() {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;
    }

    // getInfosVisiteur : retourne un tableau associatif contenant le visiteur
    public function getInfosVisiteur($login, $mdp) {
        $sth = PdoGsb::$monPdo->prepare("select * from visiteur where LOGIN=:login and MDP=:mdp");
        $sth->execute(array("login" => $login, "mdp" => $mdp));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // getLesVisiteurs : retourne un tableau associatif contenant tous les visiteurs
    public function getLesVisiteurs() {
        $rs = PdoGsb::$monPdo->query("select VIS_MATRICULE, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE from visiteur");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    // getLesMedicaments : retourne un tableau associatif contenant tous les Medicaments
    public function getLesMedicaments() {
        $sth = PdoGsb::$monPdo->query("select * from medicament order by MED_NOMCOMMERCIAL");
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // getInfoMedicament : retourne un tableau associatif contenant un medicament
    public function getInfoMedicament($DEPOTLEGAL) {
        $sth = PdoGsb::$monPdo->prepare("select * from medicament where MED_DEPOTLEGAL=:DEPOTLEGAL");
        $sth->execute(array("DEPOTLEGAL" => $DEPOTLEGAL));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // getLesPraticiens : ...
    public function getLesPraticiens() {
        $rs = PdoGsb::$monPdo->query("SELECT PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE FROM praticien ORDER BY PRA_NOM");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLePraticienDetailNom($num) {
        $rs = PdoGsb::$monPdo->prepare("SELECT praticien.PRA_NUM, praticien.PRA_NOM, praticien.PRA_PRENOM, praticien.PRA_ADRESSE, praticien.PRA_CP, praticien.PRA_VILLE, praticien.PRA_COEFNOTORIETE, type_praticien.TYP_LIBELLE, type_praticien.TYP_LIEU FROM praticien, type_praticien WHERE type_praticien.TYP_CODE=praticien.TYP_CODE AND PRA_NUM=:NUM");
        $rs->execute(array("NUM" => $num));
        return $rs->fetch(PDO::FETCH_ASSOC);
    }

    public function listePraticiens() {
        $rs = PdoGsb::$monPdo->query("SELECT PRA_NOM, PRA_PRENOM FROM praticien");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    // getLesComptesRendus : ...
    public function getLesComptesRendus() {
        $rs = PdoGsb::$monPdo->query("select * from rapport_visite");
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public function getLesComptesRendusDuVisiteur($matricule) {
        $rs = PdoGsb::$monPdo->prepare("SELECT * FROM rapport_visite WHERE VIS_MATRICULE=:MATRICULE");
        $rs->execute(array("MATRICULE" => $matricule));
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setCompteRendu() {
        $stmt = $dbh->prepare("INSERT INTO rapport_visite VALUES (:VIS_MATRICULE, :RAP_NUM, :PRA_NUM, :RAP_DATE, :RAP_BILAN, :RAP_MOTIF)");
        $stmt->bindParam(':VIS_MATRICULE', $matricule);
        $stmt->bindParam(':RAP_NUM', $numero_rapport);
        $stmt->bindParam(':PRA_NUM', $numero_praticien);
        $stmt->bindParam(':RAP_DATE', $date);
        $stmt->bindParam(':RAP_BILAN', $bilan);
        $stmt->bindParam(':RAP_MOTIF', $motif);
    }
 public function insererCompteRendu(){
    $rs = PdoGsb::$monPdo->prepare(
        "START TRANSACTION;
        SELECT @A:=SUM(salary) FROM table1 WHERE type=1;
        UPDATE table2 SET summary=@A WHERE type=1;
        COMMIT;"
    );
    
    
 }
}

?>