-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 03 Février 2022 à 16:48
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `noteplus`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
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

DROP TABLE IF EXISTS `appreciation`;
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
(2, 'trÃ¨s faible', 3, 5, '#FF0000'),
(3, 'faible', 5, 8, '#FF0000'),
(4, 'insuffisant', 8, 9, '#FF0000'),
(5, 'm&eacute;diocre', 9, 10, '#FF0000'),
(6, 'passable', 10, 12, '#0000FF'),
(7, 'assez bon travail', 12, 14, '#0000FF'),
(8, 'bon travail', 14, 16, '#0000FF'),
(9, 'trÃ¨s bien', 16, 18, '#0000FF'),
(10, 'excellent', 18, 20, '#0000FF');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_classe` varchar(255) NOT NULL,
  `code_classe` varchar(100) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `niveau` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id`, `nom_classe`, `code_classe`, `etat`, `niveau`) VALUES
(1, 'sixiÃ¨me', '6em', 'actif', '6eme'),
(2, 'cinquiÃ¨me', '5eme', 'actif', '5eme'),
(3, 'QuatriÃ¨me Allemand', '4all', 'actif', '4eme'),
(4, 'quatriÃ¨me espagnol', '4esp', 'actif', '4eme'),
(5, 'troisiÃ¨me Allemand', '3all', 'actif', '3eme'),
(6, 'troisiÃ¨me Espagnol', '3esp', 'actif', '3eme');

-- --------------------------------------------------------

--
-- Structure de la table `classe_principale`
--

