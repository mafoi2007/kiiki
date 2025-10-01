-- phpMyAdmin SQL Dump
-- version 4.1.14.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2016 at 06:24 PM
-- Server version: 5.5.22-0ubuntu1
-- PHP Version: 5.3.10-1ubuntu3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `application`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_eleve` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nombre_heure` int(11) NOT NULL COMMENT 'à revoir',
  `justification` varchar(100) NOT NULL COMMENT 'AJ ou ANJ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `appreciation`
--

CREATE TABLE IF NOT EXISTS `appreciation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_appreciation` varchar(255) NOT NULL COMMENT 'bien, ab, etc.',
  `interv_ouvert` int(2) NOT NULL COMMENT 'note de debut',
  `interv_fermet` int(2) NOT NULL COMMENT 'note de fin',
  `couleur` varchar(100) NOT NULL COMMENT 'rouge pour sous moyenne, bleu sinon',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `appreciation`
--

INSERT INTO `appreciation` (`id`, `nom_appreciation`, `interv_ouvert`, `interv_fermet`, `couleur`) VALUES
(1, 'travail nul', 0, 3, '#FF0000'),
(2, 'très faible', 3, 5, '#FF0000'),
(3, 'faible', 5, 8, '#FF0000'),
(4, 'insuffisant', 8, 9, '#FF0000'),
(5, 'médiocre', 9, 10, '#FF0000'),
(6, 'passable', 10, 12, '#0000FF'),
(7, 'assez bon travail', 12, 14, '#0000FF'),
(8, 'bon travail', 14, 16, '#0000FF'),
(9, 'très bien', 16, 18, '#0000FF'),
(10, 'excellent', 18, 20, '#0000FF');

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_classe` varchar(255) NOT NULL,
  `code_classe` varchar(100) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`id`, `nom_classe`, `code_classe`, `etat`) VALUES
(50, 'seconde C', '2C', 'actif'),
(44, 'troisiÃ¨me B', '3B', 'actif'),
(32, 'sixiÃ¨me D', '6D', 'actif'),
(53, 'premiÃ¨re A3', '1A3', 'actif'),
(52, 'premiÃ¨re A2', '1A2', 'actif'),
(51, 'premiÃ¨re A1', '1A1', 'actif'),
(49, 'seconde A2', '2A2', 'actif'),
(48, 'seconde A1', '2A1', 'actif'),
(47, 'troisiÃ¨me E', '3E', 'actif'),
(46, 'troisiÃ¨me D', '3D', 'actif'),
(45, 'troisiÃ¨me C', '3C', 'actif'),
(39, 'quatriÃ¨me A', '4A', 'actif'),
(38, 'cinquiÃ¨me D', '5D', 'actif'),
(36, 'cinquiÃ¨me B', '5B', 'actif'),
(31, 'sixiÃ¨me C', '6C', 'actif'),
(37, 'cinquiÃ¨me C', '5C', 'actif'),
(35, 'cinquiÃ¨me A', '5A', 'actif'),
(41, 'quatriÃ¨me C', '4C', 'actif'),
(29, 'sixiÃ¨me B', '6B', 'actif'),
(33, 'sixiÃ¨me A', '6A', 'actif'),
(34, 'sixiÃ¨me E', '6E', 'actif'),
(43, 'troisiÃ¨me A', '3A', 'actif'),
(42, 'quatriÃ¨me D', '4D', 'actif'),
(40, 'quatriÃ¨me B', '4B', 'actif'),
(54, 'premiÃ¨re C', '1C', 'actif'),
(55, 'premiÃ¨re D', '1D', 'actif'),
(56, 'premiÃ¨re TI', '1TI', 'actif'),
(57, 'terminale TI', 'TTI', 'actif'),
(58, 'terminale A1', 'TA1', 'actif'),
(59, 'terminale A2', 'TA2', 'actif'),
(60, 'terminale C', 'TC', 'actif'),
(61, 'terminale D', 'TD', 'actif');

-- --------------------------------------------------------

--
-- Table structure for table `club_info`
--

CREATE TABLE IF NOT EXISTS `club_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `classe` varchar(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `club_info`
--

INSERT INTO `club_info` (`id`, `nom`, `classe`, `poste`) VALUES
(2, 'akeng ayouba diane', '1A1', 'mb'),
(3, 'ndengue evang', 'NULL', 'mb'),
(4, 'kenembeni assal marie emmanuelle', 'NULL', 'mb'),
(5, 'avom daniel', '3A', 'mb'),
(6, 'ndjoly joel', '3A', 'mb'),
(7, 'ayangma abeka', '3A', 'mb'),
(8, 'guimbang aline', '1A1', 'mb'),
(9, 'ndang ezechiel ', '3A', 'mb'),
(10, 'fogouang demanou', 'NULL', 'mb'),
(11, 'magweleu', 'NULL', 'mb'),
(12, 'kenmoe', 'NULL', 'mb'),
(14, 'fikak manuella', '1A1', 'mb'),
(15, 'gam sephora', 'NULL', 'mb'),
(16, 'ndiang armelle', 'NULL', 'mb'),
(17, 'mouana mougnanou', 'NULL', 'mb'),
(18, 'biketi r', 'NULL', 'mb'),
(19, 'mambou franck ', 'TD', 'mb'),
(20, 'mbassa samuel', 'TD', 'mb'),
(21, 'bidias kevin', 'TD', 'mb'),
(22, 'bessong etienne arnaud', 'NULL', 'mb'),
(23, 'awono onana jean marie', 'NULL', 'mb'),
(24, 'nzemdio momo darlin', 'NULL', 'mb'),
(25, 'ndiang tatiana', 'NULL', 'mb'),
(27, 'kengne tsapi leonel', 'NULL', 'mb'),
(29, 'souoh christian brice', '1A1', 'mb'),
(30, 'mambou rayane', 'NULL', 'mb'),
(31, 'ndeng do''o laurelle', 'NULL', 'mb'),
(32, 'gouife bikele ange', '1A3', 'mb'),
(33, 'beuwel vera', '1A3', 'mb'),
(34, 'ribaah kathleen', '1A3', 'mb'),
(35, 'mamdap monique eliane', '1A1', 'mb'),
(36, 'youdou yimga', 'NULL', 'mb'),
(37, 'arno yannick sibe', 'NULL', 'mb'),
(38, 'amagne cedric', 'NULL', 'mb'),
(40, 'abeke ndongo', '1A1', 'pdt'),
(41, 'ebong gabrielle', 'NULL', 'mb'),
(42, 'amayana pierrette', '1A1', 'mb'),
(43, 'ambodo massang josephine armande', 'NULL', 'mb'),
(44, 'nana sati annaÃ«lle', 'NULL', 'mb'),
(45, 'mekeng Ã  nta chancelle', 'NULL', 'mb'),
(46, 'djiogue tsembou robinson', 'NULL', 'mb'),
(47, 'fotso fotso moÃ¯se', 'NULL', 'mb'),
(48, 'bitang axel brice', '1TI', 'mb'),
(49, 'mannouka Ã  nta sorelle', '2A2', 'mb'),
(50, 'djopguep christian noÃ©', '1A2', 'mb'),
(51, 'billong jeff samuel', '1A3', 'mb'),
(52, 'bagnomo elanga nicolas bruno', 'NULL', 'mb'),
(53, 'ndeme iguigui kevin', '5C', 'mb'),
(54, 'kuissue kamdem kÃ©vine', '3D', 'mb'),
(55, 'tsouboum Ã  mbamba haita blanche', 'TD', 'mb'),
(56, 'amang', 'NULL', 'mb');

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(100) NOT NULL COMMENT 'valeurs possibles M ou F',
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) NOT NULL,
  `matricule` varchar(100) NOT NULL COMMENT 'matricule de l''élève',
  `classe` varchar(100) NOT NULL COMMENT 'id de la classe de l''élève',
  `adresse_parent` varchar(255) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'supprimé ou pas',
  `statut` varchar(100) NOT NULL COMMENT 'red, nv',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `matricule`, `classe`, `adresse_parent`, `etat`, `statut`) VALUES
