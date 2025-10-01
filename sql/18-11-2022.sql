-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 28 Novembre 2022 à 06:35
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

CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nombre_heure` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_appreciation` varchar(255) NOT NULL,
  `interv_ouvert` int(2) NOT NULL COMMENT 'note de debut',
  `interv_fermet` int(2) NOT NULL COMMENT 'note de fin',
  `couleur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `appreciation`
--

INSERT INTO `appreciation` (`id`, `nom_appreciation`, `interv_ouvert`, `interv_fermet`, `couleur`) VALUES
(1, 'travail nul', 0, 3, '#FF0000'),
(2, 'trÃƒÂ¨s faible', 3, 5, '#FF0000'),
(3, 'faible', 5, 8, '#FF0000'),
(4, 'insuffisant', 8, 9, '#FF0000'),
(5, 'mÃƒÂ©diocre', 9, 10, '#FF0000'),
(6, 'passable', 10, 12, '#0000FF'),
(7, 'assez bon travail', 12, 14, '#0000FF'),
(8, 'bon travail', 14, 16, '#0000FF'),
(9, 'trÃƒÂ¨s bien', 16, 18, '#0000FF'),
(10, 'excellent', 18, 20, '#0000FF');

-- --------------------------------------------------------

--
-- Structure de la table `bull_ann`
--

CREATE TABLE IF NOT EXISTS `bull_ann` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(100) NOT NULL,
  `pret` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `bull_ann`
--


-- --------------------------------------------------------

--
-- Structure de la table `bull_trim`
--

CREATE TABLE IF NOT EXISTS `bull_trim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(100) NOT NULL,
  `pret` varchar(5) NOT NULL,
  `trim` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `bull_trim`
--


-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
(1, 'sixiÃ¨me', '6eme', 'actif', '6eme'),
(2, 'cinquiÃ¨me', '5eme', 'actif', '5eme'),
(3, 'quatriÃ¨me allemand', '4all', 'actif', '4eme'),
(4, 'quatriÃ¨me espagnol', '4esp', 'actif', '4eme'),
(5, 'troisiÃ¨me allemand', '3all', 'actif', '3eme'),
(6, 'troisiÃ¨me espagnol', '3esp', 'actif', '3eme');

-- --------------------------------------------------------

--
-- Structure de la table `classe_principale`
--

