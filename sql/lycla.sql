-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 07 Octobre 2024 à 01:15
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lycla`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `date_absence` date DEFAULT NULL,
  `nombre_heure` int(11) NOT NULL,
  `justification` varchar(100) NOT NULL COMMENT 'AJ ou ANJ'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

CREATE TABLE `annee_scolaire` (
  `id` int(11) NOT NULL,
  `libelle_annee` varchar(100) NOT NULL,
  `statut` varchar(100) NOT NULL COMMENT 'actif, inactif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `annee_scolaire`
--

INSERT INTO `annee_scolaire` (`id`, `libelle_annee`, `statut`) VALUES
(1, '2024 / 2025', 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `appreciation`
--

CREATE TABLE `appreciation` (
  `id` int(11) NOT NULL,
  `nom_appreciation` varchar(255) NOT NULL,
  `cote` varchar(100) NOT NULL,
  `interv_ouvert` int(2) NOT NULL COMMENT 'note de debut',
  `interv_fermet` int(2) NOT NULL COMMENT 'note de fin',
  `couleur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appreciation`
--

INSERT INTO `appreciation` (`id`, `nom_appreciation`, `cote`, `interv_ouvert`, `interv_fermet`, `couleur`) VALUES
(1, 'CNA', 'D', 0, 10, '#FF0000'),
(2, 'CMA', 'C', 10, 12, '#00FF00'),
(3, 'CA', 'C+', 12, 14, '#00FF00'),
(4, 'CBA', 'B', 14, 15, '#0000FF'),
(5, 'CBA', 'B+', 15, 16, '#0000FF'),
(6, 'CTBA', 'A', 16, 18, '#0000FF'),
(7, 'CTBA', 'A+', 18, 20, '#0000FF');

-- --------------------------------------------------------

--
-- Structure de la table `bull_ann`
--

CREATE TABLE `bull_ann` (
  `id` int(11) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `pret` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bull_trim`
--

