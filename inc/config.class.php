<?php
	
	class Config {
		
		/*******************************************************************
		********************************************************************
		*******		C O N F I G U R A T I O N    G E N E R A L E     *******
		********************************************************************
		*******************************************************************/
		
		/*Cette classe s'organise en fonction des menus de l'application, 
		c'est-à-dire que les fonctions déclarées sont organisées eu égard
		à la repartition des menus de l'application. */
		
		
		
		/********************************************************************
		*********************************************************************
		********	LES FONCTIONS PROPRES A LA CLASSE 	*********************
		*********************************************************************
		********************************************************************/
		
		
		
		// Pour gérer la Base de Données
		private $_db;
		
		public function __construct($db){
			$this->setDb($db);
		}
		
		public function setDb(PDO $db){
			$this->_db = $db;
		}
		
		
		
		
		
		
		
		
		
		// On veut initialiser les données de l'application avec ses tables  
		public function setDatabaseStructure($requete){
			$execution = $this->_db->query($requete);
			return $execution;
		}
		
		
		// On ne blague pas avec les clés primaires et etrangères qui sont des Id,
		// donc des entiers naturels 
		protected function setUserId($id){
			$this->_id = (int) $id;
			if($this->_id==0){
				$this->_id = NULL;
			}
			return $this->_id;
		}
		
		
		
		// Les mots de passe utilisent le système de hachage sha1 
		private function setPassword($pwd){
			$this->_pwd = sha1($pwd);
			return $this->_pwd;
		}
		
		
		
		
		
		
		
		// On veut introduire les données issues des tables 
		public function setDatabaseData($requete){
			$execution = $this->_db->query($requete);
			
		}
		
		
		
		
		// Je veux afficher les différents types utilisateurs 
		public function userType(){
			$sql = "SELECT id, code_poste, libelle_poste
					FROM poste
					ORDER BY id";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		// Je veux pouvoir afficher la liste des enseignants selon leurs postes respectifs
		public function getUtilisateurType($type){
			$sql = "SELECT nom, sexe, login, enseignant.id as idEnseignant, 
							libelle_poste
					FROM enseignant, poste
					WHERE poste.id='$type' 
						AND enseignant.poste = poste.id
						AND etat = 'actif'
						ORDER BY nom";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		function str_contains($haystack, $needle){
			return $needle !=='' && mb_strpos($haystack,$needle)!== false;
		}
		
		
		// On veut connaitre le navigateur et le Système d'exploitation utilisé
		public function getNavigateur(){
			if($this->str_contains($_SERVER['HTTP_USER_AGENT'], 'Chrome')){
				$navigateur = 'Chrome';
			}elseif($this->str_contains($_SERVER['HTTP_USER_AGENT'], 'Firefox')){
				$navigateur = 'Firefox';
			}
			if($this->str_contains($_SERVER['HTTP_USER_AGENT'], 'Windows')){
				$os = 'Windows';
			}elseif($this->str_contains($_SERVER['HTTP_USER_AGENT'], 'Android')){
				$os = 'Android';
			}
			$information = array("navigateur"=>$navigateur,
								"os"=>$os);
			return $information;
		}
		
		
		
		
		// On charge les informations sur l'établissement au complet. 
		public function chargerInformation(){
			$sql = "SELECT annee_scolaire, nom_pays_fr, nom_pays_en, nom_devise_fr, nom_devise_en,
							nom_ministere_fr, nom_ministere_en,libelle_region_fr, libelle_region_en,
							libelle_departement_fr,libelle_departement_en,nom_etablissement_fr,
							nom_etablissement_en,type_ets, chef_ets, signataire_fr, signataire_en,
							arrondissement, ville, sexe_signataire, contact, email, bp
					FROM information, region, departement  
					WHERE region.id = region
						AND departement.id = departement";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		// On transforme le sexe de l'usager en titre : Monsieur ou Madame
		public function getTitre($sexe){
			if($sexe=='M'){
				$this->titre = 'Monsieur ';
			}elseif($sexe=='F'){
				$this->titre = 'Madame ';
			}else{
				$this->titre = '';
			}
			return $this->titre;
		}
		
		
		// Obtenir l'id de l'année scolaire en cours 
		public function getCurrentYear(){
			$sql = "SELECT id
					FROM annee_scolaire 
					WHERE statut='actif'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['id'];
		}
		
		
		
		// On vérifie si la classe appartient à la section Francophone ou Anglophone
		public function getSectionClasse($classe){
			$this->_classe = $this->setUserId($classe);
			$sql = "SELECT section 
					FROM classe 
					WHERE id='$this->_classe'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $res['section'];
			return $resultat;
		}
		
		
		// La fonction qui gère le formulaire de connexion 
		public function connectUser($source, $login, $mdp){
			$this->_login = $this->setUserId($login);
			$this->_mdp = $this->setPassword($mdp);
			$sql = "SELECT enseignant.id as id, nom, sexe, poste,
							login, mdp, image, etat, code_poste, libelle_poste, poste
					FROM enseignant, poste
					WHERE enseignant.id = '$this->_login'
						AND mdp='$this->_mdp'
						AND poste.id = poste";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			if($reponse==false){
				$_SESSION['message'] = 'Le mot de passe entré est incorrect.';
				header('Location:'.$source);
			}else{
				if($reponse['etat']=='inactif'){
					$_SESSION['message'] = 'Votre compte a été désactivé.';
					$_SESSION['message'] .= ' Contactez un administrateur.';
					header('Location:'.$source);
				}else{
					// On commence par inscrire la connexion dans un journal.
					$adresse = $_SERVER['REMOTE_ADDR'];
					$periode = DATE('Y-m-d H:i:s');
					$navigateur = $this->getNavigateur();
					$journal = $this->_db->prepare('INSERT INTO journal_connexion
												SET 
												utilisateur=:login,
												adresse_ip = :adresse,
												periode_de_connexion=:periode, 
												navigateur = :machine, 
												os = :type');
					$journal->bindValue(':login', $this->_login);
					$journal->bindValue(':adresse', $adresse);
					$journal->bindValue(':periode', $periode);
					$journal->bindValue(':machine', $navigateur['navigateur']);
					$journal->bindValue(':type', $navigateur['os']);
					$journal->execute();
					// On charge les informations de l'établissement 
					$information = $this->chargerInformation();
					$_SESSION['information']['annee_scolaire'] = $information['annee_scolaire'];
					$_SESSION['information']['pays_fr'] = $information['nom_pays_fr'];
					$_SESSION['information']['pays_en'] = $information['nom_pays_en'];
					$_SESSION['information']['devise_fr'] = $information['nom_devise_fr']; 
					$_SESSION['information']['devise_en'] = $information['nom_devise_en'];
					$_SESSION['information']['ministere_fr'] = $information['nom_ministere_fr'];
					$_SESSION['information']['ministere_en'] = $information['nom_ministere_en'];
					$_SESSION['information']['region_fr'] = $information['libelle_region_fr'];
					$_SESSION['information']['region_en'] = $information['libelle_region_en'];
					$_SESSION['information']['departement_fr'] = $information['libelle_departement_fr'];
					$_SESSION['information']['departement_en'] = $information['libelle_departement_en'];
					$_SESSION['information']['nom_etablissement_fr'] = $information['nom_etablissement_fr'];
					$_SESSION['information']['nom_etablissement_en'] = $information['nom_etablissement_en'];
					$_SESSION['information']['typeEts'] = $information['type_ets'];
					$_SESSION['information']['chefEts'] = $information['chef_ets'];
					$_SESSION['information']['signataire_fr'] = $information['signataire_fr'];
					$_SESSION['information']['signataire_en'] = $information['signataire_en'];
					$_SESSION['information']['arrondissement'] = $information['arrondissement'];
					$_SESSION['information']['ville'] = $information['ville'];
					$_SESSION['information']['sexeSignataire'] = $information['sexe_signataire'];
					$_SESSION['information']['titreSignataire'] = $this->getTitre($information['sexe_signataire']);
					$_SESSION['information']['contact'] = $information['contact'];
					$_SESSION['information']['email'] = $information['email'];
					$_SESSION['information']['bp'] = $information['bp'];
					// On crée des variables de session de l'utilisateur
					$_SESSION['user']['id'] = $reponse['id'];
					$_SESSION['user']['nom'] = stripslashes($reponse['nom']);
					$_SESSION['user']['sexe'] = $reponse['sexe'];
					$_SESSION['user']['titre'] = $this->getTitre($reponse['sexe']);
					$_SESSION['user']['typeUtilisateur'] = $reponse['poste'];
					$_SESSION['user']['login'] = $reponse['login'];
					$_SESSION['user']['password'] = $reponse['mdp'];
					$_SESSION['user']['image'] = $reponse['image'];
					$_SESSION['user']['codePoste'] = $reponse['code_poste'];
					$_SESSION['user']['userPost'] = $reponse['code_poste'];
					$_SESSION['user']['libellePoste'] = $reponse['libelle_poste'];
					// La redirection 
					$_SESSION['connected'] = true;;
					$_SESSION['message'] = 'Welcome '.$_SESSION['user']['nom'];
					header('Location:'.$source);
				}
			}
		}
		
		
		
		
		
		
		
		
		
		/*******************************************************************
		********************************************************************
		************		L E S   S E T T E R S 	************************
		********************************************************************
		*******************************************************************/
		protected function setMatricule($matricule) {
			if(empty($matricule)){
				$matricule = "azerty"; 
			}
			else {
				$matricule = htmlspecialchars($matricule);
			}
			return $matricule;
		}
		
		
		
		
		protected function setNom($nom){
			if(empty($nom)){
				$nom = "azerty"; 
			}
			else {
				$nom = htmlspecialchars($nom);
			}
			return $nom;
		}
		
		
		
		
		
		
		protected function setSection($section){
			if($section!='fr' AND $section!='en'){
				$section = 'fr';
			}
			else {
				$section = htmlspecialchars($section);
			}
			return $section;
		}
		
		
		
		
		protected function setPrenom($prenom){
			if(empty($prenom)){
				$prenom = " "; 
			}
			else {
				$prenom = htmlspecialchars($prenom);
			}
			return $prenom;
		}
		
		
		
		
		protected function setSexe($sexe){
			if($sexe!='M' AND $sexe!='F'){
				$sexe = 'M';
			}
			else {
				$sexe = htmlspecialchars($sexe);
			}
			return $sexe;
		}
		
		
		
		
		protected function setStatut($statut){
			if($statut!='R' AND $statut!='N'){
				$statut = 'N';
			}
			else {
				$statut = htmlspecialchars($statut);
			}
			return $statut;
		}
		
		
		
		
		protected function setCode($code){
			if(!empty($code)){
				$code = str_ireplace(" ", "_", $code);
			}
			elseif(empty($code)){
				$code = "Code_Classe";
			}
			return $code;
		}
		
		
		
		
		public function getCode(){
			$sql = "SELECT num_rand
					FROM eleve
					ORDER BY num_rand DESC";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['num_rand'];
			return $resultat;
		}
		
		
		
		
		
		public function setSexeGest($sexe){
			if($sexe!='Mr' or $sexe!='Mme'){
				$this->_sexe = $sexe;
			}
			else{
				$this->_sexe = 'Undefined';
			}
			return $this->_sexe;
		}
		
		
		
		
		public function setPoste($poste){
			if($poste!='prof' or 
				$poste!='admin' or 
				$poste!='sg' or 
				$poste!='censeur'){
				$this->_poste = $poste;
			}
			else{
				$this->_poste = 'Undefined';
			}
			return $this->_poste;
		}
		
		
		
		
		
		public function setLogin($login){
			if(!is_string($login)){
				$this->_login = (string)$login;
			}
			else{
				$this->_login = $login;
			}
			return $this->_login;
		}
		
		
		
		
		public function setPwd($mdp){
			if(is_string($mdp)){
				$this->_mdp = sha1($mdp);
			}
			else{
				$this->_mdp = (string)sha1($mdp);
			}
			return $this->_mdp;
		}
		
		
		
		
		
		
		public function setId($id){
			if(is_int($id)){
				$this->_id = $id;
			}
			else{
				$this->_id = (int) $id;
			}
			return $this->_id;
		}
		
		
		
		
		// 1
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		*************		M E N U   C O N F I G 	*********************
		*****************************************************************
		****************************************************************/
		
		/*****************************************************************
		**********************	SOUS MENU ELEVE			******************
		*****************************************************************/
		
		public function ajouterEleve($source, $rne, $matricule, $nom, $prenom, 
									$sexe, $date, $lieu, $pere, $mere, $classe, 
									$adresse = '', $statut, $num){
			
			$this->_rne = $rne;
			$this->_matricule = $this->setMatricule($matricule);
			$this->_nom = $this->setNom($nom);
			$this->_prenom = $this->setPrenom($prenom);
			$this->_nomComplet = strtoupper($this->_nom).' '.ucwords($this->_prenom);
			$this->_sexe = $this->setSexe($sexe);
			$this->_date_naissance = $date;
			$this->_lieu_naissance = $this->setNom($lieu);
			$this->_nom_pere = $this->setNom($pere);
			$this->_nom_mere = $this->setNom($mere);
			$this->_classe = $this->setNom($classe);
			$this->_statut = $this->setStatut($statut);
			$this->_etat = 'non_supprime';
			$this->_num_rand = $num;
			$this->_adresse_parent = $adresse;
			$this->_as = $this->getCurrentYear();
			
			// On vérifie l'existence du matricule en base une première fois 
			$sql_mat = "SELECT * 
						FROM eleve 
						WHERE matricule = '".$this->_matricule."'";
			$req_mat = $this->_db->query($sql_mat);
			$res_mat = $req_mat->fetch(PDO::FETCH_ASSOC);
			
			if(!empty($res_mat['id'])){
				$_SESSION['message'] = "Ce matricule est déjà utilisé. Choisir 
										un autre";
				header('Location:'.$source);
			}
			else/*if(empty($res_mat['id']))*/{
				// On vérifie que le nom n'a pas été déjà enregistré
				$sql_std = "SELECT * 
							FROM eleve 
							WHERE nom = '".$this->_nom."' AND 
								prenom = '".$this->_prenom."'";
				$req_std = $this->_db->query($sql_std);
				$res_std = $req_std->fetch(PDO::FETCH_ASSOC);
				
				if(!empty($res_std['id'])){
					$_SESSION['message'] = "Le nom est déjà utilisé. Choisir 
											un autre";
					header('Location:'.$source);
				}
				// On peut insérer l'élève sans problème
				elseif(empty($res_std['id'])){
					$add = $this->_db->prepare('INSERT INTO eleve SET 
									rne =:rne,
									nom_complet =:nomComplet,
									sexe =:sexe,
									lieu_naissance =:lieu_naissance,
									nom_pere =:nom_pere,
									nom_mere =:nom_mere,
									matricule =:matricule,
									classe =:classe,
									date_naissance =:date_naissance,
									statut =:statut,
									adresse_parent =:adresse_parent,
									etat =:etat,
									num_rand =:num_rand,
									a_s =:as
									');
					
					$add->bindValue(':rne', $this->_rne);
					$add->bindValue(':nomComplet', $this->_nomComplet);
					// $add->bindValue(':prenom', $this->_prenom);
					$add->bindValue(':sexe', $this->_sexe);
					$add->bindValue(':date_naissance', $this->_date_naissance);
					$add->bindValue(':lieu_naissance', $this->_lieu_naissance);
					$add->bindValue(':nom_pere', $this->_nom_pere);
					$add->bindValue(':nom_mere', $this->_nom_mere);
					$add->bindValue(':matricule', $this->_matricule);
					$add->bindValue(':classe', $this->_classe);
					$add->bindValue(':adresse_parent', $this->_adresse_parent);
					$add->bindValue(':statut', $this->_statut);
					$add->bindValue(':num_rand', $this->_num_rand);
					$add->bindValue(':etat', $this->_etat);
					$add->bindValue(':as', $this->_as);
					
					$add->execute();
					
					
					$_SESSION['message'] = strtoupper($this->_nom);
					$_SESSION['message'] .= ' '.ucwords($this->_prenom).' a été inséré';
					header('Location:'.$source);
				}
			}
		}
		
		
		
		/**
		 * on vérifie dans un table qu'une information n'existe pas déjà pour éviter les doublons
		 * @$nom : la valeur du champs
		 * @$table : La table dans laquelle chercher
		 * @$champ : le libelle du champs
		 **/
		protected function checkInfo($nom, $table, $champ){
			$sql = "SELECT ".$champ." 
					FROM `".$table."` 
					WHERE ".$champ." = '".$nom."'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		public function TransfererEleve($source, $eleve){
			echo '<pre>'; print_r($eleve); echo '</pre>';
			$this->_annee = $eleve['annee'];
			$this->_classe = $this->setUserId($eleve['classe']);
			$this->_statut = $this->setStatut($eleve['statut']);
			$this->_eleve = $eleve['eleve'];
			$table = $this->_annee.'_eleve';
			for($i=0;$i<count($this->_eleve);$i++){
				$idEleve = $this->_eleve[$i];
				$infoEleve = $this->getEleveOld($idEleve, $this->_annee);
				$rne = $infoEleve['rne'];
				$nomComplet = $infoEleve['nom_complet'];
				$sexe = $infoEleve['sexe'];
				$dateNaissance = $infoEleve['date_naissance'];
				$lieuNaissance = $infoEleve['lieu_naissance'];
				$matricule = $infoEleve['matricule'];
				$classe = $this->_classe;
				$adresseParent = $infoEleve['adresse_parent'];
				$statut = $this->_statut;
				$numRand = $infoEleve['num_rand'];
				$etat = $infoEleve['etat'];
				$nomPere = $infoEleve['nom_pere'];
				$nomMere = $infoEleve['nom_mere'];
				$photo = $infoEleve['photo'];
				$as = $this->getCurrentYear();
				echo $rne;
				// print_r($infoEleve);
				echo '<pre>';print_r($infoEleve); echo '</pre>';
				$verification = $this->checkInfo($nomComplet,'eleve','nom_complet');
				if($verification==false){
					$add = $this->_db->prepare("INSERT INTO eleve 
												SET rne=:rne,
												nom_complet =:nomComplet,
												sexe =:sexe,
												date_naissance=:dateN,
												lieu_naissance=:lieuN,
												matricule=:matricule,
												classe=:classe,
												adresse_parent=:adresse,
												statut=:statut,
												num_rand=:numRand,
												etat=:etat,
												nom_pere=:pere,
												nom_mere=:mere,
												photo=:photo,
												a_s=:as");
					$add->bindValue(':rne', $rne);
					$add->bindValue(':nomComplet', $nomComplet);
					$add->bindValue(':sexe', $sexe);
					$add->bindValue(':dateN', $dateNaissance);
					$add->bindValue(':lieuN', $lieuNaissance);
					$add->bindValue(':matricule', $matricule);
					$add->bindValue(':classe', $classe);
					$add->bindValue(':adresse', $adresseParent);
					$add->bindValue(':statut', $statut);
					$add->bindValue(':numRand', $numRand);
					$add->bindValue(':etat', $etat);
					$add->bindValue(':pere', $nomPere);
					$add->bindValue(':mere', $nomMere);
					$add->bindValue(':photo', $photo);
					$add->bindValue(':as', $as);
					$add->execute();
					$_SESSION['message'] = ' ';
					$_SESSION['message'] .= 'Elève(s) transféré(s) avec succès.';
				}else{
					$_SESSION['message'] = ' ';
					$_SESSION['message'] .= 'Certains élèves étaient déjà enregistrés';
				}
			} 
			header('Location:'.$source);
			/**/
			
			// On vérifie l'existence du matricule en base une première fois 
			/*
			
			if(!empty($res_mat['id'])){
				$_SESSION['message'] = "Le Matricule a déjà été utilisé.";
				header('Location:'.$source);
			}*/
			// else/*if(empty($res_mat['id']))*/{
				// On vérifie que le nom n'a pas été déjà enregistré
				/*$sql_std = "SELECT * 
							FROM eleve 
							WHERE nom = '".$this->_nom."' AND 
								prenom = '".$this->_prenom."'";
				$req_std = $this->_db->query($sql_std);
				$res_std = $req_std->fetch(PDO::FETCH_ASSOC);*/
				
				/*if(!empty($res_std['id'])){
					$_SESSION['message'] = "Cet élève a déjà été positionné dans une classe.";
					header('Location:'.$source);
				}*/
				// On peut insérer l'élève sans problème
				// elseif(empty($res_std['id'])){
					/*$add = $this->_db->prepare('INSERT INTO eleve SET 
									nom =:nom,
									prenom =:prenom,
									sexe =:sexe,
									lieu_naissance =:lieu_naissance,
									nom_pere =:nom_pere,
									nom_mere =:nom_mere,
									matricule =:matricule,
									classe =:classe,
									date_naissance =:date_naissance,
									statut =:statut,
									adresse_parent =:adresse_parent,
									etat =:etat,
									num_rand =:num_rand,
									a_s =:as,
									photo =:photo
									');*/
					
					/*$add->bindValue(':nom', $this->_nom);
					$add->bindValue(':prenom', $this->_prenom);
					$add->bindValue(':sexe', $this->_sexe);
					$add->bindValue(':date_naissance', $this->_date_naissance);
					$add->bindValue(':lieu_naissance', $this->_lieu_naissance);
					$add->bindValue(':nom_pere', $this->_nom_pere);
					$add->bindValue(':nom_mere', $this->_nom_mere);
					$add->bindValue(':matricule', $this->_matricule);
					$add->bindValue(':classe', $this->_classe);
					$add->bindValue(':adresse_parent', $this->_adresse_parent);
					$add->bindValue(':statut', $this->_statut);
					$add->bindValue(':num_rand', $this->_num_rand);
					$add->bindValue(':etat', $this->_etat);
					$add->bindValue(':as', $this->_as);
					$add->bindValue(':photo', $this->_photo);
					
					$add->execute();*/
					
					
					// $_SESSION['message'] = strtoupper($this->_nom);
					/*$_SESSION['message'] = 'Elève(s) transféré(s) avec succès.';
					header('Location:'.$source);*/
				// }
			// }
		}
		
		
		
		
		
		public function rechercherEleve($nom){
			$sql = "SELECT *
					FROM eleve 
					WHERE nom_complet LIKE '%$nom%'
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		// La liste des élèves d'une classe 
		public function listeEleve($classe, $etat){
			$sql = "SELECT nom_complet, nom, prenom, eleve.sexe as sexe, date_naissance, lieu_naissance,
							DATE_FORMAT(date_naissance, '%d / %m / %Y') as date_fr,
							nom_classe, nom_pere, nom_mere, photo, adresse_parent, 
							matricule, eleve.etat, eleve.statut as statut, 
							eleve.id as id, rne
					FROM eleve, classe
					WHERE eleve.etat='$etat'
						AND classe='$classe'
						AND classe = classe.id
						
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		// Les statistiques de liste d'une classe donnée 
		public function listeEleveStat($classe, $etat, $as){
			$table = 'eleve';
			$effFilleRed = $this->statSexeStatut($table, $classe, 'F','R');
			$effFilleNv = $this->statSexeStatut($table, $classe, 'F','N');
			$effGarRed = $this->statSexeStatut($table, $classe, 'M','R');
			$effGarNv = $this->statSexeStatut($table, $classe, 'M','N');
			$stat['FR'] = $effFilleRed;
			$stat['FN'] = $effFilleNv;
			$stat['GR'] = $effGarRed;
			$stat['GN'] = $effGarNv;
			$stat['F'] = $effFilleRed + $effFilleNv;
			$stat['G'] = $effGarRed + $effGarNv;
			$stat['R'] = $effFilleRed + $effGarRed;
			$stat['N'] = $effFilleNv + $effGarNv;
			$stat['T'] = $stat['F'] + $stat['G'];
			return $stat;
		}
		
		
		private function statSexeStatut($table, $classe, $sexe, $statut){
			$sql = "SELECT count(*) as nombre
					FROM $table 
					WHERE sexe='$sexe'
						AND statut='$statut'
						AND classe='$classe'
						AND etat = 'non_supprime'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['nombre'];
		}
		
		
		
		
		// La liste des élèves d'une classe d'année scolaire précédente
		public function listeEleveOld($classe, $etat, $annee) {
			$tableEleve = $annee.'_eleve';
			
			$sql = "SELECT *
					FROM `$tableEleve`
					WHERE classe='$classe'
					AND etat = '$etat'
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		public function infoEleveClasse($classe,$etat){
			$fille = $this->nbFille($classe,$etat);
			$filleRed = $this->nbFilleRedoublant($classe,$etat);
			$filleNv = $this->nbFilleNouveau($classe,$etat);
			$garcon = $this->nbGarcon($classe,$etat);
			$garconRed = $this->nbGarconRedoublant($classe,$etat);
			$garconNv = $this->nbGarconNouveau($classe,$etat);
			$redoublants = $filleRed + $garconRed;
			$nouveaux = $filleNv + $garconNv;
			$total = $nouveaux + $redoublants;
			$infoEleve = array("fille"=>$fille,
								"garcon"=>$garcon,
								"filleNv"=>$filleNv,
								"filleRed"=>$filleRed,
								"garconNv"=>$garconNv,
								"redoublant"=>$redoublants,
								"nouveau"=>$nouveaux,
								"total"=>$total,
								"garconRed"=>$garconRed);
			return $infoEleve;
		}
		
		
		
		
		protected function nbFille($classe,$etat){
			/* Le Nombre de filles d'une salle de classe */
			$sql = "SELECT count(*) as nbFille 
					FROM eleve 
					WHERE classe = '$classe'
						AND sexe = 'F'
						AND etat = '$etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['nbFille'];
			return $resultat;
		}
		
		
		
		
		protected function nbGarcon($classe,$etat){
			/* Le Nombre de garçons d'une salle de classe */
			$sql = "SELECT count(*) as nbGarcon 
					FROM eleve 
					WHERE classe = '$classe'
						AND sexe = 'M'
						AND etat='$etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['nbGarcon'];
			
			return $resultat;
		}
		
		
		
		
		protected function nbFilleRedoublant($classe,$etat){
			/* Le Nombre de filles redoublants d'une salle de classe */
			$sql = "SELECT count(*) as nbFille 
					FROM eleve 
					WHERE classe = '$classe'
						AND sexe = 'F'
						AND statut = 'R'
						AND etat = '$etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['nbFille'];
			
			return $resultat;
		}
		
		
		
		
		protected function nbFilleNouveau($classe,$etat){
			/* Le Nombre de fille nouveau d'une salle de classe */
			$sql = "SELECT count(*) as nbFille 
					FROM eleve 
					WHERE classe = '$classe'
						AND sexe = 'F'
						AND statut = 'N'
						AND etat = '$etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['nbFille'];
			
			return $resultat;
		}
		
		
		
		
		protected function nbGarconRedoublant($classe,$etat){
			/* Le Nombre de garçons redoublants d'une salle de classe */
			$sql = "SELECT count(*) as nbGarcon 
					FROM eleve 
					WHERE classe = '$classe'
						AND sexe = 'M'
						AND statut = 'R'
						AND etat = '$etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['nbGarcon'];
			
			return $resultat;
		}
		
		
		
		
		
		protected function nbGarconNouveau($classe, $etat){
			/* Le Nombre de garçons nouveaux d'une salle de classe */
			$sql = "SELECT count(*) as nbGarcon 
					FROM eleve 
					WHERE classe = '$classe'
						AND sexe = 'M'
						AND statut = 'N'
						AND etat = '$etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse['nbGarcon'];
			
			return $resultat;
		}
		
		
		
		
		
		// On affiche tout sur un élève donné 
		public function getEleve($eleve){
			$this->_eleve = $this->setUserId($eleve);
			$sql = "SELECT nom_complet, eleve.sexe as sexe, 
						eleve.statut, date_naissance,
						DATE_FORMAT(date_naissance, '%d / %m / %Y') as date_fr,
						lieu_naissance, classe, nom_classe,
						nom_pere, nom_mere, photo, rne,
						adresse_parent, matricule, eleve.etat as etat, 
						a_s, libelle_annee, eleve.id as id
						
					FROM eleve, classe, annee_scolaire 
					WHERE eleve.id = '$this->_eleve'
						AND classe = classe.id
						";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		public function getEleveOld($id, $annee) {
			$tableEleve = $annee.'_eleve';
			$idChamp = $tableEleve.'.'.$id;
			$sql = "SELECT * 
					FROM `".$tableEleve."`
					WHERE id= ".$id."";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		/*Supprimer l'élève */
		public function supprimerEleve($eleve) {
			$sql = "UPDATE eleve
					SET etat = 'supprime'
					WHERE id='$eleve'";
			$req = $this->_db->query($sql);
			// mysql_query($sql) or die(mysql_error());
			$_SESSION['message'] = 'Elève Supprimé';
		}
		
		
		
		
		/*Réactiver ou Restaurer l'élève supprimé */
		public function RestaurerEleve($eleve) {
			$sql = "UPDATE eleve
					SET etat = 'non_supprime'
					WHERE id='$eleve'";
			$req = $this->_db->query($sql);
			// mysql_query($sql) or die(mysql_error());
			$_SESSION['message'] = 'Elève Réactivé';
		}
		
		
		
		
		
		
		
		public function listeEleveSansPhoto($classe, $etat) {
			$sql = "SELECT eleve.id as id, nom, prenom, sexe, rne,  
							matricule, nom_classe, statut, date_naissance, photo, 
					DATE_FORMAT(date_naissance, '%d / %m / %Y') as date_fr,"; 
			$sql .="lieu_naissance, code_classe
					FROM eleve, classe
					WHERE eleve.etat='$etat' AND 
						eleve.classe = '$classe' AND 
						code_classe = classe AND photo=''
					ORDER BY nom";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		/* Mettre à jour les informations d'un élève */
		public function updEleve($update/*$matricule, $rne, $nom, $prenom, $sexe,
								$dateN, $lieuN, $cls, $statut, 
								$id, $adr, $nomPere, $nomMere*/){
			$rne = $update['rne'];
			$matricule = $update['matricule'];
			$nom = $update['nom'];
			$sexe = $update['sexe'];
			$dateN = $update['date_naissance'];
			$lieuN = $update['lieu_naissance'];
			$cls = $update['classe'];
			$statut = $update['statut'];
			$nomPere = $update['nom_pere'];
			$nomMere  = $update['nom_mere'];
			$adr = $update['adresse_parent'];
			$id = $update['idEleve'];
			$sql = "UPDATE eleve
					SET matricule='$matricule',
						rne='$rne',
						nom_complet='$nom',
						sexe='$sexe',
						date_naissance='$dateN',
						lieu_naissance='$lieuN',
						classe='$cls',
						statut='$statut',
						nom_pere='$nomPere',
						nom_mere='$nomMere',
						adresse_parent='$adr'
					WHERE id='$id'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Elève Mis à jour';
			
		}
		
		
		
		/*public function findEleve($eleve){
			$sql = "SELECT *
					FROM eleve 
					WHERE nom_complet LIKE '%$eleve%' 
					ORDER BY nom_complet
					";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}*/
		
		
		
		// On vérifie la section à laquelle appartient une classe 
		public function verifSectionClasse($classe){
			$sql = "SELECT section 
					FROM classe
					WHERE code_classe='$classe'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $res['section'];
			return $resultat;
		}
		
		
		
		
		
		
		
		
		public function listeAnnee($statut){
			$sql = "SELECT *
					FROM annee_scolaire 
					WHERE statut = '$statut'
					ORDER BY libelle_annee";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		public function listeAncienneClasse($annee){
			$table = $annee.'_eleve';
			$sql = "SELECT DISTINCT classe, nom_classe, niveau_classe
					FROM `$table`, classe, niveau_classe
					WHERE classe = classe.id
						AND niveau_classe = niveau_classe.id
					ORDER BY classe.section, code_niveau";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		*******************			SOUS MENU CLASSE		**************
		*****************************************************************/
		
		public function ajouterClasse($source, $nom, $code, $niveau, $section){
			$this->_nom = $this->setNom($nom);
			$this->_code = $this->setCode($code);
			$this->_niveau = $this->setNom($niveau);
			$this->_section = $this->setSection($section);
			
			// On vérifie que la classe n'existe pas déjà BD
			$sql_verif = "SELECT *
						  FROM classe 
						  WHERE code_classe = '$this->_code' 
							AND nom_classe = '$this->_nom' ";
			
			$req_verif = $this->_db->query($sql_verif);
			$res_verif = $req_verif->fetch(PDO::FETCH_ASSOC);
			if(!empty($res_verif['id'])){
				$_SESSION['message'] = "La Classe existe déjà";
				header('Location:'.$source);
			}
			else {
				$add = $this->_db->prepare('INSERT INTO classe SET 
								nom_classe =:nomClasse,
								code_classe =:codeClasse,
								niveau_classe =:niveauClasse,
								section =:sectionClasse,
								etat_classe =:etatClasse
								');
					
				$add->bindValue(':nomClasse', $this->_nom);
				$add->bindValue(':codeClasse', $this->_code);
				$add->bindValue(':niveauClasse', $this->_niveau);
				$add->bindValue(':sectionClasse', $this->_section);
				$add->bindValue(':etatClasse', 'actif');
					
				$add->execute();
				
				
				$_SESSION['message'] = "La classe a bien été créée";
				header('Location:'.$source);
			}
		}
		
		// On liste les classes au complet et on trie par section
		public function viewClasseAll($etat){
			$sql = "SELECT classe.id as id, classe.section as section, nom_classe, code_classe, niveau_classe, 
							etat_classe, nom_niveau
						FROM classe , niveau_classe
						WHERE etat_classe='".$etat."'
							AND niveau_classe = niveau_classe.id
						ORDER BY classe.section, niveau_classe, nom_classe";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		 }
		
		public function listeSexe(){
			$sexe['libelle'] = array('-Choisir Sexe-','Féminin', 'Masculin');
			$sexe['code'] = array('null','F','M');
			return $sexe;
		}
		
		
		public function listeStatut(){
			$sexe['libelle'] = array('-Choisir Statut-','Nouveau', 'Redoublant');
			$sexe['code'] = array('null','N','R');
			return $sexe;
		}
		
		public function viewClasse($etat){
			$sql = "SELECT * 
						FROM classe 
						WHERE etat_classe='".$etat."' 
						ORDER BY section, niveau_classe, code_classe DESC";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
			/*while() {
				$classe[] = $res;
			}
			return $classe;*/
		 }
		 
		 
		 public function upgradeListe($classe){
			$liste = $this->listeEleve($classe, 'non_supprime');
			echo '<pre>';print_r($liste); echo '</pre>';
			for($i=0;$i<count($liste);$i++){
				$nom = strtolower($liste[$i]['nom']);
				$prenom = strtolower($liste[$i]['prenom']);
				$id = $liste[$i]['id'];
				$nomComplet = strtoupper($nom).' '.ucwords($prenom);
				echo '<p>'.$nomComplet.'</p>';
				$update = $this->_db->prepare("UPDATE eleve SET 
								nom_complet =:nomComplet,
								nom =:nom,
								prenom =:prenom
								WHERE id =:id");
				$update->bindValue(':nomComplet', $nomComplet);
				$update->bindValue(':nom','');
				$update->bindValue(':prenom','');
				$update->bindValue(':id', $id);
				
				$update->execute();
			}
		 }
		 
		 
		 
		 public function viewClasseSection($section, $etat){
			$sql = "SELECT * 
					FROM classe 
					WHERE etat_classe='".$etat."'
						AND section = '".$section."'
					ORDER BY niveau_classe DESC";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			/*while() {
				$classe[] = $res;
			}*/
			return $res;
		 }
		 
		 
		// Les Classes appartenant à un même niveau 
		public function getClasseByNiveau($niveau){
			$sql = "SELECT id, section, nom_classe 
					FROM classe
					WHERE niveau_classe='$niveau'
						AND etat_classe='actif'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		// Les statistiques des élèves par niveau 
		public function statEleveNiveau($niveau, $etat, $as){
			$sqlM = "SELECT count(*) as masculin
					FROM eleve, classe 
					WHERE niveau_classe = '$niveau'
						AND classe = classe.id
						AND eleve.etat = '$etat'
						AND sexe = 'M'";
			$reqM = $this->_db->query($sqlM);
			$resM = $reqM->fetch(PDO::FETCH_ASSOC);
			$masculin = $resM['masculin'];
			
			$sqlF = "SELECT count(*) as feminin
					FROM eleve, classe 
					WHERE niveau_classe = '$niveau'
						AND classe = classe.id
						AND eleve.etat = '$etat'
						AND sexe = 'F'";
			$reqF = $this->_db->query($sqlF);
			$resF = $reqF->fetch(PDO::FETCH_ASSOC);
			$feminin = $resF['feminin'];

			$sql = "SELECT count(*) as total
					FROM eleve, classe 
					WHERE niveau_classe = '$niveau'
						AND classe = classe.id
						AND eleve.etat = '$etat'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$total = $res['total'];
			
			$stat = array('M'=>$masculin,
							'F'=>$feminin,
							'T'=>$total);
			return $stat;
		}
		 
		 /*Les niveaux de l'application */
		public function listeNiveaux(){
			$sql = "SELECT *
					FROM niveau_classe
					";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		/*Les niveaux de l'application en fonction de la Section */
		public function listeNiveauxSection($section){
			$this->_section = $this->setSection($section);
			$sql = "SELECT *
					FROM niveau_classe
					WHERE section='$this->_section'
					ORDER BY code_niveau
					";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		// On met à jour l'élève 
		public function updateEleve($source, $eleve){
			// echo '<pre>'; print_r($eleve); echo '</pre>';
			$idEleve = $this->setUserId($eleve['idEleve']);
			$infoEleve = $this->getEleve($idEleve);
			// echo '<pre>';print_r($infoEleve);echo '</pre>';
			
			$nom = $this->setNom($eleve['nomEleve']);
			$classe = $this->setUserId($eleve['classeEleve']);
			$matricule = $eleve['matriculeEleve'];
			$rne = $eleve['rneEleve'];
			$sexe = $this->setSexe($eleve['sexeEleve']);
			$statut = $this->setStatut($eleve['statutEleve']);
			$dateNaiss = $eleve['dateNaissEleve'];
			$lieuNaiss = $this->setNom($eleve['lieuNaissEleve']);
			$nomPere = $this->setNom($eleve['nomPereEleve']);
			$nomMere = $this->setNom($eleve['nomMereEleve']);
			$contactParent = $eleve['contactParentEleve'];
			
			
			if(!empty($nom)){
				if($nom!=$infoEleve['nom_complet']){
					$champ[] = 'nom_complet';
					$valeur[] = $nom;
				}
			}
			if(!empty($sexe)){
				if($sexe!=$infoEleve['sexe']){
					$champ[] = 'sexe';
					$valeur[] = $sexe;
				}
			}
			if(!empty($statut)){
				if($statut!=$infoEleve['statut']){
					$champ[] = 'statut';
					$valeur[] = $statut;
				}
			}
			if(!empty($dateNaiss)){
				if($dateNaiss!=$infoEleve['date_naissance']){
					$champ[] = 'date_naissance';
					$valeur[] = $dateNaiss;
				}
			}
			if(!empty($lieuNaiss)){
				if($lieuNaiss!=$infoEleve['lieu_naissance']){
					$champ[] = 'lieu_naissance';
					$valeur[] = $lieuNaiss;
				}
			}
			if(!empty($classe)){
				if($classe!=$infoEleve['classe']){
					$champ[] = 'classe';
					$valeur[] = $classe;
				}
			}
			if(!empty($nomPere)){
				if($nomPere!=$infoEleve['nom_pere']){
					$champ[] = 'nom_pere';
					$valeur[] = $nomPere;
				}
			}
			if(!empty($nomMere)){
				if($nomMere!=$infoEleve['nom_mere']){
					$champ[] = 'nom_mere';
					$valeur[] = $nomMere;
				}
			}
			if(!empty($contactParent)){
				if($contactParent!=$infoEleve['adresse_parent']){
					$champ[] = 'adresse_parent';
					$valeur[] = $contactParent;
				}
			}
			if(!empty($matricule)){
				if($matricule!=$infoEleve['matricule']){
					$champ[] = 'matricule';
					$valeur[] = $matricule;
				}
			}

			if(!empty($rne)){
				if($rne!=$infoEleve['rne']){
					$champ[] = 'rne';
					$valeur[] = $rne;
				}
			}
			
			// Si au moins une modification est effectuée, alors $champ ne sera pas null 
			if(!empty($champ)){
				$iteration = count($champ);
				$sql = "UPDATE eleve SET ";
				for($i=0;$i<$iteration-1;$i++){
					$sql .= $champ[$i]." = '".$valeur[$i]."', ";
				}
				$valeurFinaleArray = $iteration - 1;
				$sql .= $champ[$valeurFinaleArray]." = '".$valeur[$valeurFinaleArray]."' ";
				$sql .= "WHERE id = '".$idEleve."'";
				$this->_db->query($sql);
				$_SESSION['message'] = 'Informations Elève Mises à jour.';
				header('Location:'.$source);
			}else{
				$_SESSION['message'] = 'Aucune information n a été modifiée.';
				header('Location:'.$source);
			}
		}
		
		
		// On restaure un élève supprimé
		public function restaureEleve($source, $eleve){
			$sql = "UPDATE eleve SET etat= 'non_supprime' WHERE id='$eleve'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Eleve retabli';
			header('Location:'.$source);
		}
		
		
		// On supprime un élève 
		public function deleteEleve($source, $eleve){
			$sql = "UPDATE eleve SET etat= 'supprime' WHERE id='$eleve'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Eleve supprimé';
			header('Location:'.$source);
		}
		
		
		
		
		public function viewNomClasse($classe){
			$sql = "SELECT *
					FROM classe
					WHERE code_classe='$classe'
					";
			$req = $this->_db->query($sql);
			$res=$req->fetch(PDO::FETCH_ASSOC);
			$resultat = $res;
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		public function rechercherClasse($nom){
			$sql = "SELECT *
					FROM classe 
					WHERE nom_classe LIKE '%$nom%'
						OR code_classe LIKE '%$nom%'
					ORDER BY code_classe DESC";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		public function getClasse($id) {
			$req = "SELECT nom_classe, code_classe, etat_classe, niveau_classe, id
					FROM classe 
					WHERE id = '$id'
					ORDER BY nom_classe";
			$sql = $this->_db->query($req);
			$res=$sql->fetch(PDO::FETCH_ASSOC);
			$classe = $res;
			return $classe;
		}
		
		
		
		
		
		
		
		
		
		
		/* Mettre à jour les informations d'une classe */
		public function updClasse($source, $id, $nomClasse, $codeClasse, $etat, $niveau){
			$sql = "UPDATE classe
					SET 
						nom_classe='$nomClasse',
						code_classe='$codeClasse',
						etat='$etat',
						niveau='$niveau'
					WHERE id='$id'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Classe Mise à jour';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		/*Supprimer la classe */
		public function supprimerClasse($source, $classe) {
			$sql = "UPDATE classe
					SET etat='inactif'
					WHERE id='$classe'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Classe Supprimée';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		
		/*Réactiver ou Restaurer une classe supprimée */
		public function RestaurerClasse($source, $classe) {
			$sql = "UPDATE classe
					SET etat='actif'
					WHERE id='$classe'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Classe Restaurée';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		public function getClasseCode($id) {
			$req = "SELECT nom_classe, code_classe, etat, niveau, id 
					FROM classe 
					WHERE code_classe = '$id'
					ORDER BY nom_classe";
			$sql = $this->_db->query($req);
			$res=$sql->fetch(PDO::FETCH_ASSOC);
			$classe = $res;
			return $classe;
		}
		
		
		
		
		
		
		
		
		
		 public function getMatiereInfo($id){
			 $req = "SELECT id, nom_matiere, code_matiere, etat 
					FROM matiere 
					WHERE code_matiere='$id'
					ORDER BY nom_matiere";
			 $sql = $this->_db->query($req);
			 $res = $sql->fetch(PDO::FETCH_ASSOC);
			 $matiere = $res;
			 return $matiere;
		 }
		
		
		
		
		
		
		/*****************************************************************
		*******************			SOUS MENU MATIERE		**************
		*****************************************************************/
		
		public function ajouterMatiere($source, $nom, $code){
			$this->_nom = $this->setNom($nom);
			$this->_code = $this->setNom($code);
			
			/* je vérifie que le code n'est pas déjà présent dans la BD
			auquel je renvoie un message d'erreur. Sinon j'enregistre */
			$sql_verif = "SELECT * 
						FROM matiere 
						WHERE nom_matiere = '".$this->_nom."' OR 
							code_matiere = '".$this->_code."'";
			$req_verif = $this->_db->query($sql_verif);
			$res_verif = $req_verif->fetch(PDO::FETCH_ASSOC);
			if($res_verif!=null){
				$_SESSION['message'] = "La matière et/ou son code existent déjà.";
				header('Location:'.$source);
			}
			else {
				$add = $this->_db->prepare('INSERT INTO matiere SET 
								nom_matiere =:nomMatiere,
								code_matiere =:codeMatiere,
								etat =:etatMatiere
								');
					
				$add->bindValue(':nomMatiere', $this->_nom);
				$add->bindValue(':codeMatiere', $this->_code);
				$add->bindValue(':etatMatiere', 'actif');
					
				$add->execute();
				
				$_SESSION['message'] = "Matière insérée";
				header('Location:'.$source);
			}		
		}
		
		
		
		
		public function listeMatiereAll($etat) {
			$this->_etat = $this->setNom($etat);
			$sql = "SELECT * 
					FROM matiere 
					WHERE etat = '".$this->_etat."'
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		public function rechercherMatiere($nom){
			$sql = "SELECT *
					FROM matiere 
					WHERE nom_matiere LIKE '%$nom%'
						OR code_matiere LIKE '%$nom%'
					ORDER BY nom_matiere DESC";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		public function getMatiere($id) {
			$req = "SELECT id, nom_matiere, code_matiere,etat
					FROM matiere 
					WHERE id = '$id'
					ORDER BY nom_matiere";
			$sql = $this->_db->query($req);
			$res=$sql->fetch(PDO::FETCH_ASSOC);
			$matiere = $res;
			return $matiere;
		}
		
		
		
		
		
		
		
		
		/*Supprimer la matière */
		public function supprimerMatiere($source, $matiere) {
			$sql = "UPDATE matiere
					SET etat='inactif'
					WHERE id='$matiere'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Matière Supprimée';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		/* Mettre à jour les informations d'une matière */
		public function updMatiere($source, $id, $nomMatiere, $codeMatiere, $etat){
			$sql = "UPDATE matiere
					SET 
						nom_matiere='$nomMatiere',
						code_matiere='$codeMatiere',
						etat='$etat'
					WHERE id='$id'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Matière Mise à jour';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		/*Réactiver ou Restaurer une matière supprimée */
		public function RestaurerMatiere($source, $matiere) {
			$sql = "UPDATE matiere
					SET etat='actif'
					WHERE id='$matiere'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Matière Restaurée';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		public function viewMatiere($etat){
			$sql = "SELECT * 
						FROM matiere 
						WHERE etat='".$etat."' 
						ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		 }
		
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		*****************			SOUS MENU ENSEIGNANT		**********
		*****************************************************************/
		
		public function ajouterGestionnaire($source, $nom, $prenom, $sexe, 
											$poste, $login, $mdp, $mdp2) {
			$this->_nom = $this->setNom($nom);
			$this->_prenom = $this->setPrenom($prenom);
			$this->_sexe = $this->setSexeGest($sexe);
			$this->_poste = $this->setPoste($poste);
			$this->_login = $this->setLogin($login);
			$this->_mdp = $this->setPwd($mdp);
			
			// les mots de passe doivent correspondre
			if($this->_mdp !=sha1($mdp2)){
			$_SESSION['message'] = "La confirmation entrée ne correpond pas ";
			$_SESSION['message'] .= "au mot de passe initial.";
			header('Location:'.$source);
			}
			
			// Le login est-il déjà utilisé ?
			$sql = "SELECT * FROM enseignant WHERE login = '$login'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			if($reponse!=false){
				$_SESSION['message'] = "Le login est déjà utilisé";
				header('Location:'.$source);
			}
			else{
				$insert = $this->_db->prepare('INSERT INTO enseignant SET 
							nom=:nom, 
							prenom=:prenom, 
							sexe=:sexe, 
							poste=:poste, 
							login=:login, 
							mdp=:mdp, 
							etat=:etat ');
				$insert->bindValue(':nom', $this->_nom);
				$insert->bindValue(':prenom', $this->_prenom);
				$insert->bindValue(':sexe', $this->_sexe);
				$insert->bindValue(':poste', $this->_poste);
				$insert->bindValue(':login', $this->_login);
				$insert->bindValue(':mdp', $this->_mdp);
				$insert->bindValue(':etat', 'actif');
				$insert->execute();
				
				$_SESSION['message'] = "Enseignant enregistré";
				header('Location:'.$source);
			}
		}
		
		
		
		
		
		public function viewGestionnaireAll($etat){
			$this->_etat = $etat;
			$sql = "SELECT enseignant.id as id, nom, prenom, sexe, poste, login, etat, 
							image, libelle_poste
					FROM enseignant, poste 
					WHERE etat='$this->_etat'
						AND code_poste = poste
					ORDER BY nom";
			$req = $this->_db->query($sql);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $reponse;
			}
			return $resultat;
		}
		
		
		
		
		// Le Nombre Total de gestionnaire
		public function nbGestionnaireAll($etat){
			$this->_etat = $etat;
			$sql = "SELECT count(*) as nb
					FROM enseignant 
					WHERE etat='$this->_etat'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			return $reponse['nb'];
		}
		
		
		
		
		// Visualiser le Gestionnaire Courant
		public function viewGestionnaireCourant($id){
			$this->_id = $this->setId($id);
			$sql = "SELECT *
					FROM enseignant 
					WHERE id='$this->_id'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			return $reponse;
		}
		
		
		
		
		/*Nommer un enseignant SG, censeur ou Administrateur */
		public function nommerEnseignant($enseignant, $poste) {
			$sql = "UPDATE enseignant
					SET poste = '".$poste."'
					WHERE id='$enseignant'";
			$req = $this->_db->query($sql);
			// mysql_query($sql) or die(mysql_error());
			$_SESSION['message'] = 'Enseignant Nommé '.$poste.'.';
		}
		
		
		
		
		
		public function updEnseignant($source, $id, $nom, $prenom, 
											$sexe, $poste, $login) {
			$sql = "UPDATE enseignant
					SET nom='$nom',
						prenom='$prenom',
						sexe='$sexe',
						poste='$poste',
						login='$login'
					WHERE id='$id'";
			$req = $this->_db->query($sql);
			// mysql_query($sql) or die(mysql_error());
			$_SESSION['message'] = 'L enseignant ';
			$_SESSION['message'] .= strtoupper($nom);
			$_SESSION['message'] .= ' ';
			$_SESSION['message'] .= ucwords($prenom);
			$_SESSION['message'] .= ' a été mis à jour. ';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		public function listePoste(){
			$sql = "SELECT * 
					FROM poste
					ORDER BY libelle_poste";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		// Le Nom correspondant au code du Poste passé en paramètres
		public function getPoste($code){
			$sql = "SELECT * 
					FROM poste
					WHERE code_poste='$code'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		public function rechercherEnseignant($nom){
			$sql = "SELECT *
					FROM enseignant 
					WHERE nom LIKE '%$nom%'
						OR prenom LIKE '%$nom%'
						OR login LIKE '%$nom%'
					ORDER BY nom DESC";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		/*Supprimer un enseignant */
		public function supprimerEnseignant($source, $enseignant) {
			$sql = "UPDATE enseignant
					SET etat = 'inactif'
					WHERE id='$enseignant'";
			$req = $this->_db->query($sql);
			// mysql_query($sql) or die(mysql_error());
			$_SESSION['message'] = 'Enseignant Supprimé';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		/*Restaurer un enseignant */
		public function restaurerEnseignant($source, $enseignant) {
			$sql = "UPDATE enseignant
					SET etat = 'actif'
					WHERE id='$enseignant'";
			$req = $this->_db->query($sql);
			// mysql_query($sql) or die(mysql_error());
			$_SESSION['message'] = 'Enseignant Réactivé';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		/*****************************************************************
		*****************	SOUS MENU PERIODE		**********************
		*****************************************************************/
		
		// Période d'Ouverture = Date du Jour 
		// Période de Fermeture = Date du Jour + Nb Jours à ajouter
		public function ouvrirPeriode($source, $sequence, $duree) {
			$this->_sequence = $sequence;
			$this->_duree = $duree;
			$today = DATE('Y-m-d');
			$new_date = DATE('Y-m-d',time()+$this->_duree*3600*24);
			$sql = "UPDATE periode 
						SET date_ouvert = '".$today."', 
							date_fermet = '".$new_date."'
						WHERE id = '".$this->_sequence."'";
			
			$req = $this->_db->query($sql);
			
			$_SESSION['message'] = "Séquence ";
			$_SESSION['message'] .= $sequence." activée pour ";
			$_SESSION['message'] .= $this->_duree." jour(s)";
			header('Location:'.$source);
			
		}
		
		
		
		
		// Periode de Fermeture = Date du Jour - 1 
		public function fermerPeriode($source, $sequence) {
			$this->_sequence = $sequence;
			$today = DATE('Y-m-d', time()-1*3600*24);
			$sql_upd = "UPDATE periode 
						SET  
							date_fermet = '".$today."'
						WHERE id = '".$this->_sequence."'";
			$req = $this->_db->query($sql_upd);
			
			$_SESSION['message'] = "Séquence ".$this->_sequence;
			$_SESSION['message'] .= " vérouillée";
			header('Location:'.$source);
		}
		
		
		
		
		public function viewPeriode(){
			$sql = "SELECT id, nom_periode,
						DATE_FORMAT(date_ouvert, '%d - %m - %Y') 
							as ouverture,
						DATE_FORMAT(date_fermet, '%d - %m - %Y') 
							as fermeture
					FROM periode 
					ORDER BY nom_periode";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		public function periodeCourante(){
			$today = DATE('Y-m-d');
			// echo $today;
			$sql = "SELECT id, nom_periode,
						DATE_FORMAT(date_ouvert, '%d - %m - %Y')
							as ouverture,
						DATE_FORMAT(date_fermet, '%d - %m - %Y') 
							as fermeture
					FROM periode 
					WHERE date_fermet>='$today' 
						AND date_ouvert<='$today'";
			$req = $this->_db->query($sql);
			while($res=$req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
			
		}
		
		
		
		
		public function createDateAbsence($source, $sequence, $open, $close) {
			$this->_sequence = (int) $sequence;
			$this->_open = $open;
			$this->_close = $close;
			echo $this->_open.'<br />';
			echo $this->_close.'<br />';
			/*La Date d'ouverture doit être strictement inférieure à la date de cloture */
			if($this->_open > $this->_close){
				$_SESSION['message'] = 'Erreur : La Date de debut est supérieure à la date de cloture.';
				header('Location:'.$source);
			}else{
				if($this->_open == $this->_close){
					$_SESSION['message'] = 'Erreur : La Date de debut est égale à la date de cloture.';
					header('Location:'.$source);
				}else{
					/*D'abord, on verifie que les données existent et on fait un update. Sinon on fait ADD */
					$sql = "INSERT INTO date_absences(id_periode, open_date, close_date)
							VALUES('$this->_sequence','$this->_open','$this->_close')";
					$req = $this->_db->query($sql);
					$_SESSION['message'] = 'Dates pour les absences définies.';
					header('Location:'.$source);
				}
				
			}
		}
		
		
		
		
		public function viewDateAbsence(){
			$sql = "SELECT date_absences.id as id, id_periode, nom_periode,
						DATE_FORMAT(open_date, '%d - %m - %Y') 
							as ouverture,
						DATE_FORMAT(close_date, '%d - %m - %Y') 
							as fermeture
					FROM date_absences, periode
					WHERE id_periode = periode.id
					ORDER BY nom_periode";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		public function viewDateAbsencePrecise($periode){
			$sql = "SELECT date_absences.id as id, id_periode, nom_periode,
						DATE_FORMAT(open_date, '%d - %m - %Y') 
							as ouverture, open_date,
						DATE_FORMAT(close_date, '%d - %m - %Y') 
							as fermeture, close_date
					FROM date_absences, periode
					WHERE id_periode = periode.id
						AND id_periode = '$periode'
					ORDER BY nom_periode";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		*************	SOUS MENU PARAMETRAGE DE LA CLASSE	 *************
		*****************************************************************/
		
		public function addMatClasse($source, $classe, 
									$matiere, $coef, 
									$groupe) {
			$this->_classe = $this->setNom($classe);
			$this->_matiere = $this->setNom($matiere);
			$this->_coef = (int) $coef;
			$this->_groupe = $this->setNom($groupe);
			
			/*On vérifie d'abord que la matière n'est pas 
			déjà enregistrée pour la classe*/
			$sql_verif = "SELECT *
						FROM prof_classe
						WHERE id_classe = '".$this->_classe."' 
							AND id_matiere = '".$this->_matiere."'";
			$req_verif = $this->_db->query($sql_verif);
			$res_verif = $req_verif->fetch(PDO::FETCH_ASSOC);
			if(!empty($res_verif['id'])){
				$_SESSION['message'] = "La matière existe déjà pour la classe";
				header('Location:'.$source);
			}
			else {
				$add = $this->_db->prepare("INSERT INTO prof_classe SET 
									id_classe =:id_classe,
									id_matiere =:id_matiere,
									coef =:coef,
									groupe =:groupe");
				
				$add->bindValue(':id_classe',$this->_classe);
				$add->bindValue(':id_matiere',$this->_matiere);
				$add->bindValue(':coef',$this->_coef);
				$add->bindValue(':groupe',$this->_groupe);
				
				$add->execute();
				
				$_SESSION['message'] = "Matière insérée dans la classe";
				header('Location:'.$source);
			}
		}
		
		
		
		
		public function addProfClasse($source, 
										$matiere = array(), 
										$prof = array(), 
										$classe) {
			$this->_matiere = $matiere;
			$this->_prof = $prof;
			$this->_classe = $classe;
			foreach($this->_prof as $cle=>$valeur) {
				if($valeur!= null) {
					$mat = $this->_matiere[$cle];
					$enseignant = $valeur;
					$sql = "UPDATE prof_classe 
							SET id_prof = '$enseignant'
							WHERE id_matiere = '$mat' 
								AND id_classe ='$this->_classe'";
					$req = $this->_db->query($sql);
					$_SESSION['message'] = "Enseignant(s) ajouté(s)";
					header('Location:'.$source);
				}
			}
		}
		
		
		
		
		
		
		
		
		// On retire une matière de la classe 
		public function delProfClasse($source, $matiere = array()) {
			$this->_idMatiere = $matiere;
			foreach($this->_idMatiere as $cle=>$valeur) {
				echo '<p> On supprimera la matière '.$valeur.'</p>';
				$sql = "DELETE FROM prof_classe WHERE id='$valeur'";
				$req = $this->_db->query($sql);
				$_SESSION['message'] = "Matière(s) retirée(s) de la classe.";
				header('Location:'.$source);
			}
		}
		
		
		
		
		/* On veut ajouter un professeur principal à la classe.
		Le principe est le suivant : D'abord on vérifie que la classe 
		n'a pas déjà un titulaire; si c'est le cas, on procède à une 
		mise à jour. Si ce n'est pas le cas, on procède à l'insertion 
		pure et simple. */
		public function ajouterProfPrincipal($source, $classe, $enseignant){
			foreach($classe as $cle=>$valeur){
				if($enseignant[$cle]!='null'){
					$cls = $valeur;
					$prof = $enseignant[$cle];
					
					$execute = $this->_db->query("DELETE FROM classe_principale 
													WHERE classe='$cls'");
					$add = $this->_db->prepare("INSERT INTO classe_principale 
												SET prof = :prof,
												classe = :classe");
					$add->bindValue(':prof',$prof);
					$add->bindValue(':classe',$cls);
					$add->execute();
					
					$_SESSION['message'] = 'Enseignant(s) inséré(s) ';
					$_SESSION['message'].= 'et/ou mis à jour';
					header('Location:'.$source);
				}
			}
		}
		
		
		
		
		// Liste des Classes issues de la Table prof_classe
		public function listeClasseProfClasse(){
			$sql = "SELECT id_classe, nom_classe
					FROM prof_classe, classe
					WHERE id_classe = code_classe
					GROUP BY id_classe ORDER BY section, niveau, id_classe DESC";
			$req = $this->_db->query($sql);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $reponse;
			}
			return $resultat;
		}
		
		
		
		
		/*Les matières inscrites dans une classe */
		public function listeMatiereClasse($classe) {
			$this->classe = $classe;
			$sql = "SELECT prof_classe.id as id, id_matiere, nom_matiere, coef, groupe
					FROM prof_classe, matiere
					WHERE id_classe='$this->classe'
						AND id_matiere=code_matiere
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			while($res=$req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		/*Le Conseil de classe d'une classe donnée.
		La différence avec la fonction listeMatiereClasse($classe)
		que dans celle - ci, on affiche les noms des enseignants 
		qui passent dans la classe.*/
		public function conseilDeClasse($classe) {
			$this->_classe = $this->setNom($classe);
			$sql = "SELECT	id_prof, id_classe, id_matiere, coef, groupe,
							nom_matiere, nom_classe, nom, prenom
					FROM prof_classe, matiere, classe, enseignant
					WHERE id_classe='".$this->_classe."'
							AND id_matiere=code_matiere
							AND id_classe=code_classe
							AND id_prof=login
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		public function classePrincipale(){
			$sql = "SELECT nom, prenom, nom_classe, classe_principale.id as id, sexe,
						classe as code_classe
					FROM enseignant, classe, classe_principale
					WHERE classe=code_classe AND prof=login
					ORDER BY niveau DESC";
			$req = $this->_db->query($sql);
			while($res=$req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		// Liste des Matières issues de la table Prof_classe
		public function listeMatiereProfClasse(){
			$sql = "SELECT id_matiere, nom_matiere
					FROM prof_classe, matiere
					WHERE id_matiere = code_matiere
					GROUP BY id_matiere ORDER BY id_matiere DESC";
			$req = $this->_db->query($sql);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $reponse;
			}
			return $resultat;
		}
		
		
		
		
		// On vérifie qu'une matière est bel et bien introduite dans une classe 
		public function verifMatiere($classe, $matiere){
			$sql = "SELECT id_classe, id_matiere, nom_classe, nom_matiere
					FROM prof_classe, classe, matiere
					WHERE id_classe='$classe'
							AND id_matiere='$matiere'
							AND code_classe=id_classe
							AND code_matiere=id_matiere";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		// Les classes dans lesquelles un enseignant intervient   
		public function listeClasseProf($enseignant){
			$sql = "SELECT id_classe, nom_classe	
					FROM prof_classe,classe
					WHERE id_prof='$enseignant'
						AND code_classe=id_classe
					GROUP BY id_classe
					";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		// Les matières dans lesquelles un enseignant intervient dans une classe
		public function listeMatiereProf($enseignant, $classe){
			$sql = "SELECT id_classe, id_matiere, nom_matiere
					FROM prof_classe, matiere
					WHERE id_prof='$enseignant'
						AND id_classe='$classe'
						AND id_matiere=code_matiere
						ORDER BY nom_matiere
					";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		/*On vérifie que le prof a bien le droit de remplir les notes pour la 
		classe et pour la matière */
		public function verifMatiereClasseProf($enseignant, $classe, $matiere){
			$sql = "SELECT *
					FROM prof_classe
					WHERE id_prof='$enseignant'
						AND id_classe='$classe'
						AND id_matiere='$matiere'
					";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		// 13
		
		
		
		
		// 14
		
		
		
		
		// 15
		
		
		
		
		// 16
		
		
		
		
		// 17
		
		
		
		
		// 18
		
		
		
		
		// 19
		
		
		
		
		// 20 
		
		
		
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
				C O N F I U R A T I O N   D U   L O G I C I E L		
		*****************************************************************
		****************************************************************/
		
		public function chargerMenu($user){
			$sql = "SELECT *
					FROM menu
					WHERE utilisateur = '$user'
					ORDER BY id";
			$req = $this->_db->query($sql);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $reponse;
			}
			return $resultat;
		}
		
		
		
		
		
		
		public function chargerSousMenu($menu){
			$sql = "SELECT *
					FROM sous_menu_1
					WHERE id_menu = '$menu'
					ORDER BY id";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		public function chargerSousMenu2($sousMenu){
			$sql = "SELECT *
					FROM sous_menu_2
					WHERE sous_menu = '$sousMenu'
					ORDER BY id";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		public function derniereConnexion($user){
			$sql = "SELECT id, adresse_ip, periode_de_connexion, 
							DATE_FORMAT(periode_de_connexion, '%d  %M  %Y') 
							as periode_fr,
							DATE_FORMAT(periode_de_connexion, '%H H %i min')
							as heure_fr
					FROM journal_connexion
					WHERE utilisateur = '$user'
					ORDER BY periode_de_connexion";
			$req = $this->_db->query($sql);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $reponse;
			}
			$trueLast = count($resultat)-2;
			return $resultat[$trueLast];
		}
		
		
		
		
		public function journalConnexion($user){
			$sql = "SELECT utilisateur, adresse_ip, 
						DATE_FORMAT(periode_de_connexion, 
									'%d %M %Y') as jour,
						DATE_FORMAT(periode_de_connexion, 
									'%H h %i min %s Sec') as heure,
						nom, prenom, sexe 
					FROM journal_connexion, enseignant
					WHERE utilisateur='$user'
						AND login=utilisateur
					ORDER BY periode_de_connexion DESC";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		public function chargerInformations(){
			$sql = "SELECT *
					FROM information
					";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $reponse;
			
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		*****		M E N U   C L O T U R E R 	A N N E E 	*************
		*****************************************************************
		****************************************************************/
		
		private function decrireTable($table){
			$requete = "DESCRIBE ".$table;
			$req = $this->_db->query($requete);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			foreach($reponse as $cle=>$valeur){
				$champ[] = $valeur['Field'];
				$type[] = $valeur['Type'];
				if($valeur['Null']=='NO'){
					$null[] = 'NOT NULL';
				} else{
					$null[] = 'NULL';
				}
				if($valeur['Key']=='PRI'){
					$pkey[]='PRIMARY KEY';
				} else{
					$pkey[]='';
				}
				$default[] = $valeur['Default'];
				$extra[] = $valeur['Extra'];
			}
			$resultat['champ'] = $champ;
			$resultat['type'] = $type;
			$resultat['null'] = $null;
			$resultat['key'] = $pkey;
			$resultat['default'] = $default;
			$resultat['extra'] = $extra;
			return $resultat;
		}
		
		
		
		
		
		
		
		
		private function renommerTable($ancienne, $nouvelle){
			$sql = "ALTER TABLE `$ancienne` 
					RENAME `$nouvelle`";
			$req = $this->_db->query($sql);
		}
		
		
		
		
		
		
		
		
		
		
		
		// On cloture l'année scolaire en cours.
		public function cloturerAnnee($source, $endYear, $openYear){
			// On introduit la nouvelle année avec le statut actif et l'ancienne en statut inactif 
			$sql_0 = "INSERT INTO annee_scolaire(libelle_annee, statut) 
						VALUES('$openYear','actif')";
			$sql_1 = "UPDATE annee_scolaire SET statut='inactif'
						WHERE libelle_annee !='$openYear'";
			$sql_2 = "UPDATE information SET annee_scolaire='$openYear'";
			$this->_db->query($sql_0);
			$this->_db->query($sql_1);
			$this->_db->query($sql_2);
			
			// On renomme les tables Annuelles en ANNEE_SCOLAIRE_ANNUEL_CLASSE
			$sql = "SELECT *
					FROM bull_ann";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			for($i=0;$i<count($res);$i++){
				$suffixe = $res[$i]['classe'];
				$table = 'annuel_'.$suffixe;
				$newTable = str_replace(' ','',$endYear).'_'.$table;
				$this->renommerTable($table, $newTable);
			}
			// On renomme les tables Trimestrielles en ANNEE_SCOLAIRE_TRIMESTRE_NUMERO_CLASSE
			$sql_3 = "SELECT *
					FROM bull_trim";
			$req_3 = $this->_db->query($sql_3);
			$res_3 = $req_3->fetchAll(PDO::FETCH_ASSOC);
			for($j=0;$j<count($res_3);$j++){
				$suffixe0 = $res_3[$j]['trim'].'_'.$res_3[$j]['classe'];
				$table0 = 'trimestre_'.$suffixe0;
				$newTable0 = str_replace(' ','',$endYear).'_'.$table0;
				$this->renommerTable($table0, $newTable0);
			}
						
			/*On truncate les tables bull_ann, bull_trim, classe_principale, journal_connexion, 
			note, note_saisie, */
			$sql_new[] = "truncate bull_ann";
			$sql_new[] = "truncate bull_trim";
			$sql_new[] = "truncate bull_seq";
			$sql_new[] = "truncate classe_principale";
			$sql_new[] = "truncate journal_connexion";
			$sql_new[] = "truncate note";
			$sql_new[] = "truncate note_saisie";
			for($k=0;$k<count($sql_new);$k++){
				$this->_db->query($sql_new[$k]);
			}
			
			// On supprime les tables commençant par VIEW_ et par sequence_
			
			
			// On vide les profs de la table prof_classe 
			$sql_prof = "UPDATE prof_classe SET id_prof=''";
			$this->_db->query($sql_prof);
			
			// La gestion particulière de la table ELEVE (On renomme la Table et on en crée une nouvelle)
			$oldName = 'eleve';
			$newName = str_replace(' ','',$endYear).'_eleve';
			$this->renommerTable($oldName, $newName);
			
			$tableStructure  = "CREATE TABLE IF NOT EXISTS `eleve` (";
			$tableStructure .= "`id` int(11) NOT NULL AUTO_INCREMENT primary key,";
			$tableStructure .= "`rne` int(11) NOT NULL,";
			$tableStructure .= "`nom_complet` varchar(255) NOT NULL,";
			$tableStructure .= "`nom` varchar(255) NOT NULL,";
			$tableStructure .= "`prenom` varchar(255) DEFAULT NULL,";
			$tableStructure .= "`sexe` varchar(1) NOT NULL,";
			$tableStructure .= "`date_naissance` date NOT NULL,";
			$tableStructure .= "`lieu_naissance` varchar(255) DEFAULT NULL,";
			$tableStructure .= "`matricule` varchar(20) NOT NULL,";
			$tableStructure .= "`classe` varchar(100) NOT NULL,";
			$tableStructure .= "`adresse_parent` varchar(255) DEFAULT NULL,";
			$tableStructure .= "`statut` varchar(100) NOT NULL COMMENT 'red, nv',";
			$tableStructure .= "`num_rand` int(11) NOT NULL COMMENT 'on recupere sa val pour increm',";
			$tableStructure .= "`etat` varchar(100) NOT NULL COMMENT 'supprimé ou pas',";
			$tableStructure .= "`nom_pere` varchar(255) NOT NULL COMMENT 'papa du bb',";
			$tableStructure .= "`nom_mere` varchar(255) NOT NULL COMMENT 'mama du bb',";
			$tableStructure .= "`photo` varchar(255) not null comment 'adresse de la photo élève',";
			$tableStructure .= "`a_s` varchar(11) not null comment 'annee scolaire'";
			$tableStructure .= ")";
			
			// echo '<pre>';echo $tableStructure; echo '</pre>';
			$this->_db->query($tableStructure);
			
			
			
			$_SESSION['message'] = "Année Cloturée. Déconnectez-vous pour la prise en compte.";
			header('Location:'.$source);
		}
		
		
		
		
		
		// Liste des tables de la BD
		/*private function listeTableBD($bd){
			$sql = 'show tables';
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$result[] = $reponse;
			}
			for($i=0;$i<count($result);$i++){
				$resultat[] = $result[$i]['Tables_in_noteplus'];
			}
			return $resultat;
		}*/
		
		
		
	
		
		private function prepaTable($champ, $type, $null, $pri, 
									$defaut, $extra){
			
		}
		
		
		
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		*****		P A R A M   D E   L ' U T I L I S A T E U R	*************
		*****************************************************************
		****************************************************************/
		
		// On souhaite changer son mot de passe 
		public function updateMotDePasse($source, $ancien, 
											$nouveau, $confirm, $id){
			// echo '<pre>'; print_r($_SESSION); echo '</pre>';
			$this->_id = $this->setId($id);
			$this->_ancien = $this->setPwd($ancien);
			$this->_nouveau = $this->setPwd($nouveau);
			$this->_confirm = $this->setPwd($confirm);
			$this->_verification = $this->getMotDePasse($this->_id);
			// On vérifie d'abord que l'ancien mdp est bien celui enregistré.
			if($this->_verification==$this->_ancien){
				// On s'assure maintenant que le nouveau mdp et l'ancien sont 
				// différents 
				if($this->_ancien==$this->_nouveau){
					$_SESSION['message'] = 'Aucune modification effectuée.';
					header('Location:'.$source);
				}
				else{
					// La confirmation doit correspondre au nouveau mdp
					if($this->_nouveau!=$this->_confirm){
						$_SESSION['message'] = 'La confirmation ';
						$_SESSION['message'] .= ' ne correspond pas.';
						header('Location:'.$source);
					}
					else{
						$sql = "UPDATE enseignant SET
								mdp='$this->_nouveau' 
								WHERE id='$this->_id'";
						$exec = $this->_db->query($sql);
						/*$exec = $this->_db->prepare("
												
												");
						$exec->bindValue(':mdp', $this->_nouveau);
						$exec->execute();*/
						$_SESSION['message'] = 'Modification effectuée';
						$_SESSION['message'] .= ' avec succès.';
						header('Location:'.$source);
					}
				}
			}
			else{
				$_SESSION['message'] = 'Vous devez entrer votre ancien';
				$_SESSION['message'] .= ' mot de passe';
				header('Location:'.$source);
			}
		}
		
		
		
		
		
		
		
		
		
		
		// On réinitialise le mot de passe perdu ou oublié 
		public function resetMotDePasse($source, $nouveau, $confirm, $id){
			$this->_id = $id;
			$this->_nouveau = $this->setPwd($nouveau);
			$this->_confirm = $this->setPwd($confirm);
			
			// Il faut que la confirmation du mot de passe corresponde
			if($this->_nouveau!=$this->_confirm){
				$_SESSION['message'] = 'La confirmation ';
				$_SESSION['message'] .= ' ne correspond pas.';
				header('Location:'.$source);
			}
			else{
				$sql = "UPDATE enseignant SET 
						mdp = '$this->_nouveau'
						WHERE login = '$this->_id'";
				$req = $this->_db->query($sql);
				print_r($req);
				$_SESSION['message'] = 'Mot de Passe réinitialisé';
				$_SESSION['message'] .= ' avec succès.';
				header('Location:'.$source);
			}
		}
		
		
		
		
		
		
		
		
		
		// Obtenir le mot de passe de l'utilisateur courant 
		private function getMotDePasse($user){
			$this->_user = $this->setId($user);
			$sql = "SELECT mdp 
					FROM enseignant 
					WHERE id = '$this->_user'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['mdp'];
		}
		
		
		
		
		
		
		
		
		
		// On met à jour la photo de profil de l'utilisateur 
		public function setPhoto($source, $user){
			$this->_user = $this->setId($user);
			$photo = $_FILES['photo'];
			// echo '<pre>';print_r($photo); echo '</pre>';
			// Si le fichier est reçu sans erreur 
			if($photo['error']==0){
				// Le fichier reçu doit être inférieur à 2Mo
				if($photo['size'] <= 2000000){
					// On gère les extensions autorisées
					$infosfichier = pathinfo($photo['name']);
					// print_r($infosfichier);
					$extension_recue = $infosfichier['extension'];
					$extension_autorisee = array('jpg',
													'jpeg',
													'png',
													'gif',
													'bmp');
					if(in_array($extension_recue, $extension_autorisee)){
						$infosfichier['filename'] = $_SESSION['login'];
						$infosfichier['basename'] = $infosfichier['filename'];
						$infosfichier['basename'].= $infosfichier['dirname'];
						$infosfichier['basename'].= $infosfichier['extension'];
						$sousRepertoireStockage = 'images/';
						$sousRepertoireStockage .= $_SESSION['poste'];
						$sousRepertoireStockage .= '/';
				$sousRepertoireStockage .= $infosfichier['basename'];
						move_uploaded_file($photo['tmp_name'],
										$sousRepertoireStockage);
						$login = $_SESSION['login'];
						$sql = "UPDATE enseignant 
								SET image ='$sousRepertoireStockage'
								WHERE login='$login'";
						$req = $this->_db->query($sql);
						$_SESSION['message'] = 'Photo insérée / Mise à jour';
						header('Location:'.$source);
					}
					else{
						$_SESSION['message'] = 'Extension de fichier non';
						$_SESSION['message'] = ' autorisée.';
						header('Location:'.$source);
					}
				}
				else{
					$_SESSION['message'] = 'La taille du fichier est supérieure';
					$_SESSION['message'] .= ' à 2Mo';
					header('Location:'.$source);
				}
			}
			else{
			 $_SESSION['message'] = 'La photo contient des erreurs';
			 header('Location:'.$source);
			}
		}
		
		
		
		
		
		
		
		
		
		
		// On insère les photos des élèves dans la Base de Données 
		public function addPhotoEleve($source, $eleve, $matricule, $image){
			// echo '<pre>'; print_r($eleve); echo '</pre>';
			// echo '<pre>'; print_r($matricule); echo '</pre>';
			$infoEleve = $this->getEleve($eleve);
			$nomEleve = $infoEleve['nom'];
			echo '<pre>'; print_r($image); echo '</pre>';
			// echo '<pre>'; print_r($infoEleve); echo '</pre>';
			
			// On se rassure que le fichier a un nom 
			$photoName = $image['name'];
			if(!empty($photoName)){
				// Si le fichier reçu est sans erreur 
				if($image['error']==0){
					// Le fichier reçu doit être inférieur à 2Mo 
					if($image['size']<=2000000){
						// On gère les extensions autorisées 
						$infosfichier = pathinfo($photoName);
						$extension_recue = $infosfichier['extension'];
						$extension_autorisee = array('jpg','jpeg','png');
						if(in_array($extension_recue, $extension_autorisee)){
							$nomFichier = 'Photo_';
							$nomFichier .= $matricule;
							$nomFichier .= $infosfichier['dirname'];
							$nomFichier .= $infosfichier['extension'];
							$sousRepertoireStockage = 'images/eleve/'.$nomFichier;
							move_uploaded_file($image['tmp_name'],$sousRepertoireStockage);
							$sql = "UPDATE eleve 
									SET photo ='$sousRepertoireStockage'
									WHERE id='$eleve'";
							$req = $this->_db->query($sql);
							$_SESSION['message'] = 'Photo(s) insérée(s) / Mise(s) à jour';
							header('Location:'.$source);
							// echo "<p>Le fichier se nommera ".$nomFichier.". et sera stocké dans $sousRepertoireStockage</p>";
						}else{
							$_SESSION['message'] = 'La photo de '.$nomEleve.' ne contient pas la bonne extension.';
							header('Location:'.$source);
						}
					}else{
						$_SESSION['message'] = 'La photo de '.$nomEleve.' est supérieure à 2Mb.';
						header('Location:'.$source);
					}
				}else{
					$_SESSION['message'] = 'La photo de '.$nomEleve.' contient des erreurs.';
					header('Location:'.$source);
				}
			}else{
				$_SESSION['message'] = 'La photo de '.$nomEleve.' doit avoir un nom valide.';
				header('Location:'.$source);
			}
			
			/*for($i=0;$i<count($eleve);$i++){
				$idEleve = $eleve[$i];
				$infoEleve = $this->getEleve($idEleve);
				// echo '<pre>';print_r($infoEleve);echo '</pre>';
				$idMatricule = $matricule[$i];
				// Si le fichier existe, c'est à dire s'il a un nom 
				
				if(!empty($photoName)){
					// Si le fichier est reçu sans erreur				
					if($photo['error'][$i]==0){
						// Le fichier reçu doit être inférieur à 2Mo
						if($photo['size'][$i] <= 2000000){
							// On gère les extensions autorisées
							$infosfichier = pathinfo($photo['name'][$i]);
							$extension_recue = $infosfichier['extension'];
							$extension_autorisee = array('jpg','jpeg','png','bmp');
							if(in_array($extension_recue, $extension_autorisee)){
								$nomFichier = 'Photo_';
								$nomFichier .= $idMatricule;
								// $nomFichier .= '_';
								// $nomFichier .= str_replace(' ','_',strtoupper($infoEleve['nom']));
								// $nomFichier .= '_';
								// $nomFichier .= str_replace(' ','_',strtoupper($infoEleve['prenom']));
								$nomFichier .= $infosfichier['dirname'];
								$nomFichier .= $infosfichier['extension'];
								$sousRepertoireStockage = 'images/eleve/'.$nomFichier;
							
								move_uploaded_file($photo['tmp_name'][$i],$sousRepertoireStockage);
								$sql = "UPDATE eleve 
										SET photo ='$sousRepertoireStockage'
										WHERE id='$idEleve'";
								$req = $this->_db->query($sql);
								$_SESSION['message'] = 'Photo(s) insérée(s) / Mise(s) à jour';
								header('Location:'.$source);
							}else{
								$_SESSION['message'] = 'Extension d image non';
								$_SESSION['message'] = ' autorisée.';
								header('Location:'.$source);
							}
						
						}else{
							$_SESSION['message'] = 'La photo de '.strtoupper($infoEleve['nom']);
							$_SESSION['message'] .= ' '.ucwords($infoEleve['prenom']);
							$_SESSION['message'] .= ' est supérieure à 2Mb.';
							header('Location:'.$source);
						}
					}else{
						echo var_dump($photo['error'][$i]);
					
						$_SESSION['message'] = 'La photo de '.strtoupper($infoEleve['nom']);
						$_SESSION['message'] .= ' '.ucwords($infoEleve['prenom']);
						$_SESSION['message'] .= ' contient des erreurs.';
						header('Location:'.$source);
					}
				}
			}*/
		}
		
		
		
		
		
		
		
		
		public function pageEnCours(){
			$page = $_SERVER['PHP_SELF'];
			$explosion = explode('/',$page);
			$nbVal = count($explosion);
			$indice = $nbVal - 1;
			$nomPage = $explosion[$indice];
			return $nomPage;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		/**************************************************************************
		***************************************************************************
		************	G E S T I O N    D E S    A B S C E N C E S 	***********
		************	D U   S U R V E I L L A N T   G E N E R A L 	***********
		***************************************************************************
		**************************************************************************/
		
		// Insérer une absence d'un élève 
		public function addAbsence($source, $eleve, $date, $heure){
			if($heure==0){
				$_SESSION['message'] = 'Les Heures doivent être supérieures à Zero.';
				header('Location:'.$source);
			}else{
				if($heure>8){
					$_SESSION['message'] = 'Une journée contient au maximum 8 heures.';
					header('Location:'.$source);
				}else{
					// On ne doit pas ajouter 2 fois les heures à un même élève pour une même journée
					$sql_verif = "SELECT * 
									FROM absence
									WHERE id_eleve='$eleve'
										AND date_absence='$date'";
					$req_verif = $this->_db->query($sql_verif);
					$res_verif = $req_verif->fetchAll(PDO::FETCH_ASSOC);
					if(!empty($res_verif)){
						$_SESSION['message'] = 'Cet élève a déjà des heures pour cette date.';
						header('location:'.$source);
					}else{
						$sql = "INSERT INTO absence(id_eleve, date_absence, nombre_heure, justification)
								VALUES('$eleve','$date','$heure','ANJ')";
						$req = $this->_db->query($sql);
						$_SESSION['message'] = $heure.' Heures ajoutées au '.$date;
						header('Location:'.$source);
					}
				}
			}
		}
		
		
		
		
		
		
		
		
		// Visualiser les absences d'un élève en particulier
		public function viewAbsenceEleve($eleve){
			$sql = "SELECT id_eleve, date_absence, nombre_heure, justification,
							nom, prenom, classe, nom_classe, absence.id as id,
							DATE_FORMAT(date_absence, '%d / %m / %Y') as date_abs
					FROM absence, eleve, classe
					WHERE id_eleve = '$eleve'
						AND eleve.id = id_eleve
						AND classe = code_classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		// Visualiser les absences d'un élève sur un trimestre en particulier 
		public function viewAbsenceElevePeriode($eleve, $periode){
			
		}
		
		
		
		
		
		
		
		
		// Visualiser les absences selon qu'elles sont justifiées (ANJ) ou non(AJ)
		public function viewAbsenceJustif($etat){
			$sql = "SELECT id_eleve, date_absence, nombre_heure, justification,
							nom, prenom, classe, nom_classe, absence.id as id,
							DATE_FORMAT(date_absence, '%d / %m / %Y') as date_abs
					FROM absence, eleve, classe
					WHERE eleve.id = id_eleve
						AND classe = code_classe
						AND justification='$etat'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		// On visualise les élèves d'une classe qui ont les absences dans la Table ABSENCE 
		public function viewEleveAbsence($classe){
			$sql = "SELECT DISTINCT id_eleve as id, nom, prenom
					FROM absence, eleve
					WHERE id_eleve = eleve.id
						AND classe='$classe'
					ORDER BY nom";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
			
			
		}
		
		
		
		
		
		
		
		
		
		
		// On Supprime définitivement les absences d'un élève de la Base de Données 
		public function deleteAbsenceEleve($source, $id){
			$sql = "DELETE FROM absence WHERE id='$id'";
			$req = $this->_db->query($sql);
			$_SESSION['message'] = 'Absence(s) supprimée(s).';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		// On Justifie les Absences d'un élève
		public function updateAbsenceEleve($source, $id){
			$sql = "UPDATE absence SET justification='AJ' WHERE id='$id'";
			$req = $this->_db->query($sql);
			$_SESSION['message'] = 'Absence(s) Justifiée(s).';
			header('Location:'.$source);
		}
		
		
		
		
		
	}