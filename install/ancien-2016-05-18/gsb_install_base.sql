--
-- gsb_install_base.sql
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Structure de la table `activite_compl`
--

CREATE TABLE IF NOT EXISTS `activite_compl` (
  `AC_NUM` int(11) NOT NULL,
  `AC_DATE` datetime DEFAULT NULL,
  `AC_LIEU` varchar(25) DEFAULT NULL,
  `AC_THEME` varchar(10) DEFAULT NULL,
  `AC_MOTIF` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`AC_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dosage`
--

CREATE TABLE IF NOT EXISTS `dosage` (
  `DOS_CODE` varchar(10) NOT NULL,
  `DOS_QUANTITE` varchar(10) DEFAULT NULL,
  `DOS_UNITE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE IF NOT EXISTS `famille` (
  `FAM_CODE` varchar(3) NOT NULL,
  `FAM_LIBELLE` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`FAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `inviter`
--

CREATE TABLE IF NOT EXISTS `inviter` (
  `AC_NUM` int(11) NOT NULL,
  `PRA_NUM` smallint(6) NOT NULL,
  `SPECIALISTEON` bit(1) DEFAULT NULL,
  PRIMARY KEY (`AC_NUM`,`PRA_NUM`),
  KEY `fk_inviter_activite_compl1_idx` (`AC_NUM`),
  KEY `fk_inviter_praticien1_idx` (`PRA_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `labo`
--

CREATE TABLE IF NOT EXISTS `labo` (
  `LAB_CODE` varchar(2) DEFAULT NULL,
  `LAB_NOM` varchar(10) DEFAULT NULL,
  `LAB_CHEFVENTE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE IF NOT EXISTS `medicament` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `MED_NOMCOMMERCIAL` varchar(25) DEFAULT NULL,
  `FAM_CODE` varchar(3) DEFAULT NULL,
  `MED_COMPOSITION` varchar(255) DEFAULT NULL,
  `MED_EFFETS` varchar(255) DEFAULT NULL,
  `MED_CONTREINDIC` varchar(255) DEFAULT NULL,
  `MED_PRIXECHANTILLON` float DEFAULT NULL,
  `MED_PRESENTATION` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`MED_DEPOTLEGAL`),
  KEY `fk_medicament_famille1_idx` (`FAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offrir`
--

CREATE TABLE IF NOT EXISTS `offrir` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `RAP_NUM` int(11) NOT NULL,
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `OFF_QTE` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`VIS_MATRICULE`,`RAP_NUM`,`MED_DEPOTLEGAL`),
  KEY `fk_offrir_rapport_visite1_idx` (`VIS_MATRICULE`),
  KEY `fk_offrir_rapport_visite2_idx` (`RAP_NUM`),
  KEY `fk_offrir_medicament1_idx` (`MED_DEPOTLEGAL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE IF NOT EXISTS `posseder` (
  `PRA_NUM` smallint(6) NOT NULL,
  `SPE_CODE` varchar(5) NOT NULL,
  `POS_DIPLOME` varchar(10) DEFAULT NULL,
  `POS_COEFPRESCRIPTION` float DEFAULT NULL,
  PRIMARY KEY (`PRA_NUM`,`SPE_CODE`),
  KEY `fk_posseder_specialite1_idx` (`SPE_CODE`),
  KEY `fk_posseder_praticien1_idx` (`PRA_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `praticien`
--

CREATE TABLE IF NOT EXISTS `praticien` (
  `PRA_NUM` smallint(6) NOT NULL,
  `PRA_NOM` varchar(25) DEFAULT NULL,
  `PRA_PRENOM` varchar(30) DEFAULT NULL,
  `PRA_ADRESSE` varchar(50) DEFAULT NULL,
  `PRA_CP` varchar(5) DEFAULT NULL,
  `PRA_VILLE` varchar(25) DEFAULT NULL,
  `PRA_COEFNOTORIETE` float DEFAULT NULL,
  `TYP_CODE` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`PRA_NUM`),
  KEY `fk_praticien_type_praticien1_idx` (`TYP_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `prescrire`
--

CREATE TABLE IF NOT EXISTS `prescrire` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `TIN_CODE` varchar(5) NOT NULL,
  `DOS_CODE` varchar(10) NOT NULL,
  `PRE_POSOLOGIE` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`MED_DEPOTLEGAL`,`TIN_CODE`,`DOS_CODE`),
  KEY `fk_prescrire_medicament1_idx` (`MED_DEPOTLEGAL`),
  KEY `fk_prescrire_type_individu1_idx` (`TIN_CODE`),
  KEY `fk_prescrire_dosage1_idx` (`DOS_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rapport_visite`
--

CREATE TABLE IF NOT EXISTS `rapport_visite` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `RAP_NUM` int(11) NOT NULL,
  `PRA_NUM` smallint(6) DEFAULT NULL,
  `RAP_DATE` datetime DEFAULT NULL,
  `RAP_BILAN` varchar(255) DEFAULT NULL,
  `RAP_MOTIF` varchar(255) DEFAULT NULL,
  `RAP_REMPLACANT` tinyint(1) NOT NULL,
  `RAP_DOC_OFFERTE` tinyint(1) NOT NULL,
  `RAP_ECHANTILLONS` tinyint(1) NOT NULL,
  PRIMARY KEY (`VIS_MATRICULE`,`RAP_NUM`),
  KEY `fk_rapport_visite_praticien1_idx` (`PRA_NUM`),
  KEY `fk_rapport_visite_visiteur1_idx` (`VIS_MATRICULE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Structure de la table `realiser`
--

CREATE TABLE IF NOT EXISTS `realiser` (
  `AC_NUM` int(11) NOT NULL,
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `REA_MTTFRAIS` float DEFAULT NULL,
  PRIMARY KEY (`AC_NUM`,`VIS_MATRICULE`),
  KEY `fk_realiser_visiteur1_idx` (`VIS_MATRICULE`),
  KEY `fk_realiser_activite_compl1_idx` (`AC_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Structure de la table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `REG_CODE` varchar(2) NOT NULL,
  `SEC_CODE` varchar(1) DEFAULT NULL,
  `REG_NOM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`REG_CODE`),
  KEY `fk_region_secteur_idx` (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE IF NOT EXISTS `secteur` (
  `SEC_CODE` varchar(1) NOT NULL,
  `SEC_LIBELLE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE IF NOT EXISTS `specialite` (
  `SPE_CODE` varchar(5) NOT NULL,
  `SPE_LIBELLE` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`SPE_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `travailler`
--

CREATE TABLE IF NOT EXISTS `travailler` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `JJMMAA` datetime NOT NULL,
  `REG_CODE` varchar(2) NOT NULL,
  `TRA_ROLE` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`VIS_MATRICULE`,`JJMMAA`,`REG_CODE`),
  KEY `fk_travailler_visiteur1_idx` (`VIS_MATRICULE`),
  KEY `fk_travailler_region1_idx` (`REG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_individu`
--

CREATE TABLE IF NOT EXISTS `type_individu` (
  `TIN_CODE` varchar(5) NOT NULL,
  `TIN_LIBELLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TIN_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_praticien`
--

CREATE TABLE IF NOT EXISTS `type_praticien` (
  `TYP_CODE` varchar(3) NOT NULL,
  `TYP_LIBELLE` varchar(25) DEFAULT NULL,
  `TYP_LIEU` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`TYP_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `VIS_NOM` varchar(25) DEFAULT NULL,
  `VIS_PRENOM` varchar(50) DEFAULT NULL,
  `LOGIN` varchar(20) DEFAULT NULL,
  `MDP` char(32) DEFAULT NULL,
  `VIS_EMAIL` varchar(255) DEFAULT NULL,
  `VIS_ADRESSE` varchar(50) DEFAULT NULL,
  `VIS_CP` varchar(5) DEFAULT NULL,
  `VIS_VILLE` varchar(30) DEFAULT NULL,
  `VIS_DATEEMBAUCHE` datetime DEFAULT NULL,
  `SEC_CODE` varchar(1) DEFAULT NULL,
  `LAB_CODE` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`VIS_MATRICULE`),
  KEY `fk_visiteur_labo1_idx` (`LAB_CODE`),
  KEY `fk_visiteur_secteur1_idx` (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
