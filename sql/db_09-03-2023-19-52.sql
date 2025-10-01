-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 09 Mars 2023 à 18:51
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
(5, 'mÃ©diocre', 9, 10, '#FF0000'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `classe_principale`
--

INSERT INTO `classe_principale` (`id`, `prof`, `classe`) VALUES
(4, 'tchekane', '5eme'),
(3, 'tchekane', '6eme'),
(5, 'anglais', '4all');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

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
(64, 'zintchem Ã  bessong', 'sophie', 'F', '2007-03-02', 'bafia', 'D2022-3072', '3esp', '675400828', 'N', 'non_supprime'),
(66, 'jonathan', 'dounia', 'M', '2015-01-01', '00', 'D2023-7877', '4all', '00', 'R', 'supprime');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Administrateur', '', 'Mr', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'actif', 'noteplus/images/admin/admin.jpg'),
(2, 'tchekane onana', 'thomas', 'M', 'prof', 'tchekane', 'e367511624830e0ad8f64fbf6cc09582d04c5f38', 'actif', ''),
(3, 'prof', 'anglais', 'M', 'prof', 'anglais', '1ef51e30e82d6f4de3d53689df68e75e9f909b21', 'actif', ''),
(4, 'prof', 'fr', 'M', 'prof', 'francais', '1d6f6c8c7c784151390f1665410900bc3212ad5d', 'actif', ''),
(5, 'prof', 'histoire', 'M', 'prof', 'histoire', 'a6c3985ce05ad3940c1712348315c81de2eb7e34', 'actif', ''),
(6, 'prof', 'allemand', 'M', 'prof', 'allemand', 'c123eca2ed17bca91c041ae4978ae521d3e5e751', 'actif', ''),
(7, 'prof', 'maths', 'M', 'prof', 'maths', '3529b24dfdbc8cd6390e15f558708c71e1d89b75', 'actif', ''),
(8, 'prof', 'svt', 'M', 'prof', 'svt', '956834138d43bda6b2a9f205b82e599f4c4af238', 'actif', ''),
(9, 'prof', 'pct', 'M', 'prof', 'pct', '7e9aaa26d6b09c893a0849cfb59e9229c23c5532', 'actif', ''),
(10, 'prof', 'eps', 'M', 'prof', 'eps', '85962fc8c09832447405cdbb1a7c3c74e6d13411', 'actif', ''),
(11, 'censeur', ' ', 'M', 'censeur', 'censeur', 'f893f20920f0d0655878d4273c5bb2cfd901c85d', 'actif', ''),
(12, 'sg', ' ', 'M', 'sg', 'sg', 'ff39796487e85a7066e18d814bcb63856de6cfff', 'actif', ''),
(13, 'nyambi ngikwa', 'richard', 'M', 'prof', 'nyambi', '79f6ce076f2320b9d6a4b3f5d33675ef2ebe9f6a', 'actif', ''),
(14, 'biaka beken', ' ', 'M', 'prof', 'biaka', 'aa031d71c2f00adee10eb9a82a3e3d7e1e75eca9', 'actif', ''),
(15, 'moubitang ', 'symphorien', 'M', 'prof', 'moubitang', 'b09fe1e7011424444bcd93007f04fa0ea60478ac', 'actif', ''),
(16, 'nabo ', 'rivoli', 'M', 'prof', 'nabo', '72c50984da34f837de036865e60ebfdc8c43b8b0', 'actif', ''),
(17, 'nkoui', 'simon', 'M', 'prof', 'nkoui', 'b89695b9a8c444163012b767887af59875220ff1', 'actif', '');

-- --------------------------------------------------------

--
-- Structure de la table `fonction_utilisateur`
--

CREATE TABLE IF NOT EXISTS `fonction_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` int(11) NOT NULL,
  `fonction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `fonction_utilisateur`
--


-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_groupe` varchar(255) NOT NULL,
  `code_groupe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id`, `libelle_groupe`, `code_groupe`) VALUES
(1, 'Groupe 1', 'gp1'),
(2, 'Groupe 2', 'gp2'),
(3, 'Groupe 3', 'gp3'),
(4, 'Matières Littéraires', 'litteraire'),
(5, 'Matières Scientifiques', 'scientifique'),
(6, 'Matières Autres', 'autre');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `journal_connexion`
--

