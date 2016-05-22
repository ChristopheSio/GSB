-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Mai 2016 à 10:47
-- Version du serveur :  5.7.9
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sio_gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite_compl`
--

DROP TABLE IF EXISTS `activite_compl`;
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

DROP TABLE IF EXISTS `dosage`;
CREATE TABLE IF NOT EXISTS `dosage` (
  `DOS_CODE` varchar(10) NOT NULL,
  `DOS_QUANTITE` varchar(10) DEFAULT NULL,
  `DOS_UNITE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

DROP TABLE IF EXISTS `famille`;
CREATE TABLE IF NOT EXISTS `famille` (
  `FAM_CODE` varchar(3) NOT NULL,
  `FAM_LIBELLE` varchar(80) NOT NULL,
  PRIMARY KEY (`FAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`FAM_CODE`, `FAM_LIBELLE`) VALUES
('AA', 'Antalgiques en association'),
('AAA', 'Antalgiques antipyrétiques en association'),
('AAC', 'Antidépresseur d''action centrale'),
('AAH', 'Antivertigineux antihistaminique H1'),
('ABA', 'Antibiotique antituberculeux'),
('ABC', 'Antibiotique antiacnéique local'),
('ABP', 'Antibiotique de la famille des béta-lactamines (pénicilline A)'),
('AFC', 'Antibiotique de la famille des cyclines'),
('AFM', 'Antibiotique de la famille des macrolides'),
('AH', 'Antihistaminique H1 local'),
('AIM', 'Antidépresseur imipraminique (tricyclique)'),
('AIN', 'Antidépresseur inhibiteur sélectif de la recapture de la sérotonine'),
('ALO', 'Antibiotique local (ORL)'),
('ANS', 'Antidépresseur IMAO non sélectif'),
('AO', 'Antibiotique ophtalmique'),
('AP', 'Antipsychotique normothymique'),
('AUM', 'Antibiotique urinaire minute'),
('CRT', 'Corticoïde, antibiotique et antifongique à  usage local'),
('HYP', 'Hypnotique antihistaminique'),
('PSA', 'Psychostimulant, antiasthénique');

-- --------------------------------------------------------

--
-- Structure de la table `inviter`
--

DROP TABLE IF EXISTS `inviter`;
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

DROP TABLE IF EXISTS `labo`;
CREATE TABLE IF NOT EXISTS `labo` (
  `LAB_CODE` varchar(2) NOT NULL,
  `LAB_NOM` varchar(10) NOT NULL,
  `LAB_CHEFVENTE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `labo`
--

INSERT INTO `labo` (`LAB_CODE`, `LAB_NOM`, `LAB_CHEFVENTE`) VALUES
('BC', 'Bichat', 'Suzanne Terminus'),
('GY', 'Gyverny', 'Marcel MacDouglas'),
('SW', 'Swiss Kane', 'Alain Poutre');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
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

--
-- Contenu de la table `medicament`
--

INSERT INTO `medicament` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`, `MED_PRIXECHANTILLON`, `MED_PRESENTATION`) VALUES
('3MYC7', 'TRIMYCINE', 'CRT', 'Triamcinolone (acétonide) + Néomycine + Nystatine', 'Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, d''infections de la peau ou de parasitisme non traités, d''acné. Ne pas appliquer sur une plaie, ni sous un pansement occlusif.', NULL, NULL),
('ADIMOL9', 'ADIMOL', 'ABP', 'Amoxicilline + Acide clavulanique', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d''allergie aux pénicillines ou aux céphalosporines.', NULL, NULL),
('AMOPIL7', 'AMOPIL', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d''allergie aux pénicillines. Il doit être administré avec prudence en cas d''allergie aux céphalosporines.', NULL, NULL),
('AMOX45', 'AMOXAR', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'La prise de ce médicament peut rendre positifs les tests de dépistage du dopage.', NULL, NULL),
('AMOXIG12', 'AMOXI Gé', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d''allergie aux pénicillines. Il doit être administré avec prudence en cas d''allergie aux céphalosporines.', NULL, NULL),
('APATOUX22', 'APATOUX Vitamine C', 'ALO', 'Tyrothricine + Tétracaïne + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, en cas de phénylcétonurie et chez l''enfant de moins de 6 ans.', NULL, NULL),
('BACTIG10', 'BACTIGEL', 'ABC', 'Erythromycine', 'Ce médicament est utilisé en application locale pour traiter l''acné et les infections cutanées bactériennes associées.', 'Ce médicament est contre-indiqué en cas d''allergie aux antibiotiques de la famille des macrolides ou des lincosanides.', NULL, NULL),
('BACTIV13', 'BACTIVIL', 'AFM', 'Erythromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d''allergie aux macrolides (dont le chef de file est l''érythromycine).', NULL, NULL),
('BITALV', 'BIVALIC', 'AAA', 'Dextropropoxyphène + Paracétamol', 'Ce médicament est utilisé pour traiter les douleurs d''intensité modérée ou intense.', 'Ce médicament est contre-indiqué en cas d''allergie aux médicaments de cette famille, d''insuffisance hépatique ou d''insuffisance rénale.', NULL, NULL),
('CARTION6', 'CARTION', 'AAA', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas de troubles de la coagulation (tendances aux hémorragies), d''ulcère gastroduodénal, maladies graves du foie.', NULL, NULL),
('CLAZER6', 'CLAZER', 'AFM', 'Clarithromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques. Il est également utilisé dans le traitement de l''ulcère gastro-duodénal, en association avec d''autres médicaments.', 'Ce médicament est contre-indiqué en cas d''allergie aux macrolides (dont le chef de file est l''érythromycine).', NULL, NULL),
('DEPRIL9', 'DEPRAMIL', 'AIM', 'Clomipramine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères, certaines douleurs rebelles, les troubles obsessionnels compulsifs et certaines énurésies chez l''enfant.', 'Ce médicament est contre-indiqué en cas de glaucome ou d''adénome de la prostate, d''infarctus récent, ou si vous avez reà§u un traitement par IMAO durant les 2 semaines précédentes ou en cas d''allergie aux antidépresseurs imipraminiques.', NULL, NULL),
('DIMIRTAM6', 'DIMIRTAM', 'AAC', 'Mirtazapine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères.', 'La prise de ce produit est contre-indiquée en cas de d''allergie à  l''un des constituants.', NULL, NULL),
('DOLRIL7', 'DOLORIL', 'AAA', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas d''allergie au paracétamol ou aux salicylates.', NULL, NULL),
('DORNOM8', 'NORMADOR', 'HYP', 'Doxylamine', 'Ce médicament est utilisé pour traiter l''insomnie chez l''adulte.', 'Ce médicament est contre-indiqué en cas de glaucome, de certains troubles urinaires (rétention urinaire) et chez l''enfant de moins de 15 ans.', NULL, NULL),
('EQUILARX6', 'EQUILAR', 'AAH', 'Méclozine', 'Ce médicament est utilisé pour traiter les vertiges et pour prévenir le mal des transports.', 'Ce médicament ne doit pas être utilisé en cas d''allergie au produit, en cas de glaucome ou de rétention urinaire.', NULL, NULL),
('EVILR7', 'EVEILLOR', 'PSA', 'Adrafinil', 'Ce médicament est utilisé pour traiter les troubles de la vigilance et certains symptomes neurologiques chez le sujet agé.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants.', NULL, NULL),
('INSXT5', 'INSECTIL', 'AH', 'Diphénydramine', 'Ce médicament est utilisé en application locale sur les piqûres d''insecte et l''urticaire.', 'Ce médicament est contre-indiqué en cas d''allergie aux antihistaminiques.', NULL, NULL),
('JOVAI8', 'JOVENIL', 'AFM', 'Josamycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d''allergie aux macrolides (dont le chef de file est l''érythromycine).', NULL, NULL),
('LIDOXY23', 'LIDOXYTRACINE', 'AFC', 'Oxytétracycline +Lidocaïne', 'Ce médicament est utilisé en injection intramusculaire pour traiter certaines infections spécifiques.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants. Il ne doit pas être associé aux rétinoïdes.', NULL, NULL),
('LITHOR12', 'LITHORINE', 'AP', 'Lithium', 'Ce médicament est indiqué dans la prévention des psychoses maniaco-dépressives ou pour traiter les états maniaques.', 'Ce médicament ne doit pas être utilisé si vous êtes allergique au lithium. Avant de prendre ce traitement, signalez à  votre médecin traitant si vous souffrez d''insuffisance rénale, ou si vous avez un régime sans sel.', NULL, NULL),
('PARMOL16', 'PARMOCODEINE', 'AA', 'Codéine + Paracétamol', 'Ce médicament est utilisé pour le traitement des douleurs lorsque des antalgiques simples ne sont pas assez efficaces.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, chez l''enfant de moins de 15 Kg, en cas d''insuffisance hépatique ou respiratoire, d''asthme, de phénylcétonurie et chez la femme qui allaite.', NULL, NULL),
('PHYSOI8', 'PHYSICOR', 'PSA', 'Sulbutiamine', 'Ce médicament est utilisé pour traiter les baisses d''activité physique ou psychique, souvent dans un contexte de dépression.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants.', NULL, NULL),
('PIRIZ8', 'PIRIZAN', 'ABA', 'Pyrazinamide', 'Ce médicament est utilisé, en association à  d''autres antibiotiques, pour traiter la tuberculose.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants, d''insuffisance rénale ou hépatique, d''hyperuricémie ou de porphyrie.', NULL, NULL),
('POMDI20', 'POMADINE', 'AO', 'Bacitracine', 'Ce médicament est utilisé pour traiter les infections oculaires de la surface de l''oeil.', 'Ce médicament est contre-indiqué en cas d''allergie aux antibiotiques appliqués localement.', NULL, NULL),
('TROXT21', 'TROXADET', 'AIN', 'Paroxétine', 'Ce médicament est utilisé pour traiter la dépression et les troubles obsessionnels compulsifs. Il peut également être utilisé en prévention des crises de panique avec ou sans agoraphobie.', 'Ce médicament est contre-indiqué en cas d''allergie au produit.', NULL, NULL),
('TXISOL22', 'TOUXISOL Vitamine C', 'ALO', 'Tyrothricine + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d''allergie à  l''un des constituants et chez l''enfant de moins de 6 ans.', NULL, NULL),
('URIEG6', 'URIREGUL', 'AUM', 'Fosfomycine trométamol', 'Ce médicament est utilisé pour traiter les infections urinaires simples chez la femme de moins de 65 ans.', 'La prise de ce médicament est contre-indiquée en cas d''allergie à  l''un des constituants et d''insuffisance rénale.', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `offrir`
--

DROP TABLE IF EXISTS `offrir`;
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

--
-- Contenu de la table `offrir`
--

INSERT INTO `offrir` (`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`, `OFF_QTE`) VALUES
('a17', 4, '3MYC7', 3),
('a17', 4, 'AMOX45', 12);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
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

DROP TABLE IF EXISTS `praticien`;
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

--
-- Contenu de la table `praticien`
--

INSERT INTO `praticien` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `TYP_CODE`) VALUES
(1, 'Notini', 'Alain', '114 r Authie', '85000', 'LA ROCHE SUR YON', 290.03, 'MH'),
(2, 'Gosselin', 'Albert', '13 r Devon', '41000', 'BLOIS', 307.49, 'MV'),
(3, 'Delahaye', 'André', '36 av 6 Juin', '25000', 'BESANCON', 185.79, 'PS'),
(4, 'Leroux', 'André', '47 av Robert Schuman', '60000', 'BEAUVAIS', 172.04, 'PH'),
(5, 'Desmoulins', 'Anne', '31 r St Jean', '30000', 'NIMES', 94.75, 'PO'),
(6, 'Mouel', 'Anne', '27 r Auvergne', '80000', 'AMIENS', 45.2, 'MH'),
(7, 'Desgranges-Lentz', 'Antoine', '1 r Albert de Mun', '29000', 'MORLAIX', 20.07, 'MV'),
(8, 'Marcouiller', 'Arnaud', '31 r St Jean', '68000', 'MULHOUSE', 396.52, 'PS'),
(9, 'Dupuy', 'Benoit', '9 r Demolombe', '34000', 'MONTPELLIER', 395.66, 'PH'),
(10, 'Lerat', 'Bernard', '31 r St Jean', '59000', 'LILLE', 257.79, 'PO'),
(11, 'Marçais-Lefebvre', 'Bertrand', '86Bis r Basse', '67000', 'STRASBOURG', 450.96, 'MH'),
(12, 'Boscher', 'Bruno', '94 r Falaise', '10000', 'TROYES', 356.14, 'MV'),
(13, 'Morel', 'Catherine', '21 r Chateaubriand', '75000', 'PARIS', 379.57, 'PS'),
(14, 'Guivarch', 'Chantal', '4 av Gén Laperrine', '45000', 'ORLEANS', 114.56, 'PH'),
(15, 'Bessin-Grosdoit', 'Christophe', '92 r Falaise', '6000', 'NICE', 222.06, 'PO'),
(16, 'Rossa', 'Claire', '14 av Thiès', '6000', 'NICE', 529.78, 'MH'),
(17, 'Cauchy', 'Denis', '5 av Ste Thérèse', '11000', 'NARBONNE', 458.82, 'MV'),
(18, 'Gaffé', 'Dominique', '9 av 1ère Armée Française', '35000', 'RENNES', 213.4, 'PS'),
(19, 'Guenon', 'Dominique', '98 bd Mar Lyautey', '44000', 'NANTES', 175.89, 'PH'),
(20, 'Prévot', 'Dominique', '29 r Lucien Nelle', '87000', 'LIMOGES', 151.36, 'PO'),
(21, 'Houchard', 'Eliane', '9 r Demolombe', '49100', 'ANGERS', 436.96, 'MH'),
(22, 'Desmons', 'Elisabeth', '51 r Bernières', '29000', 'QUIMPER', 281.17, 'MV'),
(23, 'Flament', 'Elisabeth', '11 r Pasteur', '35000', 'RENNES', 315.6, 'PS'),
(24, 'Goussard', 'Emmanuel', '9 r Demolombe', '41000', 'BLOIS', 40.72, 'PH'),
(25, 'Desprez', 'Eric', '9 r Vaucelles', '33000', 'BORDEAUX', 406.85, 'PO'),
(26, 'Coste', 'Evelyne', '29 r Lucien Nelle', '19000', 'TULLE', 441.87, 'MH'),
(27, 'Lefebvre', 'Frédéric', '2 pl Wurzburg', '55000', 'VERDUN', 573.63, 'MV'),
(28, 'Lemée', 'Frédéric', '29 av 6 Juin', '56000', 'VANNES', 326.4, 'PS'),
(29, 'Martin', 'Frédéric', 'Bât A 90 r Bayeux', '70000', 'VESOUL', 506.06, 'PH'),
(30, 'Marie', 'Frédérique', '172 r Caponière', '70000', 'VESOUL', 313.31, 'PO'),
(31, 'Rosenstech', 'Geneviève', '27 r Auvergne', '75000', 'PARIS', 366.82, 'MH'),
(32, 'Pontavice', 'Ghislaine', '8 r Gaillon', '86000', 'POITIERS', 265.58, 'MV'),
(33, 'Leveneur-Mosquet', 'Guillaume', '47 av Robert Schuman', '64000', 'PAU', 184.97, 'PS'),
(34, 'Blanchais', 'Guy', '30 r Authie', '8000', 'SEDAN', 502.48, 'PH'),
(35, 'Leveneur', 'Hugues', '7 pl St Gilles', '62000', 'ARRAS', 7.39, 'PO'),
(36, 'Mosquet', 'Isabelle', '22 r Jules Verne', '76000', 'ROUEN', 77.1, 'MH'),
(37, 'Giraudon', 'Jean-Christophe', '1 r Albert de Mun', '38100', 'VIENNE', 92.62, 'MV'),
(38, 'Marie', 'Jean-Claude', '26 r Hérouville', '69000', 'LYON', 120.1, 'PS'),
(39, 'Maury', 'Jean-François', '5 r Pierre Girard', '71000', 'CHALON SUR SAONE', 13.73, 'PH'),
(40, 'Dennel', 'Jean-Louis', '7 pl St Gilles', '28000', 'CHARTRES', 550.69, 'PO'),
(41, 'Ain', 'Jean-Pierre', '4 résid Olympia', '2000', 'LAON', 5.59, 'MH'),
(42, 'Chemery', 'Jean-Pierre', '51 pl Ancienne Boucherie', '14000', 'CAEN', 396.58, 'MV'),
(43, 'Comoz', 'Jean-Pierre', '35 r Auguste Lechesne', '18000', 'BOURGES', 340.35, 'PS'),
(44, 'Desfaudais', 'Jean-Pierre', '7 pl St Gilles', '29000', 'BREST', 71.76, 'PH'),
(45, 'Phan', 'JérÃ´me', '9 r Clos Caillet', '79000', 'NIORT', 451.61, 'PO'),
(46, 'Riou', 'Line', '43 bd Gén Vanier', '77000', 'MARNE LA VALLEE', 193.25, 'MH'),
(47, 'Chubilleau', 'Louis', '46 r Eglise', '17000', 'SAINTES', 202.07, 'MV'),
(48, 'Lebrun', 'Lucette', '178 r Auge', '54000', 'NANCY', 410.41, 'PS'),
(49, 'Goessens', 'Marc', '6 av 6 Juin', '39000', 'DOLE', 548.57, 'PH'),
(50, 'Laforge', 'Marc', '5 résid Prairie', '50000', 'SAINT LO', 265.05, 'PO'),
(51, 'Millereau', 'Marc', '36 av 6 Juin', '72000', 'LA FERTE BERNARD', 430.42, 'MH'),
(52, 'Dauverne', 'Marie-Christine', '69 av Charlemagne', '21000', 'DIJON', 281.05, 'MV'),
(53, 'Vittorio', 'Myriam', '3 pl Champlain', '94000', 'BOISSY SAINT LEGER', 356.23, 'PS'),
(54, 'Lapasset', 'Nhieu', '31 av 6 Juin', '52000', 'CHAUMONT', 107, 'PH'),
(55, 'Plantet-Besnier', 'Nicole', '10 av 1ère Armée Française', '86000', 'CHATELLEREAULT', 369.94, 'PO'),
(56, 'Chubilleau', 'Pascal', '3 r Hastings', '15000', 'AURRILLAC', 290.75, 'MH'),
(57, 'Robert', 'Pascal', '31 r St Jean', '93000', 'BOBIGNY', 162.41, 'MV'),
(58, 'Jean', 'Pascale', '114 r Authie', '49100', 'SAUMUR', 375.52, 'PS'),
(59, 'Chanteloube', 'Patrice', '14 av Thiès', '13000', 'MARSEILLE', 478.01, 'PH'),
(60, 'Lecuirot', 'Patrice', 'résid St Pères 55 r Pigacière', '54000', 'NANCY', 239.66, 'PO'),
(61, 'Gandon', 'Patrick', '47 av Robert Schuman', '37000', 'TOURS', 599.06, 'MH'),
(62, 'Mirouf', 'Patrick', '22 r Puits Picard', '74000', 'ANNECY', 458.42, 'MV'),
(63, 'Boireaux', 'Philippe', '14 av Thiès', '10000', 'CHALON EN CHAMPAGNE', 454.48, 'PS'),
(64, 'Cendrier', 'Philippe', '7 pl St Gilles', '12000', 'RODEZ', 164.16, 'PH'),
(65, 'Duhamel', 'Philippe', '114 r Authie', '34000', 'MONTPELLIER', 98.62, 'PO'),
(66, 'Grigy', 'Philippe', '15 r Mélingue', '44000', 'CLISSON', 285.1, 'MH'),
(67, 'Linard', 'Philippe', '1 r Albert de Mun', '81000', 'ALBI', 486.3, 'MV'),
(68, 'Lozier', 'Philippe', '8 r Gaillon', '31000', 'TOULOUSE', 48.4, 'PS'),
(69, 'Dechâtre', 'Pierre', '63 av Thiès', '23000', 'MONTLUCON', 253.75, 'PH'),
(70, 'Goessens', 'Pierre', '22 r Jean Romain', '40000', 'MONT DE MARSAN', 426.19, 'PO'),
(71, 'Leménager', 'Pierre', '39 av 6 Juin', '57000', 'METZ', 118.7, 'MH'),
(72, 'Née', 'Pierre', '39 av 6 Juin', '82000', 'MONTAUBAN', 72.54, 'MV'),
(73, 'Guyot', 'Pierre-Laurent', '43 bd Gén Vanier', '48000', 'MENDE', 352.31, 'PS'),
(74, 'Chauchard', 'Roger', '9 r Vaucelles', '13000', 'MARSEILLE', 552.19, 'PH'),
(75, 'Mabire', 'Roland', '11 r Boutiques', '67000', 'STRASBOURG', 422.39, 'PO'),
(76, 'Leroy', 'Soazig', '45 r Boutiques', '61000', 'ALENCON', 570.67, 'MH'),
(77, 'Guyot', 'Stéphane', '26 r Hérouville', '46000', 'FIGEAC', 28.85, 'MV'),
(78, 'Delposen', 'Sylvain', '39 av 6 Juin', '27000', 'DREUX', 292.01, 'PS'),
(79, 'Rault', 'Sylvie', '15 bd Richemond', '2000', 'SOISSON', 526.6, 'PH'),
(80, 'Renouf', 'Sylvie', '98 bd Mar Lyautey', '88000', 'EPINAL', 425.24, 'PO'),
(81, 'Alliet-Grach', 'Thierry', '14 av Thiès', '7000', 'PRIVAS', 451.31, 'MH'),
(82, 'Bayard', 'Thierry', '92 r Falaise', '42000', 'SAINT ETIENNE', 271.71, 'MV'),
(83, 'Gauchet', 'Thierry', '7 r Desmoueux', '38100', 'GRENOBLE', 406.1, 'PS'),
(84, 'Bobichon', 'Tristan', '219 r Caponière', '9000', 'FOIX', 218.36, 'PH'),
(85, 'Duchemin-Laniel', 'Véronique', '130 r St Jean', '33000', 'LIBOURNE', 265.61, 'PO'),
(86, 'Laurent', 'Younès', '34 r Demolombe', '53000', 'MAYENNE', 496.1, 'MH');

-- --------------------------------------------------------

--
-- Structure de la table `prescrire`
--

DROP TABLE IF EXISTS `prescrire`;
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

DROP TABLE IF EXISTS `rapport_visite`;
CREATE TABLE IF NOT EXISTS `rapport_visite` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `RAP_NUM` int(11) NOT NULL,
  `PRA_NUM` smallint(6) NOT NULL,
  `RAP_DATETIME` datetime NOT NULL,
  `RAP_DATEVISITE` date NOT NULL,
  `RAP_BILAN` varchar(512) NOT NULL,
  `RAP_MOTIF` varchar(128) NOT NULL,
  `RAP_REMPLACANT` tinyint(1) NOT NULL,
  `RAP_DOC_OFFERTE` tinyint(1) NOT NULL,
  `RAP_ECHANTILLONS` tinyint(1) NOT NULL,
  PRIMARY KEY (`VIS_MATRICULE`,`RAP_NUM`),
  KEY `fk_rapport_visite_praticien1_idx` (`PRA_NUM`),
  KEY `fk_rapport_visite_visiteur1_idx` (`VIS_MATRICULE`),
  KEY `RAP_NUM` (`RAP_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rapport_visite`
--

INSERT INTO `rapport_visite` (`VIS_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `RAP_DATETIME`, `RAP_DATEVISITE`, `RAP_BILAN`, `RAP_MOTIF`, `RAP_REMPLACANT`, `RAP_DOC_OFFERTE`, `RAP_ECHANTILLONS`) VALUES
('a131', 0, 41, '2003-03-23 16:42:52', '2003-03-23', 'RAS\r\nChangement de tel : 05 89 89 89 89', 'Rapport Annuel', 0, 0, 0),
('a131', 1, 23, '2002-04-18 13:02:16', '2002-04-18', 'Médecin curieux, à recontacer en décembre pour réunion', 'Actualisation annuelle', 0, 0, 0),
('a17', 0, 4, '2003-05-21 08:16:18', '2003-05-21', 'Changement de direction, redéfinition de la politique médicamenteuse, recours au générique', 'Baisse activité', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `realiser`
--

DROP TABLE IF EXISTS `realiser`;
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

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `REG_CODE` varchar(2) NOT NULL,
  `SEC_CODE` varchar(1) DEFAULT NULL,
  `REG_NOM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`REG_CODE`),
  KEY `fk_region_secteur_idx` (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `region`
--

INSERT INTO `region` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES
('AL', 'E', 'Alsace Lorraine'),
('AQ', 'S', 'Aquitaine'),
('AU', 'P', 'Auvergne'),
('BG', 'O', 'Bretagne'),
('BN', 'O', 'Basse Normandie'),
('BO', 'E', 'Bourgogne'),
('CA', 'N', 'Champagne Ardennes'),
('CE', 'P', 'Centre'),
('FC', 'E', 'Franche Comté'),
('HN', 'N', 'Haute Normandie'),
('IF', 'P', 'Ile de France'),
('LG', 'S', 'Languedoc'),
('LI', 'P', 'Limousin'),
('MP', 'S', 'Midi Pyrénée'),
('NP', 'N', 'Nord Pas de Calais'),
('PA', 'S', 'Provence Alpes Cote d''Azur'),
('PC', 'O', 'Poitou Charente'),
('PI', 'N', 'Picardie'),
('PL', 'O', 'Pays de Loire'),
('RA', 'E', 'Rhone Alpes'),
('RO', 'S', 'Roussilon'),
('VD', 'O', 'Vendée');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `ROLE_CODE` char(2) NOT NULL,
  `ROLE_LABEL` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`ROLE_CODE`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`ROLE_CODE`, `ROLE_LABEL`) VALUES
('V', 'Visiteur'),
('D', 'Délégué'),
('R', 'Responsable');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

DROP TABLE IF EXISTS `secteur`;
CREATE TABLE IF NOT EXISTS `secteur` (
  `SEC_CODE` varchar(1) NOT NULL,
  `SEC_LIBELLE` varchar(15) NOT NULL,
  PRIMARY KEY (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `secteur`
--

INSERT INTO `secteur` (`SEC_CODE`, `SEC_LIBELLE`) VALUES
('E', 'Est'),
('N', 'Nord'),
('O', 'Ouest'),
('P', 'Paris centre'),
('S', 'Sud');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `SPE_CODE` varchar(5) NOT NULL,
  `SPE_LIBELLE` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`SPE_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `specialite`
--

INSERT INTO `specialite` (`SPE_CODE`, `SPE_LIBELLE`) VALUES
('ACP', 'anatomie et cytologie pathologiques'),
('AMV', 'angéiologie, médecine vasculaire'),
('ARC', 'anesthésiologie et réanimation chirurgicale'),
('BM', 'biologie médicale'),
('CAC', 'cardiologie et affections cardio-vasculaires'),
('CCT', 'chirurgie cardio-vasculaire et thoracique'),
('CG', 'chirurgie générale'),
('CMF', 'chirurgie maxillo-faciale'),
('COM', 'cancérologie, oncologie médicale'),
('COT', 'chirurgie orthopédique et traumatologie'),
('CPR', 'chirurgie plastique reconstructrice et esthétique'),
('CU', 'chirurgie urologique'),
('CV', 'chirurgie vasculaire'),
('DN', 'diabétologie-nutrition, nutrition'),
('DV', 'dermatologie et vénéréologie'),
('EM', 'endocrinologie et métabolismes'),
('ETD', 'évaluation et traitement de la douleur'),
('GEH', 'gastro-entérologie et hépatologie (appareil digestif)'),
('GMO', 'gynécologie médicale, obstétrique'),
('GO', 'gynécologie-obstétrique'),
('HEM', 'maladies du sang (hématologie)'),
('MBS', 'médecine et biologie du sport'),
('MDT', 'médecine du travail'),
('MMO', 'médecine manuelle - ostéopathie'),
('MN', 'médecine nucléaire'),
('MPR', 'médecine physique et de réadaptation'),
('MTR', 'médecine tropicale, pathologie infectieuse et tropicale'),
('NEP', 'néphrologie'),
('NRC', 'neurochirurgie'),
('NRL', 'neurologie'),
('ODM', 'orthopédie dento maxillo-faciale'),
('OPH', 'ophtalmologie'),
('ORL', 'oto-rhino-laryngologie'),
('PEA', 'psychiatrie de l''enfant et de l''adolescent'),
('PME', 'pédiatrie maladies des enfants'),
('PNM', 'pneumologie'),
('PSC', 'psychiatrie'),
('RAD', 'radiologie (radiodiagnostic et imagerie médicale)'),
('RDT', 'radiothérapie (oncologie option radiothérapie)'),
('RGM', 'reproduction et gynécologie médicale'),
('RHU', 'rhumatologie'),
('STO', 'stomatologie'),
('SXL', 'sexologie'),
('TXA', 'toxicomanie et alcoologie');

-- --------------------------------------------------------

--
-- Structure de la table `travailler`
--

DROP TABLE IF EXISTS `travailler`;
CREATE TABLE IF NOT EXISTS `travailler` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `TRAV_DATETIME` datetime NOT NULL,
  `REG_CODE` varchar(2) NOT NULL,
  `ROLE_CODE` varchar(11) NOT NULL,
  PRIMARY KEY (`VIS_MATRICULE`,`TRAV_DATETIME`,`REG_CODE`),
  KEY `fk_travailler_visiteur1_idx` (`VIS_MATRICULE`),
  KEY `fk_travailler_region1_idx` (`REG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travailler`
--

INSERT INTO `travailler` (`VIS_MATRICULE`, `TRAV_DATETIME`, `REG_CODE`, `ROLE_CODE`) VALUES
('a131', '1992-12-11 00:00:00', 'BN', 'V'),
('a131', '1996-05-27 00:00:00', 'BG', 'V'),
('a17', '1991-08-26 00:00:00', 'RA', 'V'),
('a17', '1997-09-19 00:00:00', 'RA', 'D'),
('a55', '1987-07-17 00:00:00', 'MP', 'V'),
('a55', '1995-05-19 00:00:00', 'RO', 'V'),
('a55', '1999-08-21 00:00:00', 'RO', 'D'),
('a93', '1999-01-02 00:00:00', 'PC', 'V'),
('b13', '1996-03-11 00:00:00', 'AL', 'V'),
('b16', '1997-03-21 00:00:00', 'BG', 'V'),
('b19', '1999-01-31 00:00:00', 'PL', 'V'),
('b25', '1994-07-03 00:00:00', 'PL', 'V'),
('b25', '2000-01-01 00:00:00', 'PL', 'D'),
('b28', '2000-08-02 00:00:00', 'LG', 'V'),
('b34', '1993-12-06 00:00:00', 'CE', 'D'),
('b34', '1999-06-18 00:00:00', 'CE', 'R'),
('b4', '1997-09-25 00:00:00', 'AQ', 'V'),
('b50', '1998-01-18 00:00:00', 'PA', 'V'),
('b59', '1995-10-21 00:00:00', 'RA', 'V'),
('c14', '1989-02-01 00:00:00', 'PA', 'V'),
('c14', '1997-02-01 00:00:00', 'PA', 'D'),
('c14', '2001-03-03 00:00:00', 'PA', 'R'),
('c3', '1992-05-05 00:00:00', 'CA', 'V'),
('c54', '1991-04-09 00:00:00', 'AL', 'V'),
('d13', '1991-12-05 00:00:00', 'PL', 'V'),
('d51', '1997-11-18 00:00:00', 'FC', 'D'),
('d51', '2002-03-20 00:00:00', 'FC', 'R'),
('dE4', '2016-05-18 00:00:00', 'AL', 'D'),
('e22', '1989-03-24 00:00:00', 'AL', 'V'),
('e24', '1993-05-17 00:00:00', 'AL', 'D'),
('e24', '2000-02-29 00:00:00', 'AL', 'R'),
('e39', '1988-04-26 00:00:00', 'IF', 'V'),
('e49', '1996-02-19 00:00:00', 'MP', 'V'),
('e5', '1990-11-27 00:00:00', 'MP', 'V'),
('e5', '1995-11-27 00:00:00', 'MP', 'D'),
('e5', '2000-11-27 00:00:00', 'AQ', 'R'),
('e52', '1991-10-31 00:00:00', 'HN', 'V'),
('f21', '1993-06-08 00:00:00', 'RA', 'V'),
('f39', '1997-02-15 00:00:00', 'RA', 'V'),
('f4', '1994-05-03 00:00:00', 'MP', 'V'),
('g19', '1996-01-18 00:00:00', 'IF', 'V'),
('g30', '1999-03-27 00:00:00', 'PI', 'D'),
('g30', '2000-10-31 00:00:00', 'PI', 'R'),
('g53', '1985-10-02 00:00:00', 'BG', 'V'),
('g7', '1996-01-13 00:00:00', 'LI', 'V'),
('h13', '1993-05-08 00:00:00', 'LI', 'V'),
('h30', '1998-04-26 00:00:00', 'IF', 'V'),
('h35', '1993-08-26 00:00:00', 'AU', 'V'),
('h40', '1992-11-01 00:00:00', 'CA', 'V'),
('j45', '1998-02-25 00:00:00', 'CA', 'R'),
('j50', '1992-12-16 00:00:00', 'NP', 'V'),
('j8', '1998-06-18 00:00:00', 'IF', 'R'),
('k4', '1996-11-21 00:00:00', 'LG', 'V'),
('k53', '1983-03-23 00:00:00', 'CA', 'V'),
('k53', '1992-04-03 00:00:00', 'AL', 'D'),
('l14', '1995-02-02 00:00:00', 'PL', 'V'),
('l23', '1995-06-05 00:00:00', 'PC', 'V'),
('l46', '1997-01-24 00:00:00', 'PL', 'V'),
('l56', '1996-02-27 00:00:00', 'FC', 'V'),
('m35', '1987-10-06 00:00:00', 'MP', 'V'),
('m45', '1990-10-13 00:00:00', 'AL', 'V'),
('m45', '1999-04-08 00:00:00', 'AL', 'D'),
('n42', '1996-03-06 00:00:00', 'HN', 'V'),
('n58', '1992-08-30 00:00:00', 'CE', 'V'),
('n59', '1994-12-19 00:00:00', 'PI', 'V'),
('o26', '1995-01-05 00:00:00', 'LG', 'V'),
('p32', '1992-12-24 00:00:00', 'IF', 'V'),
('p40', '1992-12-14 00:00:00', 'BN', 'D'),
('p40', '1999-07-17 00:00:00', 'BN', 'R'),
('p41', '1998-07-27 00:00:00', 'PC', 'V'),
('p42', '1994-12-12 00:00:00', 'PI', 'V'),
('p49', '1977-10-03 00:00:00', 'CE', 'V'),
('p6', '1997-03-30 00:00:00', 'AQ', 'V'),
('p7', '1990-03-01 00:00:00', 'RO', 'V'),
('p8', '1991-06-23 00:00:00', 'BO', 'V'),
('q17', '1997-09-06 00:00:00', 'BN', 'V'),
('r24', '1984-07-29 00:00:00', 'BN', 'V'),
('r24', '1998-05-25 00:00:00', 'BN', 'R'),
('r58', '1990-06-30 00:00:00', 'BG', 'V'),
('rE4', '2016-05-18 00:00:00', 'AL', 'R'),
('s10', '1995-11-14 00:00:00', 'FC', 'V'),
('s21', '1992-09-25 00:00:00', 'LI', 'V'),
('t43', '1995-03-09 00:00:00', 'BO', 'V'),
('t47', '1997-08-29 00:00:00', 'PI', 'V'),
('t55', '1994-11-29 00:00:00', 'MP', 'V'),
('t60', '1991-03-29 00:00:00', 'CE', 'V'),
('vE4', '2016-05-18 00:00:00', 'AL', 'V');

-- --------------------------------------------------------

--
-- Structure de la table `type_individu`
--

DROP TABLE IF EXISTS `type_individu`;
CREATE TABLE IF NOT EXISTS `type_individu` (
  `TIN_CODE` varchar(5) NOT NULL,
  `TIN_LIBELLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TIN_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_praticien`
--

DROP TABLE IF EXISTS `type_praticien`;
CREATE TABLE IF NOT EXISTS `type_praticien` (
  `TYP_CODE` varchar(3) NOT NULL,
  `TYP_LIBELLE` varchar(25) DEFAULT NULL,
  `TYP_LIEU` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`TYP_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_praticien`
--

INSERT INTO `type_praticien` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES
('MH', 'Médecin Hospitalier', 'Hopital ou clinique'),
('MV', 'Médecine de Ville', 'Cabinet'),
('PH', 'Pharmacien Hospitalier', 'Hopital ou clinique'),
('PO', 'Pharmacien Officine', 'Pharmacie'),
('PS', 'Personnel de santé', 'Centre paramédical');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `VIS_MATRICULE` varchar(10) NOT NULL,
  `VIS_LOGIN` varchar(32) NOT NULL,
  `VIS_MDP` char(32) DEFAULT NULL,
  `VIS_NOM` varchar(25) DEFAULT NULL,
  `VIS_PRENOM` varchar(50) DEFAULT NULL,
  `VIS_EMAIL` varchar(255) DEFAULT NULL,
  `VIS_ADRESSE` varchar(50) DEFAULT NULL,
  `VIS_CP` varchar(5) DEFAULT NULL,
  `VIS_VILLE` varchar(30) DEFAULT NULL,
  `VIS_DATEEMBAUCHE` datetime DEFAULT NULL,
  `SEC_CODE` varchar(1) DEFAULT NULL,
  `LAB_CODE` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`VIS_MATRICULE`),
  UNIQUE KEY `VIS_LOGIN` (`VIS_LOGIN`),
  KEY `fk_visiteur_labo1_idx` (`LAB_CODE`),
  KEY `fk_visiteur_secteur1_idx` (`SEC_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`VIS_MATRICULE`, `VIS_LOGIN`, `VIS_MDP`, `VIS_NOM`, `VIS_PRENOM`, `VIS_EMAIL`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATEEMBAUCHE`, `SEC_CODE`, `LAB_CODE`) VALUES
('a131', 'VillechalaneLouis', '6c583c5ebfeb2c782d613e7388965918', 'Villechalane', 'Louis', 'fictif.gsb@yopmail.com', '8 cours Lafontaine', '29000', 'BREST', '1992-12-11 00:00:00', NULL, 'SW'),
('a17', 'AndreDavid', '6c583c5ebfeb2c782d613e7388965918', 'Andre', 'David', 'fictif.gsb@yopmail.com', '1 r Aimon de Chissée', '38100', 'GRENOBLE', '1991-08-26 00:00:00', NULL, 'GY'),
('a55', 'BedosChristian', '6c583c5ebfeb2c782d613e7388965918', 'Bedos', 'Christian', 'fictif.gsb@yopmail.com', '1 r Bénédictins', '65000', 'TARBES', '1987-07-17 00:00:00', NULL, 'GY'),
('a93', 'TusseauLouis', '6c583c5ebfeb2c782d613e7388965918', 'Tusseau', 'Louis', 'fictif.gsb@yopmail.com', '22 r Renou', '86000', 'POITIERS', '1999-01-02 00:00:00', NULL, 'SW'),
('b13', 'BentotPascal', '6c583c5ebfeb2c782d613e7388965918', 'Bentot', 'Pascal', 'fictif.gsb@yopmail.com', '11 av 6 Juin', '67000', 'STRASBOURG', '1996-03-11 00:00:00', NULL, 'GY'),
('b16', 'BioretLuc', '6c583c5ebfeb2c782d613e7388965918', 'Bioret', 'Luc', 'fictif.gsb@yopmail.com', '1 r Linne', '35000', 'RENNES', '1997-03-21 00:00:00', NULL, 'SW'),
('b19', 'BunissetFrancis', '6c583c5ebfeb2c782d613e7388965918', 'Bunisset', 'Francis', 'fictif.gsb@yopmail.com', '10 r Nicolas Chorier', '85000', 'LA ROCHE SUR YON', '1999-01-31 00:00:00', NULL, 'GY'),
('b25', 'BunissetDenise', '6c583c5ebfeb2c782d613e7388965918', 'Bunisset', 'Denise', 'fictif.gsb@yopmail.com', '1 r Lionne', '49100', 'ANGERS', '1994-07-03 00:00:00', NULL, 'SW'),
('b28', 'CacheuxBernard', '6c583c5ebfeb2c782d613e7388965918', 'Cacheux', 'Bernard', 'fictif.gsb@yopmail.com', '114 r Authie', '34000', 'MONTPELLIER', '2000-08-02 00:00:00', NULL, 'GY'),
('b34', 'CadicEric', '6c583c5ebfeb2c782d613e7388965918', 'Cadic', 'Eric', 'fictif.gsb@yopmail.com', '123 r Caponière', '41000', 'BLOIS', '1993-12-06 00:00:00', 'P', 'SW'),
('b4', 'CharozeCatherine', '6c583c5ebfeb2c782d613e7388965918', 'Charoze', 'Catherine', 'fictif.gsb@yopmail.com', '100 pl Géants', '33000', 'BORDEAUX', '1997-09-25 00:00:00', NULL, 'SW'),
('b50', 'ClepkensChristophe', '6c583c5ebfeb2c782d613e7388965918', 'Clepkens', 'Christophe', 'fictif.gsb@yopmail.com', '12 r Fédérico Garcia Lorca', '13000', 'MARSEILLE', '1998-01-18 00:00:00', NULL, 'SW'),
('b59', 'CottinVincenne', '6c583c5ebfeb2c782d613e7388965918', 'Cottin', 'Vincenne', 'fictif.gsb@yopmail.com', '36 sq Capucins', '5000', 'GAP', '1995-10-21 00:00:00', NULL, 'GY'),
('c14', 'DaburonFrançois', '6c583c5ebfeb2c782d613e7388965918', 'Daburon', 'François', 'fictif.gsb@yopmail.com', '13 r Champs Elysées', '6000', 'NICE', '1989-02-01 00:00:00', 'S', 'SW'),
('c3', 'DePhilippe', '6c583c5ebfeb2c782d613e7388965918', 'De', 'Philippe', 'fictif.gsb@yopmail.com', '13 r Charles Peguy', '10000', 'TROYES', '1992-05-05 00:00:00', NULL, 'SW'),
('c54', 'DebelleMichel', '6c583c5ebfeb2c782d613e7388965918', 'Debelle', 'Michel', 'fictif.gsb@yopmail.com', '181 r Caponière', '88000', 'EPINAL', '1991-04-09 00:00:00', NULL, 'SW'),
('d13', 'DebelleJeanne', '6c583c5ebfeb2c782d613e7388965918', 'Debelle', 'Jeanne', 'fictif.gsb@yopmail.com', '134 r Stalingrad', '44000', 'NANTES', '1991-12-05 00:00:00', NULL, 'SW'),
('d51', 'DebroiseMichel', '6c583c5ebfeb2c782d613e7388965918', 'Debroise', 'Michel', 'fictif.gsb@yopmail.com', '2 av 6 Juin', '70000', 'VESOUL', '1997-11-18 00:00:00', 'E', 'GY'),
('dE4', 'delegueE4', 'b5b6f9de8dc878ab1e99b3c07839e747', 'E4', 'Delegue', 'fictif.gsb@yopmail.com', 'Lycée Marie Curie', '13005', 'Marseille', '2016-05-18 00:00:00', 'S', 'SW'),
('e22', 'DesmarquestNathalie', '6c583c5ebfeb2c782d613e7388965918', 'Desmarquest', 'Nathalie', 'fictif.gsb@yopmail.com', '14 r Fédérico Garcia Lorca', '54000', 'NANCY', '1989-03-24 00:00:00', NULL, 'GY'),
('e24', 'DesnostPierre', '6c583c5ebfeb2c782d613e7388965918', 'Desnost', 'Pierre', 'fictif.gsb@yopmail.com', '16 r Barral de Montferrat', '55000', 'VERDUN', '1993-05-17 00:00:00', 'E', 'SW'),
('e39', 'DudouitFrédéric', '6c583c5ebfeb2c782d613e7388965918', 'Dudouit', 'Frédéric', 'fictif.gsb@yopmail.com', '18 quai Xavier Jouvin', '75000', 'PARIS', '1988-04-26 00:00:00', NULL, 'GY'),
('e49', 'DuncombeClaude', '6c583c5ebfeb2c782d613e7388965918', 'Duncombe', 'Claude', 'fictif.gsb@yopmail.com', '19 av Alsace Lorraine', '9000', 'FOIX', '1996-02-19 00:00:00', NULL, 'GY'),
('e5', 'Enault-PascreauCéline', '6c583c5ebfeb2c782d613e7388965918', 'Enault-Pascreau', 'Céline', 'fictif.gsb@yopmail.com', '25B r Stalingrad', '40000', 'MONT DE MARSAN', '1990-11-27 00:00:00', 'S', 'GY'),
('e52', 'EyndeValérie', '6c583c5ebfeb2c782d613e7388965918', 'Eynde', 'Valérie', 'fictif.gsb@yopmail.com', '3 r Henri Moissan', '76000', 'ROUEN', '1991-10-31 00:00:00', NULL, 'GY'),
('f21', 'FinckJacques', '6c583c5ebfeb2c782d613e7388965918', 'Finck', 'Jacques', 'fictif.gsb@yopmail.com', 'rte Montreuil Bellay', '74000', 'ANNECY', '1993-06-08 00:00:00', NULL, 'SW'),
('f39', 'FrémontFernande', '6c583c5ebfeb2c782d613e7388965918', 'Frémont', 'Fernande', 'fictif.gsb@yopmail.com', '4 r Jean Giono', '69000', 'LYON', '1997-02-15 00:00:00', NULL, 'GY'),
('f4', 'GestAlain', '6c583c5ebfeb2c782d613e7388965918', 'Gest', 'Alain', 'fictif.gsb@yopmail.com', '30 r Authie', '46000', 'FIGEAC', '1994-05-03 00:00:00', NULL, 'GY'),
('g19', 'GheysenGalassus', '6c583c5ebfeb2c782d613e7388965918', 'Gheysen', 'Galassus', 'fictif.gsb@yopmail.com', '32 bd Mar Foch', '75000', 'PARIS', '1996-01-18 00:00:00', NULL, 'SW'),
('g30', 'GirardYvon', '6c583c5ebfeb2c782d613e7388965918', 'Girard', 'Yvon', 'fictif.gsb@yopmail.com', '31 av 6 Juin', '80000', 'AMIENS', '1999-03-27 00:00:00', 'N', 'GY'),
('g53', 'GombertLuc', '6c583c5ebfeb2c782d613e7388965918', 'Gombert', 'Luc', 'fictif.gsb@yopmail.com', '32 r Emile Gueymard', '56000', 'VANNES', '1985-10-02 00:00:00', NULL, 'GY'),
('g7', 'GuindonCaroline', '6c583c5ebfeb2c782d613e7388965918', 'Guindon', 'Caroline', 'fictif.gsb@yopmail.com', '40 r Mar Montgomery', '87000', 'LIMOGES', '1996-01-13 00:00:00', NULL, 'GY'),
('h13', 'GuindonFrançois', '6c583c5ebfeb2c782d613e7388965918', 'Guindon', 'François', 'fictif.gsb@yopmail.com', '44 r Picotière', '19000', 'TULLE', '1993-05-08 00:00:00', NULL, 'SW'),
('h30', 'IgigabelGuy', '6c583c5ebfeb2c782d613e7388965918', 'Igigabel', 'Guy', 'fictif.gsb@yopmail.com', '33 gal Arlequin', '94000', 'CRETEIL', '1998-04-26 00:00:00', NULL, 'SW'),
('h35', 'JourdrenPierre', '6c583c5ebfeb2c782d613e7388965918', 'Jourdren', 'Pierre', 'fictif.gsb@yopmail.com', '34 av Jean Perrot', '15000', 'AURRILLAC', '1993-08-26 00:00:00', NULL, 'GY'),
('h40', 'JuttardPierre-Raoul', '6c583c5ebfeb2c782d613e7388965918', 'Juttard', 'Pierre-Raoul', 'fictif.gsb@yopmail.com', '34 cours Jean Jaurès', '8000', 'SEDAN', '1992-11-01 00:00:00', NULL, 'GY'),
('j45', 'Labouré-MorelSaout', '6c583c5ebfeb2c782d613e7388965918', 'Labouré-Morel', 'Saout', 'fictif.gsb@yopmail.com', '38 cours Berriat', '52000', 'CHAUMONT', '1998-02-25 00:00:00', 'N', 'SW'),
('j50', 'LandréPhilippe', '6c583c5ebfeb2c782d613e7388965918', 'Landré', 'Philippe', 'fictif.gsb@yopmail.com', '4 av Gén Laperrine', '59000', 'LILLE', '1992-12-16 00:00:00', NULL, 'GY'),
('j8', 'LangeardHugues', '6c583c5ebfeb2c782d613e7388965918', 'Langeard', 'Hugues', 'fictif.gsb@yopmail.com', '39 av Jean Perrot', '93000', 'BAGNOLET', '1998-06-18 00:00:00', 'P', 'GY'),
('k4', 'LanneBernard', '6c583c5ebfeb2c782d613e7388965918', 'Lanne', 'Bernard', 'fictif.gsb@yopmail.com', '4 r Bayeux', '30000', 'NIMES', '1996-11-21 00:00:00', NULL, 'SW'),
('k53', 'LeNoël', '6c583c5ebfeb2c782d613e7388965918', 'Le', 'Noël', 'fictif.gsb@yopmail.com', '4 av Beauvert', '68000', 'MULHOUSE', '1983-03-23 00:00:00', NULL, 'SW'),
('l14', 'LeJean', '6c583c5ebfeb2c782d613e7388965918', 'Le', 'Jean', 'fictif.gsb@yopmail.com', '39 r Raspail', '53000', 'LAVAL', '1995-02-02 00:00:00', NULL, 'SW'),
('l23', 'LeclercqServane', '6c583c5ebfeb2c782d613e7388965918', 'Leclercq', 'Servane', 'fictif.gsb@yopmail.com', '11 r Quinconce', '18000', 'BOURGES', '1995-06-05 00:00:00', NULL, 'SW'),
('l46', 'LecornuJean-Bernard', '6c583c5ebfeb2c782d613e7388965918', 'Lecornu', 'Jean-Bernard', 'fictif.gsb@yopmail.com', '4 bd Mar Foch', '72000', 'LA FERTE BERNARD', '1997-01-24 00:00:00', NULL, 'GY'),
('l56', 'LecornuLudovic', '6c583c5ebfeb2c782d613e7388965918', 'Lecornu', 'Ludovic', 'fictif.gsb@yopmail.com', '4 r Abel Servien', '25000', 'BESANCON', '1996-02-27 00:00:00', NULL, 'SW'),
('m35', 'LejardAgnès', '6c583c5ebfeb2c782d613e7388965918', 'Lejard', 'Agnès', 'fictif.gsb@yopmail.com', '4 r Anthoard', '82000', 'MONTAUBAN', '1987-10-06 00:00:00', NULL, 'SW'),
('m45', 'LesaulnierPascal', '6c583c5ebfeb2c782d613e7388965918', 'Lesaulnier', 'Pascal', 'fictif.gsb@yopmail.com', '47 r Thiers', '57000', 'METZ', '1990-10-13 00:00:00', NULL, 'SW'),
('n42', 'LetessierStéphane', '6c583c5ebfeb2c782d613e7388965918', 'Letessier', 'Stéphane', 'fictif.gsb@yopmail.com', '5 chem Capuche', '27000', 'EVREUX', '1996-03-06 00:00:00', NULL, 'GY'),
('n58', 'LoiratDidier', '6c583c5ebfeb2c782d613e7388965918', 'Loirat', 'Didier', 'fictif.gsb@yopmail.com', 'Les Pêchers cité Bourg la Croix', '45000', 'ORLEANS', '1992-08-30 00:00:00', NULL, 'GY'),
('n59', 'MaffezzoliThibaud', '6c583c5ebfeb2c782d613e7388965918', 'Maffezzoli', 'Thibaud', 'fictif.gsb@yopmail.com', '5 r Chateaubriand', '2000', 'LAON', '1994-12-19 00:00:00', NULL, 'SW'),
('o26', 'ManciniAnne', '6c583c5ebfeb2c782d613e7388965918', 'Mancini', 'Anne', 'fictif.gsb@yopmail.com', '5 r D''Agier', '48000', 'MENDE', '1995-01-05 00:00:00', NULL, 'GY'),
('p32', 'MarcouillerGérard', '6c583c5ebfeb2c782d613e7388965918', 'Marcouiller', 'Gérard', 'fictif.gsb@yopmail.com', '7 pl St Gilles', '91000', 'ISSY LES MOULINEAUX', '1992-12-24 00:00:00', NULL, 'GY'),
('p40', 'MichelJean-Claude', '6c583c5ebfeb2c782d613e7388965918', 'Michel', 'Jean-Claude', 'fictif.gsb@yopmail.com', '5 r Gabriel Péri', '61000', 'FLERS', '1992-12-14 00:00:00', 'O', 'SW'),
('p41', 'MontecotFrançoise', '6c583c5ebfeb2c782d613e7388965918', 'Montecot', 'Françoise', 'fictif.gsb@yopmail.com', '6 r Paul Valéry', '17000', 'SAINTES', '1998-07-27 00:00:00', NULL, 'GY'),
('p42', 'NotiniVeronique', '6c583c5ebfeb2c782d613e7388965918', 'Notini', 'Veronique', 'fictif.gsb@yopmail.com', '5 r Lieut Chabal', '60000', 'BEAUVAIS', '1994-12-12 00:00:00', NULL, 'SW'),
('p49', 'OnfroyDen', '6c583c5ebfeb2c782d613e7388965918', 'Onfroy', 'Den', 'fictif.gsb@yopmail.com', '5 r Sidonie Jacolin', '37000', 'TOURS', '1977-10-03 00:00:00', NULL, 'GY'),
('p6', 'PascreauCharles', '6c583c5ebfeb2c782d613e7388965918', 'Pascreau', 'Charles', 'fictif.gsb@yopmail.com', '57 bd Mar Foch', '64000', 'PAU', '1997-03-30 00:00:00', NULL, 'SW'),
('p7', 'PernotClaude-Noël', '6c583c5ebfeb2c782d613e7388965918', 'Pernot', 'Claude-Noël', 'fictif.gsb@yopmail.com', '6 r Alexandre 1 de Yougoslavie', '11000', 'NARBONNE', '1990-03-01 00:00:00', NULL, 'SW'),
('p8', 'PerrierMaître', '6c583c5ebfeb2c782d613e7388965918', 'Perrier', 'Maître', 'fictif.gsb@yopmail.com', '6 r Aubert Dubayet', '71000', 'CHALON SUR SAONE', '1991-06-23 00:00:00', NULL, 'GY'),
('q17', 'PetitJean-Louis', '6c583c5ebfeb2c782d613e7388965918', 'Petit', 'Jean-Louis', 'fictif.gsb@yopmail.com', '7 r Ernest Renan', '50000', 'SAINT LO', '1997-09-06 00:00:00', NULL, 'GY'),
('r24', 'PiqueryPatrick', '6c583c5ebfeb2c782d613e7388965918', 'Piquery', 'Patrick', 'fictif.gsb@yopmail.com', '9 r Vaucelles', '14000', 'CAEN', '1984-07-29 00:00:00', 'O', 'GY'),
('r58', 'QuiquandonJoël', '6c583c5ebfeb2c782d613e7388965918', 'Quiquandon', 'Joël', 'fictif.gsb@yopmail.com', '7 r Ernest Renan', '29000', 'QUIMPER', '1990-06-30 00:00:00', NULL, 'GY'),
('rE4', 'responsableE4', 'b5b6f9de8dc878ab1e99b3c07839e747', 'E4', 'Responsable', 'fictif.gsb@yopmail.com', 'Lycée Marie Curie', '13005', 'Marseille', '2016-05-18 00:00:00', 'S', 'SW'),
('s10', 'RetailleauJosselin', '6c583c5ebfeb2c782d613e7388965918', 'Retailleau', 'Josselin', 'fictif.gsb@yopmail.com', '88Bis r Saumuroise', '39000', 'DOLE', '1995-11-14 00:00:00', NULL, 'SW'),
('s21', 'RetailleauPascal', '6c583c5ebfeb2c782d613e7388965918', 'Retailleau', 'Pascal', 'fictif.gsb@yopmail.com', '32 bd Ayrault', '23000', 'MONTLUCON', '1992-09-25 00:00:00', NULL, 'SW'),
('t43', 'SouronMaryse', '6c583c5ebfeb2c782d613e7388965918', 'Souron', 'Maryse', 'fictif.gsb@yopmail.com', '7B r Gay Lussac', '21000', 'DIJON', '1995-03-09 00:00:00', NULL, 'SW'),
('t47', 'TiphagnePatrick', '6c583c5ebfeb2c782d613e7388965918', 'Tiphagne', 'Patrick', 'fictif.gsb@yopmail.com', '7B r Gay Lussac', '62000', 'ARRAS', '1997-08-29 00:00:00', NULL, 'SW'),
('t55', 'TréhetAlain', '6c583c5ebfeb2c782d613e7388965918', 'Tréhet', 'Alain', 'fictif.gsb@yopmail.com', '7D chem Barral', '12000', 'RODEZ', '1994-11-29 00:00:00', NULL, 'SW'),
('t60', 'TusseauJosselin', '6c583c5ebfeb2c782d613e7388965918', 'Tusseau', 'Josselin', 'fictif.gsb@yopmail.com', '63 r Bon Repos', '28000', 'CHARTRES', '1991-03-29 00:00:00', NULL, 'GY'),
('vE4', 'visiteurE4', 'b5b6f9de8dc878ab1e99b3c07839e747', 'E4', 'Visteur', 'fictif.gsb@yopmail.com', 'Lycée Marie Curie', '13005', 'Marseille', '2016-05-18 00:00:00', 'S', 'SW'),
('zzz', 'swissbourdin', '6c583c5ebfeb2c782d613e7388965918', 'swiss', 'bourdin', 'fictif.gsb@yopmail.com', NULL, NULL, NULL, '2003-06-18 00:00:00', NULL, 'BC');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_travailler_role`
--
DROP VIEW IF EXISTS `vue_travailler_role`;
CREATE TABLE IF NOT EXISTS `vue_travailler_role` (
`VIS_MATRICULE` varchar(10)
,`TRAV_DATETIME` datetime
,`REG_CODE` varchar(2)
,`ROLE_CODE` varchar(11)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_travailler_role`
--
DROP TABLE IF EXISTS `vue_travailler_role`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_travailler_role`  AS  select `t1`.`VIS_MATRICULE` AS `VIS_MATRICULE`,`t1`.`TRAV_DATETIME` AS `TRAV_DATETIME`,`t1`.`REG_CODE` AS `REG_CODE`,`t1`.`ROLE_CODE` AS `ROLE_CODE` from `travailler` `t1` where `t1`.`TRAV_DATETIME` in (select max(`t2`.`TRAV_DATETIME`) from `travailler` `t2` where (`t1`.`VIS_MATRICULE` = `t2`.`VIS_MATRICULE`)) ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;