CREATE TABLE IF NOT EXISTS `classe_principale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prof` varchar(100) NOT NULL,
  `classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `classe_principale`
--


-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(1) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `matricule` varchar(20) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `adresse_parent` varchar(255) DEFAULT NULL,
  `statut` varchar(100) NOT NULL COMMENT 'red, nv',
  `etat` varchar(100) NOT NULL COMMENT 'supprimÃ© ou pas',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `matricule`, `classe`, `adresse_parent`, `statut`, `etat`) VALUES
(1, 'nkiban', 'fortune', 'F', '2012-03-11', 'bafia', 'D2022-5036', '6eme', '', 'N', 'non_supprime'),
(2, 'ngo pala', 'anne marie', 'F', '2011-01-20', 'sodibanga', 'D2022-4075', '6eme', '', 'N', 'non_supprime'),
(3, 'assen Ã  bidias', 'astride jovana', 'F', '2011-03-03', 'bafia', 'D2022-6735', '6eme', '', 'N', 'non_supprime'),
(4, 'bidias nwos', 'sephora', 'F', '2010-11-30', 'bafia', 'D2022-1755', '6eme', '', 'N', 'non_supprime'),
(5, 'biyo hen', 'alexandre', 'M', '2010-09-05', 'douala', 'D2022-843', '6eme', '', 'N', 'non_supprime'),
(6, 'diam nnock', 'maeva', 'F', '2009-11-25', 'bafia', 'D2022-226', '6eme', '', 'N', 'non_supprime'),
(7, 'maden', 'brigitte', 'F', '2011-10-08', 'bafia', 'D2022-1661', '6eme', '', 'N', 'non_supprime'),
(8, 'menthong saliou', ' ', 'M', '2013-01-01', 'bafia', 'D2022-6580', '6eme', '', 'N', 'non_supprime'),
(9, 'ngae', 'christian nicaise', 'F', '2011-02-02', 'bitang bafia', 'D2022-852', '6eme', '', 'N', 'non_supprime'),
(10, 'ambassa Ã  ndjah', 'adÃ¨le', 'F', '2012-01-30', 'bafia', 'D2022-574', '5eme', '', 'N', 'non_supprime'),
(11, 'djam mbita', 'boris', 'M', '2010-01-01', 'bafia', 'D2022-8137', '5eme', '', 'N', 'non_supprime'),
(12, 'djessong', 'calvin', 'M', '2009-01-16', 'bitang', 'D2022-7758', '5eme', '', 'N', 'non_supprime'),
(13, 'ebong Ã  bep', 'magloire', 'M', '2009-06-16', 'bafia', 'D2022-8346', '5eme', '', 'N', 'non_supprime'),
(14, 'gombitang wam', ' ', 'F', '2009-06-18', 'bitang', 'D2022-5351', '5eme', '', 'N', 'non_supprime'),
(15, 'gondio', 'edith', 'F', '2009-04-09', 'bitang', 'D2022-2554', '5eme', '', 'N', 'non_supprime'),
(16, 'guebediang', 'marie l ', 'F', '2008-04-08', 'bitang', 'D2022-8706', '5eme', '', 'N', 'non_supprime'),
(17, 'guebong', 'suzanne', 'F', '2013-01-01', 'bitang', 'D2022-8594', '5eme', '', 'N', 'non_supprime'),
(18, 'mafiet andiori', 'm', 'F', '2009-03-07', 'bitang', 'D2022-749', '5eme', '', 'N', 'non_supprime'),
(19, 'nwal bitsong', 'abiba', 'F', '2005-06-14', 'bitang', 'D2022-2740', '5eme', '', 'N', 'non_supprime'),
(20, 'bong Ã  goufan', 'carine', 'F', '2007-12-13', 'bafia', 'D2022-7481', '4all', '', 'N', 'non_supprime'),
(21, 'dang Ã  nwosso', 'n', 'F', '2009-02-20', 'bitang', 'D2022-8227', '4all', '', 'N', 'non_supprime'),
(22, 'gommeh', 'laurette', 'F', '2009-01-17', 'bitang', 'D2022-9460', '4all', '', 'N', 'non_supprime'),
(23, 'matchang Ã  ngouana', 'j', 'F', '2009-03-25', 'bitang', 'D2022-8069', '4all', '', 'N', 'non_supprime'),
(24, 'sana menthong', 'f', 'F', '2009-04-18', 'bitang', 'D2022-5079', '4all', '', 'N', 'non_supprime'),
(25, 'yombo atchan', 'michelle b', 'F', '2008-04-26', 'bitang', 'D2022-8148', '4all', '', 'N', 'non_supprime'),
(26, 'atangana effa', 'elisa', 'F', '2009-05-16', 'bafia', 'D2022-949', '4esp', '', 'N', 'non_supprime'),
(27, 'bong Ã  mboussi', 'thÃ©rÃ¨se', 'F', '2009-03-19', 'bitang', 'D2022-1953', '4esp', '', 'N', 'non_supprime'),
(28, 'bong', 'leticia', 'F', '2008-08-15', 'bitang', 'D2022-6527', '4esp', '', 'N', 'non_supprime'),
(29, 'guiyombi', 'ange rose', 'F', '2009-11-26', 'bitang', 'D2022-4473', '4esp', '', 'N', 'non_supprime'),
(30, 'megnang', 'sidoine', 'F', '2010-09-26', 'bafia', 'D2022-6658', '4esp', '', 'N', 'non_supprime'),
(31, 'mewom', 'nicaise', 'F', '2007-03-12', 'bitang', 'D2022-6835', '4esp', '', 'N', 'non_supprime'),
(32, 'ngo iroung', 'vanessa', 'F', '2009-05-09', 'mouko', 'D2022-6630', '4esp', '', 'N', 'non_supprime'),
(33, 'ntah Ã  bitang', 'joel louis', 'M', '2009-12-12', 'bitang', 'D2022-3541', '4esp', '', 'N', 'non_supprime'),
(34, 'rim Ã  bep', 'ernest', 'M', '2009-11-12', 'bitang', 'D2022-5513', '4esp', '', 'N', 'non_supprime'),
(35, 'ybanewos Ã  dong', 'doriane', 'F', '2010-02-27', 'bitang', 'D2022-2151', '4esp', '', 'N', 'non_supprime'),
(36, 'adedele Ã  bep', 'marie nadÃ¨ge', 'F', '2007-08-31', 'bitang', 'D2022-9206', '3all', '', 'N', 'non_supprime'),
(37, 'amagne gondonn', 'regine cybelle', 'F', '2007-09-12', 'bitang', 'D2022-4692', '3all', '', 'R', 'non_supprime'),
(38, 'assen Ã  amang', 'myriam', 'F', '2009-01-01', 'bitang', 'D2022-484', '3all', '', 'N', 'non_supprime'),
(39, 'dan Ã  ndjah', 'prisca', 'F', '2008-01-12', 'bitang', 'D2022-1162', '3all', '', 'N', 'non_supprime'),
(40, 'mafioe Ã  rikam', ' ', 'F', '2006-03-03', 'bitang', 'D2022-3183', '3all', '', 'R', 'non_supprime'),
(41, 'alima Ã  mboussi', 'hÃ©lÃ¨ne', 'F', '2004-04-24', 'bafia', 'D2022-7199', '3esp', '', 'N', 'non_supprime'),
(42, 'andrÃ© de maison', 'sibe huit', 'M', '2007-07-01', 'bitang', 'D2022-6158', '3esp', '', 'N', 'non_supprime'),
(43, 'bakalag', 'odile dÃ©esse', 'F', '2007-05-20', 'douala', 'D2022-6913', '3esp', '', 'R', 'non_supprime'),
(44, 'beleck moupo', 'sarah natacha', 'F', '2011-03-04', 'douala', 'D2022-3971', '3esp', '', 'N', 'non_supprime'),
(45, 'bepey Ã  yombi', 'marie elodie', 'F', '1960-01-01', '00', 'D2022-9019', '3esp', '', 'R', 'non_supprime'),
(46, 'bepe ndeng', 'prisca', 'F', '2008-01-14', 'bitang', 'D2022-2831', '3esp', '', 'N', 'non_supprime'),
(47, 'goura Ã  rim', 'ferdinand', 'M', '2005-02-16', 'bitang', 'D2022-7950', '3esp', '', 'N', 'non_supprime'),
(48, 'guebediang Ã  tcheck', 'nelly', 'F', '1960-01-01', '00', 'D2022-1544', '3esp', '', 'N', 'non_supprime'),
(49, 'bikeme okobalemba', 'louis', 'M', '2006-10-01', 'ossimb', 'D2022-4603', '3esp', '', 'R', 'non_supprime'),
(50, 'guip Ã  mbang Ã  bessong', 'grace d', 'F', '2004-04-04', 'bafia', 'D2022-868', '3esp', '', 'N', 'non_supprime'),
(51, 'keng Ã  ebong', 'alan', 'M', '2006-02-26', 'bafia', 'D2022-1395', '3esp', '', 'R', 'non_supprime'),
(52, 'kesseng', 'brigitte', 'F', '2008-01-20', 'bafia', 'D2022-332', '3esp', '', 'R', 'non_supprime'),
(53, 'magnoung', 'clarisse', 'F', '2005-01-01', 'bitang', 'D2022-6741', '3esp', '', 'R', 'non_supprime'),
(54, 'maguib Ã  nwosso', 'chimelle', 'F', '2008-06-16', 'bitang', 'D2022-9958', '3esp', '', 'N', 'non_supprime'),
(55, 'mantsana moupo', 'elise raissa', 'F', '2004-07-05', 'douala', 'D2022-5637', '3esp', '', 'R', 'non_supprime'),
(56, 'mounapoua', 'emmanuel geovani', 'M', '2004-02-01', 'bitang', 'D2022-6620', '3esp', '', 'R', 'non_supprime'),
(57, 'nyoni', 'yolande', 'F', '2008-01-29', 'bitang', 'D2022-1973', '3esp', '', 'N', 'non_supprime'),
(58, 'ombang bessong', 'elisÃ©', 'M', '2004-04-04', 'bafia', 'D2022-3213', '3esp', '', 'N', 'non_supprime'),
(59, 'sanama moupo', 'paul', 'M', '2010-11-11', 'douala', 'D2022-4914', '3esp', '', 'N', 'non_supprime'),
(60, 'wandong Ã  bobo', 'olivier', 'M', '2004-09-23', 'douala', 'D2022-350', '3esp', '', 'N', 'non_supprime'),
(61, 'yombo Ã  agnangma', 'mathurin', 'M', '2006-05-05', 'bitang', 'D2022-950', '3esp', '', 'R', 'non_supprime'),
(62, 'yombo bidias', 'herman', 'M', '2007-12-09', 'bafia', 'D2022-2846', '3esp', '', 'R', 'non_supprime'),
(63, 'yombo moudio', 'emmanuel', 'M', '2007-12-09', 'bafia', 'D2022-4908', '3esp', '', 'R', 'non_supprime'),
(64, 'zintchem Ã  bessong', 'sophie', 'F', '2007-03-02', 'bafia', 'D2022-3072', '3esp', '', 'N', 'non_supprime');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(100) NOT NULL COMMENT 'Mr ou Mme',
  `poste` varchar(100) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Administrateur', '', 'Mr', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'actif', ''),
(2, 'tchekane onana', 'thomas', 'M', 'prof', 'tchekane', 'e367511624830e0ad8f64fbf6cc09582d04c5f38', 'actif', '');

-- --------------------------------------------------------

--
-- Structure de la table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `annee_scolaire` varchar(11) NOT NULL,
  `nom_pays` varchar(100) NOT NULL,
  `nom_devise` varchar(255) NOT NULL,
  `nom_ministere` varchar(255) NOT NULL,
  `nom_region` varchar(255) NOT NULL,
  `nom_departement` varchar(255) DEFAULT NULL,
  `nom_ets` varchar(255) NOT NULL,
  `type_ets` varchar(255) NOT NULL,
  `chef_ets` varchar(255) NOT NULL,
  `signataire` varchar(255) NOT NULL,
  `arrondissement` varchar(100) DEFAULT NULL,
  `sexe_signataire` varchar(20) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `titre_signataire` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `information`
--

INSERT INTO `information` (`annee_scolaire`, `nom_pays`, `nom_devise`, `nom_ministere`, `nom_region`, `nom_departement`, `nom_ets`, `type_ets`, `chef_ets`, `signataire`, `arrondissement`, `sexe_signataire`, `contact`, `titre_signataire`) VALUES
('2022 / 2023', 'REPUBLIQUE DU CAMEROUN', 'Paix - Travail - Patrie', 'ministÃ¨re des enseignements secondaires', 'DÃƒÂ©lÃƒÂ©gation RÃƒÂ©gionale du Centre', 'DÃƒÂ©lÃƒÂ©gation DÃƒÂ©partementale du mbam et inoubou', 'CES DE BITANG', 'ces', 'Monsieur TCHANGMENA BIENVENU', '', 'Bitang', NULL, '677253979', 'Le Directeur');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `journal_connexion`
--

INSERT INTO `journal_connexion` (`id`, `utilisateur`, `adresse_ip`, `periode_de_connexion`) VALUES
(1, 'admin', '127.0.0.1', '2022-10-23 14:14:21'),
(2, 'admin', '127.0.0.1', '2022-11-27 05:54:47'),
(3, 'tchekane', '127.0.0.1', '2022-11-27 09:39:48'),
(4, 'admin', '127.0.0.1', '2022-11-27 09:41:00');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_matiere` varchar(255) NOT NULL,
  `code_matiere` varchar(100) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom_matiere`, `code_matiere`, `etat`) VALUES
(1, 'travail manuel', 'tm', 'actif'),
(2, 'eps', 'eps', 'actif'),
(3, 'sciences', 'sc', 'actif'),
(4, 'SVTEEHB', 'svt', 'actif'),
(5, 'mathÃ©matiques', 'maths', 'actif'),
(6, 'informatique', 'info', 'actif'),
(7, 'pct', 'pct', 'actif'),
(8, 'allemand', 'all', 'actif'),
(9, 'espagnol', 'esp', 'actif'),
(10, 'histoire', 'hist', 'actif'),
(11, 'geographie', 'geo', 'actif'),
(12, 'ecm', 'ecm', 'actif'),
(13, 'anglais', 'ang', 'actif'),
(14, 'expression Ã©crite', 'exp_ecr', 'actif'),
(15, 'expression orale', 'exp_or', 'actif'),
(16, 'correction orthographique', 'corr_orth', 'actif'),
(17, 'Ã©tude de texte', 'etx', 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `moyennes_sequence_1_6eme`
--

CREATE TABLE IF NOT EXISTS `moyennes_sequence_1_6eme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `sexe` varchar(5) DEFAULT NULL,
  `statut` varchar(5) DEFAULT NULL,
  `effectif` int(11) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `matricule` varchar(20) DEFAULT NULL,
  `coefs_gp2` float(4,2) DEFAULT NULL,
  `points_gp2` float(5,2) DEFAULT NULL,
  `moyennes_gp2` float(4,2) DEFAULT NULL,
  `coefs_gp3` float(4,2) DEFAULT NULL,
  `points_gp3` float(5,2) DEFAULT NULL,
  `moyennes_gp3` float(4,2) DEFAULT NULL,
  `total_points` float(5,2) DEFAULT NULL,
  `total_coefs` float(5,2) DEFAULT NULL,
  `moyenne` float(5,2) DEFAULT NULL,
  `rang` varchar(10) DEFAULT NULL,
  `classes` int(3) DEFAULT NULL,
  `appreciation` varchar(255) DEFAULT NULL,
  `nb_gpe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `moyennes_sequence_1_6eme`
--

INSERT INTO `moyennes_sequence_1_6eme` (`id`, `nom`, `sexe`, `statut`, `effectif`, `date_naissance`, `lieu_naissance`, `classe`, `matricule`, `coefs_gp2`, `points_gp2`, `moyennes_gp2`, `coefs_gp3`, `points_gp3`, `moyennes_gp3`, `total_points`, `total_coefs`, `moyenne`, `rang`, `classes`, `appreciation`, `nb_gpe`) VALUES
(1, 'ASSEN Ã  BIDIAS Astride Jovana', 'F', 'N', 9, '2011-03-03', 'bafia', '6eme', 'D2022-6735', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(2, 'BIDIAS NWOS Sephora', 'F', 'N', 9, '2010-11-30', 'bafia', '6eme', 'D2022-1755', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(3, 'BIYO HEN Alexandre', 'M', 'N', 9, '2010-09-05', 'douala', '6eme', 'D2022-843', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(4, 'DIAM NNOCK Maeva', 'F', 'N', 9, '2009-11-25', 'bafia', '6eme', 'D2022-226', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(5, 'MADEN Brigitte', 'F', 'N', 9, '2011-10-08', 'bafia', '6eme', 'D2022-1661', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(6, 'MENTHONG SALIOU  ', 'M', 'N', 9, '2013-01-01', 'bafia', '6eme', 'D2022-6580', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(7, 'NGAE Christian Nicaise', 'F', 'N', 9, '2011-02-02', 'bitang bafia', '6eme', 'D2022-852', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(8, 'NGO PALA Anne Marie', 'F', 'N', 9, '2011-01-20', 'sodibanga', '6eme', 'D2022-4075', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2),
(9, 'NKIBAN Fortune', 'F', 'N', 9, '2012-03-11', 'bafia', '6eme', 'D2022-5036', 0.00, 0.00, 0.00, 2.00, 36.00, 18.00, 36.00, 2.00, 0.00, '0', 0, 'Non ClassÃ©', 2);

-- --------------------------------------------------------

--
-- Structure de la table `niveau_classe`
--

CREATE TABLE IF NOT EXISTS `niveau_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_niveau` varchar(100) NOT NULL,
  `code_niveau` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `niveau_classe`
--

INSERT INTO `niveau_classe` (`id`, `nom_niveau`, `code_niveau`) VALUES
(1, '6eme', '6eme'),
(2, '5eme', '5eme'),
(3, '4eme', '4eme'),
(4, '3eme', '3eme');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL COMMENT 'voir eleve.id',
  `id_matiere` varchar(100) NOT NULL COMMENT 'voir matiere.id',
  `id_classe` varchar(100) NOT NULL COMMENT 'voir code_classe',
  `id_periode` int(11) NOT NULL COMMENT 'voir periode.id',
  `note_simple` decimal(4,2) NOT NULL COMMENT 'note sur 20',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `id_eleve`, `id_matiere`, `id_classe`, `id_periode`, `note_simple`) VALUES
(1, 3, 'tm', '6eme', 1, '18.00'),
(2, 4, 'tm', '6eme', 1, '18.00'),
(3, 5, 'tm', '6eme', 1, '18.00'),
(4, 6, 'tm', '6eme', 1, '18.00'),
(5, 7, 'tm', '6eme', 1, '18.00'),
(6, 8, 'tm', '6eme', 1, '18.00'),
(7, 9, 'tm', '6eme', 1, '18.00'),
(8, 2, 'tm', '6eme', 1, '18.00'),
(9, 1, 'tm', '6eme', 1, '18.00'),
(10, 10, 'tm', '5eme', 1, '18.00'),
(11, 11, 'tm', '5eme', 1, '18.00'),
(12, 12, 'tm', '5eme', 1, '18.00'),
(13, 13, 'tm', '5eme', 1, '18.00'),
(14, 14, 'tm', '5eme', 1, '18.00'),
(15, 15, 'tm', '5eme', 1, '18.00'),
(16, 16, 'tm', '5eme', 1, '18.00'),
(17, 17, 'tm', '5eme', 1, '18.00'),
(18, 18, 'tm', '5eme', 1, '18.00'),
(19, 19, 'tm', '5eme', 1, '18.00');

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_periode` varchar(255) NOT NULL,
  `date_ouvert` date NOT NULL COMMENT 'debut disponibilitÃ©',
  `date_fermet` date NOT NULL COMMENT 'fin disponibilitÃ©',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`id`, `nom_periode`, `date_ouvert`, `date_fermet`) VALUES