(37, 'besingue', 'joseph', 'M', '1990-02-04', 'ee', '15CPM00113', '5A', 'cc', 'non_supprime', 'nv'),
(35, 'amana', 'ongagna', 'F', '1990-01-05', 'ee', '15CPM00111', '5A', 'cc', 'non_supprime', 'nv'),
(36, 'begui', 'yvan', 'F', '1990-02-16', 'cc', '15CPM00112', '5A', 'vvv', 'non_supprime', 'nv'),
(34, 'bien Ã  ebong', 'diane', 'F', '1990-01-08', 'ee', '15CPM00103', '6A', 'dd', 'non_supprime', 'nv'),
(33, 'biabi', 'jennifer', 'F', '1990-01-03', 'qq', '15CPM00102', '6A', 'ee', 'non_supprime', 'nv'),
(32, 'belek pacon', '', 'M', '1990-01-05', 'cc', '15CPM00101', '6A', 'sss', 'non_supprime', 'nv'),
(31, 'babissakana', '', 'M', '2003-04-16', 'bafia', '15CPM00100', '6A', 'ccx', 'non_supprime', 'nv'),
(39, 'dong', 'lugie', 'F', '1990-01-01', 'ff', '15cpm00115', '5A', 'xxx', 'non_supprime', 'red'),
(40, 'abessougue', 'adengono', 'F', '2001-08-31', 'bafia', '15lcb1398', '2A2', 'bafia', 'non_supprime', 'nv'),
(38, 'dand Ã  nwatsock', '', 'M', '1990-01-01', 'ss', '15cpm00114', '5A', 'xx', 'non_supprime', 'nv');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(100) NOT NULL COMMENT 'Mr ou Mme',
  `poste` varchar(100) NOT NULL COMMENT 'prof, sg, censeur ou admin',
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL COMMENT 'crypté en sha1',
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `image` varchar(255) NOT NULL COMMENT 'adresse de l''image du gestionnaire',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Nyambi Ngikwa', 'Richard', 'Mr', 'admin', 'nyambi', '79f6ce076f2320b9d6a4b3f5d33675ef2ebe9f6a', 'actif', ''),
(2, 'mbouh', 'paul dÃ©sirÃ©', 'Mr', 'prof', 'mbouh', '21b6907e5a53fad887498967588fa64003b8597e', 'actif', ''),
(3, 'timba', 'moÃ¯se florent', 'Mr', 'censeur', 'timba', '4c4c98e92cddf6cc52aab94eb0c317e73a2f8932', 'actif', ''),
(4, 'tatchou tatchou', 'williams dore', 'Mr', 'sg', 'tatchou', '74edca7d7b1563833b7d842fb46cdbb9e9a50d36', 'actif', ''),
(5, 'kameni', 'jean baronnet', 'Mr', 'prof', 'kameni', 'c17853d3c225b80771425ae160dfbbf94bbe2af2', 'actif', ''),
(6, 'bapo''o ba djob', 'stÃ©phane', 'Mr', 'prof', 'bapoo', 'c4f5edc1100369918a738b612ef24c2c9ef831ad', 'actif', ''),
(7, 'bogmis', 'marcus', 'Mr', 'censeur', 'bogmis', '7ec24966a2fd9d7ea3d80a01a9b33bcd21f1a84f', 'actif', ''),
(8, 'nguelemo', 'jean de dieu', 'Mr', 'censeur', 'nguelemo', '4729f0abf50e34522a007d1cd650acc2cdd5df4c', 'actif', ''),
(9, 'ngono messobo', 'renÃ©', 'Mr', 'prof', 'ngono', '6549fec273698c14a5b8c62d0da97ad909ecb1a6', 'actif', ''),
(10, 'mpila ateba', 'silas', 'Mr', 'prof', 'mpila', '9e887adbefb58abcea01c5a94728967acfe108bb', 'actif', ''),
(11, 'bougning', 'simon', 'Mr', 'sg', 'bougning', '56e1e4ab3406ee235ba61f06106862772d95b083', 'actif', ''),
(12, 'mpebe', 'hilarion', 'Mr', 'censeur', 'mpebe', 'ee3f0715a14a7bc738d8c29e709dc782c6c66884', 'actif', '');

