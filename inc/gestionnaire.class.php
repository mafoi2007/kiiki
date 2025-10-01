<?php
	
	class gestionnaire {
		
		private $_db;
		private $_id;
		private $_nom;
		private $_prenom;
		private $_sexe;
		private $_poste;
		private $_login;
		private $_mdp;
		private $_etat;
		private $_image;
		
		
		
		
		
		public function id(){ return $this->_id; }
		public function nom(){ return $this->_nom; }
		public function prenom(){ return $this->_prenom; }
		public function sexe(){ return $this->_sexe; }
		public function poste(){ return $this->_poste; }
		public function login(){ return $this->_login; }
		public function mdp(){ return $this->_mdp; }
		public function etat(){ return $this->_etat; }
		public function image(){ return $this->_image; }
		
		
		
		
		
		
		
		
		
		public function setNom($nom){
			if(!is_string($nom)){
				$this->_nom = (string)$nom;
			}
			else{
				$this->_nom = $nom;
			}
			return $this->_nom;
		}
		
		
		
		public function setPrenom($prenom){
			if(!is_string($prenom)){
				$this->_prenom = (string)$prenom;
			}
			else{
				$this->_prenom = $prenom;
			}
			return $this->_prenom;
		}
		
		
		
		public function setDb(PDO $db){
			$this->_db = $db;
		}
		
		
		
		
		public function __construct($db){
			$this->setDb($db);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Visualiser tous les gestionnaires 
		
		
		/*
		 
		
		
		
		// Visualiser les gestionnaires en fonction de leurs postes 
		public function viewGestionnairePoste($poste, $etat){
			$this->_etat = $this->setEtat($etat);
			$this->_poste = $this->setPoste($poste);
			$sql = "SELECT *
					FROM enseignant 
					WHERE poste='$this->_poste'
						AND etat = '$this->_etat'";
			$req = $this->_db->query($sql);
			while($reponse = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $reponse;
			}
			return $reponse;
		}
		
		
		
		
		
		
		
		
		
		// Liste des Types d'utilisateurs reconnus
		public function getPosteAll(){
			$sql = "SELECT * 
					FROM type_utilisateur
					ORDER BY code_utilisateur";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		
		*/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		************		DELETE FROM EN MODE PUBLIC 	***********************
		***********************************************************************
		**********************************************************************/
		
		// On rend un gestionnaire inactif 
		public function deleteUtilisateur($source, $id, $etat) {
			$this->_id = $this->setId($id);
			$this->_etat = $this->setEtat($etat);
			$exec = $this->_db->prepare("UPDATE enseignant SET 
										etat=:etat
										WHERE id='$this->_id");
					$exec->bindValue(':etat', $this->_etat);
					$exec->execute();
			$_SESSION['message'] = 'Utilisateur Désactivé';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		// On supprime un gestionnaire qu'on a crée par accident
		public function dropUtilisateur($source, $id, $etat) {
			$this->_id = $this->setId($id);
			$this->_etat = $this->setEtat($etat);
			$exec = $this->_db->query("DELETE FROM enseignant
										WHERE id='$this->_id");
			$_SESSION['message'] = 'Utilisateur Supprimé';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		************		UPDATE 	 EN MODE PUBLIC 	***********************
		***********************************************************************
		**********************************************************************/
		
		
		
		
		
		
		
		/*******************************
		*************************************
		LES METHODES SUIVANTES SONT PRIVEES ET NE DOIVENT ETRE APPELEES***
		QUE DANS LA METHODE PARAMETRES**
		*****************************/

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/********************************************************************/
		/*public function parametre($valeur) {
			if(!empty($valeur)) {
				// echo $valeur;
				if($valeur=='Changer le mot de passe') {
					$this->setMotDePasse($valeur);
				}
				elseif($valeur=='ajouter la photo') {
					$this->setPhoto($valeur);
				}
			}
		}*/
		
		
		
		
		
		
		
		public function supprimerGestionnaire($id) {
			$this->etat = 'inactif';
			$this->id = $id;
			$var = $this->updateEtat($this->id, $this->etat);
			if($var==true) {
				echo "<script>alert('Suppression réussie.');</script>";
			}
			else {
				echo "Une erreur s'est produite dans la réquête";
			}		
			
		}
		
		
		
		public function restaurerGestionnaire($id) {
			$this->etat = 'actif';
			$this->id = $id;
			$var = $this->updateEtat($this->id, $this->etat);
			if($var==true) {
				echo "<script>alert('Restauration réussie.');</script>";
			}
			else {
				echo "Une erreur s'est produite dans la réquête";
			}	
		}
		
		
		
		public function effacerGestionnaire($id, $poste, $etat) {
			$this->poste = $poste;
			$this->etat = $etat;
			$this->id = $id;
			/* Je conçois l'application pour éviter la suppression définitive d'un administrateur */
			if($this->poste=='admin') {
				echo "Vous ne pouvez pas supprimer un administrateur.";
			}
			elseif($this->etat!='inactif') {
				echo "Vous ne pouvez supprimer un utilisateur qui ne se trouve pas dans la corbeille";
			}
			else {
				$suppression = $this->deleteGestionnaire($this->id);
				if($suppression==true) {
					echo "Effacement réussi.";
				}
				else {
					echo "Une erreur s'est produite.";
				}
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		public function getJournal($id) {
			$sql = "
				SELECT utilisateur, adresse_ip, DATE_FORMAT(periode_de_connexion, '%d / %m / %Y') AS jour, DATE_FORMAT(periode_de_connexion, '%H h: %i min %s sec') AS heure, nom, prenom 
				FROM journal_connexion, enseignant 
				WHERE utilisateur=login AND utilisateur = '$id' ORDER BY jour DESC";
			$req = mysql_query($sql) or die(mysql_error());
			$i = 1;
			while($res = mysql_fetch_array($req)) {
				$utilisateur[$i] = array(
									"nom"=>$res['nom'],
									"prenom"=>$res['prenom'],
									"adresse_ip"=>$res['adresse_ip'],
									"jour"=>$res['jour'],
									"heure"=>$res['heure'],
									"utilisateur"=>$res['utilisateur']);
				$i++;
				
			}
			return $utilisateur;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function nbJournal($id) {
			$sql = "SELECT * FROM journal_connexion WHERE utilisateur='$id'"; 
			$req = mysql_query($sql) or die(mysql_error());
			$res = mysql_num_rows($req);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function attribuerClasse() {
			/* Cette fonction se charge d'ajouter un enseignant dans une classe pour une matière.
			
			*/
			if(isset($_REQUEST['affecter'])) {
				/*echo '<pre>';
				print_r($_REQUEST);
				echo '</pre>';*/
				$classe = mysql_real_escape_string(htmlspecialchars($_REQUEST['cls']));
				//echo $classe;
				foreach($_REQUEST['prof'] as $cle=>$login_prof) {
					/* La modification ne doit pas se faire sur toutes les lignes. Elle ne doit intervenir que sur les 
					lignes ayant vraiment une valeur. Ainsi si la valeur null vient dans login_prof, ne rien faire !!!
					*/
					if($login_prof!='null') {
						
						$code[$cle] = $_REQUEST['code'][$cle];
						//echo $code[$cle];
						// echo "<p> ".$cle." ".$_REQUEST['code'][$cle]." </p>";
						$requete = "
									UPDATE prof_classe
									SET id_prof = '$login_prof'
									WHERE id_classe = '$classe' AND id_matiere = '$code[$cle]'
										";
						$sql = mysql_query($requete) or die(mysql_error());
						echo "<script>alert('Affectation effectuée !!!');</script>";
						
					}
					
				}
			}
		}
		
		
		
		
		
		
		
		
		
		/*La fonction qui affiche le conseil de classe. Prend un paramètre, la classe en question*/
		public function conseilDeClasse($classe) {
			return $this->listeProfCC($classe);
		}
		
		
		
		/* Liste d'une catégorie de gestionnaire(enseignant, prof,...) deux paramètres: le statut et le poste */
		public function listeGestionnaire($poste, $etat) {
			$sql = "SELECT id, nom, prenom, sexe, poste, login, etat, image
					FROM enseignant 
					WHERE etat ='$etat' AND poste = '$poste' ORDER BY poste, nom";
			$req = mysql_query($sql) or die(mysql_error());
			$i=01;
			while($res=mysql_fetch_assoc($req)) {
				$gestionnaire[$i] = $res;
				$i++;
			}
			return $gestionnaire;
		}
		
		
		
		
		
		
		
		
		
		/* Liste des enseignants de la table Prof_classe deux paramètres: le prof et la classe */
		public function listeProf($classe) {
			$sql = "SELECT prof_classe.id, id_prof, id_classe, id_matiere, nom, prenom, nom_classe
					FROM prof_classe, enseignant, classe 
					WHERE id_prof = login AND id_classe = code_classe AND id_classe = '$classe'
							GROUP BY id_prof";
			$req = mysql_query($sql) or die(mysql_error());
			$i=01;
			while($res=mysql_fetch_assoc($req)) {
				$gestionnaire[$i] = $res;
				$i++;
			}
			return $gestionnaire;
		}
		
		
		
		
		
		
		
		
		
		/*Liste de tous les prof d'une classe dans la TABLE Prof_classe*/
		protected function listeProfCC($classe) {
			$sql = "SELECT id_prof AS login, nom, prenom
					FROM prof_classe, enseignant
					WHERE id_classe = '$classe' AND enseignant.login = id_prof
					
					";
			$req = mysql_query($sql) or die(mysql_error());
			$i = 1;
			while($res = mysql_fetch_assoc($req)) {
				$prof[$i] = $res;
				$i++;
			}
			return $prof;
		}
		
		
		
		
		
		
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*******************  FONCTION DE MODIFICATION UTILISANT LA CLAUSE SELECT UPDATE *******************
		***************************************************************************************************
		**************************************************************************************************/
		
		/* Mettre un gestionnaire à l'état inactif ou actif */
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*******************  FONCTION DE SUPPRESSION UTILISANT LA CLAUSE SELECT DELETE ********************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		
		/*Pour supprimer définitivement un gestionnaire */
		// public function deleteGestionnaire($id) {
			// $sql = "DELETE FROM enseignant WHERE id = '$id'";
			// $exec = mysql_query($sql) or die(mysql_errno());
			// return $exec;
		// }
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
