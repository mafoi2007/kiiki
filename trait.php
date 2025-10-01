<?php 
	// require_once('inc/connect.inc.php');
	session_start();
	require_once('inc/connect.inc.php');
	
	$config = new Config($db);
	
	if(isset($_POST['init'])){
		echo '<pre>';
			print_r($_POST);
		
		$nomApp = 'Gestionnaire des Notes Scolaires';
		$versionApp = 'Noteplus 1.0.4';
		
		$tableStructure[0] = "CREATE TABLE IF NOT EXISTS absence(";
		$tableStructure[0] .= "id int(11) auto_increment primary key,";
		$tableStructure[0] .= "id_eleve int(11) not null,";
		$tableStructure[0] .= "date_absence date,";
		$tableStructure[0] .= "nombre_heure int(11) not null,";
		$tableStructure[0] .= "justification varchar(100) not null comment 'AJ ou ANJ'";
		$tableStructure[0] .= ");";
		
		$tableStructure[1]  = "CREATE TABLE IF NOT EXISTS `appreciation` (";
		$tableStructure[1] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[1] .= "`nom_appreciation` varchar(255) NOT NULL ,";
		$tableStructure[1] .= "`cote` varchar(100) NOT NULL ,";
		$tableStructure[1] .= "`interv_ouvert` int(2) NOT NULL COMMENT 'note de debut',";
		$tableStructure[1] .= "`interv_fermet` int(2) NOT NULL COMMENT 'note de fin',";
		$tableStructure[1] .= "`couleur` varchar(100) NOT NULL";
		$tableStructure[1] .= ");";
		
		$tableStructure[2]  = "CREATE TABLE IF NOT EXISTS `classe` (";
		$tableStructure[2] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[2] .= "`nom_classe` varchar(255) NOT NULL,";
		$tableStructure[2] .= "`code_classe` varchar(100) NOT NULL,";
		$tableStructure[2] .= "`etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',";
		$tableStructure[2] .= "`niveau` varchar(255) NOT NULL";
		$tableStructure[2] .= ");";
		
		$tableStructure[3]  = "CREATE TABLE IF NOT EXISTS `classe_principale` (";
		$tableStructure[3] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[3] .= "`prof` varchar(100) NOT NULL,";
		$tableStructure[3] .= "`classe` varchar(255) NOT NULL";
		$tableStructure[3] .= ");";
		
		$tableStructure[4]  = "CREATE TABLE IF NOT EXISTS `eleve` (";
		$tableStructure[4] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[4] .= "`rne` int(11) NOT NULL,";
		$tableStructure[4] .= "`nom` varchar(255) NOT NULL,";
		$tableStructure[4] .= "`prenom` varchar(255) DEFAULT NULL,";
		$tableStructure[4] .= "`sexe` varchar(1) NOT NULL,";
		$tableStructure[4] .= "`date_naissance` date NOT NULL,";
		$tableStructure[4] .= "`lieu_naissance` varchar(255) DEFAULT NULL,";
		$tableStructure[4] .= "`matricule` varchar(20) NOT NULL,";
		$tableStructure[4] .= "`classe` varchar(100) NOT NULL,";
		$tableStructure[4] .= "`adresse_parent` varchar(255) DEFAULT NULL,";
		$tableStructure[4] .= "`statut` varchar(100) NOT NULL COMMENT 'red, nv',";
		$tableStructure[4] .= "`num_rand` int(11) NOT NULL COMMENT 'on recupere sa val pour increm',";
		$tableStructure[4] .= "`etat` varchar(100) NOT NULL COMMENT 'supprimé ou pas',";
		$tableStructure[4] .= "`nom_pere` varchar(255) NOT NULL COMMENT 'papa du bb',";
		$tableStructure[4] .= "`nom_mere` varchar(255) NOT NULL COMMENT 'mama du bb',";
		$tableStructure[4] .= "`photo` varchar(255) not null comment 'adresse de la photo élève',";
		$tableStructure[4] .= "`a_s` varchar(11) not null comment 'annee scolaire'";
		$tableStructure[4] .= ");";
		
		$tableStructure[5]  = "CREATE TABLE IF NOT EXISTS `enseignant` (";
		$tableStructure[5] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[5] .= "`nom` varchar(255) NOT NULL,";
		$tableStructure[5] .= "`prenom` varchar(255) DEFAULT NULL,";
		$tableStructure[5] .= "`sexe` varchar(100) NOT NULL COMMENT 'Mr ou Mme',";
		$tableStructure[5] .= "`poste` varchar(100) NOT NULL,";
		$tableStructure[5] .= "`login` varchar(255) NOT NULL,";
		$tableStructure[5] .= "`mdp` varchar(255) NOT NULL,";
		$tableStructure[5] .= "`etat` varchar(100) NOT NULL COMMENT 'actif ou inactif',";
		$tableStructure[5] .= "`image` varchar(255) NOT NULL";
		$tableStructure[5] .= ");";
		
		$tableStructure[6]  = "CREATE TABLE IF NOT EXISTS `information`(";
		$tableStructure[6] .= "annee_scolaire varchar(11) not null,";
		$tableStructure[6] .= "nom_pays varchar(100) not null,";
		$tableStructure[6] .= "nom_devise varchar(255) not null,";
		$tableStructure[6] .= "nom_ministere varchar(255) not null,";
		$tableStructure[6] .= "nom_region varchar(255) not null,";
		$tableStructure[6] .= "nom_departement varchar(255),";
		$tableStructure[6] .= "nom_ets varchar(255) not null,";
		$tableStructure[6] .= "type_ets varchar(255) not null,";
		$tableStructure[6] .= "chef_ets varchar(255) not null,";
		$tableStructure[6] .= "signataire varchar(255) not null,";
		$tableStructure[6] .= "arrondissement varchar(100),";
		$tableStructure[6] .= "sexe_signataire varchar(20),";
		$tableStructure[6] .= "contact varchar(15),";
		$tableStructure[6] .= "titre_signataire varchar(255),";
		$tableStructure[6] .= "app_version varchar(20),";
		$tableStructure[6] .= "app_name varchar(100)";
		$tableStructure[6] .= ");";
		
		$tableStructure[7]  = "CREATE TABLE IF NOT EXISTS `journal_connexion` (";
		$tableStructure[7] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[7] .= "`utilisateur` varchar(100) NOT NULL,";
		$tableStructure[7] .= "`adresse_ip` varchar(255) NOT NULL,";
		$tableStructure[7] .= "`periode_de_connexion` datetime NOT NULL";
		$tableStructure[7] .= ");";
		
		$tableStructure[8]  = "CREATE TABLE IF NOT EXISTS `matiere` (";
		$tableStructure[8] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[8] .= "`nom_matiere` varchar(255) NOT NULL,";
		$tableStructure[8] .= "`code_matiere` varchar(100) NOT NULL,";
		$tableStructure[8] .= "`etat` varchar(100) NOT NULL COMMENT 'actif ou inactif'";
		$tableStructure[8] .= ");";
		
		$tableStructure[9]  = "CREATE TABLE IF NOT EXISTS niveau_classe(";
		$tableStructure[9] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[9] .= "`nom_niveau` varchar(100) NOT NULL,";
		$tableStructure[9] .= "`code_niveau` varchar(10) NOT NULL";
		$tableStructure[9] .= ");";
		
		$tableStructure[10]  = "CREATE TABLE IF NOT EXISTS `note` (";
		$tableStructure[10] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[10] .= "`id_eleve` int(11) NOT NULL COMMENT 'voir eleve.id',";
		$tableStructure[10] .= "`id_matiere` varchar(100) NOT NULL COMMENT 'voir matiere.id',";
		$tableStructure[10] .= "`id_classe` varchar(100) NOT NULL COMMENT 'voir code_classe',";
		$tableStructure[10] .= "`id_periode` int(11) NOT NULL COMMENT 'voir periode.id',";
		$tableStructure[10] .= "`competence` text NULL COMMENT 'enonce de la competence',";
		$tableStructure[10] .= "`note_simple` decimal(4,2) NULL COMMENT 'note sur 20'";
		$tableStructure[10] .= ");";
		
		$tableStructure[11]  = "CREATE TABLE IF NOT EXISTS `note_saisie`(";
		$tableStructure[11] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[11] .= "enseignant varchar(100) not null, ";
		$tableStructure[11] .= "classe varchar(100) not null,";
		$tableStructure[11] .= "matiere varchar(100) not null,";
		$tableStructure[11] .= "sequence int(11) not null";
		$tableStructure[11] .= ");";
		
		$tableStructure[12]  = "CREATE TABLE IF NOT EXISTS `periode` (";
		$tableStructure[12] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[12] .= "`nom_periode` varchar(255) NOT NULL,";
		$tableStructure[12] .= "`date_ouvert` date NOT NULL COMMENT 'debut disponibilité',";
		$tableStructure[12] .= "`date_fermet` date NOT NULL COMMENT 'fin disponibilité'";
		$tableStructure[12] .= ");";
		
		$tableStructure[13]  = "CREATE TABLE IF NOT EXISTS `prof_classe` (";
		$tableStructure[13] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[13] .= "`id_prof` varchar(255) NOT NULL COMMENT 'login enseignant',";
		$tableStructure[13] .= "`id_classe` varchar(100) NOT NULL COMMENT 'code de la classe',";
		$tableStructure[13] .= "`id_matiere` varchar(255) NOT NULL COMMENT 'voir matiere.id',";
		$tableStructure[13] .= "`coef` decimal(2,1) NOT NULL,";
		$tableStructure[13] .= "`groupe` varchar(255) NOT NULL";
		$tableStructure[13] .= ");";
		
		$tableStructure[14]  = "CREATE TABLE IF NOT EXISTS bull_trim(";
		$tableStructure[14] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[14] .= "`classe` varchar(100) NOT NULL,";
		$tableStructure[14] .= "`pret` varchar(5) NOT NULL,";
		$tableStructure[14] .= "`trim` int(11) NOT NULL";
		$tableStructure[14] .= ");";
		
		$tableStructure[15]  = "CREATE TABLE IF NOT EXISTS bull_ann(";
		$tableStructure[15] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[15] .= "`classe` varchar(100) NOT NULL,";
		$tableStructure[15] .= "`pret` varchar(5) NOT NULL";
		$tableStructure[15] .= ");";
		
		$tableStructure[16]  = "CREATE TABLE IF NOT EXISTS `poste` (";
		$tableStructure[16] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[16] .= "`code_poste` varchar(100) NOT NULL,";
		$tableStructure[16] .= "`libelle_poste` varchar(255) NOT NULL";
		$tableStructure[16] .= ");";
		
		$tableStructure[17]  = "CREATE TABLE IF NOT EXISTS `date_absences` (";
		$tableStructure[17] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[17] .= "`id_periode` int(11) NOT NULL,";
		$tableStructure[17] .= "`open_date` date NOT NULL COMMENT 'date ouverture',";
		$tableStructure[17] .= "`close_date` date NOT NULL COMMENT 'date_fermeture'";
		$tableStructure[17] .= ");";
		
		$tableStructure[18]  = "CREATE TABLE IF NOT EXISTS `annee_scolaire` (";
		$tableStructure[18] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[18] .= "`libelle_annee` varchar(100) NOT NULL,";
		$tableStructure[18] .= "`statut` varchar(100) NOT NULL COMMENT 'actif, inactif'";
		$tableStructure[18] .= ");";
		
		/*$tableStructure[16]  = "CREATE TABLE IF NOT EXISTS bull_seq(";
		$tableStructure[16] .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
		$tableStructure[16] .= "`classe` varchar(100) NOT NULL,";
		$tableStructure[16] .= "`pret` varchar(5) NOT NULL,";
		$tableStructure[16] .= "`seq` int(11) NOT NULL";
		$tableStructure[16] .= ");";*/
		
		// On execute les tables de création de structure 
		for($i=0;$i<count($tableStructure);$i++){
			$req = $config->setDatabaseStructure($tableStructure[$i]);
		}
		
		/*Une fois les structures de données créées, on peut maintenant y ajouter les informations 
		en fonction du formulaire d'initialisation  rempli. */
		$anneeScol = $_POST['as_debut'].' / '.$_POST['as_fin'];
		$nomPays = utf8_encode(strtoupper('republique du cameroun'));
		$nomDevise = utf8_encode('Paix - Travail - Patrie');
		$nomMinistere = utf8_encode(strtoupper($_POST['ministere']));
		$arrondissement = utf8_encode(ucwords($_POST['arrondissement']));
		$contact = utf8_encode($_POST['contact']);
		if($_POST['region']=='Adamaoua' or $_POST['region']=='Ouest'
			or $_POST['region']=='Est' or $_POST['region']=='Extreme Nord'){
				$nomRegion  = utf8_encode("Delegation Regionale de l' ");
				$nomRegion .= utf8_encode($_POST['region']);
		}
		else {
			$nomRegion  = utf8_encode("Delegation Régionale du ");
			$nomRegion .= utf8_encode($_POST['region']);
		}
		$nomDepartement = utf8_encode("Delegation Departementale du ");
		$nomDepartement .= utf8_encode($_POST['departement']);
		$nomEts = utf8_encode($_POST['etablissement']);
		$typeEts = utf8_encode($_POST['type_ets']);
		$chefEts = strtoupper($_POST['nom_signataire_bulletin']);
		$sexeChefEts = $_POST['sexe_signataire_bulletin'];
		if($sexeChefEts=='M'){
			$titreChefEts = 'Monsieur ';
		}elseif($sexeChefEts=='F'){
			$titreChefEts = 'Madame ';
		}
		if($typeEts=='ces'){
			if($sexeChefEts=='M'){
				$signataire = 'Le Directeur';
			}elseif($sexeChefEts=='F'){
				$signataire = 'La Directrice';
			}
			$niveaux = array('6eme','5eme','4eme','3eme');
		}elseif($typeEts=='lycee'){
			if($sexeChefEts=='M'){
				$signataire = 'Le Proviseur';
			}elseif($sexeChefEts=='F'){
				$signataire = 'La Proviseure';
			}
			$niveaux = array('6eme','5eme','4eme','3eme','2nde','1ere','tle');
		}elseif($typeEts=='college'){
			if($sexeChefEts=='M'){
				$signataire = 'Le Principal';
			}elseif($sexeChefEts=='F'){
				$signataire = 'La Principale';
			}
			$niveaux = array('6eme','5eme','4eme','3eme','2nde','1ere','tle');
		}
		
		
		$tableData[0]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[0] .= "interv_fermet, couleur, cote)";
		$tableData[0] .= " VALUES('CNA', 0, 10, '#FF0000','D');";
		
		$tableData[1]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[1] .= "interv_fermet, couleur, cote)";
		$tableData[1] .= " VALUES('CMA', 10, 12, '#00FF00', 'C');";
		
		$tableData[2]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[2] .= "interv_fermet, couleur, cote)";
		$tableData[2] .= " VALUES('CA', 12, 14, '#00FF00','C+');";
		
		$tableData[3]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[3] .= "interv_fermet, couleur, cote)";
		$tableData[3] .= " VALUES('CBA', 14, 15, '#0000FF','B');";
		
		$tableData[4]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[4] .= "interv_fermet, couleur, cote)";
		$tableData[4] .= " VALUES('CBA', 15, 16, '#0000FF', 'B+');";
		
		$tableData[5]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[5] .= "interv_fermet, couleur, cote)";
		$tableData[5] .= " VALUES('CTBA', 16, 18, '#0000FF', 'A');";
		
		$tableData[6]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[6] .= "interv_fermet, couleur, cote)";
		$tableData[6] .= " VALUES('CTBA', 18, 20, '#0000FF', 'A+');";
		
		$tableData[7]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[7] .= "interv_fermet, couleur)";
		$tableData[7] .= " VALUES('bon travail', 14, 16, '#0000FF');";
		
		$tableData[8]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[8] .= "interv_fermet, couleur)";
		$tableData[8] .= " VALUES('très bien', 16, 18, '#0000FF');";
		
		$tableData[9]  = "INSERT INTO appreciation(nom_appreciation, interv_ouvert,";
		$tableData[9] .= "interv_fermet, couleur)";
		$tableData[9] .= " VALUES('excellent', 18, 21, '#0000FF');";
		
		$tableData[10]  = "INSERT INTO periode(nom_periode, date_ouvert,date_fermet)";
		$tableData[10] .= " VALUES('Séquence 1', '0000-00-00', '0000-00-00');";
		
		$tableData[11]  = "INSERT INTO periode(nom_periode, date_ouvert,date_fermet)";
		$tableData[11] .= " VALUES('Séquence 2', '0000-00-00', '0000-00-00');";
		
		$tableData[12]  = "INSERT INTO periode(nom_periode, date_ouvert,date_fermet)";
		$tableData[12] .= " VALUES('Séquence 3', '0000-00-00', '0000-00-00');";
		
		$tableData[13]  = "INSERT INTO periode(nom_periode, date_ouvert,date_fermet)";
		$tableData[13] .= " VALUES('Séquence 4', '0000-00-00', '0000-00-00');";
		
		$tableData[14]  = "INSERT INTO periode(nom_periode, date_ouvert,date_fermet)";
		$tableData[14] .= " VALUES('Séquence 5', '0000-00-00', '0000-00-00');";
		
		$tableData[15]  = "INSERT INTO periode(nom_periode, date_ouvert,date_fermet)";
		$tableData[15] .= " VALUES('Séquence 6', '0000-00-00', '0000-00-00');";
		
		$tableData[16]  = "INSERT INTO information(annee_scolaire, nom_pays,";
		$tableData[16] .= "nom_devise, nom_ministere, nom_region, nom_departement, ";
		$tableData[16] .= "nom_ets, type_ets, chef_ets, titre_signataire,arrondissement, ";
		$tableData[16] .= "app_name, app_version, contact, sexe_signataire, signataire)";
		$tableData[16] .= "VALUES('$anneeScol','$nomPays',";
		$tableData[16] .= "'$nomDevise','$nomMinistere','$nomRegion','$nomDepartement',";
		$tableData[16] .= "'$nomEts','$typeEts','$chefEts','$titreChefEts','$arrondissement',";
		$tableData[16] .= "'$nomApp', '$versionApp','$contact','$sexeChefEts', '$signataire' ";
		$tableData[16] .= ");";
		
		$mdp_admin = sha1('admin');
		$tableData[17]  = "INSERT INTO enseignant(nom, sexe, poste, login, mdp,";
		$tableData[17] .= "etat)";
		$tableData[17] .= " VALUES('Administrateur','Mr','admin','admin',";
		$tableData[17] .= "'$mdp_admin', 'actif'";
		$tableData[17] .= ");";
		
		$mdp_cell = sha1('cell');
		$tableData[18]  = "INSERT INTO enseignant(nom, prenom, sexe, poste, login, mdp,";
		$tableData[18] .= "etat)";
		$tableData[18] .= " VALUES('Cellule','Informatique','Mr','cell','cell',";
		$tableData[18] .= "'$mdp_cell', 'actif'";
		$tableData[18] .= ");";
		
		$tableData[19] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[19] .= "VALUES('admin','Administrateur');";
		
		$tableData[20] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[20] .= "VALUES('cell','Cellule Informatique');";
		
		$tableData[21] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[21] .= "VALUES('censeur','Censeur');";
		
		$tableData[22] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[22] .= "VALUES('sg','Surveillant Général');";
		
		$tableData[23] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[23] .= "VALUES('eco','Econome / Intendant');";
		
		$tableData[24] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[24] .= "VALUES('prof','Enseignant');";
		
		$tableData[25] = "INSERT INTO poste (code_poste, libelle_poste)";
		$tableData[25] .= "VALUES('chef','Proviseur / Principal / Directeur');";
		
		$tableData[26] = "INSERT INTO annee_scolaire (libelle_annee, statut)";
		$tableData[26] .= "VALUES('$anneeScol','actif');";
		
		// On introduit les données recueillies dans la Base de Données
		for($a=0;$a<count($tableData);$a++){
			$requete = $config->setDatabaseData($tableData[$a]);
		}
		for($b=0;$b<count($niveaux);$b++){
			$exec  = "INSERT INTO niveau_classe(nom_niveau, code_niveau)";
			$exec .= "VALUES('$niveaux[$b]','$niveaux[$b]')";
			$execution = $config->setDatabaseData($exec);
		}
		echo '</pre>';
		/*Maintenant on renomme le fichier init.php en init.done.php
		afin de pouvoir utiliser l'application normalement.*/
		rename('inc/init.php','inc/init.done.php');
		$_SESSION['message']  = 'Année Scolaire '.$anneeScol.' activée pour ';
		$_SESSION['message'] .= $nomEts;
		header('Location:index.php');
	}
	elseif(isset($_POST['closeYear'])){
		print_r($_POST);
	}
	else{
		$_SESSION['message'] = 'Accès non autorisé. Redirection imminente';
		header('Location:index.php');
	}
/**************************************************************************************************/	