-- --------------------------------------------------------

--
-- Table structure for table `journal_connexion`
--

CREATE TABLE IF NOT EXISTS `journal_connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(100) NOT NULL,
  `adresse_ip` varchar(255) NOT NULL,
  `periode_de_connexion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `journal_connexion`
--

INSERT INTO `journal_connexion` (`id`, `utilisateur`, `adresse_ip`, `periode_de_connexion`) VALUES
(1, 'kameni', '127.0.0.1', '2015-12-12 16:34:25'),
(2, 'nyambi', '127.0.0.1', '2015-12-22 11:21:48'),
(3, 'nyambi', '127.0.0.1', '2015-12-22 11:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_matiere` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL COMMENT 'littéraire, scientifuqe ou autre',
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `code_matiere` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`id`, `nom_matiere`, `categorie`, `etat`, `code_matiere`) VALUES
(1, 'Orthographe - Grammaire', 'litteraire', 'actif', 'ortho'),
(2, 'composition française', 'litteraire', 'actif', 'redac'),
(3, 'Etude de texte', 'litteraire', 'actif', ''),
(4, 'philosophie', 'litteraire', 'actif', 'philo'),
(5, 'Littérature Française', 'litteraire', 'actif', 'litte'),
(6, 'Langue Française', 'litteraire', 'actif', 'langu'),
(7, 'Anglais', 'litteraire', 'actif', 'angla'),
(8, '2ème Langue', 'litteraire', 'inactif', ''),
(9, 'Histoire - Geographie', 'litteraire', 'actif', 'hist'),
(10, 'Education à la Citoyenneté', 'litteraire', 'actif', 'ecm'),
(11, 'Mathématiques', 'scientifique', 'actif', 'maths'),
(12, 'Sciences de la Vie et de la Terre', 'scientifique', 'actif', 'svt'),
(13, 'Physiques', 'scientifique', 'actif', 'phys'),
(14, 'Chimie', 'scientifique', 'actif', 'chm'),
(15, 'Physiques -Chimie (Technologie)', 'scientifique', 'actif', 'pct'),
(16, 'Informatique', 'scientifique', 'actif', 'info'),
(17, 'Sport (EPS)', 'autre', 'actif', 'eps'),
(18, 'Economie Sociale et Familiale', 'autre', 'actif', 'esf'),
(19, 'Allemand', 'litteraire', 'actif', 'all'),
(20, 'espagnol', 'litteraire', 'actif', 'esp'),
(21, 'azerty', 'litteraire', 'inactif', ''),
(22, 'dddd', 'litteraire', 'inactif', ''),
(23, 'bvbvbvbvb', 'autre', 'inactif', ''),
(24, 'histoire', 'litteraire', 'actif', ''),
(25, 'histoire', 'scientifique', 'actif', ''),
(26, 'geographie', 'litteraire', 'actif', 'geogr'),
(27, 'azertyuiop', 'scientifique', 'inactif', 'azert');