DROP TABLE IF EXISTS `classe_principale`;
CREATE TABLE IF NOT EXISTS `classe_principale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prof` varchar(100) NOT NULL,
  `classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `classe_principale`
--


-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(1) NOT NULL COMMENT 'valeurs possibles M ou F',
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `matricule` varchar(20) NOT NULL COMMENT 'matricule de l''élève',
  `classe` varchar(100) NOT NULL COMMENT 'id de la classe de l''élève',
  `adresse_parent` varchar(255) DEFAULT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'supprimé ou pas',
  `statut` varchar(100) NOT NULL COMMENT 'red, nv',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `matricule`, `classe`, `adresse_parent`, `etat`, `statut`) VALUES
(1, 'ADELE A BEP', 'MARIE NADEGE', 'M', '2006-02-07', 'BITANG', 'D2021-8225', '4all', '', 'non_supprime', 'N'),
(2, 'AGOH A BABARI', 'BRENDA', 'M', '2005-10-07', 'BAFIA', 'D2021-1307', '4all', '', 'non_supprime', 'N'),
(3, 'GUISSACK A AMBASSA', 'NINA E', 'M', '2006-08-08', 'BITANG', 'D2021-5769', '4all', '', 'non_supprime', 'N'),
(4, 'DAN A NDJAH', 'PRISCA', 'M', '2008-01-12', 'BITANG', 'D2021-8843', '4all', '', 'non_supprime', 'N'),
(5, 'ASSEN A AMANG', 'MYRIAM', 'M', '2009-01-01', 'BITANG', 'D2021-6257', '4all', '', 'non_supprime', 'N'),
(6, 'MPON A MANKEN', 'JUNIOR', 'M', '2006-01-26', 'BOKITO', 'D2021-9811', '3all', '', 'non_supprime', 'N'),
(7, 'MAFIECK A RIKAM', 'JEANNETTE', 'F', '2006-03-03', 'BITANG', 'D2021-3400', '3all', '', 'non_supprime', 'N'),
(8, 'AMAGNE GONDONN', 'REGINE C', 'F', '2007-09-12', 'BITANG', 'D2021-8705', '3all', '', 'non_supprime', 'N'),
(9, 'BIAKA ADIRI', 'ALBERT LANDRY', 'M', '2004-06-09', 'BITANG', 'D2021-6846', '3all', '', 'non_supprime', 'N'),
(11, 'ANDOCHE ELANGUE', 'DIDIER J', 'F', '0209-12-20', 'DOUALA', 'D2021-3005', '6em', '', 'non_supprime', 'N'),
(12, 'NWAL BITSONG', 'ABIBA', 'F', '2005-06-14', 'BITANG', 'D2021-349', '6em', '', 'non_supprime', 'R'),
(13, 'alima a mboussi', 'hÃ©lÃ¨ne', 'F', '2007-01-07', 'bafia', 'D2022-6413', '4esp', '', 'non_supprime', 'R'),
(14, 'andrÃ© de maison', 'sibÃ©', 'M', '2007-07-10', 'bitang', 'D2022-3622', '4esp', '', 'non_supprime', 'N'),
(15, 'wandong Ã  bobo', 'olivier', 'M', '2005-07-04', 'douala', 'D2022-3933', '4esp', '', 'non_supprime', 'R'),
(16, 'sanama moupo', 'paul jordan', 'M', '2010-10-10', 'douala', 'D2022-8924', '4esp', '', 'non_supprime', 'R'),
(17, 'awantsago', 'tÃ©claire y', 'F', '2006-07-06', 'assala', 'D2022-9915', '4esp', '', 'non_supprime', 'R'),
(18, 'beleck moupo', 'sarah n', 'F', '2011-03-04', 'douala', 'D2022-1422', '4esp', '', 'non_supprime', 'R'),
(19, 'bepe ndeng', 'prisca', 'F', '2008-01-14', 'bitang', 'D2022-8021', '4esp', '', 'non_supprime', 'R'),
(20, 'goura Ã  rim', 'ferdinand', 'M', '2005-02-16', 'bafia', 'D2022-9526', '4esp', '', 'non_supprime', 'N'),
(21, 'ketchang', 'julie rose', 'F', '2006-10-12', 'bafia', 'D2022-225', '4esp', '', 'non_supprime', 'N'),
(22, 'maguib Ã  nwosso', 'chinelle', 'F', '2008-07-16', 'bitang', 'D2022-9376', '4esp', '', 'non_supprime', 'N'),
(23, 'mboh Ã  ndiang', 'suzanne', 'F', '2008-04-26', 'bitang', 'D2022-4641', '4esp', '', 'non_supprime', 'N'),
(24, 'nyoni', 'yolande', 'F', '2008-01-29', 'bitang', 'D2022-2335', '4esp', '', 'non_supprime', 'N'),
(25, 'yombo bidias', 'herman', 'M', '2007-12-09', 'bitang', 'D2022-5426', '3esp', '', 'non_supprime', 'N'),
(26, 'yombo Ã  agnagma', 'm', 'M', '2007-12-09', 'bitang', 'D2022-5952', '3esp', '', 'non_supprime', 'N');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(100) NOT NULL COMMENT 'Mr ou Mme',
  `poste` varchar(100) NOT NULL COMMENT 'prof, sg, censeur ou admin',
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL COMMENT 'crypté en sha1',
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `image` varchar(255) NOT NULL COMMENT 'adresse de l''image du gestionnaire',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Nyambi Ngikwa', 'Richard', 'Mr', 'prof', 'nyambi', '79f6ce076f2320b9d6a4b3f5d33675ef2ebe9f6a', 'actif', 'http://localhost/noteplus/images/prof/nyambi.jpg'),
(21, 'Administrateur', '', 'Mr', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'actif', 'http://localhost/noteplus/images/admin/admin.jpg'),
(40, 'censeur', ' ', 'M', 'censeur', 'censeur', 'f893f20920f0d0655878d4273c5bb2cfd901c85d', 'actif', ''),
(39, 'Surveillant', 'GÃ©nÃ©ral', 'M', 'sg', 'sg', 'ff39796487e85a7066e18d814bcb63856de6cfff', 'actif', ''),
(38, 'ngon a bidias', 'loic', 'M', 'prof', 'ngon', '206621adf241be06cc64e28227e18011d754542c', 'actif', ''),
(37, 'abekos nyam', 'michel', 'M', 'prof', 'abekos', '9df23761308ca8bc83e3dad6d3eaa6b6a1ea5ec6', 'actif', ''),
(36, 'fofack', 'beltus', 'M', 'prof', 'fofack', '1ec24368c440d982786541a9ec404099f5eb4947', 'actif', ''),
(35, 'MOUBITANG ', 'Symphorien', 'M', 'prof', 'moubitang', 'b09fe1e7011424444bcd93007f04fa0ea60478ac', 'actif', ''),
(34, 'BIAKA BEKEN', ' ', 'M', 'prof', 'biaka', 'aa031d71c2f00adee10eb9a82a3e3d7e1e75eca9', 'actif', '');

-- --------------------------------------------------------

--
-- Structure de la table `journal_connexion`
--

DROP TABLE IF EXISTS `journal_connexion`;
CREATE TABLE IF NOT EXISTS `journal_connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(100) NOT NULL,
  `adresse_ip` varchar(255) NOT NULL,
  `periode_de_connexion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `journal_connexion`
--

INSERT INTO `journal_connexion` (`id`, `utilisateur`, `adresse_ip`, `periode_de_connexion`) VALUES
(1, 'admin', '127.0.0.1', '2021-12-04 11:39:31'),
(2, 'biaka', '127.0.0.1', '2021-12-04 12:12:35'),
(3, 'fofack', '127.0.0.1', '2021-12-04 15:12:48'),
(4, 'admin', '127.0.0.1', '2021-12-05 08:42:44'),
(5, 'admin', '127.0.0.1', '2021-12-06 14:53:14'),
(6, 'admin', '127.0.0.1', '2022-02-03 11:36:07');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `nom_matiere` varchar(255) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `code_matiere` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom_matiere`, `etat`, `code_matiere`) VALUES
(6, 'Ã©tude de texte', 'actif', 'etx'),
(5, 'orthographe', 'actif', 'orth'),
(3, 'anglais', 'actif', 'anglais'),
(4, 'mathÃ©matiques', 'actif', 'maths'),
(7, 'expression Ã©crite', 'actif', 'ee'),
(8, 'expression orale', 'actif', 'eo'),
(9, 'histoire', 'actif', 'hist'),
(10, 'geographie', 'actif', 'geo'),
(11, 'Ã©ducation Ã  la citoyennetÃ©', 'actif', 'ecm'),
(12, 'allemand', 'actif', 'all'),
(13, 'espagnol', 'actif', 'esp'),
(14, 'sciences de la vie', 'actif', 'svt'),
(15, 'informatique', 'actif', 'info'),
(16, 'physiques - chimie - technologies', 'actif', 'pct');

