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
			$sql = "SELECT nom, nom_complet_enseignant, sexe, login, enseignant.id as idEnseignant, 
							libelle_poste
					FROM enseignant, poste
					WHERE poste.id='$type' 
						AND enseignant.poste = poste.id
						AND etat = 'actif'
						ORDER BY nom_complet_enseignant";
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
		
		
		
		public function getGroupe(){
			$sql = "SELECT * FROM groupe ORDER BY nom_groupe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res; 
		}
		
		
		// La fonction qui gère le formulaire de connexion 
		public function connectUser($source, $login, $mdp){
			$this->_login = $this->setUserId($login);
			$this->_mdp = $this->setPassword($mdp);
			$sql = "SELECT enseignant.id as id, nom, sexe, poste, nom_complet_enseignant,
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
					$_SESSION['user']['nom_complet_enseignant'] = stripslashes($reponse['nom_complet_enseignant']);
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
					$_SESSION['message'] = 'Welcome '.$_SESSION['user']['nom_complet_enseignant'];
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
				$nom = addslashes(utf8_encode($nom));
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
				$prenom = addslashes(utf8_encode($prenom));
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
		
		
		
		
		
		
		
		
		
		
		public function setLogin($login){
			if(!is_string($login)){
				$this->_login = (string)$login;
			}
			else{
				$this->_login = addslashes(utf8_encode($login));
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
			// echo '<pre>'; print_r($eleve); echo '</pre>';
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
				// echo '<pre>';print_r($infoEleve); echo '</pre>';
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
		}
		
		
		
		
		
		public function rechercherEleve($nom){
			$sql = "SELECT eleve.id as id, nom_complet, a_s, libelle_annee, etat
					FROM eleve, annee_scolaire
					WHERE nom_complet LIKE '%$nom%'
						AND annee_scolaire.id = a_s
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





		public function listeEleveAll($etat){
			$sql = "SELECT * 
					FROM eleve
					WHERE etat='$etat'
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		// Les statistiques de liste d'une classe donnée 
		public function listeEleveStat($classe, $etat, $as){
			/*if($as==$this->getCurrentYear()){
				$table = 'eleve';
			}else{
				$table = $as.'_eleve';
			}*/	
			$table = 'eleve';;
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
			$this->_classe = $this->setUserId($classe);
			$table = $annee.'_eleve';
			$sql = "SELECT *
					FROM `$table`
					WHERE etat = '$etat'
						AND classe = '$this->_classe'
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		// La liste globale des élèves d'une année scolaire écoulée 
		// La liste des élèves d'une classe d'année scolaire précédente
		public function listeEleveOldYear($annee){
			$table = $annee.'_eleve';
			$sql = "SELECT *
					FROM `$table` 
					WHERE etat='non_supprime'
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		public function rechercherEleveOld($nom, $annee){
			$table = $annee."_eleve";
			echo $table;
			/*$sql = "SELECT *
					FROM eleve 
					WHERE nom_complet LIKE '%$nom%'
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;*/
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
					WHERE classe.id='$classe'";
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
						ORDER BY classe.section, nom_niveau, nom_classe";
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
			$sql = "SELECT classe.id as id, nom_classe, code_classe, classe.section as section,
							etat_classe, niveau_classe, nom_niveau
					FROM classe, niveau_classe
					WHERE etat_classe='".$etat."'
						AND classe.section = '".$section."'
						AND classe.niveau_classe = niveau_classe.id
					ORDER BY nom_niveau, nom_classe";
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
					ORDER BY section, nom_niveau DESC";
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
			// $classe = $this->setUserId($eleve['classeEleve']);
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
			// if(!empty($classe)){
			// 	if($classe!=$infoEleve['classe']){
			// 		$champ[] = 'classe';
			// 		$valeur[] = $classe;
			// 	}
			// }
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





		public function changerClasseEleve($source, $eleve, $classe){
			$this->_eleve = $this->setUserId($eleve);
			$this->_classe = $this->setUserId($classe);
			// Ici on va changer la classe dans la table eleve et la classe dans la table note
			$eleveTable = $this->_db->prepare("UPDATE eleve SET 
												classe = :classe
												WHERE id =:eleve");
			$noteTable = $this->_db->prepare("UPDATE note SET 
												id_classe =:classe
												WHERE id_eleve =:eleve");
			$eleveTable->bindValue(':classe', $this->_classe);
			$eleveTable->bindValue(':eleve', $this->_eleve);
			$eleveTable->execute();

			$noteTable->bindValue(':classe', $this->_classe);
			$noteTable->bindValue(':eleve', $this->_eleve);
			$noteTable->execute();
			$_SESSION['message'] = 'Classe Modifiée';
			header('Location:'.$source);
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
			$sql = "SELECT classe.id as id, nom_classe, code_classe, 
							classe.section as section,
							etat_classe
					FROM classe 
					WHERE nom_classe LIKE '%$nom%'
						OR code_classe LIKE '%$nom%'
					ORDER BY nom_classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		public function getClasse($id) {
			$this->_id = $this->setUserId($id);
			$req = "SELECT classe.id as id, nom_classe, code_classe, 
							classe.section as section, etat_classe, niveau_classe, nom_niveau 
					FROM classe, niveau_classe
					WHERE classe.id = '$this->_id'
						AND niveau_classe = niveau_classe.id
					ORDER BY nom_classe";
			$sql = $this->_db->query($req);
			$res=$sql->fetch(PDO::FETCH_ASSOC);
			$classe = $res;
			return $classe;
		}
		
		
		
		
		
		
		
		
		
		
		/* Mettre à jour les informations d'une classe */
		public function updClasse($source, $information){
			echo '<pre>'; print_r($information); echo '</pre>';
			$className = $this->setNom($information['nomClasse']);
			$classCode = $this->setCode($information['codeClasse']);
			$classSection = $this->setSection($information['section']);
			$classLevel = $this->setUserId($information['niveau']);
			$classId = $this->setUserId($information['idClasse']);
			
			$requete = $this->_db->prepare("UPDATE classe SET 
											nom_classe =:nom,
											code_classe =:code,
											section =:section,
											niveau_classe =:niveau
											WHERE id=:id");
			$requete->bindValue(':nom',$className);
			$requete->bindValue(':code',$classCode);
			$requete->bindValue(':section',$classSection);
			$requete->bindValue(':niveau',$classLevel);
			$requete->bindValue(':id',$classId);
			$requete->execute();
			$_SESSION['message'] = 'Classe Mise à jour';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		/*Supprimer la classe */
		public function supprimerClasse($source, $classe) {
			$this->_classe = $this->setUserId($classe);
			$requete = $this->_db->prepare("UPDATE classe SET
											etat_classe='inactif'
											WHERE id=:id");
			$requete->bindValue(':id', $this->_classe);
			$requete->execute();
			$_SESSION['message'] = 'Classe Supprimée';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		
		/*Réactiver ou Restaurer une classe supprimée */
		public function RestaurerClasse($source, $classe) {
			$this->_classe = $this->setUserId($classe);
			$requete = $this->_db->prepare("UPDATE classe SET
											etat_classe='actif'
											WHERE id=:id");
			$requete->bindValue(':id', $this->_classe);
			$requete->execute();
			$_SESSION['message'] = 'Classe Restaurée';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		public function getClasseCode($id) {
			$req = "SELECT nom_classe, code_classe, etat_classe, niveau_classe, id 
					FROM classe 
					WHERE id = '$id'
					ORDER BY nom_classe";
			$sql = $this->_db->query($req);
			$res=$sql->fetch(PDO::FETCH_ASSOC);
			$classe = $res;
			return $classe;
		}
		
		
		


		public function getNoteEleve($eleve, $periode){
			$sql = "SELECT note.id as id, id_eleve, id_matiere, id_classe, id_periode, note,
							nom, prenom, nom_matiere  
					FROM note, eleve, matiere
					WHERE id_eleve = '$eleve'
						AND id_eleve = eleve.id
						AND code_matiere = id_matiere
						AND id_periode = '$periode'
					ORDER BY id_matiere";
			$req = $this->_db->query($sql);
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
			return $resultat;
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
		
		
		// Liste des Matières qui interviennent dans une classe 
		public function getMatiereClasse($classe){
			$sql = "SELECT prof_classe.id as id, id_classe, nom_classe, code_matiere, id_matiere, 
									nom_matiere, coef, groupe, nom_groupe
					FROM prof_classe, classe, matiere, groupe
					WHERE id_classe='$classe'
						AND classe.id = id_classe
						AND matiere.id = id_matiere
						AND groupe = groupe.id
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
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
											$poste, $login, $contact) {
			$this->_nom = $this->setNom($nom);
			$this->_prenom = $this->setPrenom($prenom);
			$this->_nomComplet = strtoupper($this->_nom).' '.ucwords($this->_prenom);
			$this->_sexe = $this->setSexeGest($sexe);
			$this->_poste = $this->setUserId($poste);
			$this->_login = $this->setLogin($login);
			$this->_mdp = $this->setPassword($login);
			$this->_contact = $contact;
			// Le login est-il déjà utilisé ?
			$sql = "SELECT * FROM enseignant WHERE login = '$this->_login'";
			$req = $this->_db->query($sql);
			$reponse = $req->fetch(PDO::FETCH_ASSOC);
			if($reponse!=false){
				$_SESSION['message'] = "Le login est déjà utilisé";
				header('Location:'.$source);
			}
			else{
				$insert = $this->_db->prepare("INSERT INTO enseignant SET 
							nom=:nom,							
							prenom=:prenom,
							nom_complet_enseignant =:nomComplet,
							sexe=:sexe, 
							poste=:poste, 
							login=:login, 
							mdp=:mdp,
							contact =:contact,
							etat=:etat ");
				$insert->bindValue(':nom', $this->_nom);
				$insert->bindValue(':prenom', $this->_prenom);
				$insert->bindValue(':sexe', $this->_sexe);
				$insert->bindValue(':poste', $this->_poste);
				$insert->bindValue(':login', $this->_login);
				$insert->bindValue(':mdp', $this->_mdp);
				$insert->bindValue(':etat', 'actif');
				$insert->bindValue(':contact', $this->_contact);
				$insert->bindValue(':nomComplet', $this->_nomComplet);
				$insert->execute();
				
				$_SESSION['message'] = "Utilisateur ajouté. Son mot de passe correspond à son login.";
				header('Location:'.$source);
			}
		}
		
		
		
		
		
		public function viewGestionnaireAll($etat){
			$this->_etat = $etat;
			$sql = "SELECT enseignant.id as id, nom_complet_enseignant, nom, 
							prenom, sexe, poste, login, etat, image, 
							libelle_poste
					FROM enseignant, poste 
					WHERE etat='$this->_etat'
						AND poste.id = poste
					ORDER BY libelle_poste, nom_complet_enseignant";
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
		
		
		// On recherche un prof
		public function findProf($nom){
			$sql = "SELECT enseignant.id as id, nom, nom_complet_enseignant, sexe, poste, login, etat
					FROM enseignant
					WHERE nom LIKE '%$nom%'
						OR login LIKE '%$nom%'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
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
		
		// On affiche tout sur un utilisateur donné 
		public function getUser($utilisateur){
			$sql = "SELECT enseignant.id as id, nom_complet_enseignant, nom, prenom, sexe, poste, login, mdp, etat, image,
							libelle_poste, contact
					FROM enseignant, poste 
					WHERE enseignant.id = '$utilisateur' 
						AND poste.id = poste";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			// if($res['sexe']=='F'){$valeurSexe='Feminin';}
			// elseif($res['sexe']=='M'){$valeurSexe='Masculin';}
			// $res['valeurSexe'] = $valeurSexe;
			return $res;
		}
		
		
		// On restaure un utilisateur supprimé
		public function restaureUser($source, $user){
			$sql = "UPDATE enseignant SET etat = 'actif' WHERE id='$user'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Utilisateur restauré.';
			header('Location:'.$source);
		}
  
		
		
		// On supprime un utilisateur 
		public function deleteUser($source, $user){
			$sql = "UPDATE enseignant SET etat= 'inactif' WHERE id='$user'";
			$this->_db->query($sql);
			$_SESSION['message'] = 'Utilisateur supprimé';
			header('Location:'.$source);
		}
		
		
		
		
		
		// On met à jour l'utilisateur 
		public function updateUtilisateur($source, $utilisateur){
			echo '<pre>'; print_r($utilisateur); echo '</pre>';
			$userName = $this->setNom($utilisateur['userName']);
			$userFName = $this->setNom($utilisateur['userfName']);
			// $userSexe = $this->setSexe($utilisateur['userSex']);
			$userSexe = $utilisateur['userSex'];
			$userPoste = $this->setUserId($utilisateur['userPost']);
			$userLogin = $this->setLogin($utilisateur['userLogin']);
			$userId = $this->setUserId($utilisateur['userId']);
			$userContact = $utilisateur['userContact'];
			
			$infoUtilisateur = $this->getUser($userId);
			
			echo '<pre>';print_r($infoUtilisateur);echo '</pre>';
			if(!empty($userName)){
				if($userName!=$infoUtilisateur['nom']){
					$champ[] = 'nom';
					$valeur[] = $userName;
				}
			}
			if(!empty($userFName)){
				if($userFName!=$infoUtilisateur['prenom']){
					$champ[] = 'prenom';
					$valeur[] = $userFName;
				}
			}
			
			if(!empty($userLogin)){
				if($userLogin!=$infoUtilisateur['login']){
					$champ[] = 'login';
					$valeur[] = $userLogin;
				}
			}
			
			if(!empty($userSexe)){
				if($userSexe!=$infoUtilisateur['sexe']){
					$champ[] = 'sexe';
					$valeur[] = $userSexe;
				}
			}


			if(!empty($userPoste)){
				if($userPoste!=$infoUtilisateur['poste']){
					$champ[] = 'poste';
					$valeur[] = $userPoste;
				}
			}
			
			
			if(!empty($userContact)){
				if($userContact!=$infoUtilisateur['contact']){
					$champ[] = 'contact';
					$valeur[] = $userContact;
				}
			}

			
			if(!empty($champ)){
				$iteration = count($champ);
				$sql = "UPDATE enseignant SET ";
				for($i=0;$i<$iteration-1;$i++){
					$sql .= $champ[$i]." = '".$valeur[$i]."', ";
				}
				$valeurFinaleArray = $iteration - 1;
				$sql .= $champ[$valeurFinaleArray]." = '".$valeur[$valeurFinaleArray]."' ";
				$sql .= "WHERE id = '".$userId."'";
				$this->_db->query($sql);
				// Le cas particulier du champ nom_complet_enseignant 
				$newValue = $this->getUser($userId);
				$nomComplet = strtoupper($newValue['nom'])." ".ucwords($newValue['prenom']);
				$requete = $this->_db->prepare("UPDATE enseignant SET 
												nom_complet_enseignant = :nomComplet
												WHERE id=:id");
				$requete->bindValue('nomComplet', $nomComplet);
				$requete->bindValue('id', $userId);
				$requete->execute();
				$_SESSION['message'] = 'Informations Utilisateur Mises à jour.';
				header('Location:'.$source);
			}else{
				$_SESSION['message'] = 'Aucune information modifiée.';
				header('Location:'.$source);
			}
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
		
		public function getSequenceCourante($id){
			$sql = "SELECT * FROM periode WHERE id = '$id'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		public function createDateAbsence($source, $sequence, $open, $close){
			$_SESSION['message'] = '';
			for($i=0;$i<count($open);$i++){
				if(!empty($open[$i])){
					$this->_open = $open[$i];
					$this->_close = $close[$i];
					$this->_periode = $sequence[$i];
					// La date d'ouverture doit être supérieure à la date de fermeture 
					if($this->_open >= $this->_close){
						$_SESSION['message'] .= '-Certaines dates sont invalides.-';
					}else{
						$verif = $this->checkInfo($sequence[$i],'date_absences', 'id_periode');
						if($verif==false){
							$add = $this->_db->prepare("INSERT INTO date_absences SET 
														open_date=:open,
														close_date=:close,
														id_periode=:periode");
							$add->bindValue(':open',$this->_open);
							$add->bindValue(':close',$this->_close);
							$add->bindValue(':periode',$this->_periode);
							$add->execute();
							$_SESSION['message'] .= '-Valeur(s) insérées.-'; 
						}else{
							$update = $this->_db->prepare("UPDATE date_absences 
														SET 
														open_date=:open,
														close_date=:close 
														WHERE id_periode=:periode");
							$update->bindValue(':open',$this->_open);
							$update->bindValue(':close',$this->_close);
							$update->bindValue(':periode',$this->_periode);
							$update->execute();
							$_SESSION['message'] .= '-Valeur(s) mise(s) à jour.-';
						}
					}
				}else{
					$_SESSION['message'] .= '-Certaines dates ne sont pas saisies.-';
				}
			}
			header('Location:'.$source);
		}
		
		
		public function updateDateAbsence($source, $info){
			// echo '<pre>'; print_r($info); echo '</pre>';
			// On vérifie que la date d'ouverture est inf ou égal a la fermeture 
			if($info['debut'] >= $info['fin']){
				$_SESSION['message'] = 'Certaines dates sont invalides';
			}else{
				$update = $this->_db->prepare("UPDATE date_absences SET 
												open_date=:open,
												close_date=:close
												WHERE id_periode=:periode");
				$update->bindValue(':open',$info['debut']);
				$update->bindValue(':close',$info['fin']);
				$update->bindValue(':periode',$info['sequence']);
				$update->execute();
				$_SESSION['message'] = 'Modifications effectuées';
			}
			header('Location:'.$source);
		}
		
		
		public function verifNoteSaisie($classe, $matiere, $periode){
			$this->_classe = $this->setUserId($classe);
			$this->_matiere = $this->setUserId($matiere);
			$this->_periode = $this->setUserId($periode);
			$sql = "SELECT id_classe, id_enseignant, id_matiere, id_periode, nom_classe, nom_complet_enseignant, nom_matiere,
							competence,
							DATE_FORMAT(date_saisie, '%d / %m / %Y') as date_fr,
							DATE_FORMAT(date_saisie, '%Hh %imin %sSec') as heure_fr
					FROM note_saisie, classe, enseignant, matiere 
					WHERE id_classe='$this->_classe'
						AND id_matiere = '$this->_matiere' 
						AND id_periode = '$this->_periode'
						AND classe.id = id_classe
						AND enseignant.id = id_enseignant
						AND matiere.id = id_matiere
						";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
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
		
		
		
		
		/**
		 * Les Notes séquentielles d'un élève
		 * @param int $classe
		 * @param int $sequence
		 * @return array $resultat
		 */
		public function noteEleveSequence($classe, $sequence){
			$as = $this->getCurrentYear();
			$this->_classe = $this->setUserId($classe);
			$this->_sequence = $this->setUserId($sequence);
			$listeMatiere = $this->getMatiereClasse($this->_classe);
			// echo '<pre>'; print_r($listeMatiere); echo '</pre>';
			for($i=0;$i<count($listeMatiere);$i++){
				$idMatiere = $listeMatiere[$i]['id_matiere'];
				$codeMatiere = $listeMatiere[$i]['code_matiere'];
				$notesEleve[$codeMatiere] = $this->getNoteEleveSequence($this->_sequence, $idMatiere, $this->_classe);
			}
			return $notesEleve;
		}





		private function getNoteEleveSequence($sequence, $matiere, $classe){
			$sql = "SELECT id_eleve, nom_complet, id_matiere, nom_matiere, code_matiere, 
							id_classe, nom_classe, id_periode, note, observation
					FROM note, eleve, matiere, classe
					WHERE eleve.id = id_eleve
						AND matiere.id = id_matiere
						AND classe.id = id_classe
						AND id_periode = '$sequence'
						AND id_matiere = '$matiere'
						AND id_classe = '$classe'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
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
		
		
		
		
		public function addProfClasse($source, $data){
			// echo '<pre>';print_r($data); echo '</pre>';
			$matiere = $data['matiere'];
			$prof = $data['prof'];
			$classe = $data['classe'];
			foreach($prof as $cle=>$valeur){
				if($valeur!=null){
					// echo $cle.'<br />';
					$this->_matiere = $this->setUserId($matiere[$cle]);
					$this->_enseignant = $this->setUserId($valeur);
					// echo $this->_matiere.' a pour prof '.$this->_enseignant.'<br />';
					$sql = $this->_db->prepare("UPDATE prof_classe SET 
													id_prof=:prof
												WHERE id=:id");
					$sql->bindValue('prof', $this->_enseignant);
					$sql->bindValue('id', $this->_matiere);
					$sql->execute();
					$_SESSION['message'] = "Enseignant(s) ajouté(s)";
					header('Location:'.$source);
				}
			}
			/*$this->_matiere = $matiere;
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
			}*/
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
		public function ajouterProfPrincipal($source, $info /*$classe, $enseignant*/){
			echo '<pre>'; print_r($info); echo '</pre>';
			$classe = $info['classe'];
			$enseignant = $info['prof'];
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
			$sql = "SELECT DISTINCT id_classe, nom_classe
					FROM prof_classe, classe
					WHERE id_classe = classe.id
					ORDER BY section, nom_classe
					";					
			$req = $this->_db->query($sql);
			$reponse = $req->fetchAll(PDO::FETCH_ASSOC);
			return $reponse;
		}
		
		
		
		
		/*Les matières inscrites dans une classe */
		public function listeMatiereClasse($classe) {
			$this->_classe = $this->setUserId($classe);
			$sql = "SELECT prof_classe.id as id, id_matiere, 
							nom_matiere, coef, groupe, code_matiere
					FROM prof_classe, matiere
					WHERE id_classe='$this->_classe'
						AND id_matiere=matiere.id
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		/*Le Conseil de classe d'une classe donnée.
		La différence avec la fonction listeMatiereClasse($classe)
		que dans celle - ci, on affiche les noms des enseignants 
		qui passent dans la classe.*/
		public function conseilDeClasse($classe) {
			$this->_classe = $this->setNom($classe);
			$sql = "SELECT	id_prof, id_classe, id_matiere, coef, groupe, code_matiere,
							nom_matiere, nom_classe, nom, prenom, nom_complet_enseignant
					FROM prof_classe, matiere, classe, enseignant
					WHERE id_classe='".$this->_classe."'
							AND id_matiere=matiere.id
							AND id_classe=classe.id
							AND id_prof=enseignant.id
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		public function classePrincipale(){
			$sql = "SELECT nom, prenom, nom_complet_enseignant, nom_classe, classe_principale.id as id, 
							sexe, classe as code_classe
					FROM enseignant, classe, classe_principale
					WHERE classe=classe.id AND prof=enseignant.id
					ORDER BY niveau_classe DESC";
			$req = $this->_db->query($sql);
			while($res=$req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		


		public function getTrimestre($matiere){
			$sequence = $this->getTrimestreDraft($matiere);
			for($i=0;$i<count($sequence);$i++){
				if($sequence[$i]['id_periode']=='1' or $sequence[$i]['id_periode']=='2'){
					$trimestre[0] = '1';
				}
				if($sequence[$i]['id_periode']=='3' or $sequence[$i]['id_periode']=='4'){
					$trimestre[1] = '2';
				}
				if($sequence[$i]['id_periode']=='5' or $sequence[$i]['id_periode']=='6'){
					$trimestre[2] = '3';
				}
			}
			return $trimestre;
		}




		// On veut vérifier les notes saisies pour un trimestre à travers la table note_saisie 
		public function getTrimestreDraft($matiere){
			$this->_matiere = $this->setLogin($matiere);
			$sql = "SELECT id_periode 
					FROM note_saisie
					WHERE id_matiere = '$this->_matiere'
					GROUP BY id_periode ORDER BY id_periode ASC";
			$req = $this->_db->query($sql);
			$res=$req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}




		
		
		// Liste des Matières issues de la table Prof_classe
		public function listeMatiereProfClasse(){
			$sql = "SELECT id_matiere, nom_matiere
					FROM prof_classe, matiere
					WHERE id_matiere = matiere.id
					GROUP BY id_matiere ORDER BY nom_matiere";
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
			$this->_enseignant = $this->setUserId($enseignant);
			$sql = "SELECT id_classe, nom_classe 
					FROM prof_classe, classe
					WHERE id_prof = '$this->_enseignant'
						AND classe.id = id_classe
					GROUP BY id_classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		// Les matières dans lesquelles un enseignant intervient dans une classe
		public function listeMatiereProf($enseignant, $classe){
			$this->_enseignant = $this->setUserId($enseignant);
			$this->_classe = $this->setUserId($classe);
			$sql = "SELECT id_classe, id_matiere, nom_matiere
					FROM prof_classe, matiere
					WHERE id_prof='$this->_enseignant'
						AND id_classe='$this->_classe'
						AND id_matiere=matiere.id
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
		public function addAbsence($source, $info){
			// echo '<pre>'; print_r($info); echo '</pre>';
			$eleve = $info['eleve'];
			$absence = $info['absence'];
			$dateAbsence = $info['dateAbsence'];
			for($i=0;$i<count($absence);$i++){
				if(!empty($absence[$i])){
					$this->_eleve = $eleve[$i];
					$this->_date = $dateAbsence;
					$this->_nbHeure = $absence[$i];
					$requete = $this->_db->prepare("INSERT INTO absence SET 
											id_eleve =:eleve,
											date_absence =:date,
											nombre_heure =:heure");
					$requete->bindValue(':eleve', $this->_eleve);
					$requete->bindValue(':date', $this->_date);
					$requete->bindValue(':heure', $this->_nbHeure);
					$requete->execute();
					$_SESSION['message'] = 'Absences insérées';
				}
			}
			header('Location:'.$source);
		}
		
		
		
		
		public function listeEleveAbsence(){
			$sql = "SELECT DISTINCT nom_complet, absence.id as id, id_eleve 
					FROM absence, eleve 
					WHERE id_eleve = eleve.id
					GROUP BY nom_complet 
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		// Visualiser les absences d'un élève en particulier
		public function viewAbsenceEleve($eleve){
			$this->_eleve = $this->setUserId($eleve);
			$sql = "SELECT id_eleve, date_absence, nombre_heure, justification,
							nom, prenom, classe, nom_classe, absence.id as id,
							DATE_FORMAT(date_absence, '%d / %m / %Y') as date_abs,
							nom_complet
					FROM absence, eleve, classe
					WHERE id_eleve = '$this->_eleve'
						AND eleve.id = id_eleve
						AND classe = classe.id";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		// Visualiser les absences d'un élève sur un trimestre en particulier 
		public function viewAbsenceElevePeriode($eleve, $periode){
			
		}
		
		
		
		
		
		
		
		
		// Visualiser les absences selon qu'elles sont justifiées (ANJ) ou non(AJ)
		public function viewAbsenceJustif($etat){
			$sql = "SELECT absence.id as id, id_eleve, date_absence, nombre_heure, justification,
						nom_complet, classe, nom_classe, 
						DATE_FORMAT(date_absence, '%d / %m / %Y') as date_abs
					FROM absence, eleve, classe 
					WHERE eleve.id = id_eleve
						AND eleve.classe = classe.id
					ORDER BY nom_complet";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
			/*$sql = "SELECT id_eleve, date_absence, nombre_heure, justification,
							nom, prenom, classe, nom_classe, absence.id as id,
							DATE_FORMAT(date_absence, '%d / %m / %Y') as date_abs
					FROM absence, eleve, classe
					WHERE eleve.id = id_eleve
						AND classe = code_classe
						AND justification='$etat'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;*/
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
			$justif = $id['just'];
			for($i=0;$i<count($justif);$i++){
				if(!empty($justif[$i])){
					$ligne = $id['ligne'][$i];
					$justification = $justif[$i];
					// On additionne à la précédente justification existante
					$returnValue = $this->ligneJustifiee($ligne);
					$addition = (int) $returnValue + (int) $justification;
					
					$req = $this->_db->prepare("UPDATE absence SET 
										justification =:just 
										WHERE id=:id");
					$req->bindValue(':just',$addition);
					$req->bindValue(':id',$ligne);
					$req->execute();
					$_SESSION['message'] = 'Absence(s) justifée(s)';
				}
			}
			header('Location:'.$source);
		}
		
		
		private function ligneJustifiee($ligne){
			$sql = "SELECT justification FROM absence WHERE id='$ligne'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['justification'];
		}
		
		
		
		public function arrangerNom(){
			$sql = "SELECT * 
					FROM enseignant
					ORDER BY poste, nom";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			echo '<pre>'; print_r($res); echo '</pre>';
			for($i=0;$i<count($res);$i++){
				$name = strtolower($res[$i]['nom']);
				$fName = strtolower($res[$i]['prenom']);
				$login = strtolower($res[$i]['login']);
				$nomComplet = strtoupper($name).' '.ucwords($fName);
				$password = $this->setPassword($login);
				$id = $res[$i]['id'];
				echo '<p>'.$i.' Nom : <b>'.$nomComplet.'</b> et Login : <b>';
				echo $login.'</b>. Mot de Passe : <b>'.$password.'</b> avec id = '.$id.'</p>';
				$requete = $this->_db->prepare("UPDATE enseignant 
												SET nom_complet_enseignant = :nomComplet,
													login = :login,
													mdp = :password 
												WHERE id = :id");
				$requete->bindValue('nomComplet', $nomComplet);
				$requete->bindValue('login', $login);
				$requete->bindValue('password', $password);
				$requete->bindValue('id', $id);
				$requete->execute();
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//  
		/**
		 * On ajoute les notes à la base de donnéees
		 * @param string  $source qui est le HTTP_REFERER
		 * @param array $note qui contient toutes les notes saisies
		 * @return void car c'est une procédure.
		 */
		public function ajouterNote($source, $note){
			// echo '<pre>'; print_r($note); echo '</pre>';
			// echo '<pre>'; print_r($_SESSION); echo '</pre>';
			$classe = $this->setUserId($note['classe']);
			$matiere = $this->setUserId($note['matiere']);
			$enseignant = $_SESSION['user']['id'];
			$sequence = $this->setUserId($note['sequence']);
			$competence = $this->setCompetence($note['competence']);
			$eleve = $note['eleve'];
			$notes = $note['note'];
			for($i=0;$i<count($eleve);$i++){
				$this->_eleve = $this->setUserId($eleve[$i]);
				$this->_note = $this->setNote($notes[$i]);
				// echo "<p>".$this->_eleve." a obtenu ".$this->_note.".</p>";
				$insertion = $this->_db->prepare("INSERT INTO note
													SET 
													id_eleve =:eleve,
													id_matiere =:matiere,
													id_classe =:classe,
													id_periode =:periode,
													note =:note"); 
				$insertion->bindValue(':eleve', $this->_eleve);
				$insertion->bindValue(':matiere', $matiere);
				$insertion->bindValue(':classe', $classe);
				$insertion->bindValue(':periode', $sequence);
				$insertion->bindValue(':note', $this->_note);
				$insertion->execute();
			}
			$this->journalSaisieNote($classe, $matiere, $sequence, $enseignant, $competence);
			$_SESSION['message'] = 'Les notes ont été enregistrées.';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		// On configure l'enregistrement de la compétence 
		public function setCompetence($nom){
			// On convertit d'abord les A 
			$this->nom = $this->replaceA($nom);
			// On convertit ensuite les E 
			$this->nom =$this->replaceE($this->nom);
			// On convertit les I 
			$this->nom =$this->replaceI($this->nom);
			$this->nom =$this->replaceC($this->nom);
			$this->nom = addslashes($this->nom);
			return $this->nom;
		}
		
		
		
		
		
		protected function replaceA($text){
			$txt = str_replace('à','a',$text);
			return $txt;
		}
		
		
		protected function replaceE($text){
			$txt = str_replace('é','e',$text);
			$txt = str_replace('è','e',$txt);
			$txt = str_replace('ê','e',$txt);
			return $txt;
		}
		
		
		protected function replaceI($text){
			$txt = str_replace('î','i',$text);
			$txt = str_replace('ï','i',$txt);
			return $txt;
		}
		
		
		protected function replaceApos($text){
			$txt = str_replace("'","",$text);
			return $txt;
		}



		protected function replaceC($text){
			$txt = str_replace("ç","c",$text);
			return $txt;
		}
		
		
		private function setNote($note){
			$this->_note = str_replace(',', '.', $note);
			if($this->_note <= 0){
				$this->_note = NULL;
			}elseif($this->_note > 20){
				$this->_note = NULL;
			}elseif($this->_note==''){
				$this->_note = NULL;
			}elseif($this->_note>0 and $this->_note<=20){
				$this->_note = (float) $this->_note;
			}
			return $this->_note;
		}
		
		
		
		private function journalSaisieNote($classe, $matiere, $periode, $enseignant, $competence){
			$date = DATE('Y-m-d H:i:s');
			$navig = $this->getNavigateur();
			$navigateur = $navig['navigateur'];
			$os = $navig['os'];
			$ip = $_SERVER['REMOTE_ADDR'];			
			$journal = $this->_db->prepare('INSERT INTO note_saisie 
											SET 
											id_classe=:classe,
											id_enseignant =:enseignant,
											id_matiere=:matiere,
											id_periode=:periode,
											add_by =:enseignant,
											competence =:competence,
											date_saisie=:date,
											navigateur =:navigateur,
											ip=:ip,
											os=:os');
			$journal->bindValue(':classe', $classe);
			$journal->bindValue(':enseignant', $enseignant);
			$journal->bindValue(':matiere', $matiere);
			$journal->bindValue(':periode', $periode);
			$journal->bindValue(':competence', $competence);
			$journal->bindValue(':date', $date);
			$journal->bindValue(':navigateur', $navigateur);
			$journal->bindValue(':ip', $ip);
			$journal->bindValue(':os', $os);
			$journal->execute();
		}
		
		
		
		
		
		
		
		
		/**
		 * Les Classes dans lesquelles un enseignant intervient et a déjà saisi ses notes.
		 * @param int $enseignant qui est le seul paramètre 
		 * @return array $res qui renvoit la liste des classes
		 */
		public function listClassSaisieProf($enseignant){
			$this->_enseignant = $this->setUserId($enseignant);
			$sql = "SELECT id_classe, id_enseignant, nom_classe, nom
					FROM note_saisie, classe, enseignant
					WHERE id_enseignant = '$this->_enseignant'
						AND classe.id = id_classe
						AND enseignant.id = id_enseignant
					GROUP BY id_classe
					ORDER BY section, niveau_classe, nom_classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		/**
		 * Les matières que l'enseignant tient dans une classe et pour lesquelles il a déjà saisi les notes
		 * @param int $enseignant
		 * @param int $classe
		 * @return array $matiere
		 */
		public function getMatiereSaisieProf($enseignant, $classe){
			$this->_enseignant = $this->setUserId($enseignant);
			$this->_classe = $this->setUserId($classe);
			$sql = "SELECT id_matiere, nom_matiere
					FROM note_saisie, matiere
					WHERE id_enseignant = '$this->_enseignant'
						AND id_classe = $this->_classe
						AND id_matiere = matiere.id";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		/**
		 * On liste les notes saisies dans une classe pour une matière au cours d'une séquence
		 * @param int $classe 
		 * @param int $matiere
		 * @param int $sequence
		 * @return array $note
		 */
		public function listeNote($classe, $matiere, $sequence){
			$this->_classe = $this->setUserId($classe);
			$this->_matiere = $this->setUserId($matiere);
			$this->_sequence = $this->setUserId($sequence);
			$sql = "SELECT id_eleve, id_matiere, id_classe, id_periode, note, observation
					FROM note 
					WHERE id_classe = '$this->_classe'
						AND id_matiere = '$this->_matiere'
						AND id_periode = '$this->_sequence'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		/**
		 * On liste les notes saisies dans une classe pour une matière au cours d'une séquence
		 * @param int $classe 
		 * @param int $sequence
		 * @return array $note
		 */
		public function listeNoteSequence($classe, $sequence){
			$this->_classe = $this->setUserId($classe);
			$this->_matiere = $this->setUserId($matiere);
			$this->_sequence = $this->setUserId($sequence);
			$sql = "SELECT id_eleve, id_matiere, id_classe, id_periode, note, observation
					FROM note 
					WHERE id_classe = '$this->_classe'
						AND id_periode = '$this->_sequence'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		/**
		 * On modifie les notes saisies dans une classe pour une séquence précise
		 * @param string $source qui est la page de provenance de la requête 
		 * @param array $note qui contient : la classe, la matière, la séquence et les notes modifiées
		 * @return void car c'est nue procédure 
		*/ 
		public function modifierNote($source, $note){
			echo '<pre>'; print_r($note); echo '</pre>';
			$this->_classe = $this->setUserId($note['classe']);
			$this->_matiere = $this->setUserId($note['matiere']);
			$this->_sequence = $this->setUserId($note['sequence']);
			$this->_competence = $this->setCompetence($note['competence']);
			$eleve = $note['eleve'];
			$notes = $note['note'];
			$annuler = $note['annuler'];
			$this->_date = DATE('Y-m-d H:i:s');
			for($i=0;$i<count($eleve);$i++){
				$this->_eleve = $this->setUserId($eleve[$i]);
				// La Colonne des notes modifées ou à modifier
				/*********
				 * Comportement Atendu : Pour éviter les aléats du genre un élève a été ajouté après
				 * la saisie des notes, on fera simplement un delete from et ensuite un insert into
				 * afin de gérer la situation.
				 * **** */ 
				if(!empty($notes[$i])){
					$countValue[] = $notes[$i];
					$this->_note = $this->setNote($notes[$i]);
					echo "<p> L'élève ".$this->_eleve." obtient ".$this->_note.".</p>";
					$delete = $this->_db->prepare("DELETE FROM note WHERE 
													id_eleve = :eleve
													AND id_matiere = :matiere
													AND id_classe = :classe
													AND id_periode =:periode");
					$delete->bindValue(':eleve',$this->_eleve);
					$delete->bindValue(':matiere',$this->_matiere);
					$delete->bindValue(':classe',$this->_classe);
					$delete->bindValue(':periode',$this->_sequence);
					$delete->execute();


					$insert = $this->_db->prepare("INSERT INTO note 
													SET note =:note,
													id_eleve =:eleve,
													id_matiere =:matiere,
													id_classe =:classe,
													id_periode =:sequence");
					$insert->bindValue(':note',$this->_note);
					$insert->bindValue(':eleve',$this->_eleve);
					$insert->bindValue(':matiere',$this->_matiere);
					$insert->bindValue(':classe',$this->_classe);
					$insert->bindValue(':sequence',$this->_sequence);
					$insert->execute();
					$this->journalUpdateNote($this->_classe, $this->_matiere, $this->_sequence,$this->_competence);
				}
			}

			if(!empty($annuler)){
				for($k=0;$k<count($annuler);$k++){
					$this->_student = $this->setUserId($annuler[$k]);
					$myNote = $this->setNote(-1); // On veut annuler ;-)
					$reset = $this->_db->prepare("UPDATE note SET 
													note =:note
													WHERE id_eleve =:eleve
													AND id_matiere =:matiere
													AND id_classe =:classe
													AND id_periode=:sequence");
					$reset->bindValue(':note',$myNote);
					$reset->bindValue(':eleve',$this->_student);
					$reset->bindValue(':matiere',$this->_matiere);
					$reset->bindValue(':classe',$this->_classe);
					$reset->bindValue(':sequence',$this->_sequence);
					$reset->execute();
				}
			}else{}

			if(isset($countValue)){
				if(count($countValue)==1){
					$phrase = count($countValue)." note a été modifiée ";
				}else{
					$phrase = count($countValue)." notes ont été modifiées ";
				}
				
			}else{
					$phrase = " aucune note modifiée ";
			}
			if(isset($k)){
				$phrase .= " et ".$k." note(s) annulée(s)";
			}else{
				$phrase .= " et pas de notes annulée.";
			}

			$_SESSION['message'] = $phrase;
			header('Location:'.$source);
		}
		
		
		
		private function journalUpdateNote($classe, $matiere, $sequence, $competence){
			$date = DATE('Y-m-d H:i:s');
			$upd = $this->_db->prepare("UPDATE note_saisie
										SET date_modification=:modif,
											competence =:compet
										WHERE id_classe=:classe
											AND id_matiere=:matiere
											ANd id_periode=:sequence");
			$upd->execute(array('modif'=>$date,
								'classe'=>$classe,
								'matiere'=>$matiere,
								'sequence'=>$sequence,
								'compet'=>$competence));
		}
		
		
		/*On supprime les notes séquentielles*/
		public function supprimerNote($source, $data) {
			$this->_classe = $this->setUserId($data['classe']);
			$this->_matiere = $this->setUserId($data['matiere']);
			$this->_sequence = $this->setUserId($data['sequence']);
			
			$deleteData = $this->_db->prepare("DELETE FROM note 
												WHERE 
												id_classe =:classe AND
												id_matiere =:matiere AND
												id_periode =:sequence");
			$deleteJournal = $this->_db->prepare("DELETE FROM note_saisie 
												WHERE 
												id_classe =:classe AND 
												id_matiere =:matiere AND 
												id_periode =:sequence");
			$deleteData->bindValue(':classe',$this->_classe);
			$deleteData->bindValue(':matiere',$this->_matiere);
			$deleteData->bindValue(':sequence',$this->_sequence);
			
			$deleteJournal->bindValue(':classe',$this->_classe);
			$deleteJournal->bindValue(':matiere',$this->_matiere);
			$deleteJournal->bindValue(':sequence',$this->_sequence);
			$deleteData->execute();
			$deleteJournal->execute();
			$_SESSION['message'] = "notes Supprimées";
			header('Location:'.$source);
		}
		
		
		
		public function listeSequenceClasse($classe){
			$sql = "SELECT id_periode  
					FROM note
					WHERE id_classe = '$classe'
					GROUP BY id_periode";
			$req = $this->_db->query($sql);
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
			return $resultat;
		}
		
		
		// Affiche l'appreciation d'une note
		public function showAppreciation($note){
			// On doit gérer les cas des élèves non classés
			if($note==0){
				$res['nom_appreciation_fr'] = 'Non Classé';
				$res['nom_appreciation_en'] = 'Not Evaluated';
				$res['couleur'] = 'Black';
				$res['cote'] = '-';
			}
			else{
				$sql = "SELECT nom_appreciation_fr, nom_appreciation_en, cote
						FROM appreciation
						WHERE interv_ouvert <= ".$note." 
							AND interv_fermet>".$note;
				$req = $this->_db->query($sql);
				$res = $req->fetch(PDO::FETCH_ASSOC);
			}
			return $res;
		}
		
		
		
		
		
		
		
		
		// On vérifie toutes les classes qui ont reçu des notes dans une séquence
		public function verifNoteSaisieClasse(){
			$sql = "SELECT id_classe, nom_classe
					FROM note_saisie, classe
					WHERE classe.id = id_classe
					GROUP BY id_classe 
					ORDER BY section, niveau_classe, nom_classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		// On verifie les séquences saisies pour une classe donnée 
		public function verifNoteSaisieSequenceReel($classe){
			$sql = "SELECT DISTINCT id_periode							
					FROM  note_saisie
					WHERE id_classe='$classe'
					ORDER BY id_periode
					";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}



		// Le nombre  et les noms de groupes définis pour une classe
		public function getGroupeClasse($classe){
			$sql = "SELECT DISTINCT groupe, nom_groupe, code_groupe
					FROM prof_classe, groupe 
					WHERE id_classe='$classe'
						AND groupe = groupe.id
					ORDER BY nom_groupe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}


		private function prepaTableSequence($periode, $classe, $table){
			// echo '<pre>'; print_r($infoClasse); echo '</pre>';
			$sql_prepa = "CREATE TABLE $table (";
			$sql_prepa .= "id int(11) auto_increment primary key, ";
			$sql_prepa .= "id_eleve int(11) not null, ";
			$sql_prepa .= "rne TEXT  null, ";
			$sql_prepa .= "nom_eleve TEXT not null, ";
			$sql_prepa .= "sexe TEXT null, ";
			$sql_prepa .= "date_en date null, ";
			$sql_prepa .= "date_fr TEXT null, ";
			$sql_prepa .= "lieu_naissance TEXT null, ";
			$sql_prepa .= "adresse_parent TEXT null, ";
			$sql_prepa .= "statut TEXT null, ";
			$sql_prepa .= "photo TEXT null, ";
			$listeMatiere = $this->listeMatiereClasse($classe);
			
			for($a=0;$a<count($listeMatiere);$a++){
				$matiere = strtolower($listeMatiere[$a]['code_matiere']);
				$req_creation_0 = "`".$matiere."_competence` TEXT NULL, ";
				$req_creation_1 = "`".$matiere."_seq` decimal(4,2) DEFAULT NULL, ";
				$req_creation_2 = "`".$matiere."_coef` decimal(4,2) NULL, ";
				$req_creation_3 = "`".$matiere."_total` decimal(5,2) NULL, ";
				$req_creation_4 = "`".$matiere."_min` decimal(4,2) NULL, ";
				$req_creation_5 = "`".$matiere."_max` decimal(4,2) NULL, ";
				$req_creation_6 = "`".$matiere."_appreciation` TEXT  null, ";
				$req_creation_7 = "`".$matiere."_cote` TEXT  null, ";
				$req_creation_8 = "`".$matiere."_enseignant` TEXT  null, ";
				$req_creation_9 = "`".$matiere."_rank` int(11) null, ";
				$sql_prepa .= $req_creation_0;
				$sql_prepa .= $req_creation_1;
				$sql_prepa .= $req_creation_2;
				$sql_prepa .= $req_creation_3;
				$sql_prepa .= $req_creation_4;
				$sql_prepa .= $req_creation_5;
				$sql_prepa .= $req_creation_6;
				$sql_prepa .= $req_creation_7;
				$sql_prepa .= $req_creation_8;
				$sql_prepa .= $req_creation_9;
			}
			$groupe = $this->getGroupeClasse($classe);
			// echo '<pre>'; print_r($groupe); echo '</pre>';
			for($b=0;$b<count($groupe);$b++){
				$gp = $groupe[$b]['code_groupe'];
				$sql_prepa .= $gp."_total float(5,2) NULL, ";
				$sql_prepa .= $gp."_coef float(4,2) NULL, ";
				$sql_prepa .= $gp."_moyenne float(4,2) NULL, ";
				$sql_prepa .= $gp."_min float(4,2) NULL, ";
				$sql_prepa .= $gp."_max float(4,2) NULL, ";
				$sql_prepa .= $gp."_appreciation TEXT NULL, ";
				$sql_prepa .= $gp."_cote TEXT NULL, ";
				$sql_prepa .= $gp."_rank int(11) NULL, ";
			}
			$sql_prepa .= "total_point float(5,2) NULL, ";
			$sql_prepa .= "total_coef float(4,2) NULL, ";
			$sql_prepa .= "moyenne float(4,2) NULL, ";
			$sql_prepa .= "min float(4,2) NULL, ";
			$sql_prepa .= "max float(4,2) NULL, ";
			$sql_prepa .= "appreciation TEXT NULL, ";
			$sql_prepa .= "cote TEXT NULL, ";
			$sql_prepa .= "classes int(11), ";
			$sql_prepa .= "rang TEXT null, ";
			$sql_prepa .= "absence_total int(11) null, ";
			$sql_prepa .= "absence_non_just int(11) null, ";
			$sql_prepa .= "absence_just int(11) null ";
			$sql_prepa .= ")";
			$sql_del = "DROP TABLE IF EXISTS $table";
			$this->_db->query($sql_del); 
			$this->_db->query($sql_prepa);
		}




		private function addEleveTable($classe, $table){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			// echo '<pre>'; print_r($listeEleve); echo '</pre>';
			for($c=0;$c<count($listeEleve);$c++){
				$idEleve = $listeEleve[$c]['id'];
				$nomEleve = addslashes($listeEleve[$c]['nom_complet']);
				$sexeEleve = $listeEleve[$c]['sexe'];
				$dateNaissance = $listeEleve[$c]['date_naissance'];
				$date_fr = $listeEleve[$c]['date_fr'];
				$lieuNaissance = strtoupper($listeEleve[$c]['lieu_naissance']);
				$matriculeEleve = $listeEleve[$c]['matricule'];
				$rneEleve = $listeEleve[$c]['rne'];
				$adresseParent = $listeEleve[$c]['adresse_parent'];
				$statut = $listeEleve[$c]['statut'];
				if(empty($listeEleve[$c]['photo'])){
					$photo = 'images/eleve/no_name.png';
				}else{
					$photo = $listeEleve[$c]['photo'];
				}
				$insertion = $this->_db->prepare("INSERT INTO $table SET 
											id_eleve =:idEleve,
											rne =:rne,
											nom_eleve =:nom,
											sexe =:sexe,
											date_en =:dateEn,
											date_fr =:dateFr,
											lieu_naissance =:lieu,
											adresse_parent =:adresse,
											statut =:statut,
											photo =:photo");
				$insertion->bindValue(':idEleve', $idEleve);
				$insertion->bindValue(':rne', $rneEleve);
				$insertion->bindValue(':nom', $nomEleve);
				$insertion->bindValue(':sexe', $sexeEleve);
				$insertion->bindValue(':dateEn', $dateNaissance);
				$insertion->bindValue(':dateFr', $date_fr);
				$insertion->bindValue(':lieu', $lieuNaissance);
				$insertion->bindValue(':adresse', $adresseParent);
				$insertion->bindValue(':statut', $statut);
				$insertion->bindValue(':photo', $photo);
				$insertion->execute();
			}
		}







		// On visualise les notes séquentielles 
		private function viewNoteSequentielleEleve($classe, $periode, $eleve){
			$sql = "SELECT note.id_eleve as id_eleve, note.id_matiere as id_matiere, 
						note.id_classe as id_classe, note.id_periode as id_periode, 
						note.note as note, note.observation as observation, code_matiere, nom_matiere,
						nom_complet, nom_classe
					FROM note, matiere, eleve, classe
					WHERE note.id_eleve = '$eleve'
						AND note.id_classe = '$classe'
						AND note.id_periode = '$periode'
						AND note.id_matiere = matiere.id
						AND note.id_eleve = eleve.id
						AND note.id_classe = classe.id
					ORDER BY code_matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}





		private function getCompetence($classe, $matiere, $periode){
			$sql = "SELECT *
					FROM note_saisie
					WHERE id_classe='$classe'
						AND id_matiere = '$matiere'
						AND id_periode = '$periode'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
		}



		// On récupère le Coef d'une matière. Ceci est utile pour calculer les notes
		private function getCoefMatiere($matiere, $classe){
			$sql = "SELECT coef
					FROM prof_classe 
					WHERE id_classe='$classe' AND id_matiere = '$matiere' 
					";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['coef'];
		}


		// On récupère le prof d'une matière. Ceci est utile pour calculer les notes
		private function getEnseignantMatiere($matiere, $classe){
			$sql = "SELECT id_prof, nom_complet_enseignant
					FROM prof_classe, enseignant 
					WHERE id_classe='$classe' 
						AND id_matiere = '$matiere'
						AND id_prof = enseignant.id 
					";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['nom_complet_enseignant'];
		}




		private function getMinMatiere($champ, $table){
			$sql = "SELECT MIN($champ) as minimum
					FROM $table
					WHERE $champ >0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['minimum'];
		}



		private function getMaxMatiere($champ, $table){
			$sql = "SELECT MAX($champ) as maximum
					FROM $table
					WHERE $champ >0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['maximum'];
		}



		private function getRankMatiere($codeMatiere, $table){
			$champCible = strtolower($codeMatiere.'_rank');
			$champMatiere = strtolower($codeMatiere.'_seq');
			$sql = "SELECT $champMatiere, id_eleve
					FROM $table
					WHERE $champMatiere >0
					ORDER BY $champMatiere DESC";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			$a = 1;
			for($i=0;$i<count($res);$i++){
				$eleve = $res[$i]['id_eleve'];
				$rank = $a;
				$sql = "UPDATE $table SET $champCible = '$rank'
						WHERE id_eleve = '$eleve'";
				$req = $this->_db->query($sql);
				$a++;
			}
		}



		private function getRank($table){
			$sql = "SELECT moyenne, id_eleve
					FROM $table
					WHERE moyenne >0
					ORDER BY moyenne DESC";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			$a = 1;
			for($i=0;$i<count($res);$i++){
				$eleve = $res[$i]['id_eleve'];
				$rank = $a;
				$sql = "UPDATE $table SET rang = '$rank'
						WHERE id_eleve = '$eleve'";
				$req = $this->_db->query($sql);
				$a++;
			}
		}




		private function addDataSequence($classe, $periode, $table){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$section = $this->getSectionClasse($classe);
			for($c=0;$c<count($listeEleve);$c++){
				$idEleve = $listeEleve[$c]['id'];
				$noteEleve = $this->viewNoteSequentielleEleve($classe, $periode, $idEleve);
				for($i=0;$i<count($noteEleve);$i++){
					$champCompetence = $noteEleve[$i]['code_matiere'].'_competence';
					$champSequence = $noteEleve[$i]['code_matiere'].'_seq';
					$champCoef = $noteEleve[$i]['code_matiere'].'_coef';
					$champTotal = $noteEleve[$i]['code_matiere'].'_total';
					$champAppreciation = $noteEleve[$i]['code_matiere'].'_appreciation';
					$champCote = $noteEleve[$i]['code_matiere'].'_cote';
					$champEnseignant = $noteEleve[$i]['code_matiere'].'_enseignant';
					$noteObtenue = $this->setNote($noteEleve[$i]['note']);
					// echo var_dump($noteObtenue).'<br />';
					$idEleve = $noteEleve[$i]['id_eleve'];
					$idMatiere = $noteEleve[$i]['id_matiere'];
					$codeMatiere = strtolower($noteEleve[$i]['code_matiere']);
					$competence = $this->getCompetence($classe, $idMatiere, $periode);
					if($noteObtenue==NULL){
						$coef = NULL;
						$total = NULL;
						}else{
							$coef = $this->getCoefMatiere($idMatiere, $classe);
							$total = $noteObtenue * $coef;
						}
					$enseignant = $this->getEnseignantMatiere($idMatiere, $classe);
					$appr = $this->showAppreciation($noteObtenue);
					$libelleAppreciation = 'nom_appreciation_'.$section;
					$appreciation = $appr[$libelleAppreciation];
					$cote = $appr['cote'];
					$requete = $this->_db->prepare("UPDATE $table SET
											$champSequence = :note,
											$champCompetence = :competence,
											$champCoef = :coef,
											$champTotal =:total,
											$champAppreciation =:appreciation,
											$champCote =:cote,
											$champEnseignant = :enseignant
											WHERE id_eleve = :eleve");
					$requete->bindValue(':note', $noteObtenue);
					$requete->bindValue(':competence', $competence['competence']);
					$requete->bindValue(':enseignant', $enseignant);
					$requete->bindValue(':coef', $coef);
					$requete->bindValue(':total', $total);
					$requete->bindValue(':cote', $cote);
					$requete->bindValue(':appreciation', $appreciation);
					$requete->bindValue(':eleve', $idEleve);
					$requete->execute();
				}
			}
		}





		private function addRankMinMaxSequence($classe, $table){
			$listeMatiere = $this->listeMatiereClasse($classe);
			// echo '<pre>'; print_r($listeMatiere); echo '</pre>';
			for($i=0;$i<count($listeMatiere);$i++){
				$idMatiere = $listeMatiere[$i]['id'];
				$codeMatiere = $listeMatiere[$i]['code_matiere'];
				$champCible = strtolower($codeMatiere.'_seq');
				$champMin = strtolower($codeMatiere.'_min');
				$champMax = strtolower($codeMatiere.'_max');
				$champRank =  strtolower($codeMatiere.'_rank');
				$min = $this->getMinMatiere($champCible,$table);
				$max = $this->getMaxMatiere($champCible, $table);
				$rank  = $this->getRankMatiere($codeMatiere, $table);
				print_r($rank);
				$requete  = $this->_db->prepare("UPDATE $table SET 
							$champMin =:min,
							$champMax = :max
							");
				$requete->bindValue(':min', $min);
				$requete->bindValue(':max', $max);
				$requete->execute();
			}
		}
		
		
		
		
		/*************
		On a validé le bouton TRAITER LES NOTES SEQUENTIELLES
		******************************************************/
		public function traiterNoteSequence($source,$info){
			// echo '<pre>'; print_r($info); echo '</pre>';
			$this->_periode = $this->setUserId($info['sekence']);
			$this->_classe = $this->setUserId($info['classe']);
			$infoClasse = $this->getClasse($this->_classe);
			$table = 'sequence_'.$this->_periode.'_'.$this->_classe;
			// On crée la table et on y ajoute les noms des élèves 
			$this->prepaTableSequence($this->_periode, $this->_classe,$table);
			// On insère les élèves dans la table créée 
			$this->addEleveTable($this->_classe, $table);
			// On intègre les notes séquentielles de l'élève
			$this->addDataSequence($this->_classe, $this->_periode, $table);
			// On génère les minimum, maximum et rang pour chaque matière présente
			$this->addRankMinMaxSequence($this->_classe, $table);
			// On introduit les heures d'absence 
			// On enregistre le traitement 
			$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
			$req_traite .= "VALUES('oui', '$this->_classe', '$this->_periode')";
			$req_traite_del = "DELETE FROM bull_seq";
			$req_traite_del .= " WHERE classe='$this->_classe' 
									AND sequence='$this->_periode'";
			$exec_traite_del = $this->_db->query($req_traite_del);
			$exec_traite = $this->_db->query($req_traite);
			// Quand tout se termine, on affiche le message
			$_SESSION['message'] = 'Notes de la Séquence '.$this->_periode;
			$_SESSION['message'] .= ' traitées pour la '.$infoClasse['nom_classe'];
			header('Location:'.$source);
			
			
			
			// Après avoir crée la table, on insère les noms des élèves dans la table créée.
			// 
			// for($c=0;$c<count($listeEleve);$c++){
				
				// En fonction de la séquence on fait les calculs et on applique un coefficient ainsi que les 
				// moyennes par matières et appréciation qui s'imposent
				/*if($periode==1){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	1, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 1 
					
					
					
					// On produit les Notes sequentielles par matière 
					
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}*/
				/*elseif($periode==2){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	2, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 2 
					for($d=0;$d<count($sequence_1);$d++){
						$compet = $sequence_1[$d]['competence'];
						$mat = $sequence_1[$d]['id_matiere'];
						$note = $sequence_1[$d]['note_simple'];
						$prof = $sequence_1[$d]['sexe_enseignant']." ";
						$prof .= strtoupper($sequence_1[$d]['nom_enseignant'])." ";
						$prof .= ucwords($sequence_1[$d]['prenom_enseignant']);
						
						$sql_upd = "UPDATE $table SET ";
						$sql_upd .= $mat."_seq1 = '$note',";
						$sql_upd .= $mat."_enseignant = '$prof',";
						$sql_upd .= $mat."_competence = '$compet'";
						$sql_upd .= " WHERE id_eleve = '$idEleve'; ";
						// echo $sql_upd.'<br/>';
						$req_4 = $this->_db->query($sql_upd);
					}
					
					
					// On produit les Notes Sequentielles par matière 
					$this->calculNoteSequence(2, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);
					
					// On Introduit les heures d'Absence qu'il faut  
					$absences = $this->calculAbsenceTrimestre($idEleve,1);
					// $sql_10 = "UPDATE $table SET 
					// 			absence_total = '".$absences['total']."',
					// 			absence_non_just = '".$absences['non_justif']."',
					// 			absence_just = '".$absences['justif']."'
					// 			WHERE id_eleve = '$idEleve'";
					// $this->_db->query($sql_10);
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}*/
				/*elseif($periode==3){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	3, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 3 
					for($d=0;$d<count($sequence_1);$d++){
						$compet = $sequence_1[$d]['competence'];
						$mat = $sequence_1[$d]['id_matiere'];
						$note = $sequence_1[$d]['note_simple'];
						$prof = $sequence_1[$d]['sexe_enseignant']." ";
						$prof .= strtoupper($sequence_1[$d]['nom_enseignant'])." ";
						$prof .= ucwords($sequence_1[$d]['prenom_enseignant']);
						
						$sql_upd = "UPDATE $table SET ";
						$sql_upd .= $mat."_seq1 = '$note',";
						$sql_upd .= $mat."_enseignant = '$prof',";
						$sql_upd .= $mat."_competence = '$compet'";
						$sql_upd .= " WHERE id_eleve = '$idEleve'; ";
						// echo $sql_upd.'<br/>';
						$req_4 = $this->_db->query($sql_upd);
					}
					
					
					// On produit les Notes Trimestrielles par matière 
					$this->calculNoteSequence(3, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);
					
					// On Introduit les heures d'Absence qu'il faut  
					$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}*/
				// elseif($periode==4){
					/*$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	4, 
																	$idEleve);*/
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 4 
					/*for($d=0;$d<count($sequence_1);$d++){
						$compet = $sequence_1[$d]['competence'];
						$mat = $sequence_1[$d]['id_matiere'];
						$note = $sequence_1[$d]['note_simple'];
						$prof = $sequence_1[$d]['sexe_enseignant']." ";
						$prof .= strtoupper($sequence_1[$d]['nom_enseignant'])." ";
						$prof .= ucwords($sequence_1[$d]['prenom_enseignant']);
						
						$sql_upd = "UPDATE $table SET ";
						$sql_upd .= $mat."_seq1 = '$note',";
						$sql_upd .= $mat."_enseignant = '$prof',";
						$sql_upd .= $mat."_competence = '$compet'";
						$sql_upd .= " WHERE id_eleve = '$idEleve'; ";
						// echo $sql_upd.'<br/>';
						$req_4 = $this->_db->query($sql_upd);
					}*/
					
					
					// On produit les Notes Trimestrielles par matière 
					/*$this->calculNoteSequence(4, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);*/
					
					// On Introduit les heures d'Absence qu'il faut  
					// $absences = $this->calculAbsenceTrimestre($idEleve,1);
					// $sql_10 = "UPDATE $table SET 
					// 			absence_total = '".$absences['total']."',
					// 			absence_non_just = '".$absences['non_justif']."',
					// 			absence_just = '".$absences['justif']."'
					// 			WHERE id_eleve = '$idEleve'";
					// $this->_db->query($sql_10);
					// print_r($absences);
					
					/*$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);*/
				// }
				// elseif($periode==5){
					/*$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	5, 
																	$idEleve);*/
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 5 
					/*for($d=0;$d<count($sequence_1);$d++){
						$compet = $sequence_1[$d]['competence'];
						$mat = $sequence_1[$d]['id_matiere'];
						$note = $sequence_1[$d]['note_simple'];
						$prof = $sequence_1[$d]['sexe_enseignant']." ";
						$prof .= strtoupper($sequence_1[$d]['nom_enseignant'])." ";
						$prof .= ucwords($sequence_1[$d]['prenom_enseignant']);
						
						$sql_upd = "UPDATE $table SET ";
						$sql_upd .= $mat."_seq1 = '$note',";
						$sql_upd .= $mat."_enseignant = '$prof',";
						$sql_upd .= $mat."_competence = '$compet'";
						$sql_upd .= " WHERE id_eleve = '$idEleve'; ";
						// echo $sql_upd.'<br/>';
						$req_4 = $this->_db->query($sql_upd);
					}*/
					
					
					// On produit les Notes Trimestrielles par matière 
					/*$this->calculNoteSequence(5, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);*/
					
					// On Introduit les heures d'Absence qu'il faut  
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					/*$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);*/
				// }
				// elseif($periode==6){
					/*$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	6, 
																	$idEleve);*/
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 1 
					
					
					
					// On produit les Notes Trimestrielles par matière 
					/*$this->calculNoteSequence(6, $classe, $idEleve);
					*/
					
					// On Introduit les heures d'Absence qu'il faut  
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					/*$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);*/
				// }
								
			// }
		}

		
		
		
		
		
		
		/*************
		On visualise les notes séquentielles d'une classe
		******************************************************/
		public function viewNoteSequentielle($periode, $classe){
			// On appelle la fonction qui créé notre table
			$this->tableNoteSequence($periode, $classe);
			$nomTable = "view_Sequence_".$periode."_".$classe;
			
			/*Ensuite on extrait les notes de la table note pour insertion
			dans notre table de destination. On procède de manière unitaire
			c'est-à-dire que pour une classe, on procède à l'extraction élève par élève.*/
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			for($i=0;$i<count($listeEleve);$i++){
				$nomEleve = strtoupper($listeEleve[$i]['nom_complet']);
				$sexeEleve = $listeEleve[$i]['sexe'];
				$statutEleve = $listeEleve[$i]['statut'];
				$matriculeEleve = $listeEleve[$i]['matricule'];
				$rneEleve = $listeEleve[$i]['rne'];
				$dateNaissance = $listeEleve[$i]['date_naissance'];
				$idEleve = $listeEleve[$i]['id'];
				$sql = "INSERT INTO $nomTable(nom, sexe, statut, matricule, 
												date_naissance, id_eleve, rne)
						VALUES('$nomEleve','$sexeEleve','$statutEleve',
								'$matriculeEleve','$dateNaissance','$idEleve','$rneEleve')";
				$req = $this->_db->query($sql);
				$variable = $this->viewNoteEleveSequence($idEleve, $periode);
				for($a=0;$a<count($variable);$a++){
					$matiere = strtolower($variable[$a]['code_matiere']);
					$note = $this->setNote($variable[$a]['note']);
					$insert = $this->_db->prepare("UPDATE $nomTable SET 
													`$matiere` =:note
													WHERE id_eleve =:eleve");
					$insert->bindValue(':note', $note);
					$insert->bindValue(':eleve', $idEleve);
					$insert->execute();			
				}
			}
		}
		
		
		

		/*******
		On crée la table qui va permettre de visualiser les notes 
		séquentielles d'une classe au complet.
		***********************************************************/
		private function tableNoteSequence($periode, $classe){
			$listeMatiere = $this->listeMatiereClasse($classe); // On récupère les matières de la classe 
			// echo '<pre>';print_r($listeMatiere);
			$nomTable = "view_Sequence_".$periode."_".$classe;
			// On supprime d'abord la table si elle existe
			$sql_1 = "DROP TABLE IF EXISTS ".$nomTable;
			$req_1 = $this->_db->query($sql_1);
			// Ensuite on la créé à nouveau
			$sql = "CREATE TABLE ".$nomTable."(";
			$sql .= "`id` int(11) AUTO_INCREMENT PRIMARY KEY,";
			$sql .= "`nom` varchar(255) not null,";
			$sql .= "`id_eleve` int(11) not null,";
			$sql .= "`rne` int(11) not null,";
			$sql .= "`sexe` varchar(10),";
			$sql .= "`statut` varchar(10),";
			$sql .= "`date_naissance` date,";
			$sql .= "`matricule` varchar(20),";
			
			// On récupère les noms des matières qu'on insère directement dans les champs 
			for($i=0;$i<count($listeMatiere);$i++){
				$nomMatiere = strtolower($listeMatiere[$i]['code_matiere']);
				$sql .= "`".$nomMatiere."` FLOAT(4,2) null,";
			}
			$sql .= "`vide` varchar(10));";
			$req = $this->_db->query($sql);
			$sql_2 = "ALTER TABLE $nomTable DROP COLUMN vide";
			$req_2 = $this->_db->query($sql_2);
		}
		
		
		
		private function viewNoteEleveSequence($eleve, $periode){
			$sql = "SELECT id_matiere, note, id_eleve,
							nom_complet, id_periode, code_matiere
					FROM note, eleve, matiere 
					WHERE id_eleve = '$eleve' AND id_periode='$periode'
							AND eleve.id=id_eleve
							AND id_matiere = matiere.id
					ORDER BY nom_complet, id_matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		


		public function exportNoteSequence($sequence, $classe){
			$table = "view_sequence_".$sequence."_".$classe;
			$classe = $this->getClasse($classe);
			$sql = "SELECT *
					FROM $table";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			$resultat['eleve'] = $res;
			$resultat['sequence'] = $sequence;
			$resultat['classe'] = $classe['nom_classe'];
			return $resultat;
		}




		public function classesTraiteesSeq(){
			$sql = "SELECT classe, nom_classe 
					FROM bull_seq, classe 
					WHERE classe = classe.id
					GROUP BY nom_classe ORDER BY section, niveau_classe, nom_classe";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}




		public function sequencesTraitees($classe){
			$sql = "SELECT DISTINCT sequence 
					FROM bull_seq
					WHERE classe='$classe'";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}


		// Les matières d'un groupe 
		public function getMatiereGroupe($gp,$classe){
			$sql = "SELECT id_matiere, nom_matiere, id_prof, nom_complet_enseignant, code_matiere
					FROM prof_classe, matiere, enseignant 
					WHERE groupe='$gp'
						AND matiere.id = id_matiere
						AND id_classe = '".$classe."'
						AND enseignant.id = id_prof
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}



		// Le Total des coefficients définis dans une classe
		private function totalCoefClasse($classe){
			$sql = "SELECT SUM(coef) as totalCoef
					FROM prof_classe 
					WHERE id_classe = '$classe'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['totalCoef'];
		}








		private function addTotalGroupe($classe, $table){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$section = $this->getSectionClasse($classe);
			for($i=0;$i<count($listeEleve);$i++){
				$idEleve = $listeEleve[$i]['id'];
				//  On récupère les matières par Groupe
				$groupe = $this->getGroupeClasse($classe);
				// print_r($groupe);
				for($a=0;$a<count($groupe);$a++){
					$codeGroupe = $groupe[$a]['code_groupe'];
					$matieres = $this->getMatiereGroupe($groupe[$a]['groupe'],$classe);
					$champGroupePoint[$a] = $codeGroupe.'_total';
					$champGroupeCoef[$a] = $codeGroupe.'_coef';
					$champGroupeMoyenne[$a] = $codeGroupe.'_moyenne';
					// print_r($matieres);
					for($b=0;$b<count($matieres);$b++){
						$champMatiere = strtolower($matieres[$b]['code_matiere'].'_total');
						$champCoef = strtolower($matieres[$b]['code_matiere'].'_coef');
						// echo $champCoef.'<br />';
						$sqlMatiere = "SELECT $champMatiere FROM $table WHERE id_eleve='$idEleve'";
						$reqMatiere = $this->_db->query($sqlMatiere);
						$resMatiere = $reqMatiere->fetch(PDO::FETCH_ASSOC);
						$points[$codeGroupe][$champMatiere] = $resMatiere[$champMatiere];

						$sqlCoef = "SELECT $champCoef FROM $table WHERE id_eleve='$idEleve'";
						$reqCoef = $this->_db->query($sqlCoef);
						$resCoef = $reqCoef->fetch(PDO::FETCH_ASSOC);
						$coef[$codeGroupe][$champCoef] = $resCoef[$champCoef];
					}
					$sommePoint[$a] = array_sum($points[$codeGroupe]);
					$sommeCoef[$a] = array_sum($coef[$codeGroupe]);
					// print_r($coef[$codeGroupe]);
					// echo '<hr />';
					if(empty($sommeCoef[$a]) or $sommeCoef[$a]==0){
						$moyenneGroupe[$a] = NULL;
					}else{
							$moyenneGroupe[$a] = $sommePoint[$a] / $sommeCoef[$a];
					}
					$sqlUpdate = "UPDATE $table SET 
									$champGroupePoint[$a] = '$sommePoint[$a]',
									$champGroupeCoef[$a] = '$sommeCoef[$a]',
									$champGroupeMoyenne[$a] = '$moyenneGroupe[$a]'
								WHERE id_eleve = '$idEleve'
									";
					$this->_db->query($sqlUpdate);
				}
				$sommeTotalePoint = array_sum($sommePoint);
				$sommeTotaleCoef = array_sum($sommeCoef);
				if(empty($sommeTotaleCoef) or $sommeTotaleCoef==0){
					$moyenneTotale = NULL;
					$appr = NULL;
					$cote = NULL;
				}else{
					$totalCoefClasse = $this->totalCoefClasse($classe);
					$classement = $totalCoefClasse * 50 / 100;
					if($sommeTotaleCoef>=$classement){
						$moyenneTotale = $sommeTotalePoint / $sommeTotaleCoef;
						$appreciation = $this->showAppreciation($moyenneTotale);
						$appr = $appreciation['cote'];
						$codeSection = 'nom_appreciation_'.$section;
						$cote = $appreciation[$codeSection];
					}else{
						$moyenneTotale = NULL;
						$appr = NULL;
						$cote = NULL;
					}
				}
				$updateMoyenne = $this->_db->prepare("UPDATE $table SET 
												total_point =:point,
												total_coef =:coef,
												moyenne =:moyenne,
												cote =:cote,
												appreciation =:appr
												WHERE id_eleve =:eleve");
				$updateMoyenne->bindValue(':point', $sommeTotalePoint);
				$updateMoyenne->bindValue(':coef', $sommeTotaleCoef);
				$updateMoyenne->bindValue(':moyenne', $moyenneTotale);
				$updateMoyenne->bindValue(':cote', $cote);
				$updateMoyenne->bindValue(':appr', $appr);
				$updateMoyenne->bindValue(':eleve', $idEleve);
				$updateMoyenne->execute();
			}
		}


		private function addMoyenneGroupe($classe, $table){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$section = $this->getSectionClasse($classe);
			for($i=0;$i<count($listeEleve);$i++){
				$idEleve = $listeEleve[$i]['id'];
				//  On récupère les matières par Groupe
				$groupe = $this->getGroupeClasse($classe);
				// print_r($groupe);
				for($a=0;$a<count($groupe);$a++){
					$codeGroupe = $groupe[$a]['code_groupe'];
					$champMoyenne = $codeGroupe.'_moyenne';
					$champCote = $codeGroupe.'_cote';
					$champAppr = $codeGroupe.'_appreciation';
					$sql = "SELECT $champMoyenne
							FROM $table 
							WHERE id_eleve = '$idEleve'";
					$req = $this->_db->query($sql);
					$resultat = $req->fetch(PDO::FETCH_ASSOC);
					$moyenneGroupe = $resultat[$champMoyenne];
					$appreciation = $this->showAppreciation($moyenneGroupe);
					
					$cleAppr = 'nom_appreciation_'.$section;
					$coteGroupe = $appreciation['cote'];
					$apprGroupe = $appreciation[$cleAppr];
					
					$update = $this->_db->prepare("UPDATE $table SET 
													$champCote =:cote,
													$champAppr =:appr
													WHERE id_eleve =:eleve");
					$update->bindValue(':cote',$coteGroupe);
					$update->bindValue(':appr',$apprGroupe);
					$update->bindValue(':eleve',$idEleve);
					$update->execute();
				}

				for($b=0;$b<count($groupe);$b++){
					$codeGroupe = $groupe[$b]['code_groupe'];
					$champMoyenneGroupe = $codeGroupe.'_moyenne';
					$champMin = $codeGroupe.'_min';
					$champMax = $codeGroupe.'_max';
					$min = $this->getMinMatiere($champMoyenneGroupe,$table);
					$max = $this->getMaxMatiere($champMoyenneGroupe, $table);
					$update = $this->_db->prepare("UPDATE $table SET 
							$champMin =:min,
							$champMax =:max");
					$update->bindValue(':min',$min);
					$update->bindValue(':max', $max);
					$update->execute();
				}
			}
		}








		/*************
		On a validé le bouton TRAITER LES MOYENNES SEQUENTIELLES
		******************************************************/
		public function traiterMoyenneSequence($source, $periode, $classe){
			$this->_sequence = $this->setUserId($periode);
			$this->_classe = $this->setUserId($classe);
			$table = 'sequence_'.$this->_sequence.'_'.$this->_classe;
			$section = $this->getSectionClasse($classe);
			$infoClasse = $this->getClasse($this->_classe);
			// On introduit les totaux par groupe ainsi que les moyennes 
			$this->addTotalGroupe($this->_classe, $table);
			// On gère les appréciations et cotes par groupe 
			$this->addMoyenneGroupe($this->_classe, $table);
			// On gère le classement des élèves
			$min = $this->getMinMatiere('moyenne', $table);
			$max = $this->getMaxMatiere('moyenne', $table);
			$count = "SELECT count(moyenne) as moyenne 
					FROM $table 
					WHERE moyenne > '0'";
			$requete = $this->_db->query($count);
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			$this->getRank($table);
			$update = $this->_db->prepare("UPDATE $table SET 
							min =:min,
							max =:max,
							classes = :classes
							");
			$update->bindValue(':min',$min);
			$update->bindValue(':max', $max);
			$update->bindValue(':classes', $resultat['moyenne']);
			$update->execute();
			$_SESSION['message'] = 'Moyennes de la classe de '.$infoClasse['nom_classe'];
			$_SESSION['message'] .= ' traitées pour la Séquence '.$this->_sequence;
			$_SESSION['message'] .= '. Vous pouvez imprimer les bulletins de la classe.';

			header('Location: '.$source);
		}




		// Quelles informations y'a t-il dans la table moy_sequence_periode_cls ?
		public function moySequenceClasse($periode, $classe){
			$table = 'sequence_'.$periode.'_'.$classe;
			$sql = "SELECT * FROM `$table`";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}



		// Quelles informations y'a t-il dans la table moy_sequence_periode_cls ?
		// Par Odre de Mérite
		public function moySequenceClasseMerite($periode, $classe){
			$table = 'sequence_'.$periode.'_'.$classe;
			$sql = "SELECT * FROM $table ORDER BY moyenne DESC";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}



		// Quelles informations y'a t-il dans la table sequence_periode_cls ?
		public function sequenceClasse($periode, $classe){
			$table = 'sequence_'.$periode.'_'.$classe;
			$sql = "SELECT * FROM $table";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat[] = $res;
			}
			return $resultat;
		}



		public function statSequence($periode, $classe){
			$table = 'sequence_'.$periode.'_'.$classe;
			
			/*/Pour les statistiques de la séquence, on va d'abord ressortir
			les effectifs genrés. */
			$liste = $this->listeEleve($classe, 'non_supprime');
			for($i=0;$i<count($liste);$i++){
				$sexe[$i] = $liste[$i]['sexe'];
			}
			$genre = array_count_values($sexe);
			if(!$genre['F']){$effFille = 0;} else{$effFille = $genre['F'];}
			if(!$genre['M']){$effMasc = 0;} else{$effMasc = $genre['M'];}
			$effTotal = $effMasc + $effFille;
			
			/*Maintenant, on ressort les effectifs des élèves réellement
			classés, c'est à dire qui ont au moins une moyenne supérieure
			à zéro. */
			$sql1 = "SELECT count(moyenne) as evalMasc 
					FROM $table 
					WHERE moyenne >'0.00' AND sexe = 'M'";
			/*$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){*/
			$req1 = $this->_db->query($sql1);
			$res1 = $req1->fetch(PDO::FETCH_ASSOC);
			
			$sql2 = "SELECT count(moyenne) as evalFille 
					FROM $table 
					WHERE moyenne >'0.00' AND sexe = 'F'";
			
			$req2 = $this->_db->query($sql2);
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
			
			$evalTotal = $res1['evalMasc'] + $res2['evalFille'];
			
			/*Maintenant, on ressort les effectifs des élèves 
			qui ont au moins une moyenne supérieure à 10.
			 */
			$sql3 = "SELECT count(moyenne) as moyMasc 
					FROM $table 
					WHERE moyenne >='10.00' AND sexe = 'M'";
			$req3 = $this->_db->query($sql3);
			$res3 = $req3->fetch(PDO::FETCH_ASSOC);
			
			$sql4 = "SELECT count(moyenne) as moyFille 
					FROM $table 
					WHERE moyenne >='10.00' AND sexe = 'F'";
			$req4 = $this->_db->query($sql4);
			$res4 = $req4->fetch(PDO::FETCH_ASSOC);
			
			/*Maintenant, on ressort les effectifs des élèves 
			qui ont la sous moyenne.
			 */
			$sql5 = "SELECT count(moyenne) as sousMoyMasc 
					FROM $table 
					WHERE moyenne <10 AND moyenne >'0.00' AND sexe = 'M'";
			$req5 = $this->_db->query($sql5);
			$res5 =$req5->fetch(PDO::FETCH_ASSOC);
			
			$sql6 = "SELECT count(moyenne) as sousMoyFille 
					FROM $table 
					WHERE moyenne <10 AND moyenne > '0.00' AND sexe = 'F'";
			$req6 = $this->_db->query($sql6);
			$res6 =$req6->fetch(PDO::FETCH_ASSOC);
			
			
			
			$moyTotal = $res3['moyMasc'] + $res4['moyFille'];
			$sousMoyTotal = $res5['sousMoyMasc'] + $res6['sousMoyFille'];
			
			if($res1['evalMasc']!=0){
				$tauxMasc = $res3['moyMasc']*100/$res1['evalMasc'];
			}else{
				$tauxMasc = '';
			}

			if($res2['evalFille']!=0){
				$tauxFille = $res4['moyFille']*100/$res2['evalFille'];
			}else{
				$tauxFille = '';
			}

			
			
			$sql = "SELECT count(moyenne) as moyTotal 
					FROM $table 
					WHERE moyenne >='10.00'";
			$req = $this->_db->query($sql) ;
			$res =$req->fetch(PDO::FETCH_ASSOC);
			if($evalTotal!=0){
				$tauxTotal = $res['moyTotal']*100/$evalTotal;
			}else{
				$tauxTotal = '';
			}
			
			$sqlNFM = "SELECT MAX(moyenne) as maxMasc 
					FROM $table 
					WHERE sexe = 'M' AND moyenne > '0.00'";
			$reqNFM = $this->_db->query($sqlNFM) ;
			$resNFM =$reqNFM->fetch(PDO::FETCH_ASSOC);
			
			$sqlNFF = "SELECT MAX(moyenne) as maxFille 
					FROM $table 
					WHERE sexe = 'F' AND moyenne >'0.00'";
			$reqNFF = $this->_db->query($sqlNFF) ;
			$resNFF =$reqNFF->fetch(PDO::FETCH_ASSOC);
			
			$sqlNFT = "SELECT MAX(moyenne) as maxTotal 
					FROM $table 
					WHERE moyenne > '0.00'";
			$reqNFT = $this->_db->query($sqlNFT) ;
			$resNFT =$reqNFT->fetch(PDO::FETCH_ASSOC);
			
			$sql10 = "SELECT MIN(moyenne) as minMasc 
					FROM $table 
					WHERE sexe = 'M' AND moyenne >'0.00'";
			$req10 = $this->_db->query($sql10) ;
			$res10 =$req10->fetch(PDO::FETCH_ASSOC);
			
			$sql11 = "SELECT MIN(moyenne) as minFille 
					FROM $table 
					WHERE sexe = 'F' AND moyenne >'0.00'";
			$req11 = $this->_db->query($sql11) ;
			$res11 =$req11->fetch(PDO::FETCH_ASSOC);
			
			$sql12 = "SELECT MIN(moyenne) as minTotal 
					FROM $table 
					WHERE moyenne >'0.00'";
			$req12 = $this->_db->query($sql12) ;
			$res12 =$req12->fetch(PDO::FETCH_ASSOC);
			
			$sql20 = "SELECT AVG(moyenne) as moyGenMasc 
					FROM $table 
					WHERE sexe='M' AND moyenne>'0.00'";
			$req20 = $this->_db->query($sql20) ;
			$res20 =$req20->fetch(PDO::FETCH_ASSOC);
			
			$sql21 = "SELECT AVG(moyenne) as moyGenFille 
					FROM $table 
					WHERE sexe='F' AND moyenne>'0.00'";
			$req21 = $this->_db->query($sql21) ;
			$res21 = $req21->fetch(PDO::FETCH_ASSOC);
			
			$sql22 = "SELECT AVG(moyenne) as moyGenTotal 
					FROM $table 
					WHERE moyenne>'0.00'";
			$req22 = $this->_db->query($sql22) ;
			$res22 = $req22->fetch(PDO::FETCH_ASSOC);
			
			
			$stat['effMasc'] = $effMasc;
			$stat['effFille'] = $effFille;
			$stat['effTotal'] = $effTotal;
			$stat['evalMasc'] = $res1['evalMasc'];
			$stat['evalFille'] = $res2['evalFille'];
			$stat['evalTotal'] = $evalTotal;
			$stat['moyMasc'] = $res3['moyMasc'];
			$stat['moyFille'] = $res4['moyFille'];
			$stat['moyTotal'] = $moyTotal;
			$stat['sousMoyMasc'] = $res5['sousMoyMasc'];
			$stat['sousMoyFille'] = $res6['sousMoyFille'];
			$stat['sousMoyTotal'] = $sousMoyTotal;
			// $stat['tauxMasc'] = $tauxMasc;
			$stat['tauxMasc'] = substr($tauxMasc,0,5);
			$stat['tauxFille'] = substr($tauxFille,0,5);
			$stat['tauxTotal'] = substr($tauxTotal,0,5);
			$stat['noteForteMasc'] = $resNFM['maxMasc'];
			$stat['noteForteFille'] = $resNFF['maxFille'];
			$stat['noteForteTotal'] = $resNFT['maxTotal'];
			$stat['noteFaibleMasc'] = $res10['minMasc'];
			$stat['noteFaibleFille'] = $res11['minFille'];
			$stat['noteFaibleTotal'] = $res12['minTotal'];
			$stat['moyGenMasc'] = substr($res20['moyGenMasc'],0,5);
			$stat['moyGenFille'] = substr($res21['moyGenFille'],0,5);
			$stat['moyGenTotal'] = substr($res22['moyGenTotal'],0,5);
			return $stat;
		}






		/*public function sequencesTraitees($classe){
			$sql = "SELECT DISTINCT sequence 
					FROM bull_seq
					WHERE classe='$classe'";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}*/












		// Les groupes et le nombre de groupes d'une classe
		public function afficheGroupe($classe){
			$sql = "SELECT groupe, nom_groupe
					FROM prof_classe, groupe 
					WHERE id_classe='$classe'
						AND groupe.id = groupe
					GROUP BY groupe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			
			return $res;
		}










		
		
		
		
		/*Fonction à utilisser uniquezment pour les mises à jour */
		public function update(){
			/*$req = 'drop table note';
			$req2 = 'drop table note_saisie';
			
			$this->_db->query($req);
			$this->_db->query($req2);
			$requeteNote = "CREATE TABLE note(
								id int(11) auto_increment primary key,
								id_eleve int(11),
								id_matiere int(11),
								id_classe int(11),
								id_periode int(11),
								note decimal(4,2),
								observation varchar(255))";
			$requeteNoteSaisie = "CREATE TABLE note_saisie(
									id int(11) auto_increment primary key,
									id_classe int(11),
									id_enseignant int(11),
									id_matiere int(11),
									id_periode int(11),
									add_by int(11),
									competence TEXT,
									date_saisie DATETIME,
									date_modification DATETIME,
									navigateur varchar(255),
									ip varchar(255),
									os varchar(255))";
			$this->_db->query($requeteNote);
			$this->_db->query($requeteNoteSaisie);*/
			
			/*$req = "ALTER TABLE enseignant ADD contact VARCHAR(100)";
			$this->_db->query($req);*/


			// J'annule les zéros qui se trouvent dans la table Note
			$sql = "SELECT * FROM note WHERE note= 0";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			for($i=0;$i<count($res);$i++){
				$idEleve = $res[$i]['id'];
				$noteObtenue = $this->setNote($res[$i]['note']);
				$sqlUpdate = $this->_db->prepare("UPDATE note SET 
									note = :note 
									WHERE id =:eleve");
				$sqlUpdate->bindValue(':note', $noteObtenue);
				$sqlUpdate->bindValue(':eleve', $idEleve);
				$sqlUpdate->execute();
				
			}
			
		}
		
	}