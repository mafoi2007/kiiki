-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 27 Novembre 2017 à 16:08
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `noteplusss`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_eleve` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nombre_heure` int(11) NOT NULL COMMENT 'à revoir',
  `justification` varchar(100) NOT NULL COMMENT 'AJ ou ANJ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `absence`
--


-- --------------------------------------------------------

--
-- Structure de la table `appreciation`
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
-- Contenu de la table `appreciation`
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
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_classe` varchar(255) NOT NULL,
  `code_classe` varchar(100) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id`, `nom_classe`, `code_classe`, `etat`) VALUES
(50, 'seconde C', '2C', 'inactif'),
(44, 'troisiÃ¨me B', '3B', 'inactif'),
(32, 'sixiÃ¨me D', '6D', 'inactif'),
(53, 'premiÃ¨re A3', '1A3', 'inactif'),
(52, 'premiÃ¨re A2', '1A2', 'inactif'),
(51, 'premiÃ¨re A1', '1A1', 'inactif'),
(49, 'seconde A2', '2A2', 'inactif'),
(48, 'seconde A1', '2A1', 'inactif'),
(47, 'troisiÃ¨me E', '3E', 'inactif'),
(46, 'troisiÃ¨me D', '3D', 'inactif'),
(45, 'troisiÃ¨me C', '3C', 'actif'),
(39, 'quatriÃ¨me A', '4A', 'actif'),
(38, 'cinquiÃ¨me D', '5D', 'inactif'),
(36, 'cinquiÃ¨me B', '5B', 'inactif'),
(31, 'sixiÃ¨me C', '6C', 'inactif'),
(37, 'cinquiÃ¨me C', '5C', 'inactif'),
(35, 'cinquiÃ¨me A', '5A', 'actif'),
(41, 'quatriÃ¨me C', '4C', 'actif'),
(29, 'sixiÃ¨me B', '6B', 'inactif'),
(33, 'sixiÃ¨me A', '6A', 'actif'),
(34, 'sixiÃ¨me E', '6E', 'inactif'),
(43, 'troisiÃ¨me A', '3A', 'actif'),
(42, 'quatriÃ¨me D', '4D', 'inactif'),
(40, 'quatriÃ¨me B', '4B', 'inactif'),
(54, 'premiÃ¨re C', '1C', 'inactif'),
(55, 'premiÃ¨re D', '1D', 'inactif'),
(56, 'premiÃ¨re TI', '1TI', 'inactif'),
(57, 'terminale TI', 'TTI', 'inactif'),
(58, 'terminale A1', 'TA1', 'inactif'),
(59, 'terminale A2', 'TA2', 'inactif'),
(60, 'terminale C', 'TC', 'inactif'),
(61, 'terminale D', 'TD', 'inactif'),
(62, 'sixiÃ¨me', '61', 'inactif');

-- --------------------------------------------------------

--
-- Structure de la table `classe_principale`
--