-- --------------------------------------------------------

--
-- Structure de la table `moyenne`
--

DROP TABLE IF EXISTS `moyenne`;
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

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_eleve` int(11) NOT NULL COMMENT 'voir eleve.id',
  `id_matiere` varchar(100) NOT NULL COMMENT 'voir matiere.id',
  `id_classe` varchar(100) NOT NULL COMMENT 'voir code_classe',
  `id_periode` int(11) NOT NULL COMMENT 'voir periode.id',
  `note_simple` decimal(4,2) NOT NULL COMMENT 'note sur 20',
  `coef` decimal(2,1) NOT NULL,
  `note_totale` decimal(5,2) NOT NULL COMMENT 'note x coef',
  `id_appreciation` int(11) NOT NULL COMMENT 'voir appreciation.id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `id_eleve`, `id_matiere`, `id_classe`, `id_periode`, `note_simple`, `coef`, `note_totale`, `id_appreciation`) VALUES
(12, 9, 'ecm', '3all', 1, '15.00', '2.0', '30.00', 8),
(11, 8, 'ecm', '3all', 1, '15.00', '2.0', '30.00', 8),
(10, 6, 'all', '3all', 1, '18.00', '3.0', '54.00', 10),
(9, 7, 'all', '3all', 1, '16.00', '3.0', '48.00', 9),
(8, 9, 'all', '3all', 1, '14.00', '3.0', '42.00', 8),
(7, 8, 'all', '3all', 1, '12.00', '3.0', '36.00', 7),
(13, 7, 'ecm', '3all', 1, '13.00', '2.0', '26.00', 7),
(14, 6, 'ecm', '3all', 1, '9.00', '2.0', '18.00', 5),
(15, 8, 'geo', '3all', 1, '15.00', '2.0', '30.00', 8),
(16, 9, 'geo', '3all', 1, '16.00', '2.0', '32.00', 9),
(17, 7, 'geo', '3all', 1, '18.00', '2.0', '36.00', 10),
(18, 6, 'geo', '3all', 1, '10.00', '2.0', '20.00', 6);

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
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
(1, 'S&eacute;quence 1', '2022-02-03', '2022-02-02'),
(2, 'S&eacute;quence 2', '2021-06-30', '2021-06-29'),
(3, 'S&eacute;quence 3', '2021-06-30', '2021-06-28'),
(4, 'S&eacute;quence 4', '0000-00-00', '0000-00-00'),
(5, 'S&eacute;quence 5', '0000-00-00', '0000-00-00'),
(6, 'S&eacute;quence 6', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `prof_classe`
--

DROP TABLE IF EXISTS `prof_classe`;
CREATE TABLE IF NOT EXISTS `prof_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire',
  `id_prof` varchar(255) NOT NULL COMMENT 'login enseignant',
  `id_classe` varchar(100) NOT NULL COMMENT 'code de la classe',
  `id_matiere` varchar(255) NOT NULL COMMENT 'voir matiere.id',
  `coef` decimal(2,1) NOT NULL,
  `groupe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `prof_classe`
--

INSERT INTO `prof_classe` (`id`, `id_prof`, `id_classe`, `id_matiere`, `coef`, `groupe`) VALUES
(15, 'abekos', '3all', 'ecm', '2.0', 'gp1'),
(14, 'fofack', '3all', 'pct', '2.0', 'gp2'),
(13, 'fofack', '3all', 'maths', '4.0', 'gp2'),
(12, '', '4all', 'ecm', '2.0', 'gp1'),
(11, 'abekos', '3all', 'geo', '2.0', 'gp1'),
(10, 'abekos', '3all', 'hist', '2.0', 'gp1'),
(16, '', '3all', 'all', '3.0', 'gp1'),
(17, '', '4all', 'all', '3.0', 'gp1'),
(18, 'ngon', '6em', 'info', '2.0', 'gp2'),
(19, 'ngon', '5eme', 'info', '2.0', 'gp2'),
(20, 'ngon', '3all', 'info', '2.0', 'gp2'),
(21, 'ngon', '4esp', 'info', '2.0', 'gp2'),
(22, 'ngon', '4all', 'info', '2.0', 'gp2'),
(23, 'ngon', '3esp', 'info', '2.0', 'gp2');

-- --------------------------------------------------------

--
-- Structure de la table `statistique`
--

DROP TABLE IF EXISTS `statistique`;
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