(1, 'S&eacute;quence 1', '2022-11-27', '2022-11-28'),
(2, 'S&eacute;quence 2', '2022-11-27', '2022-11-30'),
(3, 'S&eacute;quence 3', '0000-00-00', '0000-00-00'),
(4, 'S&eacute;quence 4', '0000-00-00', '0000-00-00'),
(5, 'S&eacute;quence 5', '0000-00-00', '0000-00-00'),
(6, 'S&eacute;quence 6', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `prof_classe`
--

CREATE TABLE IF NOT EXISTS `prof_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prof` varchar(255) NOT NULL COMMENT 'login enseignant',
  `id_classe` varchar(100) NOT NULL COMMENT 'code de la classe',
  `id_matiere` varchar(255) NOT NULL COMMENT 'voir matiere.id',
  `coef` decimal(2,1) NOT NULL,
  `groupe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `prof_classe`
--

INSERT INTO `prof_classe` (`id`, `id_prof`, `id_classe`, `id_matiere`, `coef`, `groupe`) VALUES
(1, 'tchekane', '6eme', 'tm', '2.0', 'gp3'),
(2, '', '6eme', 'sc', '2.0', 'gp3'),
(3, 'tchekane', '6eme', 'info', '2.0', 'gp2'),
(4, 'tchekane', '5eme', 'info', '2.0', 'gp2'),
(5, '', '4esp', 'info', '2.0', 'gp2'),
(6, '', '4all', 'info', '2.0', 'gp2'),
(7, '', '3esp', 'info', '2.0', 'gp2'),
(8, '', '3all', 'info', '2.0', 'gp2'),
(9, 'tchekane', '5eme', 'tm', '2.0', 'gp3'),
(10, '', '4esp', 'tm', '2.0', 'gp3'),
(11, '', '4all', 'tm', '2.0', 'gp3'),
(12, '', '3esp', 'tm', '2.0', 'gp3'),
(13, '', '3all', 'tm', '2.0', 'gp3'),
(14, 'admin', '6eme', 'eps', '2.0', 'gp3'),
(15, '', '5eme', 'eps', '2.0', 'gp3'),
(16, '', '4esp', 'eps', '2.0', 'gp3'),
(17, '', '4all', 'eps', '2.0', 'gp3'),
(18, '', '3esp', 'eps', '2.0', 'gp3'),
(19, '', '3all', 'eps', '2.0', 'gp3');

-- --------------------------------------------------------

--
-- Structure de la table `sequence_1_6eme`
--

CREATE TABLE IF NOT EXISTS `sequence_1_6eme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `sexe` varchar(5) DEFAULT NULL,
  `statut` varchar(5) DEFAULT NULL,
  `effectif` int(11) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `classe` varchar(100) DEFAULT NULL,
  `nb_gpe` int(11) DEFAULT NULL,
  `matricule` varchar(20) DEFAULT NULL,
  `nt_eps` float(4,2) DEFAULT NULL,
  `coef_eps` float(4,2) DEFAULT NULL,
  `pdt_eps` float(5,2) DEFAULT NULL,
  `appr_eps` varchar(255) DEFAULT NULL,
  `enseignant_eps` varchar(255) DEFAULT NULL,
  `nt_info` float(4,2) DEFAULT NULL,
  `coef_info` float(4,2) DEFAULT NULL,
  `pdt_info` float(5,2) DEFAULT NULL,
  `appr_info` varchar(255) DEFAULT NULL,
  `enseignant_info` varchar(255) DEFAULT NULL,
  `nt_sc` float(4,2) DEFAULT NULL,
  `coef_sc` float(4,2) DEFAULT NULL,
  `pdt_sc` float(5,2) DEFAULT NULL,
  `appr_sc` varchar(255) DEFAULT NULL,
  `enseignant_sc` varchar(255) DEFAULT NULL,
  `nt_tm` float(4,2) DEFAULT NULL,
  `coef_tm` float(4,2) DEFAULT NULL,
  `pdt_tm` float(5,2) DEFAULT NULL,
  `appr_tm` varchar(255) DEFAULT NULL,
  `enseignant_tm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `sequence_1_6eme`
--

INSERT INTO `sequence_1_6eme` (`id`, `nom`, `sexe`, `statut`, `effectif`, `date_naissance`, `lieu_naissance`, `classe`, `nb_gpe`, `matricule`, `nt_eps`, `coef_eps`, `pdt_eps`, `appr_eps`, `enseignant_eps`, `nt_info`, `coef_info`, `pdt_info`, `appr_info`, `enseignant_info`, `nt_sc`, `coef_sc`, `pdt_sc`, `appr_sc`, `enseignant_sc`, `nt_tm`, `coef_tm`, `pdt_tm`, `appr_tm`, `enseignant_tm`) VALUES
(1, 'ASSEN Ã  BIDIAS Astride Jovana', 'F', 'N', 9, '2011-03-03', 'bafia', '6eme', NULL, 'D2022-6735', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(2, 'BIDIAS NWOS Sephora', 'F', 'N', 9, '2010-11-30', 'bafia', '6eme', NULL, 'D2022-1755', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(3, 'BIYO HEN Alexandre', 'M', 'N', 9, '2010-09-05', 'douala', '6eme', NULL, 'D2022-843', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(4, 'DIAM NNOCK Maeva', 'F', 'N', 9, '2009-11-25', 'bafia', '6eme', NULL, 'D2022-226', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(5, 'MADEN Brigitte', 'F', 'N', 9, '2011-10-08', 'bafia', '6eme', NULL, 'D2022-1661', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(6, 'MENTHONG SALIOU  ', 'M', 'N', 9, '2013-01-01', 'bafia', '6eme', NULL, 'D2022-6580', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(7, 'NGAE Christian Nicaise', 'F', 'N', 9, '2011-02-02', 'bitang bafia', '6eme', NULL, 'D2022-852', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(8, 'NGO PALA Anne Marie', 'F', 'N', 9, '2011-01-20', 'sodibanga', '6eme', NULL, 'D2022-4075', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas'),
(9, 'NKIBAN Fortune', 'F', 'N', 9, '2012-03-11', 'bafia', '6eme', NULL, 'D2022-5036', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'ADMINISTRATEUR ', 0.00, 0.00, 0.00, 'Non ClassÃ©', 'TCHEKANE ONANA Thomas', 0.00, 0.00, 0.00, 'Non ClassÃ©', NULL, 18.00, 2.00, 36.00, 'Excellent', 'TCHEKANE ONANA Thomas');

-- --------------------------------------------------------

--
-- Structure de la table `view_sequence_1_5eme`
--

CREATE TABLE IF NOT EXISTS `view_sequence_1_5eme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `statut` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `matricule` varchar(20) DEFAULT NULL,
  `eps` float(4,2) DEFAULT NULL,
  `info` float(4,2) DEFAULT NULL,
  `tm` float(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `view_sequence_1_5eme`
--

INSERT INTO `view_sequence_1_5eme` (`id`, `nom`, `id_eleve`, `sexe`, `statut`, `date_naissance`, `matricule`, `eps`, `info`, `tm`) VALUES
(1, 'AMBASSA Ã  NDJAH AdÃ¨le', 10, 'F', 'N', '2012-01-30', 'D2022-574', NULL, NULL, 18.00),
(2, 'DJAM MBITA Boris', 11, 'M', 'N', '2010-01-01', 'D2022-8137', NULL, NULL, 18.00),
(3, 'DJESSONG Calvin', 12, 'M', 'N', '2009-01-16', 'D2022-7758', NULL, NULL, 18.00),
(4, 'EBONG Ã  BEP Magloire', 13, 'M', 'N', '2009-06-16', 'D2022-8346', NULL, NULL, 18.00),
(5, 'GOMBITANG WAM  ', 14, 'F', 'N', '2009-06-18', 'D2022-5351', NULL, NULL, 18.00),
(6, 'GONDIO Edith', 15, 'F', 'N', '2009-04-09', 'D2022-2554', NULL, NULL, 18.00),
(7, 'GUEBEDIANG Marie L ', 16, 'F', 'N', '2008-04-08', 'D2022-8706', NULL, NULL, 18.00),
(8, 'GUEBONG Suzanne', 17, 'F', 'N', '2013-01-01', 'D2022-8594', NULL, NULL, 18.00),
(9, 'MAFIET ANDIORI M', 18, 'F', 'N', '2009-03-07', 'D2022-749', NULL, NULL, 18.00),
(10, 'NWAL BITSONG Abiba', 19, 'F', 'N', '2005-06-14', 'D2022-2740', NULL, NULL, 18.00);

-- --------------------------------------------------------

--
-- Structure de la table `view_sequence_1_6eme`
--

CREATE TABLE IF NOT EXISTS `view_sequence_1_6eme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `statut` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `matricule` varchar(20) DEFAULT NULL,
  `eps` float(4,2) DEFAULT NULL,
  `info` float(4,2) DEFAULT NULL,
  `sc` float(4,2) DEFAULT NULL,
  `tm` float(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `view_sequence_1_6eme`
--

INSERT INTO `view_sequence_1_6eme` (`id`, `nom`, `id_eleve`, `sexe`, `statut`, `date_naissance`, `matricule`, `eps`, `info`, `sc`, `tm`) VALUES
(1, 'ASSEN Ã  BIDIAS Astride Jovana', 3, 'F', 'N', '2011-03-03', 'D2022-6735', NULL, NULL, NULL, 18.00),
(2, 'BIDIAS NWOS Sephora', 4, 'F', 'N', '2010-11-30', 'D2022-1755', NULL, NULL, NULL, 18.00),
(3, 'BIYO HEN Alexandre', 5, 'M', 'N', '2010-09-05', 'D2022-843', NULL, NULL, NULL, 18.00),
(4, 'DIAM NNOCK Maeva', 6, 'F', 'N', '2009-11-25', 'D2022-226', NULL, NULL, NULL, 18.00),
(5, 'MADEN Brigitte', 7, 'F', 'N', '2011-10-08', 'D2022-1661', NULL, NULL, NULL, 18.00),
(6, 'MENTHONG SALIOU  ', 8, 'M', 'N', '2013-01-01', 'D2022-6580', NULL, NULL, NULL, 18.00),
(7, 'NGAE Christian Nicaise', 9, 'F', 'N', '2011-02-02', 'D2022-852', NULL, NULL, NULL, 18.00),
(8, 'NGO PALA Anne Marie', 2, 'F', 'N', '2011-01-20', 'D2022-4075', NULL, NULL, NULL, 18.00),
(9, 'NKIBAN Fortune', 1, 'F', 'N', '2012-03-11', 'D2022-5036', NULL, NULL, NULL, 18.00);