CREATE TABLE IF NOT EXISTS `classe_principale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prof` varchar(100) NOT NULL,
  `classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `classe_principale`
--

INSERT INTO `classe_principale` (`id`, `prof`, `classe`) VALUES
(1, 'mpila', '2A2'),
(2, 'mbouh', '2C');

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NULL,
  `sexe` varchar(1) NOT NULL COMMENT 'valeurs possibles M ou F',
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) NULL,
  `matricule` varchar(20) NOT NULL COMMENT 'matricule de l''élève',
  `classe` varchar(100) NOT NULL COMMENT 'id de la classe de l''élève',
  `adresse_parent` varchar(255) NULL,
  `etat` varchar(100) NOT NULL COMMENT 'supprimé ou pas',
  `statut` varchar(100) NOT NULL COMMENT 'red, nv',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `matricule`, `classe`, `adresse_parent`, `etat`, `statut`) VALUES
(1, 'ABEDONG FERNANDA', '', 'F', '0000-00-00', 'bafia', '1718A001', '6a', '', 'non_supprime', 'Nv'),
(2, 'ABONA OSSANGO LUCIE', '', 'F', '0000-00-00', 'bafia', '1718A002', '6a', '', 'non_supprime', 'Red'),
(3, 'TSADE GABRIEL', '', 'M', '0000-00-00', 'bafia', '1718A0053', '6a', '', 'non_supprime', 'Nv'),
(4, 'YONGALA FLORENTINE FLORE', '', 'F', '0000-00-00', 'bafia', '1718A0054', '6a', '', 'non_supprime', 'Nv');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NULL,
  `sexe` varchar(100) NOT NULL COMMENT 'Mr ou Mme',
  `poste` varchar(100) NOT NULL COMMENT 'prof, sg, censeur ou admin',
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL COMMENT 'crypté en sha1',
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `image` varchar(255) NOT NULL COMMENT 'adresse de l''image du gestionnaire',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Nyambi Ngikwa', 'Richard', 'Mr', 'prof', 'nyambi', '79f6ce076f2320b9d6a4b3f5d33675ef2ebe9f6a', 'actif', 'http://localhost/noteplus/images/prof/nyambi.jpg'),
(21, 'Administrateur', '', 'Mr', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'actif', 'http://localhost/noteplus/images/admin/admin.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `journal_connexion`
--

CREATE TABLE IF NOT EXISTS `journal_connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(100) NOT NULL,
  `adresse_ip` varchar(255) NOT NULL,
  `periode_de_connexion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `journal_connexion`
--

INSERT INTO `journal_connexion` (`id`, `utilisateur`, `adresse_ip`, `periode_de_connexion`) VALUES
(1, 'nyambi', '127.0.0.1', '2016-05-09 11:38:36');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_matiere` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL COMMENT 'littéraire, scientifique ou autre',
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `code_matiere` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom_matiere`, `categorie`, `etat`, `code_matiere`) VALUES
(1, 'orthographe - grammaire', 'litteraire', 'actif', 'orthograph'),
(2, 'Ã©tude de cas', 'scientifique', 'actif', 'Ã©tude de ');

-- --------------------------------------------------------

--
-- Structure de la table `moyenne`
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

--
-- Contenu de la table `moyenne`
--


-- --------------------------------------------------------

--
-- Structure de la table `note`
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

--
-- Contenu de la table `note`
--


-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_periode` varchar(255) NOT NULL,
  `date_ouvert` date NOT NULL COMMENT 'debut disponibilité',
  `date_fermet` date NOT NULL COMMENT 'fin disponibilité',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`id`, `nom_periode`, `date_ouvert`, `date_fermet`) VALUES
(1, 'SÃ©quence 1', '2016-09-05', '2016-10-21'),
(2, 'SÃ©quence 2', '2016-10-24', '2016-12-02'),
(3, 'SÃ©quence 3', '2016-12-05', '2017-01-27'),
(4, 'SÃ©quence 4', '2017-01-30', '2017-03-10'),
(5, 'SÃ©quence 5', '2017-03-13', '2017-05-05'),
(6, 'SÃ©quence 6', '2017-05-08', '2017-06-09');

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE IF NOT EXISTS `poste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poste` varchar(255) NOT NULL,
  `code_p` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `poste`
--

INSERT INTO `poste` (`id`, `poste`, `code_p`) VALUES
(1, 'membre', 'mb'),
(2, 'président', 'pdt');

-- --------------------------------------------------------

--
-- Structure de la table `prof_classe`
--

CREATE TABLE IF NOT EXISTS `prof_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_prof` varchar(255) NOT NULL COMMENT 'login enseignant',
  `id_classe` varchar(100) NOT NULL COMMENT 'code de la classe',
  `principal` varchar(5) NOT NULL,
  `id_matiere` int(11) NOT NULL COMMENT 'voir matiere.id',
  `coef` decimal(2,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `prof_classe`
--

INSERT INTO `prof_classe` (`id`, `id_prof`, `id_classe`, `principal`, `id_matiere`, `coef`) VALUES
(1, 'bougning', '1A2', 'non', 15, '1.0'),
(22, 'bougning', '6A', 'non', 15, '1.0');

-- --------------------------------------------------------

--
-- Structure de la table `statistique`
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

--
-- Contenu de la table `statistique`
--

