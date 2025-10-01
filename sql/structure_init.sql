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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



--
-- Structure de la table `classe_principale`
--

DROP TABLE IF EXISTS `classe_principale`;
CREATE TABLE IF NOT EXISTS `classe_principale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prof` varchar(100) NOT NULL,
  `classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



--
-- Structure de la table `statistique`
--

DROP TABLE IF EXISTS `statistique`;
CREATE TABLE IF NOT EXISTS `statistique` (
  `id_classe` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `moyenne_generale` decimal(4,2) NOT NULL,
  `note_faible` decimal(4,2) NOT NULL,
  `note_faible_homme` decimal(4,2) NOT NULL,
  `note_faible_femme` decimal(4,2) NOT NULL,
  `note_forte` decimal(4,2) NOT NULL,
  `note_forte_homme` decimal(4,2) NOT NULL,
  `note_forte_femme` decimal(4,2) NOT NULL,
  `pourcent_reussite` decimal(4,2) NOT NULL,
  `pourcent_homme` decimal(4,2) NOT NULL,
  `pourcent_femme` decimal(4,2) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `statistique`
--