CREATE TABLE `bull_trim` (
  `id` int(11) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `pret` varchar(5) NOT NULL,
  `trim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom_classe` varchar(255) NOT NULL,
  `code_classe` varchar(100) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id`, `nom_classe`, `code_classe`, `etat`, `niveau`) VALUES
(1, 'SixiÃ¨me A', '6A', 'actif', '6eme'),
(2, 'SixiÃ¨me B', '6b', 'actif', '6eme'),
(3, 'SixiÃ¨me C', '6c', 'actif', '6eme'),
(4, 'SixiÃ¨me D', '6d', 'actif', '6eme'),
(5, 'CinquiÃ¨me A', '5A', 'actif', '5eme'),
(6, 'CinquiÃ¨me B', '5B', 'actif', '5eme'),
(7, 'CinquiÃ¨me C', '5C', 'actif', '5eme'),
(8, 'CinquiÃ¨me D', '5D', 'actif', '5eme'),
(9, 'QuatriÃ¨me A-Allemand', '4A', 'actif', '4eme'),
(10, 'QuatriÃ¨me B-Arabe', '4B-ara', 'actif', '4eme'),
(11, 'QuatriÃ¨me B-Chinois', '4B-chi', 'actif', '4eme'),
(12, 'QuatriÃ¨me C-Espagnol', '4C', 'actif', '4eme'),
(13, 'QuatriÃ¨me D-Espagnol', '4D', 'actif', '4eme'),
(15, 'TroisiÃ¨me A-Allemand', '3A-ALL', 'actif', '3eme'),
(16, 'TroisÃ¨me B-ARABE', '3B-ara', 'actif', '3eme'),
(17, 'TroisiÃ¨me B-Chinois', '3B-chi', 'actif', '3eme'),
(18, 'TroisiÃ¨me C-Espagnol', '3C-esp', 'actif', '3eme'),
(19, 'TroisiÃ¨me D-Espagnol', '3d-esp', 'actif', '3eme'),
(20, 'Seconde C', '2c', 'actif', '2nde'),
(21, 'Seconde A1-Allemand', '2a1-all', 'actif', '2nde'),
(22, 'Seconde A2-Espagnol', '2a2-esp', 'actif', '2nde'),
(23, 'Seconde A3-Espagnol', '2a3-esp', 'actif', '2nde'),
(24, 'Seconde Arabe', '2ara', 'actif', '2nde'),
(25, 'Seconde Chinoise', '2chi', 'actif', '2nde'),
(26, 'Premiere A1-Allemand', '1a1-all', 'actif', '1ere'),
(27, 'Premiere A2-Espagnol', '1a2-esp', 'actif', '1ere'),
(28, 'Premiere A3-Espagnol', '1a3-esp', 'actif', '1ere'),
(29, 'PremiÃ¨re A4-Espagnol', '1a4-esp', 'actif', '1ere'),
(30, 'PremiÃ¨re Arabe', '1ara', 'actif', '1ere'),
(31, 'Premiere Chinoise', '1chi', 'actif', '1ere'),
(32, 'Premiere C', '1c', 'actif', '1ere'),
(33, 'Premiere D', '1d', 'actif', '1ere'),
(34, 'Premiere TI', '1ti', 'actif', '1ere'),
(35, 'Terminale A1-Allemand', 'ta1-all', 'actif', 'tle'),
(36, 'Terminale A2-Espagnol', 'ta2-esp', 'actif', 'tle'),
(37, 'Terminale A3-Espagnol', 'ta3-esp', 'actif', 'tle'),
(38, 'Terminale A4-Espagnol', 'ta4-esp', 'actif', 'tle'),
(39, 'Terminale Arabe', 't-ara', 'actif', 'tle'),
(40, 'Terminale Chinoise', 't-chi', 'actif', 'tle'),
(41, 'Terminale C', 'tc', 'actif', 'tle'),
(42, 'Terminale D', 'td', 'actif', 'tle'),
(43, 'Terminale TI', 'tti', 'actif', 'tle');

-- --------------------------------------------------------

--
-- Structure de la table `classe_principale`
--

CREATE TABLE `classe_principale` (
  `id` int(11) NOT NULL,
  `prof` varchar(100) NOT NULL,
  `classe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `date_absences`
--

CREATE TABLE `date_absences` (
  `id` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `open_date` date NOT NULL COMMENT 'date ouverture',
  `close_date` date NOT NULL COMMENT 'date_fermeture'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `rne` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(1) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `matricule` varchar(20) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `adresse_parent` varchar(255) DEFAULT NULL,
  `statut` varchar(100) NOT NULL COMMENT 'red, nv',
  `num_rand` int(11) NOT NULL COMMENT 'on recupere sa val pour increm',
  `etat` varchar(100) NOT NULL COMMENT 'supprimÃ© ou pas',
  `nom_pere` varchar(255) NOT NULL COMMENT 'papa du bb',
  `nom_mere` varchar(255) NOT NULL COMMENT 'mama du bb',
  `photo` varchar(255) NOT NULL COMMENT 'adresse de la photo Ã©lÃ¨ve',
  `a_s` varchar(11) NOT NULL COMMENT 'annee scolaire'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `rne`, `nom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `matricule`, `classe`, `adresse_parent`, `statut`, `num_rand`, `etat`, `nom_pere`, `nom_mere`, `photo`, `a_s`) VALUES
(1, 241174374, 'ABEGA TOBE ARMEL TOWAN', '', 'M', '2013-03-13', 'BAFIA', 'S20240003', '6A', '', 'N', 1, 'non_supprime', '', '', '', '2024 / 2025'),
(2, 241174377, 'ABESSOUGUIE NKONO PROSPER DEOGRACE', '', 'M', '2011-01-23', 'BAFIA', 'S20240004', '6A', '', 'N', 2, 'non_supprime', '', '', '', '2024 / 2025'),
(3, 241174380, 'ABIHANGA OBIOYE ALEX FELIX', '', 'M', '2024-08-25', 'Y', 'S20240604', '6A', '', 'N', 3, 'non_supprime', '', '', '', '2024 / 2025'),
(4, 241174383, 'ABOH a ABOH DOVAN', '', 'M', '2016-02-02', 'BAFIA', 'S20240005', '6A', '', 'N', 4, 'non_supprime', '', '', '', '2024 / 2025'),
(5, 241174386, 'ADOUGUE ADZENA FALONNE', '', 'F', '2013-11-04', 'GOURA', 'S20242013', '6A', '', 'N', 5, 'non_supprime', '', '', '', '2024 / 2025'),
(6, 241174389, 'AGNOUNG a SOMEN ANGE GRACE', '', 'F', '2013-01-26', 'BAFIA', 'S20242405', '6A', '', 'N', 6, 'non_supprime', '', '', '', '2024 / 2025'),
(7, 241174392, 'AGOUME a NWAMEKANG GABRIELLA', '', 'F', '2014-06-22', 'YAOUNDe 5e', 'S20242014', '6A', '', 'N', 7, 'non_supprime', '', '', '', '2024 / 2025'),
(8, 241174395, 'BALIANG ABOUH CATHeRINE RICHELLE', '', 'F', '2015-01-09', 'BAFIA', 'S20242523', '6A', '', 'N', 8, 'non_supprime', '', '', '', '2024 / 2025'),
(9, 241174398, 'BIDIAS ADEYEKA MICHEL ARCHANGE PRINCE', '', 'M', '2013-02-03', 'BAFIA', 'S20242526', '6A', '', 'N', 9, 'non_supprime', '', '', '', '2024 / 2025'),
(10, 241174401, 'BIYO''O TINA PAUL JORDAN', '', 'M', '2012-09-29', 'NKOIENG', 'S20242064', '6A', '', 'N', 10, 'non_supprime', '', '', '', '2024 / 2025'),
(11, 241174404, 'BOBO SODEA KEDI WARREN', '', 'M', '2013-08-08', 'BAFIA', 'S20242065', '6A', '', 'N', 11, 'non_supprime', '', '', '', '2024 / 2025'),
(12, 241174407, 'BOGNING LONTSI REINE PASCALINE', '', 'F', '2013-06-02', 'BAFIA', 'S20242066', '6A', '', 'N', 12, 'non_supprime', '', '', '', '2024 / 2025'),
(13, 241174410, 'BONG ALEXIA KEREN', '', 'F', '2014-08-31', 'YAOUNDï¿½ 5', 'S20242219', '6A', '', 'N', 13, 'non_supprime', '', '', '', '2024 / 2025'),
(14, 241174413, 'BONG RIBOUEM GRACEPRISCILIA', '', 'F', '2013-06-11', 'BAFIA', 'S20242067', '6A', '', 'N', 14, 'non_supprime', '', '', '', '2024 / 2025'),
(15, 241174416, 'BONGOGNE BONDOMA LIONEL BRAYAN', '', 'M', '2015-07-10', 'BAFIA', 'S20242068', '6A', '', 'N', 15, 'non_supprime', '', '', '', '2024 / 2025'),
(16, 241174419, 'BOUSSI BYAN BOBBY', '', 'M', '2012-11-02', 'BAFIA', 'S20242671', '6A', '', 'N', 16, 'non_supprime', '', '', '', '2024 / 2025'),
(17, 241174422, 'COCO AMBADIANG FALONE', '', 'F', '2013-07-29', 'BAFIA', 'S20242071', '6A', '', 'N', 17, 'non_supprime', '', '', '', '2024 / 2025'),
(18, 241174425, 'DJANGANG LEUGUE JOACHIM GUIMEL', '', 'M', '2013-03-10', 'BERTOUA', 'S20242074', '6A', '', 'N', 18, 'non_supprime', '', '', '', '2024 / 2025'),
(19, 241174428, 'DJEBEN a MOUBITANG ALAN ', '', 'M', '2013-02-28', 'BANGONG', 'S20242075', '6A', '', 'N', 19, 'non_supprime', '', '', '', '2024 / 2025'),
(20, 241174431, 'DJOYA DJOMGOUE LAURAINNE TRECY', '', 'F', '2012-08-14', 'BAFIA', 'S20242076', '6A', '', 'N', 20, 'non_supprime', '', '', '', '2024 / 2025'),
(21, 241174434, 'DON LAURYX MERVEILLE', '', 'F', '2012-06-04', 'MBANKOMO', 'S20242077', '6A', '', 'N', 21, 'non_supprime', '', '', '', '2024 / 2025'),
(22, 241174437, 'DONG PRISO ELIE ROCHEL', '', 'M', '2014-09-21', 'DOUALA', 'S20242078', '6A', '', 'N', 22, 'non_supprime', '', '', '', '2024 / 2025'),
(23, 241174440, 'DONGMO BRUNEL VALDEZ', '', 'M', '2012-09-15', 'BALEVENG', 'S20242079', '6A', '', 'N', 23, 'non_supprime', '', '', '', '2024 / 2025'),
(24, 241174443, 'DOUNZI a BIDIAS ANNE CHERIE LAURE', '', 'F', '2013-12-07', 'BAFIA', 'S20242081', '6A', '', 'N', 24, 'non_supprime', '', '', '', '2024 / 2025'),
(25, 241174446, 'DOUSSILE BIYAGA APPoLINE AUDE', '', 'F', '2013-09-02', 'BAFIA', 'S20242082', '6A', '', 'N', 25, 'non_supprime', '', '', '', '2024 / 2025'),
(26, 241174449, 'EFFOUDOU EFFOUDOU PATRICIA', '', 'F', '2013-01-27', 'YAOUNDE', 'S20242083', '6A', '', 'N', 26, 'non_supprime', '', '', '', '2024 / 2025'),
(27, 241174452, 'EKOUMA BITENG SAMUEL ROMARIC', '', 'M', '2012-11-15', 'NTUI', 'S20242085', '6A', '', 'N', 27, 'non_supprime', '', '', '', '2024 / 2025'),
(28, 241174455, 'ELIBIEN MAKON DANIELLE', '', 'F', '2014-11-12', 'OMBESSA', 'S20242086', '6A', '', 'N', 28, 'non_supprime', '', '', '', '2024 / 2025'),
(29, 241174458, 'ELLA ELLA MAX LIONEL', '', 'M', '2011-02-13', 'BAFIA', 'S20242087', '6A', '', 'N', 29, 'non_supprime', '', '', '', '2024 / 2025'),
(30, 241174461, 'EVINA AYISSI ERIC LANDRY', '', 'M', '2013-05-27', 'DOUALA', 'S20242089', '6A', '', 'N', 30, 'non_supprime', '', '', '', '2024 / 2025'),
(31, 241174464, 'EVODO ASSANGA MARIE PRICILLIA', '', 'F', '2016-10-13', 'MBAZOA', 'S20242090', '6A', '', 'N', 31, 'non_supprime', '', '', '', '2024 / 2025'),
(32, 241174467, 'FAPON POKAM EUGeNE AUREL', '', 'M', '2014-02-01', 'PENKA MICHEL', 'S20242091', '6A', '', 'N', 32, 'non_supprime', '', '', '', '2024 / 2025'),
(33, 241174470, 'GUEBEDIANG ALIMA', '', 'F', '2012-12-17', 'YAKAN', 'S20242632', '6A', '', 'N', 33, 'non_supprime', '', '', '', '2024 / 2025'),
(34, 241174473, 'KEGOUL À BABAN PRINCESSE JOYEE', '', 'F', '2012-06-07', 'BAFIA', 'S20242193', '6A', '', 'N', 34, 'non_supprime', '', '', '', '2024 / 2025'),
(35, 241174476, 'KEKOULI GAELLE NICAISE', '', 'F', '2014-09-06', 'GUIENTSING II', 'S20242194', '6A', '', 'N', 35, 'non_supprime', '', '', '', '2024 / 2025'),
(36, 241174479, 'KENMIE ANNAELLE DAINA', '', 'F', '2015-07-03', 'YAOUNDÉ', 'S20242195', '6A', '', 'N', 36, 'non_supprime', '', '', '', '2024 / 2025'),
(37, 241174482, 'KESSENG AKANDA NAVELIE', '', 'F', '2013-04-24', 'BAFIA', 'S20242196', '6A', '', 'N', 37, 'non_supprime', '', '', '', '2024 / 2025'),
(38, 241174485, 'KEUFA TATIENOU NEOLYN LYS LAFOI', '', 'F', '2014-08-25', 'BAFIA', 'S20242197', '6A', '', 'N', 38, 'non_supprime', '', '', '', '2024 / 2025'),
(39, 241174488, 'KIDEING ZOK LIONEL', '', 'M', '2010-05-11', 'BOKO', 'S20232274', '6A', '', 'R', 39, 'non_supprime', '', '', '', '2024 / 2025'),
(40, 241174491, 'KINYUY NSOBEY THERESE', '', 'F', '2012-12-04', 'OMBESSA', 'S20242198', '6A', '', 'N', 40, 'non_supprime', '', '', '', '2024 / 2025'),
(41, 241174494, 'KOSSOCK PRINCINITA LISLONE', '', 'F', '2014-01-21', 'KOMBOU', 'S20242199', '6A', '', 'N', 41, 'non_supprime', '', '', '', '2024 / 2025'),
(42, 241174497, 'KOUND DJEUBANG NAFISATOU', '', 'F', '2014-07-16', 'DOUALA', 'S20242201', '6A', '', 'N', 42, 'non_supprime', '', '', '', '2024 / 2025'),
(43, 241174500, 'KUETI BOUNGO MARCELLE SERA', '', 'F', '2013-04-27', 'BAFIA', 'S20242202', '6A', '', 'N', 43, 'non_supprime', '', '', '', '2024 / 2025'),
(44, 241174503, 'MARIE EMMACULÉE EMANUELIE BOPDA NGON', '', 'F', '2014-06-07', 'BAFIA', 'S20242211', '6A', '', 'N', 44, 'non_supprime', '', '', '', '2024 / 2025'),
(45, 241174506, 'MATCHAN À MOUTHE MAHOMEY', '', 'M', '2013-04-23', 'BAFIA', 'S20242213', '6A', '', 'N', 45, 'non_supprime', '', '', '', '2024 / 2025'),
(46, 241174509, 'MBA MEBESSO CHRIST', '', 'M', '2013-12-01', 'BAFIA', 'S20242216', '6A', '', 'N', 46, 'non_supprime', '', '', '', '2024 / 2025'),
(47, 241174512, 'MBALLA MPAMAGA BERTHE NAVINA', '', 'F', '2013-02-28', 'BAFIA', 'S20242217', '6A', '', 'N', 47, 'non_supprime', '', '', '', '2024 / 2025'),
(48, 241174515, 'MPFOUNDE SIADE MEDINA BERNADETTE', '', 'F', '2012-06-18', 'BAFIA', 'S20242255', '6A', '', 'N', 48, 'non_supprime', '', '', '', '2024 / 2025'),
(49, 241174518, 'MPON JOSS PAULIN', '', 'M', '2012-11-02', 'BAFIA', 'S20242274', '6A', '', 'N', 49, 'non_supprime', '', '', '', '2024 / 2025'),
(50, 241174521, 'MPONO ODILE FLORE', '', 'F', '2011-01-23', 'BOURAKA', 'S20240001', '6A', '', 'N', 50, 'non_supprime', '', '', '', '2024 / 2025'),
(51, 241174524, 'NDANG NAM LUMEN JACQUELINE FLEUR', '', 'F', '2009-05-10', 'YAOUNDÉ', 'S20242275', '6A', '', 'N', 51, 'non_supprime', '', '', '', '2024 / 2025'),
(52, 241174527, 'NDJENGUE FORTUNE LEONA', '', 'F', '2013-05-19', 'YAOUNDÉ', 'S20242278', '6A', '', 'N', 52, 'non_supprime', '', '', '', '2024 / 2025'),
(53, 241174530, 'NDJI SONG EMILIE CLOYER KEYINA', '', 'F', '2012-09-25', 'NGORO', 'S20242279', '6A', '', 'N', 53, 'non_supprime', '', '', '', '2024 / 2025'),
(54, 241174533, 'NDONG MBASSA PASCAL LEBON', '', 'M', '2012-02-13', 'BAFIA', 'S20242280', '6A', '', 'N', 54, 'non_supprime', '', '', '', '2024 / 2025'),
(55, 241174536, 'NEKA ANGELINE', '', 'F', '2010-10-25', 'NYAMZOM', 'S20242541', '6A', '', 'N', 55, 'non_supprime', '', '', '', '2024 / 2025'),
(56, 241174539, 'NGA MELANIE FLORENCE', '', 'F', '2012-05-29', 'NYAHO', 'S20242281', '6A', '', 'N', 56, 'non_supprime', '', '', '', '2024 / 2025'),
(57, 241174542, 'NGNENEDONG MGBATOU JUNIOR LEJUSTE', '', 'M', '2015-04-07', 'BAFIA', 'S20242283', '6A', '', 'N', 57, 'non_supprime', '', '', '', '2024 / 2025'),
(58, 241174545, 'NGOULOUGUE FRANCK BLAISE SHADRACK', '', 'M', '2012-10-22', 'NINGDANG', 'S20242403', '6A', '', 'N', 58, 'non_supprime', '', '', '', '2024 / 2025'),
(59, 241174548, 'NNA GOUM FERNANDAISE', '', 'F', '2012-04-22', 'ZOCK-MONTAGNE', 'S20242294', '6A', '', 'N', 59, 'non_supprime', '', '', '', '2024 / 2025'),
(60, 241174551, 'ONAÏNA NDEM MARIE LOUISE', '', 'F', '2013-12-04', 'ASSALA', 'S20242314', '6A', '', 'N', 60, 'non_supprime', '', '', '', '2024 / 2025'),
(61, 241174554, 'ONANA JULES HOLY ANAËL', '', 'M', '2014-12-05', 'GUIENTSING I', 'S20242315', '6A', '', 'N', 61, 'non_supprime', '', '', '', '2024 / 2025'),
(62, 241174557, 'ONGMOES BABAGNACK PRISCILLE', '', 'F', '2013-05-09', 'YAOUNDÉ', 'S20242316', '6A', '', 'N', 62, 'non_supprime', '', '', '', '2024 / 2025'),
(63, 241174560, 'RIMO À NGON FRIQUETTE', '', 'F', '2010-08-02', 'BAFIA', 'S20242522', '6A', '', 'N', 63, 'non_supprime', '', '', '', '2024 / 2025'),
(64, 241174563, 'SALAMATOU ALI', '', 'F', '2013-06-13', 'BAFIA', 'S20242327', '6A', '', 'N', 64, 'non_supprime', '', '', '', '2024 / 2025'),
(65, 241174566, 'SAPAH GOPPÉ ROSINE STÉPHANE', '', 'F', '2009-02-04', 'MPOUGA', 'S20242655', '6A', '', 'N', 65, 'non_supprime', '', '', '', '2024 / 2025'),
(66, 241174569, 'TANKAM À NGUETO FERNAND SUPPRISE', '', 'M', '2014-10-05', 'GBWAH', 'S20242407', '6A', '', 'N', 66, 'non_supprime', '', '', '', '2024 / 2025'),
(67, 241174572, 'TCHOPE DJIMADEU ESTHER SILOE', '', 'F', '2013-01-20', 'BAFIA', 'S20242132', '6A', '', 'N', 67, 'non_supprime', '', '', '', '2024 / 2025'),
(68, 241174575, 'TCHOUBOUM A MEREM CHRISTIANA LAREINE', '', 'F', '2013-12-25', 'BAFIA', 'S20242133', '6A', '', 'N', 68, 'non_supprime', '', '', '', '2024 / 2025'),
(69, 241174578, 'TCHOUNGA MBATENG OTHNIEL AMOUR', '', 'M', '2014-04-23', 'BAFIA', 'S20242134', '6A', '', 'N', 69, 'non_supprime', '', '', '', '2024 / 2025'),
(70, 241174581, 'TSOA IRANGOU ALICE', '', 'F', '2012-09-29', 'MBANGASSINA', 'S20242408', '6A', '', 'N', 70, 'non_supprime', '', '', '', '2024 / 2025'),
(71, 241175325, 'ABOUEM a BIRAM JUSTIN ARCHANGE BRAYAN', '', 'M', '2014-12-06', 'BAFIA', 'S20240007', '6b', '', 'N', 71, 'non_supprime', '', '', '', '2024 / 2025'),
(72, 241175406, 'ADALA ANEGOUE ANTOINE CHRISTIAN', '', 'M', '2012-06-22', 'BAFIA', 'S20240008', '6b', '', 'N', 72, 'non_supprime', '', '', '', '2024 / 2025'),
(73, 241175409, 'ADIBEYI a DANG SAMIRA KADJIDJA', '', 'F', '2013-10-01', 'BAFIA', 'S20240009', '6b', '', 'N', 73, 'non_supprime', '', '', '', '2024 / 2025'),
(74, 241175412, 'ADIBON ATANGANA AGATHE LUMILA', '', 'F', '2013-10-26', 'OUAI', 'S20240010', '6b', '', 'N', 74, 'non_supprime', '', '', '', '2024 / 2025'),
(75, 241175415, 'ADIGNAGNA ASSIENE MELVINE JESSICA', '', 'F', '2013-10-23', 'GOUIFE', 'S20240011', '6b', '', 'N', 75, 'non_supprime', '', '', '', '2024 / 2025'),
(76, 241175418, 'ALLIBONG a MOUDIO FORD EPIPHANIE', '', 'F', '2011-08-18', 'HD DE BAFIA', 'S20242531', '6b', '', 'N', 76, 'non_supprime', '', '', '', '2024 / 2025'),
(77, 241175421, 'AMANTSANG RIBOUEM GLORIA MARGUERITE', '', 'F', '2014-05-26', 'RIBANG', 'S20242018', '6b', '', 'N', 77, 'non_supprime', '', '', '', '2024 / 2025'),
(78, 241175424, 'AMASSANA EMOSSI JOSEPH BENJAMIN', '', 'M', '2014-01-21', 'BOKITO', 'S20242019', '6b', '', 'N', 78, 'non_supprime', '', '', '', '2024 / 2025'),
(79, 241175427, 'AMBATATIA CHRIST ALEXANDRE LAEL', '', 'M', '2012-02-14', 'BAFIA', 'S20242022', '6b', '', 'N', 79, 'non_supprime', '', '', '', '2024 / 2025'),
(80, 241175430, 'AMINATOU CHEFOU ', '', 'F', '2011-01-19', 'OMBESSA', 'S20242024', '6b', '', 'N', 80, 'non_supprime', '', '', '', '2024 / 2025'),
(81, 241175433, 'ANDERA NDJOULI DJORDANE', '', 'M', '2010-02-12', 'BANDA', 'S20242025', '6b', '', 'N', 81, 'non_supprime', '', '', '', '2024 / 2025'),
(82, 241175436, 'ANONG JOANE MARQUAISE', '', 'F', '2011-09-28', 'BAFIA', 'S20242027', '6b', '', 'N', 82, 'non_supprime', '', '', '', '2024 / 2025'),
(83, 241175439, 'ASSEN NOAH ANGE DIVINE SHEKINA', '', 'F', '2013-04-24', 'BAFIA', 'S20242030', '6b', '', 'N', 83, 'non_supprime', '', '', '', '2024 / 2025'),
(84, 241175442, 'ASSENA SANDRA OLIVIA', '', 'F', '2014-01-30', 'BAFIA', 'S20242031', '6b', '', 'N', 84, 'non_supprime', '', '', '', '2024 / 2025'),
(85, 241175445, 'AYABA MBALLA MARGUERITE LAFLEUR', '', 'F', '2013-12-17', 'DEUK', 'S20242417', '6b', '', 'N', 85, 'non_supprime', '', '', '', '2024 / 2025'),
(86, 241175448, 'BEBOUNG ABADOMA CHRISTIAN LeONEL', '', 'M', '2010-02-28', 'TALBA', 'S20222081', '6b', '', 'R', 86, 'non_supprime', '', '', '', '2024 / 2025'),
(87, 241175451, 'BIDOUA CHAKOANA AILYNE', '', 'F', '2015-03-06', 'BAFIA', 'S20241809', '6b', '', 'N', 87, 'non_supprime', '', '', '', '2024 / 2025'),
(88, 241175454, 'BILE BESSALA MARCEL NADAL', '', 'M', '2011-04-22', 'HOPITAL DE SOA', 'S20242061', '6b', '', 'N', 88, 'non_supprime', '', '', '', '2024 / 2025'),
(89, 0, 'EBANGA BONGUEN ETIENNE ARTHUR', '', 'M', '2011-05-23', 'BAFIA', 'S20242673', '6b', '', 'N', 89, 'non_supprime', '', '', '', '2024 / 2025'),
(90, 241175460, 'ESSONG ANALANG LUCRECE THECLAIRE ', '', 'F', '2015-05-02', 'SOA', 'S20242088', '6b', '', 'N', 90, 'non_supprime', '', '', '', '2024 / 2025'),
(91, 241175463, 'FEULEFACK a BIHAMBE EZEKIEL', '', 'M', '2015-04-11', 'SANTCHOU', 'S20242093', '6b', '', 'N', 91, 'non_supprime', '', '', '', '2024 / 2025'),
(92, 241175466, 'FEUNTCHOU DJIMEU NAOMIE NATACHA', '', 'F', '2014-05-10', 'BAFIA', 'S20242094', '6b', '', 'N', 92, 'non_supprime', '', '', '', '2024 / 2025'),
(93, 241175469, 'FOUEGHO NGUEMO AROLD', '', 'M', '2013-01-01', 'BAFIA', 'S20242095', '6b', '', 'N', 93, 'non_supprime', '', '', '', '2024 / 2025'),
(94, 241175472, 'FOYET BAFIEK MARIE REINE', '', 'F', '2013-10-10', 'BAFIA', 'S20242096', '6b', '', 'N', 94, 'non_supprime', '', '', '', '2024 / 2025'),
(95, 241175475, 'GLORIA MADELEINE AROMO OLINGA', '', 'F', '2012-06-28', 'CMA DE DEUK', 'S20242097', '6b', '', 'N', 95, 'non_supprime', '', '', '', '2024 / 2025'),
(96, 241175478, 'GOUFAN MERVEILLES', '', 'F', '2012-03-20', 'BAFIA', 'S20242098', '6b', '', 'N', 96, 'non_supprime', '', '', '', '2024 / 2025'),
(97, 241175481, 'GOUFAN NNOUKA DAVID', '', 'M', '2013-03-29', 'BAFIA', 'S20242099', '6b', '', 'N', 97, 'non_supprime', '', '', '', '2024 / 2025'),
(98, 241175484, 'KAMBEING SAMBANG MARIE', '', 'F', '2012-06-20', 'MOUZI', 'S20242684', '6b', '', 'N', 98, 'non_supprime', '', '', '', '2024 / 2025'),
(99, 241175487, 'KAMYIM MELI ANGE DAROCHE', '', 'F', '2013-05-31', 'BAFIA', 'S20241116', '6b', '', 'N', 99, 'non_supprime', '', '', '', '2024 / 2025'),
(100, 241175490, 'KAPJIO MPeMe LUCAS DANIEL', '', 'M', '2012-02-09', 'NTUI', 'S20242409', '6b', '', 'N', 100, 'non_supprime', '', '', '', '2024 / 2025'),
(101, 241175493, 'KEMAJOU NGANDJOU DAVID NALA', '', 'F', '2014-05-21', 'BAMBILI', 'S20242388', '6b', '', 'N', 101, 'non_supprime', '', '', '', '2024 / 2025'),
(102, 241175496, 'KEMEGNI FRESHNEL TRÉSOR', '', 'M', '2013-08-07', 'BAFIA', 'S20240586', '6b', '', 'N', 102, 'non_supprime', '', '', '', '2024 / 2025'),
(103, 241175499, 'LONTSI TEDONGMO NELSON', '', 'M', '2014-12-15', 'BATCHAM', 'S20242203', '6b', '', 'N', 103, 'non_supprime', '', '', '', '2024 / 2025'),
(104, 241175502, 'LONTSI TSAGUE ARCHANGE', '', 'F', '2013-12-05', 'BAFIA', 'S20242204', '6b', '', 'N', 104, 'non_supprime', '', '', '', '2024 / 2025'),
(105, 241175505, 'MAGON À TAAH EMMANUELLE SHARONNE', '', 'F', '2012-06-09', 'BAFIA', 'S20242207', '6b', '', 'N', 105, 'non_supprime', '', '', '', '2024 / 2025'),
(106, 241175508, 'MAPEL À NNOUKA MAXIMILIEN JOES', '', 'M', '2015-02-22', 'KIIKI', 'S20242209', '6b', '', 'N', 106, 'non_supprime', '', '', '', '2024 / 2025'),
(107, 241175511, 'MAPWONG À ITHIIONG ADELAIDE', '', 'F', '2011-01-01', 'YAOUNDÉ', 'S20242210', '6b', '', 'N', 107, 'non_supprime', '', '', '', '2024 / 2025'),
(108, 241175514, 'MATCHAN EKOUEY MOHAMADOU JUNIOR', '', 'M', '2013-01-23', 'BAFIA', 'S20242214', '6b', '', 'N', 108, 'non_supprime', '', '', '', '2024 / 2025'),
(109, 241175517, 'MAYO MANGA NDOBE FADIMATOU', '', 'F', '2013-03-29', 'BAFIA', 'S20242215', '6b', '', 'N', 109, 'non_supprime', '', '', '', '2024 / 2025'),
(110, 241175520, 'MBASSE MBASSE ARTUE BRAYANE', '', 'M', '2013-03-01', 'ESSENDE', 'S20242226', '6b', '', 'N', 110, 'non_supprime', '', '', '', '2024 / 2025'),
(111, 241175523, 'MBEGUE BAKITI MAXIME LIONEL', '', 'M', '2012-01-27', 'MONATELE', 'S20242228', '6b', '', 'N', 111, 'non_supprime', '', '', '', '2024 / 2025'),
(112, 241175526, 'NANTCHOUANG NONO LEOPOLD', '', 'M', '2011-11-17', 'BANGOULAP À 5H', 'S20242533', '6b', '', 'N', 112, 'non_supprime', '', '', '', '2024 / 2025'),
(113, 241175529, 'NGANSO TCHOUNKEU GODWIN', '', 'M', '2014-04-26', 'YAOUNDÉ', 'S20242282', '6b', '', 'N', 113, 'non_supprime', '', '', '', '2024 / 2025'),
(114, 241175532, 'NGNOKONG À KADANG LYSE BERCY', '', 'F', '2014-09-19', 'GAROUA', 'S20242284', '6b', '', 'N', 114, 'non_supprime', '', '', '', '2024 / 2025'),
(115, 241175535, 'NGO BOUM GENEVIEVE', '', 'F', '2013-01-13', 'BOUMNYEBEL', 'S20242285', '6b', '', 'N', 115, 'non_supprime', '', '', '', '2024 / 2025'),
(116, 241175538, 'NGON À DONG YANN STEPHANE', '', 'M', '2014-08-06', 'BALIAMA', 'S20242286', '6b', '', 'N', 116, 'non_supprime', '', '', '', '2024 / 2025'),
(117, 241175541, 'NGUEDIA WAMBA JUDICAEL', '', 'M', '2014-05-28', 'BAFIA', 'S20242287', '6b', '', 'N', 117, 'non_supprime', '', '', '', '2024 / 2025'),
(118, 241175544, 'NGUENI MARIE JOSEPHINE', '', 'F', '2011-11-13', 'KELLENG', 'S20242288', '6b', '', 'N', 118, 'non_supprime', '', '', '', '2024 / 2025'),
(119, 241175547, 'NITHA BASSONG GILLES WARREN', '', 'M', '2014-02-17', 'YAOUNDÉ', 'S20242289', '6b', '', 'N', 119, 'non_supprime', '', '', '', '2024 / 2025'),
(120, 241175550, 'NJEJAM YOH NADJA', '', 'F', '2024-10-09', '0', 'S20242422', '6b', '', 'N', 120, 'non_supprime', '', '', '', '2024 / 2025'),
(121, 241175553, 'NKAYIBI À BOUESSEKE SASHAT ELISE', '', 'F', '2014-09-08', 'BAFIA', 'S20242291', '6b', '', 'N', 121, 'non_supprime', '', '', '', '2024 / 2025'),
(122, 241175556, 'NKOUO SAFIATOU', '', 'F', '2012-05-12', 'CSI DE MPAGNA', 'S20242418', '6b', '', 'N', 122, 'non_supprime', '', '', '', '2024 / 2025'),
(123, 241175559, 'OUMAR KATILE ', '', 'M', '2012-01-10', 'BAFIA', 'S20242318', '6b', '', 'N', 123, 'non_supprime', '', '', '', '2024 / 2025'),
(124, 241175562, 'OUMAROU ABDOULAYE', '', 'M', '2010-06-04', 'YAOUNDÉ', 'S20242319', '6b', '', 'N', 124, 'non_supprime', '', '', '', '2024 / 2025'),
(125, 241175565, 'SANAMA LUCIEN', '', 'M', '2011-04-20', 'BAFIA', 'S20242328', '6b', '', 'N', 125, 'non_supprime', '', '', '', '2024 / 2025'),
(126, 241175568, 'TAMPAH LOUIS JUSTIN', '', 'M', '2010-09-21', 'GBWAH', 'S20232047', '6b', '', 'R', 126, 'non_supprime', '', '', '', '2024 / 2025'),
(127, 241175571, 'TCHUISSANG FONDJIP FANIELLE NAVELIE', '', 'F', '2013-02-20', 'NGOUSSO YAOUNDÉ', 'S20242137', '6b', '', 'N', 127, 'non_supprime', '', '', '', '2024 / 2025'),
(128, 241175574, 'TEH DARIN ROBERT', '', 'M', '2013-01-25', 'YAOUNDÉ', 'S20242139', '6b', '', 'N', 128, 'non_supprime', '', '', '', '2024 / 2025'),
(129, 241175577, 'YOUMBI NGUEKOUA PRINCESS CHELSEA', '', 'F', '2015-08-07', 'BAFIA', 'S20242525', '6b', '', 'N', 129, 'non_supprime', '', '', '', '2024 / 2025'),
(130, 241175940, 'AGOL ISSAKE OSCARINE DOROTHe', '', 'F', '2013-12-04', 'BAFIA', 'S20242179', '6c', '', 'N', 130, 'non_supprime', '', '', '', '2024 / 2025'),
(131, 241175943, 'ALOMO RAIL ISMAEL', '', 'M', '2014-06-29', 'GOUIFe', 'S20242410', '6c', '', 'N', 131, 'non_supprime', '', '', '', '2024 / 2025'),
(132, 241175946, 'ASSIM DIADOMINE KENDRA', '', 'F', '2013-04-06', 'CSI BANGONG', 'S20242033', '6c', '', 'N', 132, 'non_supprime', '', '', '', '2024 / 2025'),
(133, 241175949, 'ASSOLA SUZANNE', '', 'F', '2010-05-06', 'NYAMANGA II', 'S20242034', '6c', '', 'N', 133, 'non_supprime', '', '', '', '2024 / 2025'),
(134, 241175952, 'ASSOLO ASSONGO JOSEPH ANDRY', '', 'M', '2012-10-12', 'BAFIA', 'S20242035', '6c', '', 'N', 134, 'non_supprime', '', '', '', '2024 / 2025'),
(135, 241175955, 'ATSOBOLO GUENTANG MARINA GRACE', '', 'F', '2015-08-08', 'OMBESSA', 'S20242036', '6c', '', 'N', 135, 'non_supprime', '', '', '', '2024 / 2025'),
(136, 241175958, 'AYANGMA BENI SAMUEL', '', 'M', '2014-07-28', 'BAFIA', 'S20242039', '6c', '', 'N', 136, 'non_supprime', '', '', '', '2024 / 2025'),
(137, 241175961, 'AYOLO NYANGONO STEPHANIE LUCRESSE', '', 'F', '2012-09-12', 'SANGMELIMA', 'S20242040', '6c', '', 'N', 137, 'non_supprime', '', '', '', '2024 / 2025'),
(138, 241175964, 'BADANG CLAIRE ALEXANDRA', '', 'F', '2015-01-20', 'BOYABA I', 'S20242043', '6c', '', 'N', 138, 'non_supprime', '', '', '', '2024 / 2025'),
(139, 241175967, 'BADIA AGNeS LUCRECE', '', 'F', '2011-10-20', 'NKOULOU', 'S20242044', '6c', '', 'N', 139, 'non_supprime', '', '', '', '2024 / 2025'),
(140, 241175970, 'BARAN PAMELA VERLINE', '', 'F', '2012-04-25', 'KIIKI', 'S20242047', '6c', '', 'N', 140, 'non_supprime', '', '', '', '2024 / 2025'),
(141, 241175973, 'BENDE ULRICH KeVINE', '', 'F', '2010-04-15', 'BAFIA', 'S20242411', '6c', '', 'N', 141, 'non_supprime', '', '', '', '2024 / 2025'),
(142, 241175976, 'BETCHEM AYANNE MARQUISE', '', 'F', '2014-02-24', 'BAFIA', 'S20242222', '6c', '', 'N', 142, 'non_supprime', '', '', '', '2024 / 2025'),
(143, 241175979, 'BITOMO EBOSSO EULALIE PATRICIA', '', 'F', '2013-10-02', 'BIATANGANA', 'S20242412', '6c', '', 'N', 143, 'non_supprime', '', '', '', '2024 / 2025'),
(144, 241175982, 'BITSACK SETOU MABELLE', '', 'F', '2001-01-01', 'BER', 'S20232285', '6c', '', 'R', 144, 'non_supprime', '', '', '', '2024 / 2025'),
(145, 241175985, 'DAN ANANG MARTHE LARENE', '', 'F', '2012-04-14', 'BAFIA', 'S20242528', '6c', '', 'N', 145, 'non_supprime', '', '', '', '2024 / 2025'),
(146, 241175988, 'EBANA ZEBI BRAYAN', '', 'M', '2009-06-27', 'HOPITAL CENTRAL DE BAFIA', 'S20222066', '6c', '', 'R', 146, 'non_supprime', '', '', '', '2024 / 2025'),
(147, 230633282, 'GARBA AOUDOU', '', 'M', '2001-01-01', 'YABASSI', 'S20232023', '6c', '', 'R', 147, 'non_supprime', '', '', '', '2024 / 2025'),
(148, 241175994, 'GOUIFE ATIOK PAUL MICHEL', '', 'M', '2014-06-23', 'BAFIA', 'S20242100', '6c', '', 'N', 148, 'non_supprime', '', '', '', '2024 / 2025'),
(149, 241175997, 'GREYCETOBIE TSALA AFAKA', '', 'F', '2015-05-28', 'BAFIA', 'S20242101', '6c', '', 'N', 149, 'non_supprime', '', '', '', '2024 / 2025'),
(150, 241176000, 'GUEBEDIANG NDOKI LETICIA', '', 'F', '2013-04-13', 'BAFIA', 'S20242102', '6c', '', 'N', 150, 'non_supprime', '', '', '', '2024 / 2025'),
(151, 241176003, 'GUEHOADA NIBIGNI EVELINE DORCASSE', '', 'F', '2014-07-14', 'OMBESSA', 'S20242103', '6c', '', 'N', 151, 'non_supprime', '', '', '', '2024 / 2025'),
(152, 241176006, 'GUIBOCK LIKO EMMANUELLA BLONDE', '', 'F', '2013-03-20', 'GUIENTSING II', 'S20242104', '6c', '', 'N', 152, 'non_supprime', '', '', '', '2024 / 2025'),
(153, 241176009, 'GUILIZOCK a SEKE IVANA MAJOIE', '', 'F', '2013-11-02', 'BAFIA', 'S20242105', '6c', '', 'N', 153, 'non_supprime', '', '', '', '2024 / 2025'),
(154, 241176012, 'GUIZEUK a RIBAL LETICIA', '', 'F', '2012-12-11', 'BAFIA', 'S20242106', '6c', '', 'N', 154, 'non_supprime', '', '', '', '2024 / 2025'),
(155, 241176015, 'HASSAN MOUSSA AMADOU', '', 'M', '2009-04-23', 'SCHWEITZER', 'S20242107', '6c', '', 'N', 155, 'non_supprime', '', '', '', '2024 / 2025'),
(156, 241176018, 'HEUDOU DALLAN HOPE AGEE', '', 'M', '2014-08-16', 'BAFIA', 'S20242108', '6c', '', 'N', 156, 'non_supprime', '', '', '', '2024 / 2025'),
(157, 241176021, 'IBRAHIM MOUSSA ', '', 'M', '2011-05-04', 'BAFIA', 'S20242109', '6c', '', 'N', 157, 'non_supprime', '', '', '', '2024 / 2025'),
(158, 241176024, 'ISMAEL PAKISTAN BEN NDJAMEN', '', 'M', '2015-02-06', 'BAFIA', 'S20242110', '6c', '', 'N', 158, 'non_supprime', '', '', '', '2024 / 2025'),
(159, 241176027, 'KEDIEM SARA CHRISTIANA', '', 'F', '2011-08-01', 'DJAGA', 'S20240825', '6c', '', 'N', 159, 'non_supprime', '', '', '', '2024 / 2025'),
(160, 241176030, 'KEEDIS ï¿½ DANG COLLENCE', '', 'F', '2010-10-04', 'BAFIA', 'S20232286', '6c', '', 'R', 160, 'non_supprime', '', '', '', '2024 / 2025'),
(161, 241176033, 'KELO''O NSIOMA ESTHER ROSINE', '', 'F', '2012-05-25', 'BAFIA', 'S20242529', '6c', '', 'N', 161, 'non_supprime', '', '', '', '2024 / 2025'),
(162, 241176036, 'MEUTANG RIFOE YSMAEL BREL', '', 'M', '2013-07-09', 'YAOUNDÉ', 'S20242240', '6c', '', 'N', 162, 'non_supprime', '', '', '', '2024 / 2025'),
(163, 241176039, 'MEYINIKEM À MOUGNOL JACQUELINE ANGE BRANDY', '', 'F', '2014-01-24', 'KIIKI', 'S20242241', '6c', '', 'N', 163, 'non_supprime', '', '', '', '2024 / 2025'),
(164, 241176042, 'MGBAROUMA BEYEG MARC OLIVE GREEN', '', 'M', '2014-02-25', 'DISPENSAIRE DE BANGONG', 'S20242242', '6c', '', 'N', 164, 'non_supprime', '', '', '', '2024 / 2025'),
(165, 241176045, 'MIKAHILO IBRAHIM', '', 'M', '2012-05-23', 'LIMBÉ', 'S20242243', '6c', '', 'N', 165, 'non_supprime', '', '', '', '2024 / 2025'),
(166, 241176048, 'MOGNE INGRID MANUELLA', '', 'F', '2012-01-03', 'BAFIA', 'S20242244', '6c', '', 'N', 166, 'non_supprime', '', '', '', '2024 / 2025'),
(167, 241176051, 'MONDO SARA DORCAS', '', 'F', '2013-03-15', 'BANGONG', 'S20242245', '6c', '', 'N', 167, 'non_supprime', '', '', '', '2024 / 2025'),
(168, 241176054, 'MOUCHIKPOU FRYDA SYLVANA', '', 'F', '2014-01-03', 'FOUMBOT', 'S20242247', '6c', '', 'N', 168, 'non_supprime', '', '', '', '2024 / 2025'),
(169, 241176057, 'MOUDJIH À MATCHA ETAN EMMANUEL', '', 'M', '2012-09-30', 'BAFIA', 'S20242248', '6c', '', 'N', 169, 'non_supprime', '', '', '', '2024 / 2025'),
(170, 241176060, 'MOUGNOL À NWATSOK STÉPHANE', '', 'M', '2013-02-15', 'BAFIA', 'S20242249', '6c', '', 'N', 170, 'non_supprime', '', '', '', '2024 / 2025'),
(171, 241176063, 'MOUNAMBA EMMANUEL ELVIS', '', 'M', '2013-02-04', 'OMBESSA', 'S20242250', '6c', '', 'N', 171, 'non_supprime', '', '', '', '2024 / 2025'),
(172, 241176066, 'MOUSSA SAÏD WAH', '', 'M', '2013-10-03', 'MAGHART', 'S20242251', '6c', '', 'N', 172, 'non_supprime', '', '', '', '2024 / 2025'),
(173, 241176069, 'MOUTCHEU DJIMANI THÉRÈSE JEMINA', '', 'F', '2010-03-19', 'BAFIA', 'S20242252', '6c', '', 'N', 173, 'non_supprime', '', '', '', '2024 / 2025'),
(174, 241176072, 'MOUTHE À NGON OCEANNE', '', 'F', '2014-01-02', 'BAFIA', 'S20242253', '6c', '', 'N', 174, 'non_supprime', '', '', '', '2024 / 2025'),
(175, 241176075, 'MOUTSOCK BESSANG MAUREL', '', 'M', '2013-10-15', 'BEIH', 'S20242530', '6c', '', 'N', 175, 'non_supprime', '', '', '', '2024 / 2025'),
(176, 241176078, 'NKEMI À MOUTHE ADRIEN NATHANAEL', '', 'M', '2014-01-29', 'BAFIA', 'S20242292', '6c', '', 'N', 176, 'non_supprime', '', '', '', '2024 / 2025'),
(177, 241176081, 'NNANG MBASSEGUE AGNÈS ALICE', '', 'F', '2013-05-01', 'MATERNITÉ DE BANYO', 'S20242296', '6c', '', 'N', 177, 'non_supprime', '', '', '', '2024 / 2025'),
(178, 241176084, 'NWANWAL TOUNZI CHELSY FABIENNE', '', 'F', '2009-09-17', 'DOUALA', 'S20242303', '6c', '', 'N', 178, 'non_supprime', '', '', '', '2024 / 2025'),
(179, 241176087, 'NWOS À BETCHEM RAPHAIELLA MARTHE FORTUNE', '', 'F', '2013-06-05', 'BAFIA', 'S20242304', '6c', '', 'N', 179, 'non_supprime', '', '', '', '2024 / 2025'),
(180, 241176090, 'NWOS À NWATSOK FATIMA ', '', 'F', '2015-05-20', 'YAOUNDÉ', 'S20242305', '6c', '', 'N', 180, 'non_supprime', '', '', '', '2024 / 2025'),
(181, 241176093, 'NYAM SANDA DIM EMMANUEL', '', 'M', '2014-01-15', 'BAFIA', 'S20242307', '6c', '', 'N', 181, 'non_supprime', '', '', '', '2024 / 2025'),
(182, 241176096, 'RENE DESCARTES KENDI', '', 'M', '2013-06-28', 'TOBAGNE', 'S20242320', '6c', '', 'N', 182, 'non_supprime', '', '', '', '2024 / 2025'),
(183, 241176099, 'RIKEM MAELLE AURORE', '', 'F', '2015-08-19', 'BAFIA', 'S20242322', '6c', '', 'N', 183, 'non_supprime', '', '', '', '2024 / 2025'),
(184, 241176102, 'TACOP NGAMBE DAOUDA', '', 'M', '2009-05-20', 'NYABIDI', 'S20242628', '6c', '', 'N', 184, 'non_supprime', '', '', '', '2024 / 2025'),
(185, 241176105, 'TIDANG MBOGNING ROHAN ANDY', '', 'M', '2012-07-16', 'BAFIA', 'S20242142', '6c', '', 'N', 185, 'non_supprime', '', '', '', '2024 / 2025'),
(186, 241176108, 'TIOMATSA KEMEFOUET MERVEILLE CRISPEL', '', 'F', '2012-01-15', 'BAFIA', 'S20242144', '6c', '', 'N', 186, 'non_supprime', '', '', '', '2024 / 2025'),
(187, 241176111, 'TOMBI À YOMBO MARC OTHNEEL', '', 'F', '2015-11-30', 'BAFIA', 'S20242145', '6c', '', 'N', 187, 'non_supprime', '', '', '', '2024 / 2025'),
(188, 241176114, 'TOMBI CHRYSTIE LOVALY CHARLENE', '', 'F', '2012-01-09', 'BAFIA', 'S20242112', '6c', '', 'N', 188, 'non_supprime', '', '', '', '2024 / 2025'),
(189, 241176117, 'TSOUBOUM À ZOCK OCEANNE STESSY', '', 'F', '2014-04-24', 'BAFIA', 'S20242114', '6c', '', 'N', 189, 'non_supprime', '', '', '', '2024 / 2025'),
(190, 241176120, 'USMANU BURBA', '', 'M', '2012-07-21', 'NKAMBE', 'S20242115', '6c', '', 'N', 190, 'non_supprime', '', '', '', '2024 / 2025'),
(191, 241176123, 'WETI FONGANG JOHANE DANIELLE', '', 'F', '2013-05-24', 'BAFIA', 'S20242116', '6c', '', 'N', 191, 'non_supprime', '', '', '', '2024 / 2025'),
(192, 241176126, 'ZOCK KEVIN LABARAN', '', 'M', '2012-11-17', 'BOYABA I', 'S20242111', '6c', '', 'N', 192, 'non_supprime', '', '', '', '2024 / 2025'),
(193, 241176153, 'AMANTA ALIMA', '', 'F', '2024-01-01', 'GOURA', 'S20241374', '6d', '', 'N', 193, 'non_supprime', '', '', '', '2024 / 2025'),
(194, 241176156, 'BADEFOUNA ALIME SERENA', '', 'F', '2012-03-03', 'BAFIA', 'S20242415', '6d', '', 'N', 194, 'non_supprime', '', '', '', '2024 / 2025'),
(195, 241176159, 'BASSA a BIAKAN CASSY CAPRISTINE', '', 'F', '2015-09-27', 'BAFIA', 'S20242048', '6d', '', 'N', 195, 'non_supprime', '', '', '', '2024 / 2025'),
(196, 241176162, 'BAZOM TAPA AGATHE MANUELLA', '', 'F', '2014-01-20', 'DOUALA - CAMEROUN', 'S20242050', '6d', '', 'N', 196, 'non_supprime', '', '', '', '2024 / 2025'),
(197, 241176165, 'BEBEY DOLOH JEOVANI', '', 'M', '2014-04-27', 'DEUK II', 'S20242057', '6d', '', 'N', 197, 'non_supprime', '', '', '', '2024 / 2025'),
(198, 241176168, 'BEDIAM NWAKIBAN SOMAIYA', '', 'F', '2014-08-13', 'BAFIA', 'S20242051', '6d', '', 'N', 198, 'non_supprime', '', '', '', '2024 / 2025'),
(199, 241176171, 'BELINGA ONDOA ERYCK STEPHANE', '', 'M', '2012-10-05', 'MENGUEME', 'S20242053', '6d', '', 'N', 199, 'non_supprime', '', '', '', '2024 / 2025'),
(200, 241176174, 'BEMELINGUINE ANGE RACHIDA', '', 'F', '2012-10-02', 'MENDONG', 'S20242054', '6d', '', 'N', 200, 'non_supprime', '', '', '', '2024 / 2025'),
(201, 241176177, 'BERONG a AMANG HYPOLYTE DONALD', '', 'M', '2011-02-05', 'MOUKEN', 'S20242055', '6d', '', 'N', 201, 'non_supprime', '', '', '', '2024 / 2025'),
(202, 241176180, 'BESSONG KOAKA DAVID OMARION', '', 'M', '2014-08-19', 'BAFIA', 'S20242056', '6d', '', 'N', 202, 'non_supprime', '', '', '', '2024 / 2025'),
(203, 241176183, 'BIDOUE a BIDIAS GISeLE HYACINTHE', '', 'F', '2014-08-14', 'BAFIA', 'S20242059', '6d', '', 'N', 203, 'non_supprime', '', '', '', '2024 / 2025'),
(204, 241176186, 'BIEN RABIATOU ', '', 'F', '2013-03-14', 'BAFIA', 'S20242060', '6d', '', 'N', 204, 'non_supprime', '', '', '', '2024 / 2025'),
(205, 241176189, 'BIO a MESSE ACHLEY FRANCHESCA', '', 'F', '2013-11-15', 'GAH BAPe', 'S20242062', '6d', '', 'N', 205, 'non_supprime', '', '', '', '2024 / 2025'),
(206, 241176192, 'BITIJEK a BOYOMO FRANCK', '', 'M', '2015-11-28', 'BAFIA', 'S20242063', '6d', '', 'N', 206, 'non_supprime', '', '', '', '2024 / 2025'),
(207, 241176195, 'BIWELE SAL ABDOULKARIM', '', 'M', '2014-10-18', 'SOA', 'S20242220', '6d', '', 'N', 207, 'non_supprime', '', '', '', '2024 / 2025'),
(208, 241176198, 'BOOTO MAROINE', '', 'M', '2014-09-12', 'BAFIA', 'S20242221', '6d', '', 'N', 208, 'non_supprime', '', '', '', '2024 / 2025'),
(209, 241176201, 'BOUIL a BESSONG JEAN CALVIN', '', 'M', '2014-05-15', 'LABLÃ©', 'S20242532', '6d', '', 'N', 209, 'non_supprime', '', '', '', '2024 / 2025'),
(210, 241176204, 'BOUSSI KEEDI RAISSA MERVEILLE', '', 'F', '2009-12-09', 'DJAGA', 'S20212339', '6d', '', 'R', 210, 'non_supprime', '', '', '', '2024 / 2025'),
(211, 241176207, 'DJAM a DJAM ELZA MELISSA', '', 'F', '2013-09-30', 'BAFIA', 'S20240615', '6d', '', 'N', 211, 'non_supprime', '', '', '', '2024 / 2025'),
(212, 241176210, 'EPWe EPWe PIERRE JUNIOR', '', 'M', '2014-10-07', 'HOPITAL CENTRAL DE BAFIA', 'S20242653', '6d', '', 'N', 212, 'non_supprime', '', '', '', '2024 / 2025'),
(213, 0, 'FANKEM KENMOE KEVIN YOAN', '', 'M', '2013-09-14', 'BAFIA', 'S20242524', '6d', '', 'N', 213, 'non_supprime', '', '', '', '2024 / 2025'),
(214, 241176216, 'KADANG ALAIN FLIS', '', 'M', '2016-01-15', 'BAFIA', 'S20242189', '6d', '', 'N', 214, 'non_supprime', '', '', '', '2024 / 2025'),
(215, 241176219, 'KAMTSAP YEMATA ALEXE WINIE', '', 'F', '2013-01-02', 'CMA DE TYO', 'S20242190', '6d', '', 'N', 215, 'non_supprime', '', '', '', '2024 / 2025'),
(216, 241176222, 'KAN AWENI LESSOUK CALEB', '', 'M', '2012-12-06', 'BAFIA', 'S20242191', '6d', '', 'N', 216, 'non_supprime', '', '', '', '2024 / 2025'),
(217, 241176225, 'KEBEYENG a ZINTSEM ESTHER NELLY', '', 'F', '2012-05-19', 'BAFIA', 'S20242192', '6d', '', 'N', 217, 'non_supprime', '', '', '', '2024 / 2025'),
(218, 241176228, 'MAKA DJOH BLANDINE', '', 'F', '2024-01-01', 'GOURA', 'S20241376', '6d', '', 'N', 218, 'non_supprime', '', '', '', '2024 / 2025'),
(219, 241176231, 'MBOCK DAVID KIND', '', 'M', '2011-05-17', 'YAOUNDÉ', 'S20242230', '6d', '', 'N', 219, 'non_supprime', '', '', '', '2024 / 2025'),
(220, 241176234, 'MBORO À MBORO ISSA', '', 'M', '2014-12-04', 'BAFIA', 'S20242231', '6d', '', 'N', 220, 'non_supprime', '', '', '', '2024 / 2025'),
(221, 241176237, 'MBOUNE AGNOMO ANGE GABRIEL', '', 'M', '2012-09-11', 'BAFIA', 'S20242232', '6d', '', 'N', 221, 'non_supprime', '', '', '', '2024 / 2025'),
(222, 241176240, 'MBYATOU MOUSSA HAMADOU EFRAHIM', '', 'M', '2012-03-26', 'KIIKI', 'S20242234', '6d', '', 'N', 222, 'non_supprime', '', '', '', '2024 / 2025'),
(223, 241176243, 'MEGADJOU ZIDANE', '', 'M', '2012-09-23', 'BAFIA', 'S20242235', '6d', '', 'N', 223, 'non_supprime', '', '', '', '2024 / 2025'),
(224, 241176246, 'MEKANG À MOUTHE ABOUBAKAR MALIK', '', 'M', '2013-06-19', 'BAFIA', 'S20242236', '6d', '', 'N', 224, 'non_supprime', '', '', '', '2024 / 2025'),
(225, 241176249, 'MENDENG ONANENA ANGE IVAN', '', 'M', '2015-07-07', 'BAFIA', 'S20242237', '6d', '', 'N', 225, 'non_supprime', '', '', '', '2024 / 2025'),
(226, 241176252, 'MENDOMO ELA SYLVA MARIE ANGE', '', 'F', '2014-10-25', 'EBOLOWA', 'S20242238', '6d', '', 'N', 226, 'non_supprime', '', '', '', '2024 / 2025'),
(227, 241176255, 'MENTONG À MEDIEM FATOU RANY ORNELLE', '', 'F', '2011-07-26', 'BAFIA', 'S20242224', '6d', '', 'N', 227, 'non_supprime', '', '', '', '2024 / 2025'),
(228, 241176258, 'MEROUNG SATOU FADIMATOU', '', 'F', '2014-07-03', 'YAOUNDÉ', 'S20242239', '6d', '', 'N', 228, 'non_supprime', '', '', '', '2024 / 2025'),
(229, 241176261, 'MEYONG À MBEP NATHALIE', '', 'F', '2024-01-01', 'GOURA', 'S20241375', '6d', '', 'N', 229, 'non_supprime', '', '', '', '2024 / 2025'),
(230, 241176264, 'MPONG LE BENJAMIN', '', 'M', '2024-01-01', 'GOURA', 'S20241373', '6d', '', 'N', 230, 'non_supprime', '', '', '', '2024 / 2025'),
(231, 241176267, 'NDEGONG NKOUM VALENTINE', '', 'F', '2014-12-05', 'DEUK', 'S20242413', '6d', '', 'N', 231, 'non_supprime', '', '', '', '2024 / 2025'),
(232, 241176270, 'NGUEMBA MARIE ROSINE', '', 'F', '2010-10-21', 'NGORO', 'S20242414', '6d', '', 'N', 232, 'non_supprime', '', '', '', '2024 / 2025'),
(233, 241176273, 'NOAH NOAH FRANÇOIS JUNIOR', '', 'M', '2013-04-22', 'BAFIA', 'S20242299', '6d', '', 'N', 233, 'non_supprime', '', '', '', '2024 / 2025'),
(234, 241176276, 'NOMO BITE XKA', '', 'F', '2014-03-09', 'BAFIA', 'S20242300', '6d', '', 'N', 234, 'non_supprime', '', '', '', '2024 / 2025'),
(235, 241176279, 'NSANGOU SAÏD JAMIL ', '', 'M', '2013-02-09', 'BAFIA', 'S20242301', '6d', '', 'N', 235, 'non_supprime', '', '', '', '2024 / 2025'),
(236, 241176282, 'NTSO MAFOUMA MARIE CLAIRE', '', 'F', '2012-08-07', 'BAFIA', 'S20242302', '6d', '', 'N', 236, 'non_supprime', '', '', '', '2024 / 2025'),
(237, 241176285, 'NYOGNI ETAN YOUR', '', 'M', '2013-07-10', 'OMBESSA', 'S20242308', '6d', '', 'N', 237, 'non_supprime', '', '', '', '2024 / 2025'),
(238, 241176288, 'NZOUPE NJEBAYI GRACELIA AUDREY', '', 'F', '2012-01-30', 'BAFIA', 'S20242311', '6d', '', 'N', 238, 'non_supprime', '', '', '', '2024 / 2025'),
(239, 241176291, 'OLINGA ABISSAMBA LORENZO', '', 'M', '2010-03-19', 'BAFIA', 'S20242312', '6d', '', 'N', 239, 'non_supprime', '', '', '', '2024 / 2025'),
(240, 241176294, 'PKELÈM KENTANG TCHELSEA PREITA', '', 'F', '2012-08-20', 'BEANDONG', 'S20242669', '6d', '', 'N', 240, 'non_supprime', '', '', '', '2024 / 2025'),
(241, 241176297, 'RIM À RIM ANGE JUNIOR', '', 'M', '2011-06-16', 'CSI DE KIIKI', 'S20242323', '6d', '', 'N', 241, 'non_supprime', '', '', '', '2024 / 2025'),
(242, 241176300, 'RIMOH MPE SAMANTA', '', 'F', '2012-02-01', 'BAFIA', 'S20242324', '6d', '', 'N', 242, 'non_supprime', '', '', '', '2024 / 2025'),
(243, 241176303, 'SAFO DE MOUNANG MINA STELLA LATIFA', '', 'F', '2013-10-09', 'BAFIA', 'S20242325', '6d', '', 'N', 243, 'non_supprime', '', '', '', '2024 / 2025'),
(244, 241176306, 'SEKE À RIBAL KRADIDJA', '', 'F', '2013-03-27', 'BAFIA', 'S20242126', '6d', '', 'N', 244, 'non_supprime', '', '', '', '2024 / 2025'),
(245, 241176309, 'SIMO TSUATA BRATEL', '', 'M', '2011-11-27', 'BATCHAM', 'S20242127', '6d', '', 'N', 245, 'non_supprime', '', '', '', '2024 / 2025'),
(246, 241176312, 'TADAA TALANE GESSICA AIMÉE', '', 'F', '2012-02-20', 'BAFIA', 'S20242128', '6d', '', 'N', 246, 'non_supprime', '', '', '', '2024 / 2025'),
(247, 241176315, 'TALA DJEUTIO DYMITRI LOIC', '', 'M', '2009-09-13', 'BAFIA', 'S20242129', '6d', '', 'N', 247, 'non_supprime', '', '', '', '2024 / 2025'),
(248, 241176318, 'TAMEU SANOGO ISSA FRED', '', 'M', '2014-01-27', 'BAFIA', 'S20242130', '6d', '', 'N', 248, 'non_supprime', '', '', '', '2024 / 2025'),
(249, 241176321, 'TCHEULIBOU ZEUFACK NAVELIE ESTHER', '', 'F', '2012-03-24', 'BAFIA', 'S20242131', '6d', '', 'N', 249, 'non_supprime', '', '', '', '2024 / 2025'),
(250, 241176324, 'YAKA NWATCHOK ASHLEY VALLERIE LATIFA', '', 'F', '2013-02-08', 'BAFIA', 'S20242119', '6d', '', 'N', 250, 'non_supprime', '', '', '', '2024 / 2025'),
(251, 241176327, 'YAKAM MBEYAP SOUDEX', '', 'M', '2010-10-28', 'BAFIA', 'S20242120', '6d', '', 'N', 251, 'non_supprime', '', '', '', '2024 / 2025'),
(252, 241176330, 'YAKAN TCHAPGANG IRENE PRINCESSE', '', 'F', '2013-10-31', 'BAFIA', 'S20242121', '6d', '', 'N', 252, 'non_supprime', '', '', '', '2024 / 2025'),
(253, 241176333, 'YAKOURA MBOH VALENTIN', '', 'M', '2013-06-05', 'NDIM', 'S20242122', '6d', '', 'N', 253, 'non_supprime', '', '', '', '2024 / 2025'),
(254, 0, 'YANA MAHOP GILBERT NELSON', '', 'M', '2013-12-15', 'DEUK', 'S20242223', '6d', '', 'N', 254, 'non_supprime', '', '', '', '2024 / 2025'),
(255, 241176339, 'YONGUE BELLE HORIZON RYDEN', '', 'M', '2013-05-07', 'BONABERI DOUALA', 'S20242124', '6d', '', 'N', 255, 'non_supprime', '', '', '', '2024 / 2025'),
(256, 241176342, 'YOUBI KEMDEM NARCISSE BRADLEY', '', 'M', '2013-10-09', 'BAFIA', 'S20242535', '6d', '', 'N', 256, 'non_supprime', '', '', '', '2024 / 2025'),
(257, 241176345, 'YOUMBOUEN NOUNDJA CHRIST BRAYAN', '', 'M', '2013-01-20', 'BAFIA', 'S20242123', '6d', '', 'N', 257, 'non_supprime', '', '', '', '2024 / 2025'),
(258, 241176348, 'ZOM A ANONG AWA CHRISTELLE', '', 'F', '2010-09-01', 'BAFIA', 'S20242643', '6d', '', 'N', 258, 'non_supprime', '', '', '', '2024 / 2025'),
(259, 241192566, 'ABIALINA LUNELLE BERLINE', '', 'F', '2012-08-23', 'BAFIA', 'S20230151', '5A', '', 'N', 259, 'non_supprime', '', '', '', '2024 / 2025'),
(260, 0, 'ADJARA A ZOCK NAFISSATOU', '', 'F', '2013-11-09', 'NAFISSATOU', 'S20242594', '5A', '', 'N', 260, 'non_supprime', '', '', '', '2024 / 2025'),
(261, 231743126, 'ADJI ABOUBAKAR ', '', 'M', '2011-11-13', 'BAFIA', 'S20230152', '5A', '', 'N', 261, 'non_supprime', '', '', '', '2024 / 2025'),
(262, 231759449, 'AGOUME GENEVIEVE', '', 'F', '2011-04-06', 'OMBESSA', 'S20230153', '5A', '', 'N', 262, 'non_supprime', '', '', '', '2024 / 2025'),
(263, 231891968, 'AKOTO JACQUELINE', '', 'F', '2013-06-05', 'BAFIA', 'S20230154', '5A', '', 'N', 263, 'non_supprime', '', '', '', '2024 / 2025'),
(264, 231743204, 'ALEMOKA MPELE CORNELUS DUVAL', '', 'M', '2012-10-11', 'BALIAMA', 'S20230155', '5A', '', 'N', 264, 'non_supprime', '', '', '', '2024 / 2025'),
(265, 0, 'ARIF ZYADE YOMBO', '', 'M', '2013-09-01', 'BAFIA', 'S20220562', '5A', '', 'R', 265, 'non_supprime', '', '', '', '2024 / 2025'),
(266, 0, 'ASSIENE MOAKA MIRIS', '', 'F', '2013-06-17', 'BALIAMA', 'S20240613', '5A', '', 'N', 266, 'non_supprime', '', '', '', '2024 / 2025'),
(267, 0, 'ATANGA GILBERT CYRILLE', '', 'M', '2012-05-17', 'BAFIA', 'S20242618', '5A', '', 'N', 267, 'non_supprime', '', '', '', '2024 / 2025'),
(268, 231743258, 'ATEBA BENEBINE JERMAELLE', '', 'F', '2013-12-08', 'BAFIA', 'S20230162', '5A', '', 'N', 268, 'non_supprime', '', '', '', '2024 / 2025'),
(269, 230587139, 'AWA NGNERO', '', 'F', '2012-01-01', 'BAFIA', 'S20232111', '5A', '', 'N', 269, 'non_supprime', '', '', '', '2024 / 2025'),
(270, 230750450, 'AYANGMA ADALA CHRISTIANA ZOE', '', 'F', '2013-04-04', 'BAFIA', 'S20230163', '5A', '', 'N', 270, 'non_supprime', '', '', '', '2024 / 2025'),
(271, 230862227, 'AYEMELONG STEVIE NOELLE', '', 'F', '2012-01-25', 'BAFIA', 'S20230165', '5A', '', 'N', 271, 'non_supprime', '', '', '', '2024 / 2025'),
(272, 0, 'BEKOUNA PAUL FERDINAND', '', 'M', '2010-06-05', 'BAFIA', 'S20242265', '5A', '', 'N', 272, 'non_supprime', '', '', '', '2024 / 2025'),
(273, 230587856, 'BELECK ATIBACK VICTOIRE GAeLLE', '', 'F', '2013-09-09', 'BAFIA', 'S20232060', '5A', '', 'N', 273, 'non_supprime', '', '', '', '2024 / 2025'),
(274, 230587985, 'BELIKILE a RIBAMA ANGE JOVANY', '', 'F', '2012-06-24', 'BAFIA', 'S20230183', '5A', '', 'N', 274, 'non_supprime', '', '', '', '2024 / 2025'),
(275, 230801093, 'BEYEM ï¿½ MBASSA RASMINE', '', 'F', '2011-06-30', 'BAFIA', 'S20230184', '5A', '', 'N', 275, 'non_supprime', '', '', '', '2024 / 2025'),
(276, 0, 'BIADA A NGAM RACHIDA', '', 'F', '2010-08-24', 'BAFIA', 'S20242627', '5A', '', 'N', 276, 'non_supprime', '', '', '', '2024 / 2025'),
(277, 230811707, 'BIAGA TCHAGA ELLA LA DOUCE', '', 'F', '2013-05-22', 'BAFIA', 'S20230185', '5A', '', 'N', 277, 'non_supprime', '', '', '', '2024 / 2025'),
(278, 231744260, 'BIAKAN ï¿½ NGON JEANNOT ERWAN', '', 'M', '2011-08-25', 'TCHOLLIRï¿½', 'S20230186', '5A', '', 'N', 278, 'non_supprime', '', '', '', '2024 / 2025'),
(279, 231744398, 'BIDIAS ï¿½ RIM DIVANE KABREL', '', 'M', '2012-06-05', 'BAFIA', 'S20230187', '5A', '', 'N', 279, 'non_supprime', '', '', '', '2024 / 2025'),
(280, 230632967, 'BIDINGHA a EKORONG PRINCE RICHARD', '', 'M', '2013-04-13', 'GOUIFE', 'S20230188', '5A', '', 'N', 280, 'non_supprime', '', '', '', '2024 / 2025'),
(281, 231892340, 'BIKE ï¿½ MOUM MANUELLA', '', 'F', '2011-11-08', 'BAFIA', 'S20232124', '5A', '', 'N', 281, 'non_supprime', '', '', '', '2024 / 2025'),
(282, 230801114, 'BILONG SETH CALEB', '', 'M', '2012-06-25', 'BAFIA', 'S20230189', '5A', '', 'N', 282, 'non_supprime', '', '', '', '2024 / 2025'),
(283, 230633198, 'BIOMBO NGUENE DIANE EUGeNIE', '', 'F', '2013-09-06', 'BAFIA', 'S20230190', '5A', '', 'N', 283, 'non_supprime', '', '', '', '2024 / 2025'),
(284, 0, 'BITANG À BITANG ADAMOU', '', 'M', '2011-03-15', 'TARO', 'S20230191', '5A', '', 'N', 284, 'non_supprime', '', '', '', '2024 / 2025'),
(285, 0, 'BOTA RAPHAEL', '', 'M', '2012-10-15', 'DIZANGUE', 'S20242170', '5A', '', 'N', 285, 'non_supprime', '', '', '', '2024 / 2025'),
(286, 0, 'BOUNDI SAMUEL', '', 'M', '2009-02-01', 'BAFIA', 'S20240612', '5A', '', 'N', 286, 'non_supprime', '', '', '', '2024 / 2025'),
(287, 0, 'DANG MOSSOK KIARRA MERVEILLE', '', 'F', '2011-10-16', 'BAFIA', 'S20230993', '5A', '', 'R', 287, 'non_supprime', '', '', '', '2024 / 2025'),
(288, 230873504, 'DJAPA NANDA CHRISTELLE KETSIA', '', 'F', '2013-12-04', 'YAOUNDE 5e', 'S20230202', '5A', '', 'N', 288, 'non_supprime', '', '', '', '2024 / 2025'),
(289, 0, 'DJAPDOUNKE MAIMOUNA PRINCESSE', '', 'F', '2012-10-25', 'BAFOUSSAM', 'S20242172', '5A', '', 'N', 289, 'non_supprime', '', '', '', '2024 / 2025'),
(290, 230588681, 'EBOUGONG ELENGOU ANGE', '', 'F', '2011-01-20', 'KON - KIDOUN', 'S20231987', '5A', '', 'N', 290, 'non_supprime', '', '', '', '2024 / 2025'),
(291, 231892646, 'GANDEH JEAN GAeL', '', 'M', '2008-06-15', 'DEUK', 'S20232282', '5A', '', 'N', 291, 'non_supprime', '', '', '', '2024 / 2025'),
(292, 230751248, 'GOEN AMANG HENRI', '', 'M', '2011-09-24', 'BEIH', 'S20230216', '5A', '', 'N', 292, 'non_supprime', '', '', '', '2024 / 2025'),
(293, 0, 'GON À NGOMO JESSICA TANICHA FERNANDA', '', 'F', '2014-08-18', 'BAFIA', 'S20230217', '5A', '', 'N', 293, 'non_supprime', '', '', '', '2024 / 2025'),
(294, 0, 'GONDIO À MOUNGAM ASSANA', '', 'F', '2007-10-06', 'BAFIA', 'S20222160', '5A', '', 'R', 294, 'non_supprime', '', '', '', '2024 / 2025'),
(295, 0, 'GUEBEDIANG PRISCA FABIOLA', '', 'F', '2011-11-02', 'BAFIA', 'S20230182', '5A', '', 'N', 295, 'non_supprime', '', '', '', '2024 / 2025'),
(296, 0, 'GUIMBANG BILOA BIANCA ANAELLE', '', 'F', '2012-05-01', 'BAFIA', 'S20242152', '5A', '', 'N', 296, 'non_supprime', '', '', '', '2024 / 2025'),
(297, 0, 'GUIMEDELIE EMMANUEL', '', 'M', '2006-03-23', 'BAFIA', 'S20242648', '5A', '', 'N', 297, 'non_supprime', '', '', '', '2024 / 2025'),
(298, 230590796, 'KENGNE DJEUTIO ARIANE', '', 'F', '2012-09-27', 'BAFIA', 'S20232091', '5A', '', 'N', 298, 'non_supprime', '', '', '', '2024 / 2025'),
(299, 0, 'KODE LEWOU GISÈLE', '', 'F', '2008-06-02', 'BOKO', 'S20242257', '5A', '', 'N', 299, 'non_supprime', '', '', '', '2024 / 2025'),
(300, 0, 'KOFANE GEORGETTE', '', 'F', '2003-09-13', '30/08/2010', 'S20242570', '5A', '', 'N', 300, 'non_supprime', '', '', '', '2024 / 2025'),
(301, 230825909, 'MAWELLE ANABA MICHEL THeODORE', '', 'M', '2012-05-08', 'YAOUNDï¿½', 'S20230215', '5A', '', 'N', 301, 'non_supprime', '', '', '', '2024 / 2025'),
(302, 0, 'MBA MBA CYRILLE KLOÉ', '', 'F', '2013-07-02', 'ENYENG', 'S20230178', '5A', '', 'R', 302, 'non_supprime', '', '', '', '2024 / 2025'),
(303, 0, 'MBABI a KEEDI JOAN JEAN BOSCO', '', 'M', '2011-01-31', 'BAFIA', 'S20230250', '5A', '', 'N', 303, 'non_supprime', '', '', '', '2024 / 2025'),
(304, 231892883, 'MBANA a MBANA WILLIAM', '', 'M', '2011-09-15', 'BAFIA', 'S20230252', '5A', '', 'N', 304, 'non_supprime', '', '', '', '2024 / 2025'),
(305, 231892931, 'MEFFO DOLOH CHANCELINE', '', 'F', '2012-10-11', 'DEUK II', 'S20230263', '5A', '', 'N', 305, 'non_supprime', '', '', '', '2024 / 2025'),
(306, 230896691, 'MELINGUI GERMAINE LAURE', '', 'F', '2013-06-27', 'SA', 'S20230264', '5A', '', 'N', 306, 'non_supprime', '', '', '', '2024 / 2025'),
(307, 231759590, 'MESSOCK ESSOUSSE NDJOMBO INDIRA PROVIDENCE', '', 'F', '2014-06-11', 'BANGONG', 'S20230265', '5A', '', 'N', 307, 'non_supprime', '', '', '', '2024 / 2025'),
(308, 231745109, 'MFANDJIA ANAKON MARIE DANIELLE', '', 'F', '2013-01-14', 'BAFIA', 'S20230266', '5A', '', 'N', 308, 'non_supprime', '', '', '', '2024 / 2025'),
(309, 0, 'MINCHE WILLIEM BRUCE', '', 'M', '2008-04-01', 'DISPENSAIRE DE MANKOUOMBI', 'S20212323', '5A', '', 'R', 309, 'non_supprime', '', '', '', '2024 / 2025'),
(310, 230905232, 'MOMO ABOGANENA GUY GEORGES', '', 'M', '2010-06-18', 'MBANGASSINA', 'S20230267', '5A', '', 'N', 310, 'non_supprime', '', '', '', '2024 / 2025'),
(311, 230632370, 'MOUGNOL KONO NELLY GLORIA', '', 'F', '2014-01-21', 'MENGLOW', 'S20230246', '5A', '', 'N', 311, 'non_supprime', '', '', '', '2024 / 2025'),
(312, 0, 'MOULEMA EBOUMBOU FRANCINE GLORIA', '', 'F', '2010-05-09', 'DOUALA - CAMEROUN', 'S20242355', '5A', '', 'N', 312, 'non_supprime', '', '', '', '2024 / 2025'),
(313, 0, 'MPA''AR MPOUBA TESTELIN LUBRANI', '', 'M', '2011-02-25', 'ETSICK', 'S20242637', '5A', '', 'N', 313, 'non_supprime', '', '', '', '2024 / 2025'),
(314, 0, 'NDOUBI THIERY CALVIN', '', 'M', '2012-08-25', 'BAFIA', 'S20230283', '5A', '', 'N', 314, 'non_supprime', '', '', '', '2024 / 2025'),
(315, 0, 'NDOUMBE AMANG YANN DAVID', '', 'M', '2012-12-03', 'BAYOMEN', 'S20230284', '5A', '', 'N', 315, 'non_supprime', '', '', '', '2024 / 2025'),
(316, 0, 'NENKAM TAGNE PAUL GANDHI', '', 'M', '2013-07-15', 'BAFIA', 'S20230285', '5A', '', 'N', 316, 'non_supprime', '', '', '', '2024 / 2025'),
(317, 0, 'NGAHE SIMADJUI REUEL PENIEL', '', 'M', '2012-10-27', 'BAFOUSSAM', 'S20230286', '5A', '', 'N', 317, 'non_supprime', '', '', '', '2024 / 2025'),
(318, 0, 'NGO NDJIKI MARIE THÉRÈSE', '', 'F', '2011-12-06', 'EBOLOWA', 'S20230287', '5A', '', 'N', 318, 'non_supprime', '', '', '', '2024 / 2025'),
(319, 0, 'NGONO MBITA FLAVIENNE ROSY', '', 'F', '2012-05-08', 'BAFIA', 'S20232188', '5A', '', 'N', 319, 'non_supprime', '', '', '', '2024 / 2025'),
(320, 0, 'NGOUNDOU ETIENNE BRAYANE', '', 'F', '2011-01-15', 'NYAMONGO', 'S20232125', '5A', '', 'N', 320, 'non_supprime', '', '', '', '2024 / 2025'),
(321, 230595905, 'NGUEPNANG MERVEILLE', '', 'F', '2011-12-08', 'BANGOUA', 'S20232157', '5A', '', 'N', 321, 'non_supprime', '', '', '', '2024 / 2025'),
(322, 0, 'NKOMHA NSETH STEVE ABRAHAM', '', 'M', '2012-08-09', 'YAOUNDÉ', 'S20230298', '5A', '', 'N', 322, 'non_supprime', '', '', '', '2024 / 2025'),
(323, 0, 'NWAWEL ABONG RICHARD', '', 'M', '2011-01-27', 'DOUALA', 'S20232284', '5A', '', 'N', 323, 'non_supprime', '', '', '', '2024 / 2025'),
(324, 0, 'NWELEFAK À BEP LATIFA', '', 'F', '2011-03-29', 'BANGONG', 'S20230304', '5A', '', 'N', 324, 'non_supprime', '', '', '', '2024 / 2025'),
(325, 0, 'NYADI À MOUTHE IRO''O ZAHRA', '', 'F', '2013-01-27', 'BAFIA', 'S20230305', '5A', '', 'N', 325, 'non_supprime', '', '', '', '2024 / 2025'),
(326, 0, 'NYATOH NAFONG EMILIENNE NADINE', '', 'F', '2011-03-24', 'NYAMOKO', 'S20242346', '5A', '', 'N', 326, 'non_supprime', '', '', '', '2024 / 2025'),
(327, 0, 'NZIEM BARAN SADATOU LÉA', '', 'F', '2013-05-12', 'BAFIA', 'S20230306', '5A', '', 'N', 327, 'non_supprime', '', '', '', '2024 / 2025');
INSERT INTO `eleve` (`id`, `rne`, `nom`, `prenom`, `sexe`, `date_naissance`, `lieu_naissance`, `matricule`, `classe`, `adresse_parent`, `statut`, `num_rand`, `etat`, `nom_pere`, `nom_mere`, `photo`, `a_s`) VALUES
(328, 0, 'NZOGNENG TALLA WILFRED', '', 'M', '2012-05-19', 'CMA DE BABADJOU', 'S20230307', '5A', '', 'N', 328, 'non_supprime', '', '', '', '2024 / 2025'),
(329, 230597021, 'NZOYEM TCHEFFEU MAXWELL', '', 'M', '2011-02-23', 'MBOUDA', 'S20230308', '5A', '', 'N', 329, 'non_supprime', '', '', '', '2024 / 2025'),
(330, 0, 'OGNEBE HOPE SARA', '', 'F', '2007-10-26', 'KEDIA', 'S20231011', '5A', '', 'R', 330, 'non_supprime', '', '', '', '2024 / 2025'),
(331, 0, 'OMAM CHRISTIAN PARFAIT', '', 'M', '2014-12-30', 'YAOUNDÉ', 'S20230312', '5A', '', 'N', 331, 'non_supprime', '', '', '', '2024 / 2025'),
(332, 0, 'OMBALA ETELE PASCALINE PRINCESSE', '', 'F', '2012-04-24', 'NYAMANGA II', 'S20232126', '5A', '', 'N', 332, 'non_supprime', '', '', '', '2024 / 2025'),
(333, 0, 'OUSMAN BEN SAID', '', 'M', '2012-01-01', 'BAFIA', 'S20232073', '5A', '', 'N', 333, 'non_supprime', '', '', '', '2024 / 2025'),
(334, 0, 'POUTOUGNIGNI NJOUMENI MARAFAT', '', 'M', '2009-08-27', 'MANCHA', 'S20242549', '5A', '', 'N', 334, 'non_supprime', '', '', '', '2024 / 2025'),
(335, 230597381, 'RIM ABDOULMOUBARIK', '', 'M', '2012-01-17', 'BAFIA', 'S20230314', '5A', '', 'N', 335, 'non_supprime', '', '', '', '2024 / 2025'),
(336, 230597615, 'RIM ANYANGMA EMMANUEL PAULINO', '', 'M', '2013-03-07', 'BOUMAYEBEL', 'S20230315', '5A', '', 'N', 336, 'non_supprime', '', '', '', '2024 / 2025'),
(337, 0, 'RIMO LÉOCADINE LAFORTUNE', '', 'F', '2010-12-07', 'BAFIA', 'S20230316', '5A', '', 'N', 337, 'non_supprime', '', '', '', '2024 / 2025'),
(338, 230764595, 'SHEY PRECIOUS WIRNYU', '', 'F', '2012-12-05', 'MBOYAH', 'S20232191', '5A', '', 'N', 338, 'non_supprime', '', '', '', '2024 / 2025'),
(339, 230801762, 'TCHOUTOUO TCHOUAMO JONATHAN PHANUEL', '', 'M', '2011-07-14', 'BAFIA', 'S20232190', '5A', '', 'N', 339, 'non_supprime', '', '', '', '2024 / 2025'),
(340, 0, 'WAZECK BOLIVAN', '', 'M', '2011-07-09', 'DEUK', 'S20242551', '5A', '', 'N', 340, 'non_supprime', '', '', '', '2024 / 2025'),
(341, 0, 'WELLEPAK À MADEM DJORDANE FARELLE', '', 'M', '2010-11-17', 'BAFIA', 'S20230343', '5A', '', 'N', 341, 'non_supprime', '', '', '', '2024 / 2025'),
(342, 0, 'YAKAN ADISSA', '', 'F', '2013-03-29', 'BAFIA', 'S20230344', '5A', '', 'N', 342, 'non_supprime', '', '', '', '2024 / 2025'),
(343, 230600234, 'YAMOIGNE a IWEWE DAVILLA', '', 'F', '2013-05-07', 'BAFIA', 'S20230346', '5A', '', 'N', 343, 'non_supprime', '', '', '', '2024 / 2025'),
(344, 230801033, 'AMBASSA ESTELLE', '', 'F', '2011-12-08', 'BAFIA', 'S20230157', '5B', '', 'N', 344, 'non_supprime', '', '', '', '2024 / 2025'),
(345, 0, 'AMBATINDA MAMA JOSEPH LE ROI', '', 'M', '2012-02-01', 'NGORO', 'S20242429', '5B', '', 'N', 345, 'non_supprime', '', '', '', '2024 / 2025'),
(346, 0, 'AMINA ONONINO CATHÉRINE', '', 'F', '2012-02-01', 'BAFIA', 'S20230159', '5B', '', 'N', 346, 'non_supprime', '', '', '', '2024 / 2025'),
(347, 230587064, 'ANANGA ODHODY ALAN LE PRINCE', '', 'M', '2011-08-14', 'BAFIA', 'S20230160', '5B', '', 'N', 347, 'non_supprime', '', '', '', '2024 / 2025'),
(348, 0, 'ASSOM BITO ANDRÉA DAVILLA', '', 'F', '2013-03-06', 'AKOM II', 'S20242423', '5B', '', 'N', 348, 'non_supprime', '', '', '', '2024 / 2025'),
(349, 0, 'ATOCK JÉRÉMIE NATHAN', '', 'M', '2010-01-24', 'BAFIA', 'S20230765', '5B', '', 'N', 349, 'non_supprime', '', '', '', '2024 / 2025'),
(350, 231743639, 'BAFEU SINGO BELLIS MANUELLA', '', 'F', '2010-09-27', 'BAFIA', 'S20230166', '5B', '', 'N', 350, 'non_supprime', '', '', '', '2024 / 2025'),
(351, 0, 'BARAN À NGON ANGE PASCALINE', '', 'F', '2013-03-31', 'BANGONG', 'S20230170', '5B', '', 'N', 351, 'non_supprime', '', '', '', '2024 / 2025'),
(352, 0, 'BARAN SALAMATOU ', '', 'F', '2010-10-10', 'BRED', 'S20232288', '5B', '', 'R', 352, 'non_supprime', '', '', '', '2024 / 2025'),
(353, 230864369, 'BELOUNE ONOBIONO ISAAC ARONE NAEL', '', 'M', '2011-03-01', 'BAFIA', 'S20231982', '5B', '', 'N', 353, 'non_supprime', '', '', '', '2024 / 2025'),
(354, 0, 'BETSEM A DANG KABREL MARTIAL', '', 'M', '2010-07-22', 'BAFIA', 'S20220167', '5B', '', 'R', 354, 'non_supprime', '', '', '', '2024 / 2025'),
(355, 230588198, 'BOLOCK ANDRe JACOB JUNIOR', '', 'M', '2011-08-24', 'BAFIA', 'S20232083', '5B', '', 'N', 355, 'non_supprime', '', '', '', '2024 / 2025'),
(356, 0, 'BOUKÉ MIRIANE', '', 'F', '2010-02-04', 'NGAMBE TIKAR CENTRE', 'S20230194', '5B', '', 'N', 356, 'non_supprime', '', '', '', '2024 / 2025'),
(357, 0, 'CHEIK BARKA HAMAÏ BARKA', '', 'M', '2011-09-26', 'KOUSSERI', 'S20230997', '5B', '', 'N', 357, 'non_supprime', '', '', '', '2024 / 2025'),
(358, 230801135, 'DAN CASIMIR MANASSe', '', 'M', '2013-11-25', 'BAFIA', 'S20230195', '5B', '', 'N', 358, 'non_supprime', '', '', '', '2024 / 2025'),
(359, 0, 'DANG À YOMBI DAVID RAYAN LEROI ADOUIS', '', 'M', '2012-05-02', 'KIIKI', 'S20230196', '5B', '', 'N', 359, 'non_supprime', '', '', '', '2024 / 2025'),
(360, 0, 'EKEL À KADANG ALPHONSE CALVIN', '', 'M', '2007-07-03', 'BAFIA', 'S20241366', '5B', '', 'N', 360, 'non_supprime', '', '', '', '2024 / 2025'),
(361, 0, 'ELOUMOU OWONA PAUL JORDANA', '', 'F', '2011-07-20', 'YAOUNDÉ', 'S20241365', '5B', '', 'N', 361, 'non_supprime', '', '', '', '2024 / 2025'),
(362, 0, 'EVRA LIEWONBUCH ISSABA', '', 'M', '2010-10-22', 'BABESSI', 'S20242633', '5B', '', 'N', 362, 'non_supprime', '', '', '', '2024 / 2025'),
(363, 230590559, 'EYEBE ATANGANA MARCEL LEBREF', '', 'M', '2010-09-15', 'BAFIA', 'S20230209', '5B', '', 'N', 363, 'non_supprime', '', '', '', '2024 / 2025'),
(364, 231744533, 'FEREME A MOUGNOL BEYONCE LADOUCE', '', 'F', '2012-03-07', 'BANGONG', 'S20230210', '5B', '', 'N', 364, 'non_supprime', '', '', '', '2024 / 2025'),
(365, 0, 'FEU''A SILI DEBORA LAGRACE', '', 'F', '2013-01-02', 'GOURA', 'S20230211', '5B', '', 'N', 365, 'non_supprime', '', '', '', '2024 / 2025'),
(366, 230590613, 'GBARACK ANNETOU SALAMETOU', '', 'F', '2011-11-14', 'BAFIA', 'S20230212', '5B', '', 'N', 366, 'non_supprime', '', '', '', '2024 / 2025'),
(367, 230883635, 'GUEHOADA MOUNTSENG GUY BRYAN', '', 'M', '2012-12-18', 'DEUK', 'S20230218', '5B', '', 'N', 367, 'non_supprime', '', '', '', '2024 / 2025'),
(368, 230764859, 'GUIMBANG a BABARI GABRIELLA JOYXE', '', 'F', '2013-01-01', 'BAFIA', 'S20230360', '5B', '', 'N', 368, 'non_supprime', '', '', '', '2024 / 2025'),
(369, 0, 'GUIMBANG À MOUGNOL AMAMATA', '', 'F', '2011-02-26', 'BAFIA', 'S20242401', '5B', '', 'N', 369, 'non_supprime', '', '', '', '2024 / 2025'),
(370, 230801189, 'KEGUENI YAKANA ANGE GARETTE', '', 'F', '2012-12-04', 'YANGBEN', 'S20230226', '5B', '', 'N', 370, 'non_supprime', '', '', '', '2024 / 2025'),
(371, 0, 'LOANGA NZIE CATHÉRINE GABRIELLE', '', 'F', '2011-10-05', 'BAFIA', 'S20230221', '5B', '', 'N', 371, 'non_supprime', '', '', '', '2024 / 2025'),
(372, 230595233, 'MAHONDE OUSSEINI GABRIEL', '', 'M', '2012-02-26', 'BAFIA', 'S20230222', '5B', '', 'N', 372, 'non_supprime', '', '', '', '2024 / 2025'),
(373, 230801303, 'MBAMBA a MBAMBA BRILLAND', '', 'M', '2012-08-23', 'BAFIA', 'S20230251', '5B', '', 'N', 373, 'non_supprime', '', '', '', '2024 / 2025'),
(374, 230632058, 'MBANG a AMANG BETHEL PARFAIT', '', 'M', '2012-04-08', 'BAFIA', 'S20230253', '5B', '', 'N', 374, 'non_supprime', '', '', '', '2024 / 2025'),
(375, 0, 'MBANG EROUME ARSÈNE', '', 'M', '2011-12-06', 'BANGONG', 'S20230254', '5B', '', 'N', 375, 'non_supprime', '', '', '', '2024 / 2025'),
(376, 230764943, 'MBAZOA NYAMSI ANGELIKA ERICA', '', 'F', '2012-02-11', 'YAOUNDE', 'S20230257', '5B', '', 'N', 376, 'non_supprime', '', '', '', '2024 / 2025'),
(377, 0, 'MBEDJA EBOSSO DELPHIN', '', 'M', '2011-01-11', 'BIATANGANA', 'S20242430', '5B', '', 'N', 377, 'non_supprime', '', '', '', '2024 / 2025'),
(378, 0, 'MBODO ELISABETH', '', 'F', '2009-12-12', 'BANTA-TALBA', 'S20212535', '5B', '', 'R', 378, 'non_supprime', '', '', '', '2024 / 2025'),
(379, 230632283, 'MEPOUI NGOUMOU OCeANNE LADIFA MILEY', '', 'F', '2011-12-07', 'BAFIA - TCHEKANE', 'S20222044', '5B', '', 'N', 379, 'non_supprime', '', '', '', '2024 / 2025'),
(380, 231745172, 'MONG YANGANG MIRANDA NeE BELLE', '', 'F', '2012-08-09', 'BOKO MONTAGNE', 'S20230268', '5B', '', 'N', 380, 'non_supprime', '', '', '', '2024 / 2025'),
(381, 230765066, 'MORE AGUINISSAGA MANUELA', '', 'F', '2012-06-23', 'BAFIA', 'S20230269', '5B', '', 'N', 381, 'non_supprime', '', '', '', '2024 / 2025'),
(382, 0, 'MOUDJI CHARLES', '', 'M', '2012-12-08', 'BALAMBA', 'S20230270', '5B', '', 'N', 382, 'non_supprime', '', '', '', '2024 / 2025'),
(383, 230765171, 'MOUHAMADOU ABDOULAYE', '', 'M', '2012-02-20', 'BAFIA', 'S20230271', '5B', '', 'N', 383, 'non_supprime', '', '', '', '2024 / 2025'),
(384, 0, 'MPON LISETTE SERIANA', '', 'F', '2010-12-07', 'BAFIA', 'S20220173', '5B', '', 'R', 384, 'non_supprime', '', '', '', '2024 / 2025'),
(385, 0, 'NDJI CHARLES ROLIANG', '', 'M', '2010-04-03', 'BAFIA', 'S20241362', '5B', '', 'N', 385, 'non_supprime', '', '', '', '2024 / 2025'),
(386, 0, 'NGONO À MOUNGAM JEANNE RIBOOEM', '', 'F', '2012-04-28', 'BAFIA', 'S20230289', '5B', '', 'N', 386, 'non_supprime', '', '', '', '2024 / 2025'),
(387, 0, 'NGOUABE DJOUAKOUA AROL OSCAR', '', 'M', '2012-03-06', 'BAPOUGUE', 'S20230290', '5B', '', 'N', 387, 'non_supprime', '', '', '', '2024 / 2025'),
(388, 0, 'NGOUGOURE AWA', '', 'F', '2010-04-03', 'GOUFE', 'S20230291', '5B', '', 'N', 388, 'non_supprime', '', '', '', '2024 / 2025'),
(389, 0, 'NGOUMOULOLO ROSE ORNELLA', '', 'F', '2011-11-13', 'BAFIA', 'S20230292', '5B', '', 'N', 389, 'non_supprime', '', '', '', '2024 / 2025'),
(390, 0, 'NGUELE SAMBA MAXIME GIOVANE', '', 'M', '2012-11-17', 'KOBILA(DOUMÉ)', 'S20240576', '5B', '', 'N', 390, 'non_supprime', '', '', '', '2024 / 2025'),
(391, 0, 'NOUGA HERMINE CAROLINE', '', 'F', '2012-06-15', 'CS DE TSHOMB PHILIPPE', 'S20242497', '5B', '', 'N', 391, 'non_supprime', '', '', '', '2024 / 2025'),
(392, 230597171, 'OBA MEKUI KISSEN', '', 'M', '2014-05-01', 'KIIKI', 'S20230309', '5B', '', 'N', 392, 'non_supprime', '', '', '', '2024 / 2025'),
(393, 0, 'OKONO PAUL WILLIAM', '', 'M', '2011-09-19', 'AKOM II', 'S20242426', '5B', '', 'N', 393, 'non_supprime', '', '', '', '2024 / 2025'),
(394, 0, 'OLITA BRAYAN FERNANDO', '', 'M', '2014-07-06', 'BIALANGUENA', 'S20230310', '5B', '', 'N', 394, 'non_supprime', '', '', '', '2024 / 2025'),
(395, 0, 'OLOUME ADIDIGUE DENISE REXANE', '', 'F', '2012-06-04', 'BAFIA', 'S20230311', '5B', '', 'N', 395, 'non_supprime', '', '', '', '2024 / 2025'),
(396, 0, 'RIM À BETCHEM GILBERT STÉPHANE', '', 'M', '2011-05-05', 'BAFIA', 'S20230313', '5B', '', 'N', 396, 'non_supprime', '', '', '', '2024 / 2025'),
(397, 230706896, 'SANAM a TSENTSO TESSI JOICE', '', 'F', '2012-09-13', 'BAFIA', 'S20230318', '5B', '', 'N', 397, 'non_supprime', '', '', '', '2024 / 2025'),
(398, 0, 'SIMO KUISSEU BRAYAN NATHAN', '', 'M', '2012-02-16', 'BAFIA', 'S20220170', '5B', '', 'R', 398, 'non_supprime', '', '', '', '2024 / 2025'),
(399, 230599088, 'TASSI MBOENE FERNANDA JUDIGAELLE', '', 'F', '2011-01-07', 'NYAMANGA II', 'S20230322', '5B', '', 'N', 399, 'non_supprime', '', '', '', '2024 / 2025'),
(400, 230599175, 'TCHINDA FONKOU LIONEL', '', 'M', '2012-03-05', 'BAFIA', 'S20231000', '5B', '', 'N', 400, 'non_supprime', '', '', '', '2024 / 2025'),
(401, 0, 'TCHOUMI NDJANTOU ELIEL ANSELME', '', 'M', '2011-10-21', 'DOUALA À 11H15', 'S20242427', '5B', '', 'N', 401, 'non_supprime', '', '', '', '2024 / 2025'),
(402, 0, 'TSOH AMANG SÉGUELÈNE SARAH', '', 'F', '2012-04-11', 'AKOEMAN', 'S20242428', '5B', '', 'N', 402, 'non_supprime', '', '', '', '2024 / 2025'),
(403, 0, 'WABO DIDIER GLADYS', '', 'F', '2013-09-20', 'CSI DE GOUIFÉ', 'S20241810', '5B', '', 'N', 403, 'non_supprime', '', '', '', '2024 / 2025'),
(404, 230894702, 'YANA OBAMA KOTTO YANN GAUTIER', '', 'M', '2011-06-27', 'DOUALA', 'S20230347', '5B', '', 'N', 404, 'non_supprime', '', '', '', '2024 / 2025'),
(405, 231746114, 'YARA JEPTE CYRILLE NATHANAEL', '', 'M', '2013-01-20', 'KIIKI', 'S20230348', '5B', '', 'N', 405, 'non_supprime', '', '', '', '2024 / 2025'),
(406, 0, 'YASSI À RIBAL CHARLES EDOUARD RAYMOND', '', 'M', '2013-08-28', 'ESEKA', 'S20230349', '5B', '', 'N', 406, 'non_supprime', '', '', '', '2024 / 2025'),
(407, 0, 'YERIMA KESSO YADIRA LATITIA', '', 'F', '2013-09-01', 'BAFIA', 'S20230350', '5B', '', 'N', 407, 'non_supprime', '', '', '', '2024 / 2025'),
(408, 0, 'YOMBO ANENGNE JERÔME', '', 'M', '2013-06-11', 'NDIKINIMEKI', 'S20230352', '5B', '', 'N', 408, 'non_supprime', '', '', '', '2024 / 2025'),
(409, 231743096, 'ABI JULIENNE CHARNELLE', '', 'F', '2010-03-27', 'DONENKENG', 'S20232084', '5C', '', 'N', 409, 'non_supprime', '', '', '', '2024 / 2025'),
(410, 230587268, 'BALIABA JOeL HARRISSON', '', 'M', '2014-10-21', 'BAFIA', 'S20230167', '5C', '', 'N', 410, 'non_supprime', '', '', '', '2024 / 2025'),
(411, 230587391, 'BAMBANG MARIAMA', '', 'F', '2012-05-20', 'MPAGNE', 'S20230169', '5C', '', 'N', 411, 'non_supprime', '', '', '', '2024 / 2025'),
(412, 0, 'BARAN a NYAM AiCHATOU', '', 'F', '2012-01-20', 'BAFIA', 'S20230171', '5C', '', 'N', 412, 'non_supprime', '', '', '', '2024 / 2025'),
(413, 0, 'BELL EMILIENNE PATRICIA', '', 'F', '2012-07-09', 'YAOUNDÉ 5', 'S20242182', '5C', '', 'N', 413, 'non_supprime', '', '', '', '2024 / 2025'),
(414, 0, 'BIKO ASSOM FRANCIS BRICE', '', 'M', '2011-05-14', 'DOUALA', 'S20232075', '5C', '', 'N', 414, 'non_supprime', '', '', '', '2024 / 2025'),
(415, 0, 'DIAM a NNOUCK MAEVA ROSANDRE FLAUBERTE', '', 'F', '2008-02-25', 'BAFIA', 'S20231962', '5C', '', 'R', 415, 'non_supprime', '', '', '', '2024 / 2025'),
(416, 231744425, 'DIFFOUO FOMEKONG PERRAIN', '', 'M', '2012-08-28', 'BATCHAM', 'S20230199', '5C', '', 'N', 416, 'non_supprime', '', '', '', '2024 / 2025'),
(417, 0, 'DJAM BILOA NATHANAEL BOURGEOIS', '', 'M', '2012-05-01', 'BAFIA', 'S20242153', '5C', '', 'N', 417, 'non_supprime', '', '', '', '2024 / 2025'),
(418, 0, 'FITOM DE MOUNANG SARA BENJAMINE HASSANA', '', 'F', '2010-02-08', 'BAFIA', 'S20210421', '5C', '', 'R', 418, 'non_supprime', '', '', '', '2024 / 2025'),
(419, 0, 'FOFOU FOYO MITILIENNE', '', 'F', '2008-01-07', 'BATCHAM', 'S20242256', '5C', '', 'N', 419, 'non_supprime', '', '', '', '2024 / 2025'),
(420, 230590655, 'GNADIANG MEREMA ', '', 'F', '2012-05-20', 'MPAGNE', 'S20230213', '5C', '', 'N', 420, 'non_supprime', '', '', '', '2024 / 2025'),
(421, 230817320, 'GOCK ANEGOUE PATRICE ARMAND', '', 'M', '2012-05-11', 'BAFIA', 'S20230214', '5C', '', 'N', 421, 'non_supprime', '', '', '', '2024 / 2025'),
(422, 231744569, 'GUILIBOUEM ANGE REINE', '', 'F', '2011-07-01', 'DONENKENG', 'S20232203', '5C', '', 'N', 422, 'non_supprime', '', '', '', '2024 / 2025'),
(423, 0, 'GUITCHOMBO ADRIENNE CLARA', '', 'F', '2011-01-01', 'BAFIA', 'S20230223', '5C', '', 'N', 423, 'non_supprime', '', '', '', '2024 / 2025'),
(424, 230883176, 'HIOL FRANcOIS JEFFTE', '', 'M', '2011-08-31', 'BAFIA', 'S20230224', '5C', '', 'N', 424, 'non_supprime', '', '', '', '2024 / 2025'),
(425, 230633348, 'IDONDI DONALD', '', 'M', '2012-11-15', 'KOUTABA', 'S20230225', '5C', '', 'N', 425, 'non_supprime', '', '', '', '2024 / 2025'),
(426, 231893744, 'IKEM DIBEL GLORIA', '', 'F', '2010-01-13', 'BAFIA', 'S20220122', '5C', '', 'R', 426, 'non_supprime', '', '', '', '2024 / 2025'),
(427, 0, 'KEGUENI A RIBOUEM CHARLENE OLIVIA', '', 'F', '2009-02-02', 'BAFIA', 'S20220124', '5C', '', 'R', 427, 'non_supprime', '', '', '', '2024 / 2025'),
(428, 230801210, 'KENDE a MBARA ABOUBAKAR', '', 'F', '2011-12-03', 'BAFIA', 'S20230227', '5C', '', 'N', 428, 'non_supprime', '', '', '', '2024 / 2025'),
(429, 0, 'KOUGOUM FOWOUe GRACE DIVINE', '', 'F', '2013-03-28', 'YAOUNDÃ©', 'S20232137', '5C', '', 'R', 429, 'non_supprime', '', '', '', '2024 / 2025'),
(430, 230854841, 'LONKENG ASNA CLAUDIA', '', 'F', '2013-04-06', 'BAFIA', 'S20230228', '5C', '', 'N', 430, 'non_supprime', '', '', '', '2024 / 2025'),
(431, 0, 'MANGA AMBATTA SEBASTIEN', '', 'M', '2010-02-20', 'BAFIA', 'S20241187', '5C', '', 'N', 431, 'non_supprime', '', '', '', '2024 / 2025'),
(432, 0, 'MANIRA SOULEMAN', '', 'F', '2012-12-11', 'BAFIA', 'S20230229', '5C', '', 'N', 432, 'non_supprime', '', '', '', '2024 / 2025'),
(433, 230633573, 'MAPOURE NJOYA ISMAeL RAMADAN', '', 'M', '2012-07-27', 'KOUMENKE', 'S20230230', '5C', '', 'N', 433, 'non_supprime', '', '', '', '2024 / 2025'),
(434, 230801264, 'MATOUK a GOLO ABIBA', '', 'F', '2012-08-02', 'DEUK', 'S20230231', '5C', '', 'N', 434, 'non_supprime', '', '', '', '2024 / 2025'),
(435, 0, 'MBAKE BIOH MARCEL', '', 'M', '2010-04-25', 'MPOUGA', 'S20242536', '5C', '', 'N', 435, 'non_supprime', '', '', '', '2024 / 2025'),
(436, 230813939, 'MBESSA ENELI YVES WARREN', '', 'M', '2012-01-22', 'BAFIA', 'S20230259', '5C', '', 'N', 436, 'non_supprime', '', '', '', '2024 / 2025'),
(437, 230801366, 'MBESSE NSONG PHILIPPE TORRES', '', 'M', '2011-06-11', 'BAFIA', 'S20230260', '5C', '', 'N', 437, 'non_supprime', '', '', '', '2024 / 2025'),
(438, 0, 'MBOKINI EMMANUEL GAeL', '', 'M', '2013-11-02', 'GONDON BAFIA', 'S20230261', '5C', '', 'N', 438, 'non_supprime', '', '', '', '2024 / 2025'),
(439, 230765354, 'MBOUAL ARMAND DIVIN', '', 'M', '2012-02-08', 'BAFIA', 'S20230262', '5C', '', 'N', 439, 'non_supprime', '', '', '', '2024 / 2025'),
(440, 0, 'MENDJI ABRAHAM ONELA', '', 'F', '2007-10-28', 'HOPITAL CENTRAL DE BAFIA', 'S20222067', '5C', '', 'N', 440, 'non_supprime', '', '', '', '2024 / 2025'),
(441, 0, 'MOUDIO ANGUISSO HONORINE MARIE', '', 'F', '2012-09-29', 'BALIAMA', 'S20242166', '5C', '', 'N', 441, 'non_supprime', '', '', '', '2024 / 2025'),
(442, 230706722, 'MOUTHE a NWAL ADAMOU JUNIOR', '', 'M', '2010-05-03', 'BAFIA', 'S20230273', '5C', '', 'N', 442, 'non_supprime', '', '', '', '2024 / 2025'),
(443, 0, 'MOUTHE PAULINE', '', 'F', '2011-08-13', 'BEIH', 'S20230274', '5C', '', 'N', 443, 'non_supprime', '', '', '', '2024 / 2025'),
(444, 0, 'MPON NSOBEY EMMANUEL DIEUDONNÃ©', '', 'M', '2009-11-17', 'BAFIA', 'S20230275', '5C', '', 'N', 444, 'non_supprime', '', '', '', '2024 / 2025'),
(445, 0, 'MVELE ASSEMBE VALeRE JOSEPH', '', 'M', '2011-08-21', 'YAOUNDÃ©', 'S20230276', '5C', '', 'N', 445, 'non_supprime', '', '', '', '2024 / 2025'),
(446, 230595716, 'NDAM a NGON MERVEILLE CHANTAL', '', 'F', '2011-08-10', 'BAFIA', 'S20230277', '5C', '', 'N', 446, 'non_supprime', '', '', '', '2024 / 2025'),
(447, 0, 'NDIEM GUESSENG SOUFFRANCE', '', 'F', '2011-08-29', 'BOKO', 'S20242431', '5C', '', 'N', 447, 'non_supprime', '', '', '', '2024 / 2025'),
(448, 0, 'NDONGO LAZARE JOVIAL', '', 'M', '2012-01-24', 'NYAMANGA', 'S20232014', '5C', '', 'N', 448, 'non_supprime', '', '', '', '2024 / 2025'),
(449, 0, 'NGO NDJEL SHEKINA ORNELLA', '', 'F', '2012-05-29', 'BAFIA', 'S20232076', '5C', '', 'N', 449, 'non_supprime', '', '', '', '2024 / 2025'),
(450, 0, 'NGON NGON PARFAIT RYAN', '', 'M', '2013-02-20', 'BAFIA', 'S20230288', '5C', '', 'N', 450, 'non_supprime', '', '', '', '2024 / 2025'),
(451, 230596049, 'NGUINA MESSINA ELISE CAMELA', '', 'F', '2010-04-18', 'DONENKENG', 'S20231960', '5C', '', 'N', 451, 'non_supprime', '', '', '', '2024 / 2025'),
(452, 0, 'NJIMI NDJANTOU AZIEL CAMILLE', '', 'M', '2011-10-21', 'DOUALA À 11H 17', 'S20242433', '5C', '', 'N', 452, 'non_supprime', '', '', '', '2024 / 2025'),
(453, 230596169, 'NJOLI MOUKO WILFRID PARFAIT', '', 'M', '2012-10-07', 'YaoundÃ©', 'S20230294', '5C', '', 'N', 453, 'non_supprime', 'mouko georges parfait', 'abialina mfanga hermine nicole', '', '2024 / 2025'),
(454, 0, 'NKEN TAFOLAC MIGUEL', '', 'M', '2009-06-16', 'BAFIA', 'S20230295', '5C', '', 'N', 454, 'non_supprime', '', '', '', '2024 / 2025'),
(455, 0, 'NYABOB À ETCHONG PIERRE DÉSIRÉ', '', 'M', '2011-08-15', 'YAOUNDÉ 5È', 'S20230999', '5C', '', 'N', 455, 'non_supprime', '', '', '', '2024 / 2025'),
(456, 0, 'RIBAMA À ENGOUTÉ DIEUDONNÉ', '', 'M', '2008-10-03', 'LABLÉ', 'S20232024', '5C', '', 'N', 456, 'non_supprime', '', '', '', '2024 / 2025'),
(457, 0, 'TCHOUBOUM IKORONG JEANNINE PRISCA', '', 'F', '2012-03-28', 'YAOUNDÉ', 'S20230325', '5C', '', 'N', 457, 'non_supprime', '', '', '', '2024 / 2025'),
(458, 0, 'TCHOUMBA NSAIBAK EMMANUEL BELMOND', '', 'M', '2012-08-11', 'YAOUNDÉ 5È', 'S20230326', '5C', '', 'N', 458, 'non_supprime', '', '', '', '2024 / 2025'),
(459, 0, 'TCHOUNGA NKOUINDOU ANGE NATHAN', '', 'M', '2012-08-17', 'BAFIA', 'S20230327', '5C', '', 'N', 459, 'non_supprime', '', '', '', '2024 / 2025'),
(460, 230765618, 'TCHOUTA NDAMTANG SARA LOANNE', '', 'F', '2013-05-26', 'BAFIA', 'S20230328', '5C', '', 'N', 460, 'non_supprime', '', '', '', '2024 / 2025'),
(461, 230599391, 'TCHUAMELEU NJOPMO PRINCESSE NATACHA', '', 'F', '2012-02-22', 'DEUK', 'S20230329', '5C', '', 'N', 461, 'non_supprime', '', '', '', '2024 / 2025'),
(462, 0, 'TIATI À TIATI HOUSSENI', '', 'M', '2011-05-01', 'BAFIA', 'S20222115', '5C', '', 'R', 462, 'non_supprime', '', '', '', '2024 / 2025'),
(463, 230801792, 'TINKEU TCHOUPE ELISCHA', '', 'F', '2012-07-08', 'DOUALA - CAMEROUN', 'S20231024', '5C', '', 'N', 463, 'non_supprime', '', '', '', '2024 / 2025'),
(464, 230844515, 'TITI PEGGUY CECILE', '', 'M', '2013-11-22', 'BAFIA', 'S20230330', '5C', '', 'N', 464, 'non_supprime', '', '', '', '2024 / 2025'),
(465, 0, 'TITOM ASSOKA PRINCESSE LAURAINE', '', 'F', '2013-07-09', 'BAFIA', 'S20230331', '5C', '', 'N', 465, 'non_supprime', '', '', '', '2024 / 2025'),
(466, 0, 'WAGANG NDJANI HORNELLA', '', 'F', '2010-12-11', 'MPOUGA', 'S20242432', '5C', '', 'N', 466, 'non_supprime', '', '', '', '2024 / 2025'),
(467, 230861657, 'YOUMBI WANOU FARREL', '', 'M', '2012-05-29', 'BAFIA', 'S20230354', '5C', '', 'N', 467, 'non_supprime', '', '', '', '2024 / 2025'),
(468, 0, 'ZAMBOU NGUETSOP AUDREL NOLAN', '', 'M', '2012-01-08', 'BAFIA', 'S20230355', '5C', '', 'N', 468, 'non_supprime', '', '', '', '2024 / 2025'),
(469, 230801810, 'Ze YENGA ANOKO CHANTAL', '', 'F', '2011-10-28', 'BAFIA', 'S20230356', '5C', '', 'N', 469, 'non_supprime', '', '', '', '2024 / 2025'),
(470, 230600342, 'ZIEM ELI FRANCK AUREL', '', 'M', '2012-07-29', 'BAFIA', 'S20230357', '5C', '', 'N', 470, 'non_supprime', '', '', '', '2024 / 2025'),
(471, 0, 'ZINTCHEM À BEYEM AMINA', '', 'F', '2007-01-24', 'BAFIA', 'S20222079', '5C', '', 'R', 471, 'non_supprime', '', '', '', '2024 / 2025'),
(472, 0, 'AMADJODA ANOKO ABOUBAKAR', '', 'M', '2011-09-10', 'BAFIA', 'S20230156', '5D', '', 'N', 472, 'non_supprime', '', '', '', '2024 / 2025'),
(473, 231892256, 'ANONG RACHIDATOU', '', 'F', '2007-08-23', 'BAFIA', 'S20231998', '5D', '', 'N', 473, 'non_supprime', '', '', '', '2024 / 2025'),
(474, 0, 'ASSALI BONKOUM LOMESTIQUE', '', 'M', '2005-12-22', 'BAFIA', 'S20222060', '5D', '', 'R', 474, 'non_supprime', '', '', '', '2024 / 2025'),
(475, 0, 'ASSEN À DONG PAULINE JUDITH', '', 'F', '2014-09-27', 'BAFIA', 'S20242169', '5D', '', 'N', 475, 'non_supprime', '', '', '', '2024 / 2025'),
(476, 230902070, 'ATANA BOUNI PHILOMï¿½NE', '', 'F', '2012-10-12', 'OBALA', 'S20230161', '5D', '', 'N', 476, 'non_supprime', '', '', '', '2024 / 2025'),
(477, 230587541, 'BARAN TIMOGNe MAeLLE GRaCE', '', 'F', '2011-07-31', 'BAFIA', 'S20230172', '5D', '', 'N', 477, 'non_supprime', '', '', '', '2024 / 2025'),
(478, 231743705, 'BASSAGA NDJOKO LEOPOLDINE AiCHA', '', 'F', '2012-03-22', 'BAFIA', 'S20230173', '5D', '', 'N', 478, 'non_supprime', '', '', '', '2024 / 2025'),
(479, 231759503, 'BEBOCK RIBOUEM FANNY PRINCESSE', '', 'F', '2013-02-28', 'BAFIA', 'S20230174', '5D', '', 'N', 479, 'non_supprime', '', '', '', '2024 / 2025'),
(480, 230587715, 'BEDIAM NYAM GLADIS CLARA', '', 'F', '2012-07-24', 'BAFIA', 'S20230175', '5D', '', 'N', 480, 'non_supprime', '', '', '', '2024 / 2025'),
(481, 0, 'BEGUESSE MBALAMOUEN NAVELLY', '', 'F', '2012-01-27', 'BAFIA', 'S20230176', '5D', '', 'N', 481, 'non_supprime', '', '', '', '2024 / 2025'),
(482, 0, 'BÉLÉMÉ NKOUAMO BRAYANNE WILFRIED', '', 'M', '2012-01-26', 'BAFIA', 'S20230177', '5D', '', 'N', 482, 'non_supprime', '', '', '', '2024 / 2025'),
(483, 231744227, 'BESSONG WESSIBASSIEBAH JEFF DAREL', '', 'M', '2004-09-24', 'MATERNITE DE BAFIA', 'S20212335', '5D', '', 'R', 483, 'non_supprime', '', '', '', '2024 / 2025'),
(484, 0, 'DICKO SADIGA ARDO', '', 'M', '2011-04-01', 'BAFIA', 'S20230198', '5D', '', 'N', 484, 'non_supprime', '', '', '', '2024 / 2025'),
(485, 230588435, 'DJEMOE TEUMNOU ANGE DIVINE', '', 'F', '2012-09-06', 'BAFIA', 'S20232072', '5D', '', 'N', 485, 'non_supprime', '', '', '', '2024 / 2025'),
(486, 230801165, 'DJERIKEM BOYOMO BeNeDICTE PRINCESSE', '', 'F', '2013-09-03', 'BAFIA', 'S20230204', '5D', '', 'N', 486, 'non_supprime', '', '', '', '2024 / 2025'),
(487, 0, 'DJOUANZO BOYOGUENO AURELIE LORITA', '', 'F', '2012-04-05', 'NKONGSAMBA', 'S20230205', '5D', '', 'N', 487, 'non_supprime', '', '', '', '2024 / 2025'),
(488, 0, 'DOKAN À BOOTOH LARISSA DIANE', '', 'F', '2012-11-19', 'GOUIFÉ', 'S20230206', '5D', '', 'N', 488, 'non_supprime', '', '', '', '2024 / 2025'),
(489, 230588519, 'DOMTCHOUANG MENDJE PASCALE', '', 'F', '2012-07-04', 'DOUALA', 'S20232026', '5D', '', 'N', 489, 'non_supprime', '', '', '', '2024 / 2025'),
(490, 0, 'EBONG ANOKO GAUSLIN', '', 'M', '2009-09-25', 'MERENG BAFIA', 'S20232133', '5D', '', 'R', 490, 'non_supprime', '', '', '', '2024 / 2025'),
(491, 0, 'ENEFECK BOUDIA LATIFA KITA', '', 'F', '2013-05-03', 'BAFIA', 'S20230208', '5D', '', 'N', 491, 'non_supprime', '', '', '', '2024 / 2025'),
(492, 230590508, 'ETONG SIMOGNe CABREL CHRIST ROI', '', 'M', '2011-07-31', 'BAFIA', 'S20230180', '5D', '', 'N', 492, 'non_supprime', '', '', '', '2024 / 2025'),
(493, 231744629, 'IKORONG ARIELLE HUGUETTE', '', 'F', '2011-05-25', 'BAFIA', 'S20230219', '5D', '', 'N', 493, 'non_supprime', '', '', '', '2024 / 2025'),
(494, 231744695, 'KAMDEM CHENANG FREDI ARLANE', '', 'M', '2011-05-14', 'BAFIA', 'S20230232', '5D', '', 'N', 494, 'non_supprime', '', '', '', '2024 / 2025'),
(495, 230590700, 'KAMTIA AIMe', '', 'M', '2012-06-10', 'SANTCHOU', 'S20230233', '5D', '', 'N', 495, 'non_supprime', '', '', '', '2024 / 2025'),
(496, 0, 'KEEDI ABOUEM ISSA', '', 'M', '2009-03-06', 'BAFIA', 'S20230235', '5D', '', 'N', 496, 'non_supprime', '', '', '', '2024 / 2025'),
(497, 230837654, 'KISSIEN a KEDI ISMAeD', '', 'M', '2013-07-17', 'DONENKENG', 'S20230237', '5D', '', 'N', 497, 'non_supprime', '', '', '', '2024 / 2025'),
(498, 0, 'KOUBA À NTA LOUISE ELODIE', '', 'F', '2010-02-15', 'NKONGSAMBA', 'S20230238', '5D', '', 'N', 498, 'non_supprime', '', '', '', '2024 / 2025'),
(499, 230595065, 'LIEUMO SIMO BELVIRA RICHELLE', '', 'F', '2013-02-01', 'BAFIA', 'S20230239', '5D', '', 'N', 499, 'non_supprime', '', '', '', '2024 / 2025'),
(500, 0, 'LOBÉ GOUGNHI PETIT RAYMOND', '', 'M', '2009-12-17', 'MPOUGA', 'S20232289', '5D', '', 'R', 500, 'non_supprime', '', '', '', '2024 / 2025'),
(501, 231744728, 'MABEN GABRIELLE PRISCA', '', 'F', '2012-05-16', 'DOUALA', 'S20230240', '5D', '', 'N', 501, 'non_supprime', '', '', '', '2024 / 2025'),
(502, 230595146, 'MADOUME AiCHATOU SAMIRA', '', 'F', '2012-02-19', 'BALIAMA', 'S20230241', '5D', '', 'N', 502, 'non_supprime', '', '', '', '2024 / 2025'),
(503, 231744758, 'MAFFOGANG FOTSO VIKI STEVENSON', '', 'F', '2011-05-11', 'BAMOUGOUM', 'S20230242', '5D', '', 'N', 503, 'non_supprime', '', '', '', '2024 / 2025'),
(504, 0, 'MATCHANN AGON UMU AÏMANN', '', 'F', '2012-07-29', 'BAFIA', 'S20230244', '5D', '', 'N', 504, 'non_supprime', '', '', '', '2024 / 2025'),
(505, 230706602, 'MATCHANN GUIZOCK UMU DARDAH', '', 'F', '2013-11-03', 'BAFIA', 'S20230245', '5D', '', 'N', 505, 'non_supprime', '', '', '', '2024 / 2025'),
(506, 0, 'MAYAGA PIERRE', '', 'M', '2009-02-21', 'BAFIA', 'S20220209', '5D', '', 'R', 506, 'non_supprime', '', '', '', '2024 / 2025'),
(507, 231745052, 'MAYEGA MANUELA FRANcOISE FAREZ', '', 'F', '2013-04-21', 'DOUALA', 'S20230248', '5D', '', 'N', 507, 'non_supprime', '', '', '', '2024 / 2025'),
(508, 230631935, 'MBA FONKOU CABREL GEORDAN', '', 'M', '2010-07-30', 'BAFIA', 'S20222080', '5D', '', 'N', 508, 'non_supprime', '', '', '', '2024 / 2025'),
(509, 230877089, 'MEGNANG a BETCHEM SETOU GRaCE', '', 'F', '2010-03-08', 'BAFIA', 'S20231958', '5D', '', 'N', 509, 'non_supprime', '', '', '', '2024 / 2025'),
(510, 0, 'MOUKOUS ANDRÉAS KELLY', '', 'F', '2013-06-18', 'BAFIA', 'S20232128', '5D', '', 'N', 510, 'non_supprime', '', '', '', '2024 / 2025'),
(511, 0, 'NDENG GABRIELLE ETIENNE', '', 'F', '2012-06-22', 'DONENKENG', 'S20230278', '5D', '', 'N', 511, 'non_supprime', '', '', '', '2024 / 2025'),
(512, 230706806, 'NDJAMA a MOUGNOKON LE DOUX', '', 'M', '2011-01-19', 'KIIKI', 'S20230279', '5D', '', 'N', 512, 'non_supprime', '', '', '', '2024 / 2025'),
(513, 0, 'NDJAMA À ZOCK EMMANUEL CHRISTIAN', '', 'M', '2012-10-01', 'BAFIA', 'S20230280', '5D', '', 'N', 513, 'non_supprime', '', '', '', '2024 / 2025'),
(514, 0, 'NDORO MARIE-BELLE', '', 'F', '2012-08-03', 'BAFIA', 'S20230282', '5D', '', 'N', 514, 'non_supprime', '', '', '', '2024 / 2025'),
(515, 0, 'NGON NDJOKO WISDOM GODWILL', '', 'M', '2011-06-19', 'BOKITO', 'S20231995', '5D', '', 'N', 515, 'non_supprime', '', '', '', '2024 / 2025'),
(516, 0, 'NGON YANGA ROSIE CARELLE', '', 'F', '2010-11-13', 'BAFIA', 'S20232044', '5D', '', 'N', 516, 'non_supprime', '', '', '', '2024 / 2025'),
(517, 0, 'NKOMIDIO MBANG LUCRÈCE FALONNE', '', 'F', '2012-08-10', 'BAFIA', 'S20232123', '5D', '', 'N', 517, 'non_supprime', '', '', '', '2024 / 2025'),
(518, 0, 'NOUBISSIE ARMELLE', '', 'F', '2012-08-10', 'BAFIA', 'S20230299', '5D', '', 'N', 518, 'non_supprime', '', '', '', '2024 / 2025'),
(519, 230596877, 'NOYIEWO FOTSO GRaCE DIVINE', '', 'F', '2013-04-14', 'BAFIA', 'S20230301', '5D', '', 'N', 519, 'non_supprime', '', '', '', '2024 / 2025'),
(520, 0, 'NWAL À MABEN RODRIGUE ORPHÉE', '', 'M', '2012-03-29', 'LABLÉ BAFIA', 'S20230303', '5D', '', 'N', 520, 'non_supprime', '', '', '', '2024 / 2025'),
(521, 0, 'REBAE À NGOMO ODETTE MERVEILLES', '', 'F', '2013-09-06', 'BAFIA', 'S20232074', '5D', '', 'N', 521, 'non_supprime', '', '', '', '2024 / 2025'),
(522, 0, 'RIMOH ASSAMBA SOLEIL', '', 'F', '2011-04-14', 'BAFIA', 'S20232082', '5D', '', 'N', 522, 'non_supprime', '', '', '', '2024 / 2025'),
(523, 0, 'TCHIEL À NGAY KYSNELLE CARELLE', '', 'F', '2011-03-01', 'MAKENENE', 'S20232085', '5D', '', 'N', 523, 'non_supprime', '', '', '', '2024 / 2025'),
(524, 0, 'TCHOUATÉ BAKOA LENA NELY', '', 'F', '2010-05-16', 'KOMBO-LAKA', 'S20232039', '5D', '', 'N', 524, 'non_supprime', '', '', '', '2024 / 2025'),
(525, 0, 'TIZE BABARA', '', 'M', '2011-11-01', 'BAFIA', 'S20230333', '5D', '', 'N', 525, 'non_supprime', '', '', '', '2024 / 2025'),
(526, 0, 'TOM REKIA ZENABOU', '', 'F', '2011-05-02', 'BAFIA', 'S20230335', '5D', '', 'N', 526, 'non_supprime', '', '', '', '2024 / 2025'),
(527, 0, 'TOMBI À BEYECK ABIGAËL GLORIA', '', 'F', '2012-02-01', 'BAFIA', 'S20230336', '5D', '', 'N', 527, 'non_supprime', '', '', '', '2024 / 2025'),
(528, 230820854, 'TSANOU BELINGA', '', 'F', '2012-08-22', 'LABLï¿½ BAFIA', 'S20230337', '5D', '', 'N', 528, 'non_supprime', '', '', '', '2024 / 2025'),
(529, 231745973, 'TUFE TSUATA SHALOM', '', 'M', '2012-01-15', 'BAFIA', 'S20230339', '5D', '', 'N', 529, 'non_supprime', '', '', '', '2024 / 2025'),
(530, 0, 'WAÏDEMO MISSA JULIETTE MORTINNIENNE', '', 'F', '2012-10-29', 'NGAOUNDAL', 'S20230341', '5D', '', 'N', 530, 'non_supprime', '', '', '', '2024 / 2025'),
(531, 230599595, 'WANKEU NATHALIE LABELLE', '', 'F', '2012-03-25', 'NDIKINIMEKI', 'S20230342', '5D', '', 'N', 531, 'non_supprime', '', '', '', '2024 / 2025'),
(532, 0, 'WANSAM BEYO STÉPHANE', '', 'M', '2011-11-08', 'BOKO MONTAGNE', 'S20231012', '5D', '', 'N', 532, 'non_supprime', '', '', '', '2024 / 2025'),
(533, 0, 'YOMBI À BOUE ILLORIS', '', 'M', '2012-10-15', 'BAFIA', 'S20232293', '5D', '', 'R', 533, 'non_supprime', '', '', '', '2024 / 2025'),
(534, 0, 'ZINTCHEM FRANKLIN BOYANN', '', 'M', '2011-02-17', 'BAFIA', 'S20230358', '5D', '', 'N', 534, 'non_supprime', '', '', '', '2024 / 2025'),
(535, 230801837, 'ZOA YONGHA HeLeNE', '', 'F', '2009-01-11', 'BAFIA', 'S20230359', '5D', '', 'N', 535, 'non_supprime', '', '', '', '2024 / 2025'),
(536, 230588678, 'mbara', 'clotilde prudence', 'F', '2007-03-28', 'bafia', 'S20192537', '1chi', '', 'R', 536, 'non_supprime', 'bilong a mbara gilbert', 'ndiang madeleine', '', '2024 / 2025'),
(537, 231764285, 'betchem bigna', 'paul eric', 'M', '2004-04-25', 'bafia', 'S20232270', 'ta4-esp', '', 'R', 537, 'non_supprime', 'azerty', 'azerty', '', '2024 / 2025'),
(538, 0, 'sembel ekoueyi', 'gaetan donald', 'M', '2001-08-16', 'ninguessen - yambetta', 'S20211245', 'ta4-esp', '', 'N', 538, 'non_supprime', 'azerty', 'azerty', '', '2024 / 2025'),
(539, 0, 'membok wawe', 'amadou', 'M', '2010-01-10', 'bafia', 'D2024-0539', '5D', '', 'N', 539, 'non_supprime', 'azerty', 'azerty', '', '2024 / 2025'),
(540, 0, 'ngom', 'joseph desire', 'M', '2007-07-27', 'yaoundÃ©', 'D2024-0540', '3A-ALL', '', 'N', 540, 'non_supprime', 'azerty', 'azerty', '', '2024 / 2025');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(100) NOT NULL COMMENT 'Mr ou Mme',
  `poste` varchar(100) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `sexe`, `poste`, `login`, `mdp`, `etat`, `image`) VALUES
(1, 'Administrateur', NULL, 'Mr', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'actif', ''),
(2, 'Cellule', 'Informatique', 'Mr', 'cell', 'cell', '5f435eb30281de82a41717382717b0626fdd64bc', 'actif', ''),
(3, 'amaguega', 'alain', 'Mr', 'cell', 'alino', '3e66317909c857c0c61c72e67d046daefac1c5b2', 'actif', ''),
(4, 'NKENGUE A NGON', 'ETIENNE', 'Mr', 'prof', 'nkengue', '6d93a15b11f2cc37f45f29d9a996bf384e78cb87', 'actif', ''),
(5, 'agon', 'paule laqueen', 'Mme', 'prof', 'agon', '24bedab33e290c7e0e5aeabd08ae06b939539a3a', 'actif', ''),
(6, 'stephanette sylvie', 'mengang', 'Mme', 'prof', 'mengang', '8107eb1bb58a3771cbbcc0b1c20d4e581ad66edc', 'actif', ''),
(7, 'adeng', 'nicole', 'Mme', 'prof', 'adeng', '5d133893854ab03cfd98ef2fc98a7a52ab51d75c', 'actif', ''),
(8, 'wellifack a etong', 'jeannette', 'Mme', 'prof', 'wellifack', '58eb8bfd5863a2bf8be9941cf2fee66457452584', 'actif', ''),
(9, 'bayokolack', 'andrÃ©', 'Mr', 'prof', 'bayo', '9b02edf0a8e758e8664f2aaa5a4945aeffe15ad5', 'actif', ''),
(10, 'anong anong', 'ivan claude', 'Mr', 'prof', 'anong', 'bc0615afe26bcb63f5eca6a8989e50885fe9a1b4', 'actif', ''),
(11, 'kougnol', 'blandine', 'Mme', 'prof', 'kougnol', 'ea1b00e2dbeae9a9613a62bfeb1daf21c4497c5c', 'actif', ''),
(12, 'alene kombou', 'nina aurelie', 'Mme', 'prof', 'alene', '9a540e14dcf78e2f8ff1c4fd4e20d936626856b3', 'actif', ''),
(13, 'hamadou', ' ', 'Mr', 'prof', 'hamadou', '6b73dc99508e96d771c8f4bc702a041ddb991590', 'actif', ''),
(14, 'amene zenabou', ' ', 'Mme', 'prof', 'amene', '07faafa8d387bc1399c3a9ff6cbb3688fec07718', 'actif', ''),
(15, 'bouaye', 'alphonse', 'Mr', 'eco', 'bouaye', '6a519081f7c8bb3ec6ee9ebdeebf026b424d9fdc', 'actif', ''),
(16, 'ayangma', 'fabrice', 'Mr', 'prof', 'ayangma', '09dd755086aaa84a10c5479432da94ce3fad8dbf', 'actif', ''),
(17, 'tiwa', 'edouard legrand', 'Mr', 'prof', 'tiwa', '99264107f4c1c33481d9cd2f6cfa5df6be69d0b2', 'actif', ''),
(18, 'meyong', 'ernestine', 'Mme', 'prof', 'meyong', 'a049a51c89509291e7735728c1e18de40c5c2a9d', 'actif', ''),
(19, 'boyeba', 'chanceline', 'Mme', 'prof', 'boyeba', '60846cd4394edb9e072211058deed741e5caa7a4', 'actif', ''),
(20, 'ikoanuma', 'helen ngando', 'Mme', 'prof', 'helen', '6469cae2f553d304b9fdfc5c08fe688f83a0ed79', 'actif', ''),
(21, 'aliyou', 'aboubakar', 'Mr', 'prof', 'aliyou', '131500347de7708658754aec4f7b7939e04e8dd4', 'actif', ''),
(22, 'ngono messobo', 'rene', 'Mr', 'prof', 'ngono', '6549fec273698c14a5b8c62d0da97ad909ecb1a6', 'actif', ''),
(23, 'tsafack wamba', 'francois', 'Mr', 'prof', 'tsafack', 'fea3989725ae9ccf3701ed8d95571586dbc9c160', 'actif', ''),
(24, 'kenfack', 'willy', 'Mr', 'prof', 'kenfack', '1e3b300f8096d9673d28380e5885c7a5bb07a576', 'actif', ''),
(25, 'moupe mounde', 'ibrahim', 'Mr', 'prof', 'moupe', '5c4e90637c484f80c6a7de5b0eed13ccb3a54c92', 'actif', ''),
(26, 'nyambi ngikwa', 'richard', 'Mr', 'prof', 'nyambi', '79f6ce076f2320b9d6a4b3f5d33675ef2ebe9f6a', 'actif', ''),
(27, 'nkal', 'eric', 'Mr', 'prof', 'nkal', 'fe89aadbd27b23c40372062a4588c953596f75f1', 'actif', ''),
(28, 'zintchem a ngam', 'oumar', 'Mr', 'prof', 'zintchem', 'bd8d466ca18c7954b7ba2a547be50f2a0731ff51', 'actif', ''),
(29, 'bamenda a ngon', 'sophie', 'Mme', 'prof', 'manga', '1c404c691e1ce199d7682f5526652b4f55d19326', 'actif', ''),
(30, 'ayomack', 'solange', 'Mme', 'prof', 'ayomack', 'b2ab5493ea9d919661d245a07c5d39e086429375', 'actif', ''),
(31, 'mounpoubeyi', 'moise', 'Mr', 'censeur', 'mounpou', 'd8c86956a1801147ad98a2018466d769ccc58dcc', 'actif', ''),
(32, 'bogning', 'michel', 'Mr', 'sg', 'bogning', 'fe0a0af7e77588e494f67b62dd089fc7984df562', 'actif', ''),
(33, 'mouthe', 'jean claude', 'Mr', 'sg', 'mouthe', '5dd18749553cace8ce714fb920fce187a3979acc', 'actif', ''),
(34, 'ngon a biaka', 'issa', 'Mr', 'sg', 'ngon', '206621adf241be06cc64e28227e18011d754542c', 'actif', ''),
(35, 'ndjike', ' ', 'Mr', 'sg', 'ndjike', '467d95b5445e59f7e23a045bdcc94c481e9f5dd9', 'actif', ''),
(36, 'iroume a matchan', ' ', 'Mr', 'sg', 'iroume', '6e49f5c6489e5730c3f8fcf88f3433cc8ad7cd72', 'actif', ''),
(37, 'njock', 'jean pierre', 'Mr', 'sg', 'njock', 'e74caafc022c9f85b883461c8cb191063ad66c19', 'actif', ''),
(38, 'liko', 'jean guy', 'Mr', 'sg', 'liko', 'b3da4a87f0d8cb692bbf29fb2bf65cd1908ca445', 'actif', ''),
(39, 'ndembe', 'rose', 'Mme', 'prof', 'ndembe', 'ac0622346b5ffe081c7f564aa6f144239ea25db2', 'actif', ''),
(40, 'djeuga', 'yannick', 'Mme', 'prof', 'djeuga', 'de1cecaf1fb1462404520f1c66832e25e4ff2875', 'actif', ''),
(41, 'amang', 'marianne', 'Mme', 'censeur', 'amang', '57621d667bf26ef0c24f338f450a956aa57335e1', 'actif', ''),
(42, 'mbang', 'crescence', 'Mme', 'prof', 'mbang', '3edf0acfb06f5d6696e42a5a7f376aa1c2baca15', 'actif', '');

-- --------------------------------------------------------

--
-- Structure de la table `information`
--

CREATE TABLE `information` (
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
  `titre_signataire` varchar(255) DEFAULT NULL,
  `app_version` varchar(20) DEFAULT NULL,
  `app_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `information`
--

INSERT INTO `information` (`annee_scolaire`, `nom_pays`, `nom_devise`, `nom_ministere`, `nom_region`, `nom_departement`, `nom_ets`, `type_ets`, `chef_ets`, `signataire`, `arrondissement`, `sexe_signataire`, `contact`, `titre_signataire`, `app_version`, `app_name`) VALUES
('2024 / 2025', 'REPUBLIQUE DU CAMEROUN', 'Paix - Travail - Patrie', 'MINISTERE DES ENSEIGNEMENTS SECONDAIRES', 'Delegation RÃƒÂ©gionale du Centre', 'Delegation Departementale du mbam et inoubou', 'lycee classique et moderne de bafia', 'lycee', 'MOKA ABRAHAM', 'Le Proviseur', 'Bafia', 'M', '675489227', 'Monsieur ', 'Noteplus 1.0.4', 'Gestionnaire des Notes Scolaires');

-- --------------------------------------------------------

--
-- Structure de la table `journal_connexion`
--

CREATE TABLE `journal_connexion` (
  `id` int(11) NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `adresse_ip` varchar(255) NOT NULL,
  `periode_de_connexion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `journal_connexion`
--

INSERT INTO `journal_connexion` (`id`, `utilisateur`, `adresse_ip`, `periode_de_connexion`) VALUES
(1, 'cell', '::1', '2024-10-01 13:16:21'),
(2, 'cell', '::1', '2024-10-01 13:34:34'),
(3, 'alino', '192.168.1.105', '2024-10-01 13:35:45'),
(4, 'cell', '::1', '2024-10-01 14:02:17'),
(5, 'cell', '::1', '2024-10-01 16:47:36'),
(6, 'cell', '::1', '2024-10-01 16:50:15'),
(7, 'cell', '::1', '2024-10-01 16:52:45'),
(8, 'cell', '::1', '2024-10-01 16:53:43'),
(9, 'cell', '192.168.1.104', '2024-10-01 16:54:32'),
(10, 'cell', '::1', '2024-10-01 16:56:30'),
(11, 'cell', '::1', '2024-10-01 16:56:56'),
(12, 'cell', '::1', '2024-10-01 16:59:13'),
(13, 'cell', '192.168.1.104', '2024-10-01 17:01:06'),
(14, 'agon', '::1', '2024-10-01 21:22:54'),
(15, 'agon', '192.168.1.110', '2024-10-01 21:31:24'),
(16, 'bouaye', '192.168.1.110', '2024-10-01 21:33:34'),
(17, 'nyambi', '192.168.1.110', '2024-10-01 21:40:24'),
(18, 'cell', '::1', '2024-10-01 21:40:47'),
(19, 'agon', '192.168.1.110', '2024-10-01 21:45:42'),
(20, 'nyambi', '192.168.1.110', '2024-10-01 21:56:25'),
(21, 'cell', '192.168.1.120', '2024-10-01 22:21:38'),
(22, 'admin', '192.168.1.119', '2024-10-03 09:05:26'),
(23, 'cell', '192.168.1.103', '2024-10-03 09:24:01'),
(24, 'Cell', '192.168.1.104', '2024-10-03 12:48:58'),
(25, 'cell', '::1', '2024-10-03 12:49:19'),
(26, 'cell', '::1', '2024-10-03 13:47:56'),
(27, 'cell', '192.168.1.120', '2024-10-03 14:01:28'),
(28, 'mounpou', '192.168.1.100', '2024-10-03 14:16:22'),
(29, 'bogning', '192.168.1.100', '2024-10-03 14:19:41'),
(30, 'admin', '192.168.1.100', '2024-10-03 14:26:54'),
(31, 'cell', '127.0.0.1', '2024-10-06 15:27:55');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `nom_matiere` varchar(255) NOT NULL,
  `code_matiere` varchar(100) NOT NULL,
  `etat` varchar(100) NOT NULL COMMENT 'actif ou inactif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom_matiere`, `code_matiere`, `etat`) VALUES
(1, 'Anglais', 'ang', 'actif'),
(2, 'Allemand', 'all', 'actif'),
(3, 'Espagnol', 'esp', 'actif'),
(4, 'arabe', 'ara', 'actif'),
(5, 'chinois', 'chi', 'actif'),
(6, 'latin', 'lat', 'actif'),
(7, 'langue francaise', 'lang', 'actif'),
(8, 'litterature francaise', 'litt', 'actif'),
(9, 'Correction Orth', 'co', 'actif'),
(10, 'expression ecrite', 'ee', 'actif'),
(11, 'expression orale', 'eo', 'actif'),
(12, 'etude de texte', 'etx', 'actif'),
(13, 'education a la citoyennete', 'ecm', 'actif'),
(14, 'geographie', 'geo', 'actif'),
(15, 'histoire', 'hist', 'actif'),
(16, 'Informatique', 'info', 'actif'),
(17, 'Mathematiques', 'maths', 'actif'),
(18, 'physiques', 'phys', 'actif'),
(19, 'Chimie', 'chim', 'actif'),
(20, 'Physiques - Chimie - Technologies', 'pct', 'actif'),
(21, 'Sciences', 'sc', 'actif'),
(22, 'SVTEEHB', 'SVTEEHB', 'actif'),
(23, 'Langues et Culture nationale', 'LCN', 'actif'),
(24, 'EPS', 'EPS', 'actif'),
(25, 'Travail Manuel', 'tm', 'actif'),
(26, 'ESF', 'ESF', 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_classe`
--

CREATE TABLE `niveau_classe` (
  `id` int(11) NOT NULL,
  `nom_niveau` varchar(100) NOT NULL,
  `code_niveau` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `niveau_classe`
--

INSERT INTO `niveau_classe` (`id`, `nom_niveau`, `code_niveau`) VALUES
(1, '6eme', '6eme'),
(2, '5eme', '5eme'),
(3, '4eme', '4eme'),
(4, '3eme', '3eme'),
(5, '2nde', '2nde'),
(6, '1ere', '1ere'),
(7, 'tle', 'tle');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL COMMENT 'voir eleve.id',
  `id_matiere` varchar(100) NOT NULL COMMENT 'voir matiere.id',
  `id_classe` varchar(100) NOT NULL COMMENT 'voir code_classe',
  `id_periode` int(11) NOT NULL COMMENT 'voir periode.id',
  `note_simple` decimal(4,2) DEFAULT NULL COMMENT 'note sur 20'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `note_saisie`
--

CREATE TABLE `note_saisie` (
  `id` int(11) NOT NULL,
  `enseignant` varchar(100) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `nom_periode` varchar(255) NOT NULL,
  `date_ouvert` date NOT NULL COMMENT 'debut disponibilitÃ©',
  `date_fermet` date NOT NULL COMMENT 'fin disponibilitÃ©'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`id`, `nom_periode`, `date_ouvert`, `date_fermet`) VALUES
(1, 'SÃ©quence 1', '2024-10-01', '2024-10-02'),
(2, 'SÃ©quence 2', '0000-00-00', '0000-00-00'),
(3, 'SÃ©quence 3', '0000-00-00', '0000-00-00'),
(4, 'SÃ©quence 4', '0000-00-00', '0000-00-00'),
(5, 'SÃ©quence 5', '0000-00-00', '0000-00-00'),
(6, 'SÃ©quence 6', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id` int(11) NOT NULL,
  `code_poste` varchar(100) NOT NULL,
  `libelle_poste` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `poste`
--

INSERT INTO `poste` (`id`, `code_poste`, `libelle_poste`) VALUES
(1, 'admin', 'Administrateur'),
(2, 'cell', 'Cellule Informatique'),
(3, 'censeur', 'Censeur'),
(4, 'sg', 'Surveillant GÃ©nÃ©ral'),
(5, 'eco', 'Econome / Intendant'),
(6, 'prof', 'Enseignant'),
(7, 'chef', 'Proviseur / Principal / Directeur');

-- --------------------------------------------------------

--
-- Structure de la table `prof_classe`
--

CREATE TABLE `prof_classe` (
  `id` int(11) NOT NULL,
  `id_prof` varchar(255) NOT NULL COMMENT 'login enseignant',
  `id_classe` varchar(100) NOT NULL COMMENT 'code de la classe',
  `id_matiere` varchar(255) NOT NULL COMMENT 'voir matiere.id',
  `coef` decimal(2,1) NOT NULL,
  `groupe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `prof_classe`
--

INSERT INTO `prof_classe` (`id`, `id_prof`, `id_classe`, `id_matiere`, `coef`, `groupe`) VALUES
(1, 'nkengue', '6A', 'EPS', '2.0', 'gp3'),
(2, 'agon', '6A', 'ESF', '1.0', 'gp3'),
(3, '', '6A', 'tm', '1.0', 'gp3'),
(4, 'mengang', '6b', 'EPS', '2.0', 'gp3'),
(5, 'adeng', '6b', 'ESF', '2.0', 'gp3'),
(6, '', '6b', 'tm', '1.0', 'gp3'),
(7, 'mengang', '6c', 'EPS', '2.0', 'gp3'),
(8, 'wellifack', '6c', 'ESF', '2.0', 'gp3'),
(9, '', '6c', 'tm', '1.0', 'gp3'),
(10, 'mengang', '6d', 'EPS', '2.0', 'gp3'),
(11, 'agon', '6d', 'ESF', '2.0', 'gp3'),
(12, '', '6d', 'tm', '1.0', 'gp3'),
(13, 'bayo', '5A', 'EPS', '2.0', 'gp3'),
(14, '', '5A', 'ESF', '2.0', 'gp3'),
(15, '', '5A', 'tm', '1.0', 'gp3'),
(16, 'nkengue', '5B', 'EPS', '2.0', 'gp3'),
(17, '', '5B', 'ESF', '2.0', 'gp3'),
(18, '', '5B', 'tm', '1.0', 'gp3'),
(19, 'bayo', '5C', 'EPS', '2.0', 'gp3'),
(20, '', '5C', 'ESF', '2.0', 'gp3'),
(21, '', '5C', 'tm', '1.0', 'gp3'),
(22, 'nkengue', '5D', 'EPS', '2.0', 'gp3'),
(23, '', '5D', 'ESF', '2.0', 'gp3'),
(24, '', '5D', 'tm', '1.0', 'gp3'),
(25, '', '4A', 'EPS', '2.0', 'gp3'),
(26, '', '4A', 'ESF', '2.0', 'gp3'),
(27, '', '4A', 'tm', '1.0', 'gp3'),
(28, '', '4B-ara', 'EPS', '2.0', 'gp3'),
(29, '', '4B-ara', 'ESF', '2.0', 'gp3'),
(30, '', '4B-ara', 'tm', '1.0', 'gp3'),
(31, '', '4B-chi', 'EPS', '2.0', 'gp3'),
(32, '', '4B-chi', 'ESF', '2.0', 'gp3'),
(33, '', '4B-chi', 'tm', '1.0', 'gp3'),
(34, '', '4C', 'EPS', '2.0', 'gp3'),
(35, '', '4C', 'ESF', '2.0', 'gp3'),
(36, '', '4C', 'tm', '1.0', 'gp3'),
(37, '', '4D', 'EPS', '2.0', 'gp3'),
(38, '', '4D', 'ESF', '2.0', 'gp3'),
(39, '', '4D', 'tm', '1.0', 'gp3'),
(41, '', '3A-ALL', 'ESF', '2.0', 'gp3'),
(43, '', '3A-ALL', 'EPS', '2.0', 'gp3'),
(44, '', '3A-ALL', 'tm', '1.0', 'gp3'),
(45, '', '3B-ara', 'EPS', '2.0', 'gp3'),
(46, '', '3B-ara', 'ESF', '2.0', 'gp3'),
(47, '', '3B-ara', 'tm', '1.0', 'gp3'),
(48, '', '3B-chi', 'EPS', '2.0', 'gp3'),
(49, '', '3B-chi', 'ESF', '2.0', 'gp3'),
(50, '', '3B-chi', 'tm', '1.0', 'gp3'),
(51, '', '3C-esp', 'EPS', '2.0', 'gp3'),
(52, '', '3C-esp', 'ESF', '2.0', 'gp3'),
(53, '', '3C-esp', 'tm', '1.0', 'gp3'),
(54, '', '3d-esp', 'EPS', '2.0', 'gp3'),
(55, '', '3d-esp', 'ESF', '2.0', 'gp3'),
(56, '', '3d-esp', 'tm', '1.0', 'gp3'),
(57, '', '6A', 'info', '2.0', 'gp2'),
(58, '', '6A', 'maths', '4.0', 'gp2'),
(59, '', '6A', 'sc', '2.0', 'gp2'),
(60, '', '6b', 'info', '2.0', 'gp2'),
(61, '', '6b', 'maths', '4.0', 'gp2'),
(62, '', '6b', 'sc', '2.0', 'gp2'),
(63, '', '6c', 'info', '2.0', 'gp2'),
(64, '', '6c', 'maths', '4.0', 'gp2'),
(65, '', '6c', 'sc', '2.0', 'gp2'),
(66, 'nyambi', '6d', 'info', '2.0', 'gp2'),
(67, '', '6d', 'maths', '4.0', 'gp2'),
(68, '', '6d', 'sc', '2.0', 'gp2'),
(69, '', '5A', 'info', '2.0', 'gp2'),
(70, '', '5A', 'maths', '4.0', 'gp2'),
(71, '', '5A', 'sc', '2.0', 'gp2'),
(72, '', '5B', 'info', '2.0', 'gp2'),
(73, '', '5B', 'maths', '4.0', 'gp2'),
(74, '', '5B', 'sc', '2.0', 'gp2'),
(75, 'nyambi', '5C', 'info', '2.0', 'gp2'),
(76, '', '5C', 'maths', '4.0', 'gp2'),
(77, '', '5C', 'sc', '2.0', 'gp2'),
(78, '', '5D', 'info', '2.0', 'gp2'),
(79, '', '5D', 'maths', '4.0', 'gp2'),
(80, '', '5D', 'sc', '2.0', 'gp2'),
(81, '', '2c', 'EPS', '2.0', 'gp3'),
(82, '', '2c', 'ESF', '1.0', 'gp3'),
(83, '', '2c', 'tm', '2.0', 'gp3'),
(84, '', '2a3-esp', 'EPS', '2.0', 'gp3'),
(85, '', '2a3-esp', 'ESF', '1.0', 'gp3'),
(86, '', '2a3-esp', 'tm', '2.0', 'gp3'),
(87, '', '2a2-esp', 'EPS', '2.0', 'gp3'),
(88, '', '2a2-esp', 'ESF', '1.0', 'gp3'),
(89, '', '2a2-esp', 'tm', '2.0', 'gp3'),
(90, '', '2a1-all', 'EPS', '2.0', 'gp3'),
(91, '', '2a1-all', 'ESF', '1.0', 'gp3'),
(92, '', '2a1-all', 'tm', '2.0', 'gp3'),
(93, '', '2ara', 'EPS', '2.0', 'gp3'),
(94, '', '2ara', 'ESF', '1.0', 'gp3'),
(95, '', '2ara', 'tm', '2.0', 'gp3'),
(96, '', '2chi', 'EPS', '2.0', 'gp3'),
(97, '', '2chi', 'ESF', '1.0', 'gp3'),
(98, '', '2chi', 'tm', '2.0', 'gp3'),
(99, '', '4A', 'info', '2.0', 'gp2'),
(100, '', '4A', 'maths', '4.0', 'gp2'),
(101, '', '4A', 'pct', '2.0', 'gp2'),
(102, '', '4A', 'SVTEEHB', '2.0', 'gp2'),
(103, '', '4B-ara', 'info', '2.0', 'gp2'),
(104, '', '4B-ara', 'maths', '4.0', 'gp2'),
(105, '', '4B-ara', 'pct', '2.0', 'gp2'),
(106, '', '4B-ara', 'SVTEEHB', '2.0', 'gp2'),
(107, '', '4B-chi', 'info', '2.0', 'gp2'),
(108, '', '4B-chi', 'maths', '4.0', 'gp2'),
(109, '', '4B-chi', 'pct', '2.0', 'gp2'),
(110, '', '4B-chi', 'SVTEEHB', '2.0', 'gp2'),
(111, '', '4C', 'info', '2.0', 'gp2'),
(112, '', '4C', 'maths', '4.0', 'gp2'),
(113, '', '4C', 'pct', '2.0', 'gp2'),
(114, '', '4C', 'SVTEEHB', '2.0', 'gp2'),
(115, '', '4D', 'info', '2.0', 'gp2'),
(116, '', '4D', 'maths', '4.0', 'gp2'),
(117, '', '4D', 'pct', '2.0', 'gp2'),
(118, '', '4D', 'SVTEEHB', '2.0', 'gp2'),
(119, '', '3A-ALL', 'info', '2.0', 'gp2'),
(120, '', '3A-ALL', 'maths', '4.0', 'gp2'),
(121, '', '3A-ALL', 'pct', '2.0', 'gp2'),
(122, '', '3A-ALL', 'SVTEEHB', '2.0', 'gp2'),
(123, '', '3B-ara', 'info', '2.0', 'gp2'),
(124, '', '3B-ara', 'maths', '4.0', 'gp2'),
(125, '', '3B-ara', 'pct', '2.0', 'gp2'),
(126, '', '3B-ara', 'SVTEEHB', '2.0', 'gp2'),
(127, '', '3B-chi', 'info', '2.0', 'gp2'),
(128, '', '3B-chi', 'maths', '4.0', 'gp2'),
(129, '', '3B-chi', 'pct', '2.0', 'gp2'),
(130, '', '3B-chi', 'SVTEEHB', '2.0', 'gp2'),
(131, '', '3C-esp', 'info', '2.0', 'gp2'),
(132, '', '3C-esp', 'maths', '4.0', 'gp2'),
(133, '', '3C-esp', 'pct', '2.0', 'gp2'),
(134, '', '3C-esp', 'SVTEEHB', '2.0', 'gp2'),
(135, '', '3d-esp', 'info', '2.0', 'gp2'),
(136, '', '3d-esp', 'maths', '4.0', 'gp2'),
(137, '', '3d-esp', 'pct', '2.0', 'gp2'),
(138, '', '3d-esp', 'SVTEEHB', '2.0', 'gp2'),
(139, '', '6A', 'ang', '3.0', 'gp1'),
(140, '', '6A', 'co', '1.0', 'gp1'),
(141, '', '6A', 'ecm', '2.0', 'gp1'),
(142, '', '6A', 'etx', '1.0', 'gp1'),
(143, '', '6A', 'ee', '2.0', 'gp1'),
(144, '', '6A', 'eo', '2.0', 'gp1'),
(145, '', '6A', 'geo', '2.0', 'gp1'),
(146, '', '6A', 'hist', '2.0', 'gp1'),
(147, '', '6A', 'LCN', '2.0', 'gp1'),
(148, '', '6A', 'lat', '2.0', 'gp1'),
(149, '', '6b', 'ang', '3.0', 'gp1'),
(150, '', '6b', 'co', '1.0', 'gp1'),
(151, '', '6b', 'ecm', '2.0', 'gp1'),
(152, '', '6b', 'etx', '1.0', 'gp1'),
(153, '', '6b', 'ee', '2.0', 'gp1'),
(154, '', '6b', 'eo', '2.0', 'gp1'),
(155, '', '6b', 'geo', '2.0', 'gp1'),
(156, '', '6b', 'hist', '2.0', 'gp1'),
(157, '', '6b', 'LCN', '2.0', 'gp1'),
(158, '', '6b', 'lat', '2.0', 'gp1'),
(159, '', '6c', 'ang', '3.0', 'gp1'),
(160, '', '6c', 'co', '1.0', 'gp1'),
(161, '', '6c', 'ecm', '2.0', 'gp1'),
(162, '', '6c', 'etx', '1.0', 'gp1'),
(163, '', '6c', 'ee', '2.0', 'gp1'),
(164, '', '6c', 'eo', '2.0', 'gp1'),
(165, '', '6c', 'geo', '2.0', 'gp1'),
(166, '', '6c', 'hist', '2.0', 'gp1'),
(167, '', '6c', 'LCN', '2.0', 'gp1'),
(168, '', '6c', 'lat', '2.0', 'gp1'),
(169, '', '6d', 'ang', '3.0', 'gp1'),
(170, '', '6d', 'co', '1.0', 'gp1'),
(171, '', '6d', 'ecm', '2.0', 'gp1'),
(172, '', '6d', 'etx', '1.0', 'gp1'),
(173, '', '6d', 'ee', '2.0', 'gp1'),
(174, '', '6d', 'eo', '2.0', 'gp1'),
(175, '', '6d', 'geo', '2.0', 'gp1'),
(176, '', '6d', 'hist', '2.0', 'gp1'),
(177, '', '6d', 'LCN', '2.0', 'gp1'),
(178, '', '6d', 'lat', '2.0', 'gp1'),
(179, '', '5A', 'ang', '3.0', 'gp1'),
(180, '', '5A', 'co', '1.0', 'gp1'),
(181, '', '5A', 'ecm', '2.0', 'gp1'),
(182, '', '5A', 'etx', '1.0', 'gp1'),
(183, '', '5A', 'ee', '2.0', 'gp1'),
(184, '', '5A', 'eo', '2.0', 'gp1'),
(185, '', '5A', 'geo', '2.0', 'gp1'),
(186, '', '5A', 'hist', '2.0', 'gp1'),
(187, '', '5A', 'LCN', '2.0', 'gp1'),
(188, '', '5A', 'lat', '2.0', 'gp1'),
(189, '', '5B', 'ang', '3.0', 'gp1'),
(190, '', '5B', 'co', '1.0', 'gp1'),
(191, '', '5B', 'ecm', '2.0', 'gp1'),
(192, '', '5B', 'etx', '1.0', 'gp1'),
(193, '', '5B', 'ee', '2.0', 'gp1'),
(194, '', '5B', 'eo', '2.0', 'gp1'),
(195, '', '5B', 'geo', '2.0', 'gp1'),
(196, '', '5B', 'hist', '2.0', 'gp1'),
(197, '', '5B', 'LCN', '2.0', 'gp1'),
(198, '', '5B', 'lat', '2.0', 'gp1'),
(199, '', '5C', 'ang', '3.0', 'gp1'),
(200, '', '5C', 'co', '1.0', 'gp1'),
(201, '', '5C', 'ecm', '2.0', 'gp1'),
(202, '', '5C', 'etx', '1.0', 'gp1'),
(203, '', '5C', 'ee', '2.0', 'gp1'),
(204, '', '5C', 'eo', '2.0', 'gp1'),
(205, '', '5C', 'geo', '2.0', 'gp1'),
(206, '', '5C', 'hist', '2.0', 'gp1'),
(207, '', '5C', 'LCN', '2.0', 'gp1'),
(208, '', '5C', 'lat', '2.0', 'gp1'),
(209, '', '5D', 'ang', '3.0', 'gp1'),
(210, '', '5D', 'co', '1.0', 'gp1'),
(211, '', '5D', 'ecm', '2.0', 'gp1'),
(212, '', '5D', 'etx', '1.0', 'gp1'),
(213, '', '5D', 'ee', '2.0', 'gp1'),
(214, '', '5D', 'eo', '2.0', 'gp1'),
(215, '', '5D', 'geo', '2.0', 'gp1'),
(216, '', '5D', 'hist', '2.0', 'gp1'),
(217, '', '5D', 'LCN', '2.0', 'gp1'),
(218, '', '5D', 'lat', '2.0', 'gp1');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `appreciation`
--
ALTER TABLE `appreciation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bull_ann`
--
ALTER TABLE `bull_ann`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bull_trim`
--
ALTER TABLE `bull_trim`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe_principale`
--
ALTER TABLE `classe_principale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `date_absences`
--
ALTER TABLE `date_absences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `journal_connexion`
--
ALTER TABLE `journal_connexion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `niveau_classe`
--
ALTER TABLE `niveau_classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note_saisie`
--
ALTER TABLE `note_saisie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prof_classe`
--
ALTER TABLE `prof_classe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `appreciation`
--
ALTER TABLE `appreciation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `bull_ann`
--
ALTER TABLE `bull_ann`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `bull_trim`
--
ALTER TABLE `bull_trim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `classe_principale`
--
ALTER TABLE `classe_principale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `date_absences`
--
ALTER TABLE `date_absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;
--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `journal_connexion`
--
ALTER TABLE `journal_connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `niveau_classe`
--
ALTER TABLE `niveau_classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `note_saisie`
--
ALTER TABLE `note_saisie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `prof_classe`
--
ALTER TABLE `prof_classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
