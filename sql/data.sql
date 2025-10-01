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

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Administrateur', '', 'Mr', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'actif', 'http://localhost/noteplus/images/admin/admin.jpg');