INSERT INTO `journal_connexion` (`id`, `utilisateur`, `adresse_ip`, `periode_de_connexion`) VALUES
(1, 'admin', '127.0.0.1', '2022-10-23 14:14:21'),
(2, 'admin', '127.0.0.1', '2022-11-27 05:54:47'),
(3, 'tchekane', '127.0.0.1', '2022-11-27 09:39:48'),
(4, 'admin', '127.0.0.1', '2022-11-27 09:41:00'),
(5, 'admin', '127.0.0.1', '2022-12-01 16:06:23'),
(6, 'tchekane', '127.0.0.1', '2022-12-01 16:07:41'),
(7, 'admin', '127.0.0.1', '2022-12-01 16:09:05'),
(8, 'admin', '127.0.0.1', '2022-12-01 16:18:31'),
(9, 'admin', '127.0.0.1', '2022-12-28 13:29:38'),
(10, 'admin', '192.168.10.30', '2022-12-30 20:22:13'),
(11, 'admin', '127.0.0.1', '2022-12-30 20:29:07'),
(12, 'admin', '192.168.10.20', '2023-01-02 07:58:21'),
(13, 'admin', '127.0.0.1', '2023-01-02 09:55:12'),
(14, 'admin', '127.0.0.1', '2023-01-08 08:45:22'),
(15, 'admin', '127.0.0.1', '2023-01-08 09:48:32'),
(16, 'admin', '127.0.0.1', '2023-01-09 12:49:38'),
(17, 'eps', '127.0.0.1', '2023-01-09 15:51:04'),
(18, 'admin', '127.0.0.1', '2023-01-09 15:51:33'),
(19, 'admin', '127.0.0.1', '2023-01-12 12:52:52'),
(20, 'admin', '127.0.0.1', '2023-02-01 15:48:19'),
(21, 'admin', '127.0.0.1', '2023-02-01 16:06:57'),
(22, 'admin', '127.0.0.1', '2023-02-02 08:41:34'),
(23, 'admin', '127.0.0.1', '2023-02-07 12:41:45'),
(24, 'censeur', '127.0.0.1', '2023-02-07 12:43:21'),
(25, 'admin', '127.0.0.1', '2023-02-07 15:19:05'),
(26, 'admin', '127.0.0.1', '2023-02-07 16:17:45'),
(27, 'admin', '127.0.0.1', '2023-02-08 09:20:23'),
(28, 'admin', '127.0.0.1', '2023-02-09 06:19:50'),
(29, 'admin', '192.168.10.20', '2023-02-09 06:31:35'),
(30, 'admin', '192.168.10.20', '2023-02-09 06:33:40'),
(31, 'admin', '192.168.10.20', '2023-02-09 07:41:13'),
(32, 'admin', '192.168.10.20', '2023-02-09 07:44:36'),
(33, 'admin', '127.0.0.1', '2023-02-10 08:31:28'),
(34, 'admin', '127.0.0.1', '2023-02-10 17:16:53'),
(35, 'admin', '127.0.0.1', '2023-02-11 07:40:58'),
(36, 'admin', '127.0.0.1', '2023-02-12 08:51:39'),
(37, 'admin', '127.0.0.1', '2023-02-12 16:56:37'),
(38, 'admin', '127.0.0.1', '2023-02-13 14:07:02'),
(39, 'admin', '127.0.0.1', '2023-02-13 14:57:35'),
(40, 'admin', '127.0.0.1', '2023-02-13 15:56:41'),
(41, 'admin', '127.0.0.1', '2023-02-14 12:38:28'),
(42, 'admin', '127.0.0.1', '2023-02-15 18:27:50'),
(43, 'admin', '127.0.0.1', '2023-02-16 13:01:11'),
(44, 'biaka', '127.0.0.1', '2023-02-21 12:51:09'),
(45, 'admin', '127.0.0.1', '2023-02-21 12:51:42'),
(46, 'francais', '127.0.0.1', '2023-02-21 12:53:27'),
(47, 'admin', '127.0.0.1', '2023-02-21 12:53:47'),
(48, 'francais', '127.0.0.1', '2023-02-21 12:54:31'),
(49, 'histoire', '127.0.0.1', '2023-02-21 12:58:28'),
(50, 'nkoui', '127.0.0.1', '2023-02-21 13:02:46'),
(51, 'tchekane', '127.0.0.1', '2023-02-21 13:03:35'),
(52, 'svt', '127.0.0.1', '2023-02-21 13:06:32'),
(53, 'nabo', '127.0.0.1', '2023-02-21 13:08:21'),
(54, 'moubitang', '127.0.0.1', '2023-02-21 13:09:04'),
(55, 'biaka', '127.0.0.1', '2023-02-21 13:10:46'),
(56, 'admin', '127.0.0.1', '2023-02-21 13:13:03'),
(57, 'francais', '127.0.0.1', '2023-02-21 13:14:06'),
(58, 'histoire', '127.0.0.1', '2023-02-21 13:16:52'),
(59, 'nkoui', '127.0.0.1', '2023-02-21 13:18:29'),
(60, 'tchekane', '127.0.0.1', '2023-02-21 13:20:41'),
(61, 'svt', '127.0.0.1', '2023-02-21 13:21:31'),
(62, 'nabo', '127.0.0.1', '2023-02-21 13:23:53'),
(63, 'moubitang', '127.0.0.1', '2023-02-21 13:25:11'),
(64, 'biaka', '127.0.0.1', '2023-02-21 13:25:45'),
(65, 'admin', '127.0.0.1', '2023-02-21 14:02:13'),
(66, 'admin', '127.0.0.1', '2023-03-07 12:18:33'),
(67, 'admin', '127.0.0.1', '2023-03-08 14:36:25'),
(68, 'admin', '127.0.0.1', '2023-03-09 14:46:35');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

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
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_menu` varchar(255) NOT NULL,
  `code_menu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id`, `libelle_menu`, `code_menu`) VALUES
(1, 'configuration générale', ''),
(2, 'gestion des notes', 'note.php'),
(3, 'traitement des notes', 'traitementnote.php'),
(4, 'gestion des bulletins', 'bulletin.php'),
(5, 'gestion des statistiques', 'statistique.php');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `note`
--


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
(1, 'S&eacute;quence 1', '0000-00-00', '0000-00-00'),
(2, 'S&eacute;quence 2', '0000-00-00', '0000-00-00'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Contenu de la table `prof_classe`
--

INSERT INTO `prof_classe` (`id`, `id_prof`, `id_classe`, `id_matiere`, `coef`, `groupe`) VALUES
(1, 'moubitang', '6eme', 'tm', '2.0', 'gp3'),
(2, 'svt', '6eme', 'sc', '2.0', 'gp3'),
(3, 'tchekane', '6eme', 'info', '2.0', 'gp2'),
(4, 'tchekane', '5eme', 'info', '2.0', 'gp2'),
(5, '', '4esp', 'info', '2.0', 'gp2'),
(6, 'tchekane', '4all', 'info', '2.0', 'gp2'),
(7, '', '3esp', 'info', '2.0', 'gp2'),
(8, '', '3all', 'info', '2.0', 'gp2'),
(9, 'tchekane', '5eme', 'tm', '2.0', 'gp3'),
(10, '', '4esp', 'tm', '2.0', 'gp3'),
(11, 'eps', '4all', 'tm', '2.0', 'gp3'),
(12, '', '3esp', 'tm', '2.0', 'gp3'),
(13, '', '3all', 'tm', '2.0', 'gp3'),
(14, 'biaka', '6eme', 'eps', '2.0', 'gp3'),
(15, '', '5eme', 'eps', '2.0', 'gp3'),
(16, '', '4esp', 'eps', '2.0', 'gp3'),
(17, 'eps', '4all', 'eps', '2.0', 'gp3'),
(18, '', '3esp', 'eps', '2.0', 'gp3'),
(19, '', '3all', 'eps', '2.0', 'gp3'),
(20, 'pct', '4all', 'pct', '3.0', 'gp2'),
(21, 'svt', '4all', 'svt', '2.0', 'gp2'),
(22, 'maths', '4all', 'maths', '4.0', 'gp2'),
(23, 'allemand', '4all', 'all', '3.0', 'gp1'),
(24, 'histoire', '4all', 'ecm', '2.0', 'gp1'),
(25, 'histoire', '4all', 'geo', '2.0', 'gp1'),
(26, 'histoire', '4all', 'hist', '2.0', 'gp1'),
(27, 'francais', '4all', 'corr_orth', '1.0', 'gp1'),
(28, 'francais', '4all', 'etx', '1.0', 'gp1'),
(29, 'francais', '4all', 'exp_ecr', '2.0', 'gp1'),
(30, 'francais', '4all', 'exp_or', '2.0', 'gp1'),
(31, 'anglais', '4all', 'ang', '3.0', 'gp1'),
(33, 'francais', '6eme', 'corr_orth', '1.0', 'gp1'),
(34, 'francais', '6eme', 'etx', '1.0', 'gp1'),
(35, 'francais', '6eme', 'exp_ecr', '2.0', 'gp1'),
(36, 'francais', '6eme', 'exp_or', '2.0', 'gp1'),
(37, 'histoire', '6eme', 'geo', '2.0', 'gp1'),
(38, 'histoire', '6eme', 'hist', '2.0', 'gp1'),
(39, 'histoire', '6eme', 'ecm', '2.0', 'gp1'),
(40, 'nkoui', '6eme', 'ang', '3.0', 'gp1'),
(41, 'nabo', '6eme', 'maths', '4.0', 'gp2');

-- --------------------------------------------------------

--
-- Structure de la table `sous_menu`
--

CREATE TABLE IF NOT EXISTS `sous_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `libelle_sous_menu` varchar(255) NOT NULL,
  `code_sous_menu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `sous_menu`
--

INSERT INTO `sous_menu` (`id`, `menu`, `libelle_sous_menu`, `code_sous_menu`) VALUES
(1, 1, 'eleve', 'AZERTY'),
(2, 1, 'classe', ''),
(3, 1, 'matiere', ''),
(4, 1, 'enseignant', ''),
(5, 1, 'periode', ''),
(6, 1, 'note', '');

-- --------------------------------------------------------

--
-- Structure de la table `type_fonction`
--

CREATE TABLE IF NOT EXISTS `type_fonction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  `sous_menu` varchar(255) NOT NULL,
  `libelle_fonction` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `type_fonction`
--


-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_utilisateur` varchar(255) NOT NULL,
  `code_utilisateur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`id`, `libelle_utilisateur`, `code_utilisateur`) VALUES
(1, 'administrateur', 'admin'),
(2, 'censeur', 'censeur'),
(3, 'enseignant', 'prof'),
(4, 'surveillant général', 'sg'),
(5, 'chef', 'poviseur');