-- --------------------------------------------------------

--
-- Table structure for table `moyenne`
--

CREATE TABLE IF NOT EXISTS `moyenne` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_eleve` int(11) NOT NULL,
  `id_classe` varchar(100) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `total_coef` decimal(4,2) NOT NULL COMMENT 'total des coef',
  `total_note` decimal(5,2) NOT NULL COMMENT 'somme des notes',
  `moyenne` decimal(4,2) NOT NULL COMMENT 'rapport total_note sur total_coef',
  `rang` int(11) NOT NULL COMMENT 'à revoir',
  `id_appreciation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_eleve` int(11) NOT NULL COMMENT 'voir eleve.id',
  `id_matiere` int(11) NOT NULL COMMENT 'voir matiere.id',
  `id_classe` varchar(100) NOT NULL COMMENT 'voir code_classe',
  `id_periode` int(11) NOT NULL COMMENT 'voir periode.id',
  `note_simple` decimal(4,2) NOT NULL COMMENT 'note sur 20',
  `coef` decimal(2,1) NOT NULL,
  `note_totale` decimal(5,2) NOT NULL COMMENT 'note x coef',
  `id_appreciation` int(11) NOT NULL COMMENT 'voir appreciation.id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_periode` varchar(255) NOT NULL,
  `date_ouvert` date NOT NULL COMMENT 'debut disponibilité',
  `date_fermet` date NOT NULL COMMENT 'fin disponibilité',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `nom_periode`, `date_ouvert`, `date_fermet`) VALUES
(1, 'SÃ©quence 1', '2014-09-08', '2014-10-17'),
(2, 'SÃ©quence 2', '2014-10-20', '2014-11-28'),
(3, 'SÃ©quence 3', '2014-12-01', '2015-01-23'),
(4, 'SÃ©quence 4', '2015-01-26', '2015-03-06'),
(5, 'SÃ©quence 5', '2015-03-09', '2015-04-30'),
(6, 'SÃ©quence 6', '2015-05-04', '2015-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `poste`
--

CREATE TABLE IF NOT EXISTS `poste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poste` varchar(255) NOT NULL,
  `code_p` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `poste`
--

INSERT INTO `poste` (`id`, `poste`, `code_p`) VALUES
(1, 'membre', 'mb'),
(2, 'président', 'pdt');

-- --------------------------------------------------------

--
-- Table structure for table `prof_classe`
--

CREATE TABLE IF NOT EXISTS `prof_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_prof` varchar(255) NOT NULL COMMENT 'login enseignant',
  `id_classe` varchar(100) NOT NULL COMMENT 'code de la classe',
  `id_matiere` int(11) NOT NULL COMMENT 'voir matiere.id',
  `principal` varchar(100) NOT NULL COMMENT 'prof principal ou non',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `statistique`
--

CREATE TABLE IF NOT EXISTS `statistique` (
  `id_classe` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `moyenne_generale` decimal(4,2) NOT NULL,
  `note_faible` decimal(4,2) NOT NULL,
  `note_forte` decimal(4,2) NOT NULL,
  `pourcent_reussite` decimal(4,2) NOT NULL,
  `pourcent_homme` decimal(4,2) NOT NULL,
  `pourcent_femme` decimal(4,2) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
