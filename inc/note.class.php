<?php
	
	class Note {
		
		/********************************************************************
		*******************************************************************
		***************  		LES ATTRIBUTS 		**********************
		***********************************************************************
		***********************************************************/
		
		private $_id;
		private $_idEleve;
		private $_idMatiere;
		private $_idClasse;
		private $_idPeriode;
		private $_noteSimple;
		private $_eleve;
		private $_matiere;
		private $_codeMatiere;
		// private $_idMatiere;
		private $_classe;
		private $_periode;
		private $_coef;
		private $_enseignant;
		private $_idEnseignant;
		private $_idProf;
		private $_groupe;
		
		
		private $_db;
		
		public function __construct($db){
			$this->setDb($db);
		}
		
		public function setDb(PDO $db){
			$this->_db = $db;
		}
		
		
		
		
		
		
		/***************************************************************
		***************************************************************
		************  		LES GETTERS OU ACCESSEURS 		**************
		*****************************************************************
		************************************************************/
		
		public function id(){return $this->_id;}
		public function idEleve(){return $this->_idEleve;}
		public function idMatiere(){return $this->_idMatiere;}
		public function idClasse(){return $this->_idClasse;}
		public function idPeriode(){return $this->_idPeriode;}
		public function noteSimple(){return $this->_noteSimple;}
		public function eleve(){return $this->_eleve;}
		public function matiere(){return $this->_matiere;}
		public function codeMatiere(){return $this->_codeMatiere;}
		// public function idMatiere(){return $this->_idMatiere;}
		public function classe(){return $this->_classe;}
		public function periode(){return $this->_periode;}
		public function coef(){return $this->_coef;}
		public function enseignant(){return $this->_enseignant;}
		public function idEnseignant(){return $this->_idEnseignant;}
		public function idProf(){return $this->_idProf;}
		public function groupe(){return $this->_groupe;}
		
		
		
		
		
		
		
		
		
		/***************************************************************
		******************************************************************
		***********  		LES SETTERS OU MUTATEURS 		*************
		*******************************************************************
		***************************************************************/
		
		public function setNote($noteSimple){
			$this->_note = (float) str_replace(',','.',$noteSimple);
			
			// Si la Note reçue est inférieure ou égale à Zéro, on l'annule 
			if($this->_note <=0){
				$this->_note = NULL;
			}elseif($this->_note >20){
				// if(strlen($this->_note)==2){
					// On impose une virgule au milieu des deux chiffres
					// $this->_note = explode('.',$this->_note);
				// }elseif(strlen($this->_note)>=3){
					/*Si le 1er chiffre est 1, on impose la virgule après le chiffre qui 
					suit 1. Sinon, s'il est 2, le 2ème chiffre doit être 0 et on supprime 
					le dernier chiffre. Sinon, on impose la virgule au milieu du 1er et du 
					2nd chiffre */
					// $this->_note = explode('.',$this->_note);
					// $this->_note = implode($this->_note,'.');
					
				// }
				$this->_note = (float) 20;
			}else{
				(float) $this->_note;
			}
			return $this->_note;
		}
		
		
		public function setCoef($coef){
			$this->_coef = (float) $coef;
			return $this->_coef;
		}
		
		
		public function setGroupe($groupe){
			
		}
		
		
		/***************************************************************
		******************************************************************
		***********  		LES SETTERS OU MUTATEURS 		*************
		*******************************************************************
		***************************************************************/
		
		
		// On précise si la classe appartient à la section Francophone ou Anglophone
		public function getSection($classe){
			$sql = "SELECT section 
					FROM classe 
					WHERE code_classe='$classe'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $res['section'];
			return $resultat;
		}
		
		
		
		
		/****************************************************************
		*****************************************************************
		*************		M E N U   N O T E S 	*********************
		*****************************************************************
		****************************************************************/
		
		/*Visualiser les notes d'une matière pour une séquence précise */
		public function viewNote($classe, $periode, $matiere){
			$sql = "SELECT id_eleve, id_matiere, nom_matiere, id_classe, id_periode, 
							note_simple, competence, 
							note.id as id, nom_classe, 
							nom, prenom, sexe	
					FROM note, eleve, matiere, classe 
					WHERE id_classe = '$classe' 
							AND id_periode = '$periode' 
							AND id_matiere = '$matiere'
							AND id_matiere = code_matiere
							AND id_classe = code_classe
							AND eleve.id = id_eleve
					ORDER BY nom
							";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		// On vérifie les matières qu'un enseignant a pu saisir dans la table Note
		public function viewMatiereSaisieProf($prof){
			$sql = "SELECT note_saisie.id as id, enseignant as id_prof, 
							classe as id_classe, matiere as id_matiere, 
							sequence, nom_classe, nom_matiere 
					FROM note_saisie, classe, matiere
					WHERE enseignant='$prof'
							AND classe=code_classe
							AND matiere=code_matiere
					GROUP BY matiere";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		// On vérifie les classes dont les notes ont été saisies par le prof 
		public function viewClasseSaisieProf($prof){
			$sql = "SELECT note_saisie.id as id, enseignant as id_prof, 
							classe as id_classe, matiere as id_matiere, 
							sequence, nom_classe, nom_matiere 
					FROM note_saisie, classe, matiere
					WHERE enseignant='$prof'
							AND classe=code_classe
							AND matiere=code_matiere
					GROUP BY classe";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		// On vérifie les séquences dont les notes ont été saisies par le prof 
		public function viewSequenceSaisieProf($prof){
			$sql = "SELECT note_saisie.id as id, enseignant as id_prof, 
							classe as id_classe, matiere as id_matiere, 
							sequence, nom_classe, nom_matiere 
					FROM note_saisie, classe, matiere
					WHERE enseignant='$prof'
							AND classe=code_classe
							AND matiere=code_matiere
					GROUP BY sequence";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		/*****************************************************************
		***********	SOUS MENU SAISIE DES NOTES			******************
		*****************************************************************/
		
		/*Enregistrer des notes dans la table Note*/
		public function ajouterNote($source, $classe, 
									$matiere, $periode, 
									$eleve = array(), $note = array(), $competence ){
			
			$this->_classe = $classe;
			$this->_matiere = $matiere;
			$this->_periode = $periode;
			$this->_competence = trim($competence);
			$verif = $this->viewNote($this->_classe, $this->_periode, $this->_matiere);
			// print_r($verif);
			if(empty($verif)){
				$this->noteSaisie($this->_classe,
								$this->_matiere,
								$this->_periode);
				foreach($eleve as $cle=>$valeur){
					$noteSimple = $this->setNote($note[$cle]);
					$sql = "INSERT INTO note(id_eleve, id_matiere, id_classe,
												id_periode, note_simple, competence)
							VALUES('$valeur',
									'$this->_matiere',
									'$this->_classe',
									'$this->_periode',
									'$noteSimple',
									'$competence')";
					$execution = $this->_db->query($sql);
					$_SESSION['message'] = "Les notes ont été insérées.";
					header('Location:'.$source);
				}
			}else{
				$_SESSION['message'] = "Erreur : Les notes avaient déjà été saisies.";
				header('Location:'.$source);
			}
			/*foreach($eleve as $cle=>$valeur){
				
				// echo $note[$cle].' devient ';
				// echo $noteSimple.' </br />';
				
											
						
								
								
								
								
								
				
				
				
			}*/
			/**/
		}
		
		
		
		
		
		// On crée une sorte de journal de  saisie des Notes
		private function noteSaisie($classe,$matiere,$sequence,$heureSaisie){
			$sql = "SELECT id_prof 
					FROM prof_classe 
					WHERE id_classe='$classe'
						AND id_matiere='$matiere'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$enseignant = $res['id_prof'];
			$sql_1 = "INSERT INTO note_saisie(classe, matiere, 
											sequence,enseignant, periode_saisie)
					VALUES('$classe','$matiere','$sequence','$enseignant', '$heureSaisie')";
			$exec = $this->_db->query($sql_1);
		}
		
		
		
		
		
		
		// On crée un suppresseur de journal de saisie des Notes 
		private function noteSaisieDelete($classe,$matiere,$sequence){
			$sql = "SELECT id_prof 
					FROM prof_classe 
					WHERE id_classe='$classe'
						AND id_matiere='$matiere'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$enseignant = $res['id_prof'];
			$sql_1 = "DELETE FROM note_saisie
						WHERE enseignant='$enseignant' 
							AND classe='$classe'
							AND matiere='$matiere'
							AND sequence='$sequence'
					";
			$exec = $this->_db->query($sql_1);
		}
		
		
		
		
		
		// On vérifie toutes les notes qui ont été saisies 
		public function verifNoteSaisieAll(){
			$sql = "SELECT note_saisie.id as id, 
							classe as id_classe, nom_classe, 
							matiere as id_matiere, nom_matiere, sequence
					FROM note_saisie, classe, matiere 
					WHERE classe=code_classe
						AND code_matiere=matiere
						ORDER BY classe, sequence";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// On Vérifie les classes pour lesquelles les matières séquentielles ont été saisies 
		public function verifNoteSaisieSequence($classe){
			$sql = "SELECT matiere, nom_matiere							
					FROM  note_saisie, matiere
					WHERE classe='$classe'
						AND matiere = code_matiere
					GROUP BY matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		// On vérifie les notes qui ont été saisies par un enseignant
		public function verifNoteSaisieProf($enseignant){
			$sql = "SELECT note_saisie.id as id, 
							classe as id_classe, nom_classe, 
							matiere as id_matiere, nom_matiere, sequence
					FROM note_saisie, classe, matiere 
					WHERE enseignant='$enseignant'
						AND classe=code_classe
						AND code_matiere=matiere
						ORDER BY classe, sequence";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		
		
		public function getLigneNoteSaisie($id){
			$sql = "SELECT note_saisie.id as id, 
							classe as id_classe, nom_classe, 
							matiere as id_matiere, nom_matiere, sequence,
							enseignant, nom, prenom
					FROM note_saisie, classe, matiere, enseignant 
					WHERE note_saisie.id='$id'
						AND classe=code_classe
						AND code_matiere=matiere
						AND enseignant=login
						ORDER BY classe, sequence";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res;
			/*while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;*/
		}
		
		
		/*****************************************************************
		***********	SOUS MENU COPIE DES NOTES			******************
		*****************************************************************/
		
		/*Copier les notes d'une séquence à l'autre*/
		public function copierNote($source, $matiere, $classe, 
									$sequence_depart, $sequence_cible){
			
			$this->_classe = $classe;
			$this->_matiere = $matiere;
			$this->_depart = htmlentities($sequence_depart);
			$this->_cible = htmlentities($sequence_cible);
			/*D'abord on récupère les notes relatives à la séquence départ.*/
			$notes = $this->viewNote($this->_classe, 
										$this->_depart, 
										$this->_matiere);
			// Si la table renvoie un resultat vide
			if(empty($notes)){
				$_SESSION['message'] = "Informations vides Retournées.";
				header('Location:'.$source);
			}
			else{
				// La Séquence Départ doit être différente de la séquence Cible 
				if($this->_depart==$this->_cible){
					$_SESSION['message'] = "Erreur : La Séquence Cible et la Séquence Départ sont identiques.";
					header('Location:'.$source);
				}else{
					for($i=0;$i<count($notes);$i++){
						$eleve = $notes[$i]['id_eleve'];
						$matiere = $notes[$i]['id_matiere'];
						$classe = $notes[$i]['id_classe'];
						$periode = $this->_cible;
						$note_simple = $notes[$i]['note_simple'];
						$insert = "INSERT INTO note(id_eleve, id_matiere,
								id_classe, id_periode, note_simple)
								VALUES('$eleve','$matiere','$classe','$periode',
								'$note_simple')";
						$requete = $this->_db->query($insert);
						$_SESSION['message'] = "notes copiées";
						header('Location:'.$source);
					}
					$this->noteSaisie($this->_classe, $this->_matiere, $this->_cible);
				}						
			}
		}
		
		
		
		
		
		
		
		
		
		// Quelles sont les classes pour lesquelles le prof a saisies les notes 
		public function noteSaisieProf($prof){
			$sql = "SELECT DISTINCT classe as id_classe, nom_classe
					FROM note_saisie, classe
					WHERE enseignant = '$prof' AND classe = code_classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		// Les Classes pour lesquelles un enseignant a saisi les notes 
		public function noteSaisieProfClasse($prof){
			$sql = "SELECT DISTINCT classe, nom_classe
					FROM note_saisie, classe
					WHERE enseignant = '$prof'
						AND classe = code_classe
					ORDER BY classe";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		// Les matières qu'un prof a déjà saisie dans la classe 
		public function noteSaisieProfClasseMatiere($prof, $classe){
			$sql = "SELECT DISTINCT matiere, nom_matiere
					FROM note_saisie, matiere
					WHERE enseignant = '$prof'
						AND classe = '$classe'
						AND matiere = code_matiere
					ORDER BY nom_matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		// Les séquences remplies pour une classe par un prof 
		public function noteSaisieProfClasseSequence($prof, $classe){
			$sql = "SELECT sequence 
					FROM note_saisie
					WHERE classe='$classe'
						AND enseignant = '$prof'
					ORDER BY sequence";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		***********	SOUS MENU SUPPRESSION DES NOTES			**************
		*****************************************************************/
		
		/*On supprime les notes séquentielles*/
		public function supprimerNote($source, $classe, $periode, $matiere) {
			$sql = "DELETE FROM note
					WHERE id_classe='$classe' 
							AND id_periode = '$periode' 
							AND id_matiere = '$matiere'";
			$req = $this->_db->query($sql);
			// $req = $this->_db->query($sql);
			$this->noteSaisieDelete($classe,
								$matiere,
								$periode);
			$_SESSION['message'] = "notes Supprimées";
			header('Location:'.$source);
		}
		
		
		// 4
		
		
		/*****************************************************************
		*******	SOUS MENU CONSULTATION DES NOTES			**************
		*****************************************************************/
		
		// Calcule le produit d'une note
		public function genereProduit($note, $coef){
			$produit = $note * $coef;
			return $produit;
		}
		
		
		
		
		
		
		
		
		
		
		/**************************************************************
		***********		SOUS MENU MODIFICATION DES NOTES		*******
		***************************************************************
		**************************************************************/
		/*Ajuster les notes déjà insérées */
		public function modifierNote($source, $matiere, $classe, $eleve = array(), $sequence, $oldNote = array(), $newNote = array() ) {
			foreach($newNote as $cle=>$valeur){
				$valeur = $this->setNote($valeur);
				$identifiant = $eleve[$cle];
				/*On supprime les lignes concernées au besoin et on créé de nouvelles lignes. Ceci permet la gestion des élèves qui 
				n'avaient pas de notes au départ de la saisie. */
				if($valeur!='0'){
					echo "<p>L'élève $identifiant a obtenu $valeur en $matiere pour la séquence $sequence en classe de $classe</p>";
					$sql_delete = "DELETE FROM note 
									WHERE id_eleve = '$identifiant'
										AND id_periode = '$sequence'
										AND id_matiere = '$matiere'";
					$sql_insert = "INSERT INTO note (id_eleve, id_matiere, id_classe, id_periode, note_simple)
									VALUES('$identifiant','$matiere','$classe','$sequence','$valeur')";
					$this->_db->query($sql_delete);
					$this->_db->query($sql_insert);
					$_SESSION['message'] = "notes mises à jour";
					header('Location:'.$source);
				}
				
				
				/*$sql = "UPDATE note 
						SET note_simple = '$valeur', competence='$competence'
						WHERE id = '$identifiant'";
				$req = $this->_db->query($sql); */
			}
		}
		
		
		
		
		
		
		
		
		
		private function viewNoteEleveSequence($eleve, $periode){
			$sql = "SELECT id_matiere, note_simple, id_eleve,
							nom, prenom, id_periode
					FROM note, eleve 
					WHERE id_eleve = '$eleve' AND id_periode='$periode'
							AND eleve.id=id_eleve
					ORDER BY nom, id_matiere";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
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
				$nomEleve = strtoupper($listeEleve[$i]['nom']);
				$nomEleve .= " ";
				$nomEleve .= ucwords($listeEleve[$i]['prenom']);
				$sexeEleve = $listeEleve[$i]['sexe'];
				$statutEleve = $listeEleve[$i]['statut'];
				$matriculeEleve = $listeEleve[$i]['matricule'];
				$dateNaissance = $listeEleve[$i]['date_naissance'];
				$idEleve = $listeEleve[$i]['id'];
				$sql = "INSERT INTO $nomTable(nom, sexe, statut, matricule, 
												date_naissance, id_eleve)
						VALUES('$nomEleve','$sexeEleve','$statutEleve',
								'$matriculeEleve','$dateNaissance','$idEleve')";
				$req = $this->_db->query($sql);
				$variable = $this->viewNoteEleveSequence($idEleve, $periode);
				for($a=0;$a<count($variable);$a++){
					$matiere = $variable[$a]['id_matiere'];
					$note = $variable[$a]['note_simple'];
					$insert = "UPDATE `$nomTable` 
								SET `$matiere` = $note 
								WHERE id_eleve = $idEleve";
					$exec = $this->_db->query($insert);			
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
			$sql .= "`sexe` varchar(10),";
			$sql .= "`statut` varchar(10),";
			$sql .= "`date_naissance` date,";
			$sql .= "`matricule` varchar(20),";
			
			// On récupère les noms des matières qu'on insère directement dans les champs 
			for($i=0;$i<count($listeMatiere);$i++){
				$nomMatiere = $listeMatiere[$i]['id_matiere'];
				$sql .= "`".$nomMatiere."` FLOAT(4,2) null,";
			}
			$sql .= "`vide` varchar(10));";
			$req = $this->_db->query($sql);
			$sql_2 = "ALTER TABLE $nomTable DROP COLUMN vide";
			$req_2 = $this->_db->query($sql_2);
		}
		
		
		
		
		
		
		
		
		
		
		public function exportNoteSequence($sequence, $classe){
			$table = "view_sequence_".$sequence."_".$classe;
			$sql = "SELECT *
					FROM $table";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			$resultat['eleve'] = $res;
			$resultat['sequence'] = $sequence;
			$resultat['classe'] = $classe;
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		***********	SOUS MENU STATISTIQUE DES NOTES			**************
		*****************************************************************/
		
		
		public function statNotePeriode($periode,$classe, $matiere){
			$nomTable = "view_sequence_".$periode."_".$classe;
			$effectif['M'] = $this->nbM($periode,$classe);
			$effectif['F'] = $this->nbF($periode,$classe);
			$effectif['T'] = $effectif['M'] + $effectif['F'];
			$effectif['evalM'] = $this->evalM($periode, $classe, $matiere);
			$effectif['evalF'] = $this->evalF($periode, $classe, $matiere);
			$effectif['evalT'] = $effectif['evalM'] + $effectif['evalF'];
			$effectif['moyM'] = $this->moyM($periode, $classe, $matiere);
			$effectif['moyF'] = $this->moyF($periode, $classe, $matiere);
			$effectif['moyT'] = $effectif['moyM'] + $effectif['moyF'];
			$effectif['tauxM'] = round($effectif['moyM']*100/$effectif['evalM'],2);
			$effectif['tauxF'] = round($effectif['moyF']*100/$effectif['evalF'],2);
			$effectif['tauxT'] = round($effectif['moyT']*100/$effectif['evalT'],2);
			
			return $effectif;
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
		
		
		
		
		public function statDuProf($classe,$prof,$matiere,$periode){
			// Les Notes de la classe pour la matière
			$notes = $this->viewNote($classe, $periode, $matiere); 
			
			// Effectif de la Classe
			$nbGarcon = $this->nbGenre('M', $classe, 'non_supprime');
			$nbFille = $this->nbGenre('F', $classe, 'non_supprime');
			$nbEleve = $nbFille + $nbGarcon;
			
			// Effectif Evalué
			$nbGarconEvalue = $this->nbGenreEvalueMatiere($classe,
													$matiere, 
													'M',
													$periode);
			$nbFilleEvalue = $this->nbGenreEvalueMatiere($classe,
													$matiere, 
													'F',
													$periode);
			$nbEleveEvalue = $nbGarconEvalue + $nbFilleEvalue;
			
			// Effectif Evalué ayant eu la moyenne
			$nbGarconMoyenne = $this->nbGenreMoyenneMatiere($classe, 
													$matiere, 
													'M', 
													$periode);
			$nbFilleMoyenne = $this->nbGenreMoyenneMatiere($classe, 
													$matiere, 
													'F', 
													$periode);
			$nbEleveMoyenne = $nbGarconMoyenne + $nbFilleMoyenne;
			
			// Taux de réussite
			$tauxGarcon = round($nbGarconMoyenne*100/$nbGarconEvalue, 2);
			$tauxFille = round($nbFilleMoyenne*100/$nbFilleEvalue, 2);
			$tauxGlobal = round($nbEleveMoyenne*100/$nbEleveEvalue, 2);
			
			
			// Notes Maximales et Minimales
			$maxNoteGarcon = $this->maxNoteMatiere($classe, 
													$matiere, 
													'M', 
													$periode);
			$maxNoteFille = $this->maxNoteMatiere($classe, 
													$matiere, 
													'F', 
													$periode);
			$maxNoteEleve = $this->maxNoteMatiereGenerale($classe, 
													$matiere,
													$periode);
			$minNoteGarcon = $this->minNoteMatiere($classe, 
													$matiere, 
													'M', 
													$periode);
			$minNoteFille = $this->minNoteMatiere($classe, 
													$matiere, 
													'F', 
													$periode);
			$minNoteEleve =$this->minNoteMatiereGenerale($classe, 
													$matiere,
													$periode);
			
			// Moyenne Générale dans la matière 
			$moyNoteGarcon = $this->moyNoteMatiere($classe,
													$matiere,
													'M',
													$periode);
			$moyNoteFille = $this->moyNoteMatiere($classe,
													$matiere,
													'F',
													$periode);
			$moyNoteEleve = $this->moyNoteMatiereGenerale($classe,
													$matiere,
													$periode);
			
			$effectif = array(
								'effM'=>$nbGarcon,
								'effF'=>$nbFille,
								'effT'=>$nbEleve,
								'evalM'=>$nbGarconEvalue,
								'evalF'=>$nbFilleEvalue,
								'evalT'=>$nbEleveEvalue,
								'moyM'=>$nbGarconMoyenne,
								'moyF'=>$nbFilleMoyenne,
								'moyT'=>$nbEleveMoyenne,
								'maxM'=>$maxNoteGarcon,
								'maxF'=>$maxNoteFille,
								'maxT'=>$maxNoteEleve,
								'minM'=>$minNoteGarcon,
								'minF'=>$minNoteFille,
								'minT'=>$minNoteEleve,
								'tauxM'=>$tauxGarcon,
								'tauxF'=>$tauxFille,
								'tauxT'=>$tauxGlobal,
								'mgM'=>round($moyNoteGarcon, 2),
								'mgF'=>round($moyNoteFille, 2),
								'mgT'=>round($moyNoteEleve, 2)
								);
			return $effectif;
		}
		
		
		// 7
		
		
		
		
		// 8
		
		
		
		
		// 9
		
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		***********		M E N U   TRAITEMENT NOTE 	*********************
		*****************************************************************
		****************************************************************/
		
		
		
		
		
		
		
		
		
		
		// On vérifie l'état de remplissage des Notes 
		public function etatRemplissage($classe, $sequence){
			$sql = "SELECT enseignant, classe, matiere, sequence, 
							nom, prenom, nom_classe, nom_matiere 
					FROM note_saisie, enseignant, classe, matiere
					WHERE classe='$classe'
						AND sequence ='$sequence'
						AND login=enseignant
						AND code_classe=classe
						AND code_matiere = matiere
					ORDER BY code_matiere";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function classesTraiteesSeq(){
			$sql = "SELECT classe, nom_classe 
					FROM bull_seq, classe 
					WHERE classe = code_classe
					GROUP BY code_classe";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		public function trimestresTraites($classe){
			$sql = "SELECT DISTINCT trim 
					FROM bull_trim
					WHERE classe='$classe'";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Affiche l'appreciation d'une note
		public function showAppreciation($note){
			// On doit gérer les cas des élèves non classés
			if($note==0){
				$res['nom_appreciation'] = 'Non Classé';
				$res['couleur'] = 'Black';
			}
			else{
				$sql = "SELECT nom_appreciation, nom_appreciation_anglais, couleur, cote
						FROM appreciation
						WHERE interv_ouvert <= ".$note." 
							AND interv_fermet>".$note;
				$req = $this->_db->query($sql);
				$res = $req->fetch(PDO::FETCH_ASSOC);
			}
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		*********	VISUALISATION DES NOTES SEQUENTIELLES		**********
		*****************************************************************/
		
		// On visualise les notes séquentielles 
		public function viewNoteSequentielleEleve($classe, $periode, $eleve){
			$sql = "SELECT id_eleve, note.id_matiere as id_matiere, competence, 
							note.id_classe as id_classe, id_periode, note_simple,
							nom_periode, nom_classe, nom_matiere, eleve.nom as nom, 
							eleve.prenom as prenom, id_prof, enseignant.nom as nom_enseignant,
							enseignant.prenom as prenom_enseignant, enseignant.sexe as sexe_enseignant
					FROM  note, periode, classe, matiere, eleve, prof_classe, enseignant
					WHERE note.id_classe='$classe'
						AND id_periode='$periode'
						AND id_eleve='$eleve'
						AND periode.id=id_periode
						AND note.id_classe=code_classe
						AND code_matiere=note.id_matiere
						AND eleve.id=id_eleve			
						AND note.id_matiere = prof_classe.id_matiere
						AND note.id_classe = prof_classe.id_classe
						AND enseignant.login = prof_classe.id_prof
					ORDER BY nom_matiere
					";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		/*****************************************************************
		******	TRAITEMENT DES NOTES TRIMESTRIELLES			**********
		*****************************************************************/
		
		
		
		
		
		
		
		
		
		
		// Calcul des Heures d'Absences trimestrielles d'un élève 
		public function calculAbsenceTrimestre($eleve,$trimestre){
			/* En fonction du trimestre, on sélectionne les dates définies dans la table 
				DATE_ABSENCES, surtout les open_date et les close_date. */
			if($trimestre==1){
				$sequence_1 = 1;
				$sequence_2 = 2;
			}elseif($trimestre==2){  // Trimestre vaut 2
				$sequence_1 = 3;
				$sequence_2 = 4;
			}elseif($trimestre==3){  // Trimestre vaut 3
				$sequence_1 = 5;
				$sequence_2 = 6;
			}
			
			$sql_open = "SELECT open_date 
						FROM date_absences
						WHERE id_periode = '$sequence_1'";
			$sql_close = "SELECT close_date 
						FROM date_absences
						WHERE id_periode = '$sequence_2'";
			$req_open = $this->_db->query($sql_open);
			$req_close = $this->_db->query($sql_close);
			$res_open = $req_open->fetch(PDO::FETCH_ASSOC);
			$res_close = $req_close->fetch(PDO::FETCH_ASSOC);
			
			$date_ouverture = $res_open['open_date'];
			$date_fermeture = $res_close['close_date'];
			
			$sql_total = "SELECT SUM(nombre_heure) as total  
					FROM absence 
					WHERE id_eleve = '$eleve'
						AND date_absence >= '$date_ouverture'
						AND date_absence <= '$date_fermeture'";
			$req_total = $this->_db->query($sql_total);
			$res_total = $req_total->fetchAll(PDO::FETCH_ASSOC);
			
			$sql_nj = "SELECT SUM(nombre_heure) as non_justif  
					FROM absence 
					WHERE id_eleve = '$eleve'
						AND date_absence >= '$date_ouverture'
						AND date_absence <= '$date_fermeture'
						AND justification = 'ANJ'";
			$req_nj = $this->_db->query($sql_nj);
			$res_nj = $req_nj->fetchAll(PDO::FETCH_ASSOC);
			
			
			$sql_j = "SELECT SUM(nombre_heure) as justif  
					FROM absence 
					WHERE id_eleve = '$eleve'
						AND date_absence >= '$date_ouverture'
						AND date_absence <= '$date_fermeture'
						AND justification = 'AJ'";
			$req_j = $this->_db->query($sql_j);
			$res_j = $req_j->fetchAll(PDO::FETCH_ASSOC);
			
			$totalAbsence['total'] = $res_total[0]['total'];
			$totalAbsence['non_justif'] = $res_nj[0]['non_justif'];
			$totalAbsence['justif'] = $res_j[0]['justif'];
			// print_r($totalAbsence);
			return $totalAbsence;
		}
		
		
		
		
		
		
		
		
		
		
		// Calcul des Heures d'Absence Annuelles d'un élève 
		public function calculAbsenceAnnuelle($eleve){
			/*On sélectionne les date définies dans la table dans date_absences, surtout les 
			open_date et les close_date. */
			
			$sequence_1 = 1;
			$sequence_2 = 6;
			$sql_open = "SELECT open_date 
						FROM date_absences
						WHERE id_periode = '$sequence_1'";
			$sql_close = "SELECT close_date 
						FROM date_absences
						WHERE id_periode = '$sequence_2'";
			$req_open = $this->_db->query($sql_open);
			$req_close = $this->_db->query($sql_close);
			$res_open = $req_open->fetch(PDO::FETCH_ASSOC);
			$res_close = $req_close->fetch(PDO::FETCH_ASSOC);
			
			$date_ouverture = $res_open['open_date'];
			$date_fermeture = $res_close['close_date'];
			
			$sql_total = "SELECT SUM(nombre_heure) as total  
					FROM absence 
					WHERE id_eleve = '$eleve'
						AND date_absence >= '$date_ouverture'
						AND date_absence <= '$date_fermeture'";
			$req_total = $this->_db->query($sql_total);
			$res_total = $req_total->fetchAll(PDO::FETCH_ASSOC);
			
			$sql_nj = "SELECT SUM(nombre_heure) as non_justif  
					FROM absence 
					WHERE id_eleve = '$eleve'
						AND date_absence >= '$date_ouverture'
						AND date_absence <= '$date_fermeture'
						AND justification = 'ANJ'";
			$req_nj = $this->_db->query($sql_nj);
			$res_nj = $req_nj->fetchAll(PDO::FETCH_ASSOC);
			
			
			$sql_j = "SELECT SUM(nombre_heure) as justif  
					FROM absence 
					WHERE id_eleve = '$eleve'
						AND date_absence >= '$date_ouverture'
						AND date_absence <= '$date_fermeture'
						AND justification = 'AJ'";
			$req_j = $this->_db->query($sql_j);
			$res_j = $req_j->fetchAll(PDO::FETCH_ASSOC);
			
			$totalAbsence['total'] = $res_total[0]['total'];
			$totalAbsence['non_justif'] = $res_nj[0]['non_justif'];
			$totalAbsence['justif'] = $res_j[0]['justif'];
			// print_r($totalAbsence);
			return $totalAbsence;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Trouver le Rang d'un élève
		public function showRangEleve($table){
			$sql = "SELECT moyenne, id
					FROM $table
					ORDER BY moyenne DESC";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res['moyenne'];
				$id[] = $res['id'];
			}
			$a = 1;
			for($i=0;$i<count($resultat);$i++){
				$ran[$i] = $a;
				if($ran[$i]==1){
					$rang[$i] = $ran[$i];
				}
				else{
					$rang[$i] = $ran[$i];
				}
				$a++;
			}
			$total['resultat'] = $resultat;
			$total['id'] = $id;
			$total['rang'] = $rang;
			return $total;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*Les matières inscrites dans une classe */
		public function listeMatiereClasse($classe) {
			$this->classe = $classe;
			$sql = "SELECT id_matiere, nom_matiere, coef, groupe
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
		
		
		
		
		
		
		
		
		
		public function listeEleve($classe, $etat) {
			$sql = "SELECT eleve.id as id, nom, prenom, sexe, rne, adresse_parent,  
							matricule, nom_classe, statut, date_naissance, photo, 
					DATE_FORMAT(date_naissance, '%d / %m / %Y') as date_fr,"; 
			$sql .="lieu_naissance, code_classe
					FROM eleve, classe
					WHERE eleve.etat='$etat' AND 
						eleve.classe = '$classe' AND 
						code_classe = classe 
					ORDER BY nom";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$liste[] = $res;
			}
			return $liste;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		protected function calculNoteSequence($periode, $classe, $eleve){
			$table = "sequence_".$periode."_".$classe;
			$listeMatiere = $this->listeMatiereClasse($classe);
			$section = $this->getSection($classe);
			// echo $eleve;
			for($a=0;$a<count($listeMatiere);$a++){
				$idEleve = $eleve;
				$codeMatiere = $listeMatiere[$a]['id_matiere'];
				$coefMatiere = $listeMatiere[$a]['coef'];
				$gpMatiere = $listeMatiere[$a]['groupe'];
				
				$noteMax = $this->maxNoteMatiereGenerale($classe,$codeMatiere,$periode);
				$noteMin = $this->minNoteMatiereGenerale($classe,$codeMatiere,$periode);
				
				$Cseq1 = $codeMatiere.'_seq1';
				$Ccoef = $codeMatiere.'_coef';
				$Ctotal = $codeMatiere.'_total';
				$Capprec = $codeMatiere.'_appreciation';
				$Cmin = $codeMatiere.'_min';
				$Cmax = $codeMatiere.'_max';
				$Ccote = $codeMatiere.'_cote';
				
				$sql = "SELECT $Cseq1
						FROM $table 
						WHERE id_eleve = '$idEleve'";
				$requete = $this->_db->query($sql);
				
				while($res = $requete->fetch(PDO::FETCH_ASSOC)){
					if($res[$Cseq1]=='0.00' or $res[$Cseq1]==null){
						$coef = 0;
						$total = 0;
						$appr = utf8_decode('Non Evalue');
						$cote = utf8_decode('');
					}
					else{
						$coef = $listeMatiere[$a]['coef'];
						$total = $res[$Cseq1]*$coef;
						$appreciation = $this->showAppreciation($res[$Cseq1]);
						// On charge l'appréciation en fonction de la Section 
						if($section=='fr'){
							$appr = ucwords($appreciation['nom_appreciation']);
						}elseif($section=='en'){
							$appr = ucwords($appreciation['nom_appreciation_anglais']);
						}
						$cote = ucwords($appreciation['cote']);
					}

					
				}
				$sql_upd = "UPDATE $table 
							SET 
								$Ccoef = '$coef',
								$Ctotal = '$total',
								$Capprec = '$appr',
								$Ccote = '$cote',
								$Cmin = '$noteMin',
								$Cmax = '$noteMax'
							WHERE id_eleve = '$idEleve'";
				$req = $this->_db->query($sql_upd);
				// $total_point[$gpMatiere] = $trim;
				$total_point[$gpMatiere] = $res[$Cseq1];
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*****************************************************************
		******	TRAITEMENT DES MOYENNES TRIMESTRIELLES			**********
		*****************************************************************/
		
		
		
		
		
		
		
		
		
		
		
		// On compte les Coefficients Définis dans une classe
		public function getCoefClasse($classe){
			$sql = "SELECT SUM(coef) as total_coef
					FROM prof_classe 
					WHERE id_classe = '$classe'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$resultat = $res['total_coef'];
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		*************		M E N U   TRAITEMENT ANNUEL 	*************
		*****************************************************************
		****************************************************************/
		
		/*On veut vérifier les classes qui sont prêtes pour un traitement annuel.
		Concrètement, si une classe a produit au moins deux bulletins trimestriels,
		elle peut générer un bulletin annuel. */ 
		public function classePreteAnnuelle(){
			$listeClasse = $this->viewClasse('actif');
			// echo '<pre>';print_r($listeClasse);echo '</pre>';
			for($i=0;$i<count($listeClasse);$i++){
				$codeClasse = $listeClasse[$i]['code_classe'];
				$nomClasse = $listeClasse[$i]['nom_classe'];
				$sql = "SELECT count(classe) as classe
						FROM bull_trim
						WHERE classe='$codeClasse'";
				$req = $this->_db->query($sql);
				$res = $req->fetch(PDO::FETCH_ASSOC);
				if($res['classe']>=2){
					$resultat['codeClasse'][] = $codeClasse;
					$resultat['nomClasse'][] = $nomClasse;
				}
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		public function viewClasse($etat){
			$sql = "SELECT * 
						FROM classe 
						WHERE etat='".$etat."' 
						ORDER BY code_classe DESC";
			$req = $this->_db->query($sql);
			while($res=$req->fetch(PDO::FETCH_ASSOC)) {
				$classe[] = $res;
			}
			return $classe;
		}
		
		
		
		
		
		
		
		
		
		public function calculNoteAnnuelle($classe){
			$table = strtolower('annuel_'.$classe);
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$section = $this->getSection($classe);
			// print_r($listeEleve);
			for($a=0;$a<count($listeEleve);$a++){
				$idEleve = $listeEleve[$a]['id'];
				$listeMatiere = $this->listeMatiereClasse($classe);
				$absences = $this->calculAbsenceAnnuelle($idEleve);
				$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
				$this->_db->query($sql_10);
				// echo '<pre>';print_r($listeMatiere);echo '</pre>';
				// $conseil = $this->conseilDeClasse($classe);
				// echo '<pre>';print_r($conseil);echo '</pre>';
				for($i=0;$i<count($listeMatiere);$i++){
					$codeMatiere = $listeMatiere[$i]['id_matiere'];
					$coefMatiere = $listeMatiere[$i]['coef'];
					/*$enseignant = $conseil[$i]['sexe'];
					$enseignant .= ' '.strtoupper($conseil[$i]['nom']);
					$enseignant .= ' '.ucwords($conseil[$i]['prenom']);*/
					$champArriveeTrim1 = $codeMatiere.'_trim1';
					$champArriveeTrim2 = $codeMatiere.'_trim2';
					$champArriveeTrim3 = $codeMatiere.'_trim3';
					// echo $champArriveeTrim3.'<br />';
					$sqlDepart = "SELECT $champArriveeTrim1, $champArriveeTrim2, $champArriveeTrim3
							FROM $table 
							WHERE id_eleve='$idEleve'";
					$reqDepart = $this->_db->query($sqlDepart);
					$resDepart = $reqDepart->fetch(PDO::FETCH_ASSOC);
					if($resDepart[$champArriveeTrim1]=='0.00' or $resDepart[$champArriveeTrim1]==NULL){
						// echo "<p>Non Evalué au Trim 1 en ".$codeMatiere."</p>";
						unset($resDepart[$champArriveeTrim1]);
					}
					if($resDepart[$champArriveeTrim2]=='0.00' or $resDepart[$champArriveeTrim2]==NULL){
						// echo "<p>Non Evalué au Trim 2 en ".$codeMatiere."</p>";
						unset($resDepart[$champArriveeTrim2]);
					}
					if($resDepart[$champArriveeTrim3]=='0.00' or $resDepart[$champArriveeTrim3]==NULL){
						// echo "<p>Non Evalué au Trim 3 en ".$codeMatiere."</p>";
						unset($resDepart[$champArriveeTrim3]);
					}
					// Nombre d'évaluation subies pour l'année dans la matière 
					$nbEvaluation = count($resDepart);
					// Préparation des Champs
					$champAnnuel = $codeMatiere.'_ann';
					$champCoef = $codeMatiere.'_coef';
					$champEnseignant = $codeMatiere.'_enseignant';
					$champTotalMatiere = $codeMatiere.'_total';
					$champAppreciation = $codeMatiere.'_appr';
					$champCote = $codeMatiere.'_cote';
					// Si on a suivi plus de 2 évaluations on doit être classé 
					if($nbEvaluation<2){
						$sql = "UPDATE $table 
								SET $champAnnuel = '',
									$champCoef = '',
									$champCote = '',
									$champTotalMatiere = '',
									$champAppreciation = 'Non Evalué'
								WHERE id_eleve='$idEleve'";
						$req = $this->_db->query($sql);
					}
					else{
						$sommeNote = array_sum($resDepart);
						$noteAnnuelle = $sommeNote / $nbEvaluation;
						$coefAnnuel = $coefMatiere;
						$totalMatiere = $noteAnnuelle * $coefAnnuel;
						// echo "<p>Note Annuelle vaut $noteAnnuelle et Coef vaut $coefAnnuel : $totalMatiere</p>";
						$appr = $this->showAppreciation($noteAnnuelle);
						if($section=='fr'){
							$appreciationAnnuelle = ucwords($appr['nom_appreciation']);
						}elseif($section=='en'){
							$appreciationAnnuelle = ucwords($appr['nom_appreciation_anglais']);
						}
						
						$coteAnnuelle = ucwords($appr['cote']);
						// print_r($appr);
						// echo $noteAnnuelle.'<br />';
						$sql = "UPDATE $table 
								SET $champAnnuel = '$noteAnnuelle',
									$champCoef = '$coefAnnuel',
									$champTotalMatiere = '$totalMatiere',
									$champCote = '$coteAnnuelle',
									$champAppreciation = '$appreciationAnnuelle'
								WHERE id_eleve='$idEleve'";
						$req = $this->_db->query($sql);
					}
				}
				
			}
		}
		
		
		
		
		
		// Traitement des Notes Annuelles 
		public function TraiterNoteAnnuelle($source, $classe){
			// On s'assure que les données transmises ne vont pas créer de problèmes 
			if($classe=='null' or $classe==NULL){
				$_SESSION['message'] = 'Classe choisie invalide';
			}else{
				// On Commence par créer la table qui va accueillir les notes
				$this->prepaTableAnnuelle($classe);
				// On récupère les notes trimestrielles qu'on stocke dans la table
				$this->prepaRecapNoteAnnuelle($classe);
				// On calcule les notes annuelles par matière pour les stocker
				$this->calculNoteAnnuelle($classe); 
				// On récupère les noms des enseignants et les min et max
				$this->prepaRecapMoyenneAnnuelle($classe);
			}
			$sqlPret = "DELETE FROM bull_ann WHERE classe='$classe'";
			$reqPret = $this->_db->query($sqlPret);
			$sqlPret1 = "INSERT INTO bull_ann (classe, pret)
							VALUES('$classe','oui')";
			$reqPret1 = $this->_db->query($sqlPret1);
			$_SESSION['message'] = 'Notes Annuelles de la '.$classe.' traitées.';
			header('Location:'.$source);
		}
		
		
		
		
		
		
		
		
		
		
		// Traitement des moyennes annuelles
		public function traiterMoyenneAnnuelle($source, $classe){
			$table = 'annuel_'.$classe;
			// On s'assure que les données transmises ne vont pas créer de problèmes 
			if($classe=='null' or $classe==NULL){
				$_SESSION['message'] = 'Classe choisie invalide.';
				$_SESSION['message'] .= ' - Veuillez choisir une Classe -';
				header('Location:'.$source);
			}
			else{
				// On commence par selectionner les notes obtenues par groupe au cours des trimestres
				$this->noteObtenueGroupe($classe);
				// On somme les coefficients obtenus annuellement
				$this->sommeCoeffAnnuel($classe);
				// On génère les moyennes par Groupes, ainsi que la cote et l'appr du Groupe 
				$this->genereMoyenneGroupe($classe);
				// On génère les moyennes annuelles
				$this->genereMoyenneAnnuelle($classe);
				
				$_SESSION['message'] = 'Moyennes de la classe de '.$classe;
				$_SESSION['message'] .= ' traitées. Vous pouvez imprimer les bulletins';
				header('Location:'.$source);
			}
		}
		
		
		
		
		
		
		
		
		
		public function noteObtenueGroupe($classe){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			// Tables de Départ
			$tableTrim1 = strtolower('trimestre_1_'.$classe);
			$tableTrim2 = strtolower('trimestre_2_'.$classe);
			$tableTrim3 = strtolower('trimestre_3_'.$classe);
			// On va controller que la table existe avant de poser la base des réquêtes
			$existTable1 = $this->verifTable($tableTrim1);
			$existTable2 = $this->verifTable($tableTrim2);
			$existTable3 = $this->verifTable($tableTrim3);
			
			for($a=0;$a<count($listeEleve);$a++){
				$idEleve = $listeEleve[$a]['id'];
								
				$listeGroupe = $this->getGroupeClasse($classe);
				// print_r($listeGroupe);
				for($b=0;$b<count($listeGroupe);$b++){
					$champGroupeNoteDepart = $listeGroupe[$b].'_moyenne';
					$tableArrivee = 'annuel_'.$classe;
					
					// Pour le Trimestre 1 
					$champArrivee = $listeGroupe[$b].'_tr1';
					if($existTable1==true){
						$sql = "SELECT $champGroupeNoteDepart, moyenne
								FROM $tableTrim1
								WHERE id_eleve = '$idEleve'";
						$req = $this->_db->query($sql);
						if(is_object($req)){
							$res = $req->fetch(PDO::FETCH_ASSOC);
							$resultat = $res[$champGroupeNoteDepart];
							$moyenne1 = $res['moyenne'];
							$sqlArrivee = "UPDATE $tableArrivee
											SET $champArrivee = '$resultat',
											moyenne_1 = '$moyenne1'
											WHERE id_eleve = '$idEleve'";
							$reqArrivee = $this->_db->query($sqlArrivee);
						}
					}
					
					
					// Pour le Trimestre 2		
					$champArrivee2 = $listeGroupe[$b].'_tr2';	
					if($existTable2){
						$sql2 = "SELECT $champGroupeNoteDepart, moyenne
								FROM $tableTrim2
								WHERE id_eleve = '$idEleve'";
						$req2 = $this->_db->query($sql2);
						if(is_object($req2)){
							$res2 = $req2->fetch(PDO::FETCH_ASSOC);
							$resultat2 = $res2[$champGroupeNoteDepart];
							$moyenne2 = $res2['moyenne'];
							$sqlArrivee2 = "UPDATE $tableArrivee
											SET $champArrivee2 = '$resultat2',
											moyenne_2 = '$moyenne2'
											WHERE id_eleve = '$idEleve'";
							$reqArrivee2 = $this->_db->query($sqlArrivee2);
						}
					}
					
					
					// Pour le Trimestre 3
					$champArrivee3 = $listeGroupe[$b].'_tr3';
					if($existTable3){
						$sql3 = "SELECT $champGroupeNoteDepart, moyenne
								FROM $tableTrim3
								WHERE id_eleve = '$idEleve'";
						$req3 = $this->_db->query($sql3);
						if(is_object($req3)){
							$res3 = $req3->fetch(PDO::FETCH_ASSOC);
							$resultat3 = $res3[$champGroupeNoteDepart];
							$moyenne3 = $res3['moyenne'];
							$sqlArrivee3 = "UPDATE $tableArrivee
											SET $champArrivee3 = '$resultat3',
											moyenne_3 = '$moyenne3'
											WHERE id_eleve = '$idEleve'";
							$reqArrivee3 = $this->_db->query($sqlArrivee3);
						}
					}
				}
			}
			
		}
		
		
		
		
		
		
		
		
		
		
		public function sommeCoeffAnnuel($classe){
			$table = strtolower('annuel_'.$classe);
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			// print_r($listeEleve);
			for($i=0;$i<count($listeEleve);$i++){
				$idEleve = $listeEleve[$i]['id'];
				// echo "<h3>Nom : ".$listeEleve[$i]['nom'].".</h3>";
				$listeGroupe = $this->getGroupeClasse($classe);
				// echo '<pre>';print_r($listeGroupe);
				for($b=0;$b<count($listeGroupe);$b++){
					$listeMatiere = $this->getMatiereGroupe($listeGroupe[$b], $classe);
					// echo '<pre>'; print_r($listeMatiere);
					$codeGroupe = $listeGroupe[$b];
					for($c=0;$c<count($listeMatiere);$c++){
						$codeMatiere = $listeMatiere[$c]['id_matiere'];
						$nomGroupe[$codeGroupe][$codeMatiere] = $codeMatiere;
						$champMatiereCoef = $listeMatiere[$c]['id_matiere'].'_coef';
						$champMatierePoint = $listeMatiere[$c]['id_matiere'].'_total';
						
						$sql = "SELECT $champMatiereCoef, $champMatierePoint 
								FROM $table 
								WHERE id_eleve = '$idEleve'";
						$req = $this->_db->query($sql);
						$res = $req->fetch(PDO::FETCH_ASSOC);
						
						$nomGroupe[$codeGroupe][$codeMatiere] = $res[$champMatiereCoef];
						$totalPointGroupe[$codeGroupe][$codeMatiere] = $res[$champMatierePoint];
					}
				}
				// echo '<pre>';print_r($nomGroupe); echo '</pre>';
				foreach($nomGroupe as $cle=>$valeur){
					$sommeCoef[$cle] = array_sum($valeur); 
				}
				foreach($totalPointGroupe as $clePoint=>$valeurPoint){
					$sommePoint[$clePoint] = array_sum($valeurPoint); 
				}
				foreach($sommeCoef as $code=>$resultat){
					$champCoef = $code.'_Coef';
					$sql_upd = "UPDATE $table";
					$sql_upd .= " SET $champCoef = '$resultat'";
					$sql_upd .= " WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_upd);
				}
				foreach($sommePoint as $codePoint=>$resultatPoint){
					$champPoint = $codePoint.'_total';
					$sql_updPt = "UPDATE $table";
					$sql_updPt .= " SET $champPoint = '$resultatPoint'";
					$sql_updPt .= " WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_updPt);
				}
			}
		}
		
		
		
		
		
		
		
		
		
		public function genereMoyenneAnnuelle($classe){
			$table = strtolower('annuel_'.$classe);
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			for($i=0;$i<count($listeEleve);$i++){
				$idEleve = $listeEleve[$i]['id'];
				$sql = "SELECT moyenne_1, moyenne_2, moyenne_3 
						FROM $table 
						WHERE id_eleve = '$idEleve'";
				$req = $this->_db->query($sql);
				$res = $req->fetch(PDO::FETCH_ASSOC);
				if($res['moyenne_1']=='0.00' or $res['moyenne_1']==NULL){
					unset($res['moyenne_1']);
				}if($res['moyenne_2']=='0.00' or $res['moyenne_2']==NULL){
					unset($res['moyenne_2']);
				}if($res['moyenne_3']=='0.00' or $res['moyenne_3']==NULL){
					unset($res['moyenne_3']);
				}
				$sommeMoyenne = array_sum($res);
				$nbEval = count($res);
				// echo $nbEval;
				// Pour être classé annuellement, il faut avoir subi au moins deux évaluations 
				if($nbEval<2){
					$moyenneFinale = '0.00';
					$appreciation = 'Non Classé';
					$cote = '-';
				}else{
					$moyenneFinale = round($sommeMoyenne / $nbEval,2);
					$appr = $this->showAppreciation($moyenneFinale);
					$appreciation = $appr['nom_appreciation'];
					$cote = $appr['cote'];
				}
				// On insère dans la BD 
				$sqlFin = "UPDATE $table 
							SET moyenne = '$moyenneFinale',
								appreciation = '$appreciation',
								cote = '$cote'
							WHERE id_eleve = '$idEleve'";
				$reqFin = $this->_db->query($sqlFin);
				
				// On gère le total des Points et le total des Coefs de l'élève 
				$groupe = $this->getGroupeClasse($classe);
				// echo '<pre>';print_r($groupe);
				for($a=0;$a<count($groupe);$a++){
					$codeGroupe = $groupe[$a];
					$champCoef = $codeGroupe.'_Coef';
					$champPoint = $codeGroupe.'_total';
					$sql = "SELECT $champCoef, $champPoint
							FROM $table 
							WHERE id_eleve='$idEleve'";
					$req = $this->_db->query($sql);
					$res = $req->fetch(PDO::FETCH_ASSOC);
					$coef[$codeGroupe] = $res[$champCoef];
					$point[$codeGroupe] = $res[$champPoint];
					// echo '<pre>'; print_r($point); echo '</pre>';
				}
				$totalPoint = array_sum($point);
				$totalCoef = array_sum($coef);
				$sql_update = "UPDATE $table 
								SET total_point = '$totalPoint',
								total_coef = '$totalCoef'
								WHERE id_eleve='$idEleve'";
				$this->_db->query($sql_update);
			}
			
			$rang = $this->showRangEleve($table);
			for($b=0;$b<count($rang['rang']);$b++){
				$rank = $rang['rang'][$b];
				$idElev = $rang['id'][$b];
				$sql = "UPDATE $table 
						SET rang = '$rank'
						WHERE id = '$idElev'";
				$req = $this->_db->query($sql);
			}
			$sql_min = "SELECT min(moyenne) as minimum 
						FROM $table 
						WHERE moyenne > 0";
			$req_min = $this->_db->query($sql_min);
			$res_min = $req_min->fetch(PDO::FETCH_ASSOC);
			$minimum = $res_min['minimum'];
			
			$sql_max = "SELECT max(moyenne) as maximum 
						FROM $table 
						WHERE moyenne > 0";
			$req_max = $this->_db->query($sql_max);
			$res_max = $req_max->fetch(PDO::FETCH_ASSOC);
			$maximum = $res_max['maximum'];
			
			$sql_classement = "SELECT count(moyenne) as classement 
								FROM $table 
								WHERE moyenne > 0";
			$req_classement = $this->_db->query($sql_classement);
			$res_classement = $req_classement->fetch(PDO::FETCH_ASSOC);
			$classement = $res_classement['classement'];
			
			
			$sql_upd = "UPDATE $table 
						SET min = '$minimum',
						max = '$maximum',
						classes = '$classement'";
			$this->_db->query($sql_upd);
		}
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		*************		M E N U   BULLETINS 	*********************
		*****************************************************************
		****************************************************************/
		
		public function bulletinAnnuelPret(){
			$sql = "SELECT classe, nom_classe 
					FROM bull_ann, classe 
					WHERE code_classe = classe 
					ORDER BY code_classe";
			$req = $this->_db->query($sql);
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
			// while($res = $req->fetch(PDO::FETCH_ASSOC)){
				// $resultat[] = $res;
			// }
			return $resultat;
		}
		
		
		
		
		
		
		
		/****************************************************************
		*****************************************************************
		*************		M E N U   STATISTIQUES 	*********************
		*****************************************************************
		****************************************************************/
		
		// On liste les élèves d'une classe en fonction du genre
		public function nbGenre($sexe, $classe, $etat){
			$sql = "SELECT count(*) as genre	 
					FROM  eleve
					WHERE sexe = '$sexe'
						AND classe = '$classe'
						AND etat = '$etat'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['genre'];
		}
		
		
		
		
		// On liste les élèves d'une classe qui ont eu la moyenne par genre 
		public function nbGenreMoyenne($sexe, $classe, $etat){
			
		}
		
		
		
		
		// On liste les élèves d'une classe qui ont été évalué par genre
		public function nbGenreEvalue($sexe, $classe, $etat){
			
		}
		
		
		
		// Ceux qui ont eu la moyenne dans une matière par Genre
		public function nbGenreMoyenneMatiere($classe,$matiere,$sexe,$periode){
			$sql = "SELECT count(*) as nbMoyenne 
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND sexe = '$sexe'
						AND note_simple>=10";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['nbMoyenne'];
		}
		
		
		
		
		// Ceux qui ont été évalués dans une matière par genre
		public function nbGenreEvalueMatiere($classe,$matiere,$sexe,$periode){
			$sql = "SELECT count(*) as nbEvalue 
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND sexe = '$sexe'
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['nbEvalue'];
		}
		
		
		
		
		// La Note maximale dans la matière pour une séquence précise par genre
		public function maxNoteMatiere($classe,$matiere,$sexe,$periode){
			$sql = "SELECT max(note_simple) as noteMax 
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND sexe = '$sexe'
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['noteMax'];
		}
		
		
		
		
		// La Note maximale dans la matière sans précision de genre
		public function maxNoteMatiereGenerale($classe,$matiere,$periode){
			$sql = "SELECT max(note_simple) as noteMax 
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['noteMax'];
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// La Note minimale dans la matière pour une séquence précise par genre
		public function minNoteMatiere($classe,$matiere,$sexe,$periode){
			$sql = "SELECT min(note_simple) as noteMin 
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND sexe = '$sexe'
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['noteMin'];
		}
		
		
		
		
		// La Note minimale dans la matière sans précision de genre
		public function minNoteMatiereGenerale($classe,$matiere,$periode){
			$sql = "SELECT min(note_simple) as noteMin 
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['noteMin'];
		}
		
		
		
		
		// La Moyenne générale dans la matière pour une séquence précise par genre
		private function moyNoteMatiere($classe,$matiere,$sexe,$periode){
			$sql = "SELECT avg(note_simple) as moy
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND sexe = '$sexe'
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['moy'];
		}
		
		
		
		
		
		// La Moyenne générale dans la matière sans précision de genre
		private function moyNoteMatiereGenerale($classe,$matiere,$periode){
			$sql = "SELECT avg(note_simple) as moy
					FROM note, eleve
					WHERE id_periode = '$periode'
						AND id_classe = '$classe'
						AND id_matiere = '$matiere'
						AND id_eleve = eleve.id
						AND note_simple>0";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			return $res['moy'];
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Les Classes pour lesquelles on a déjà saisi les notes
		public function viewClasseNote(){
			$sql = "SELECT id_classe, nom_classe
					FROM note, classe, niveau_classe
					WHERE id_classe = classe.id
						AND niveau_classe = niveau_classe.id
					GROUP BY id_classe ORDER BY classe.section, nom_niveau, nom_classe";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		
		
		
		
		
		// La classe appartient à l'enseignant. Mais a-t-on saisi ses notes ?
		public function verifClasseNote($classe){
			$sql = "SELECT id_classe as classe, nom_classe
					FROM note, classe
					WHERE id_classe='".$classe."'
							AND code_classe=id_classe
					GROUP BY id_classe";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		
		
		
		
		
		// Les Séquences pour lesquelles les notes ont déjà été saisies
		public function viewSequenceNote(){
			$sql = "SELECT id_periode, nom_periode
					FROM note, periode
					WHERE periode.id = id_periode
					GROUP BY id_periode";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$reponse[] = $res;
			}
			return $reponse;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/********************************************************************************
		*********************************************************************************
		***************  		PARAMETRAGE DE BASE EN BD 		*************************
		*********************************************************************************
		*********************************************************************************/
		
		
		
		/**************************************************************************
		**********************		Les private Function **************************/
		
		
		
		
		
		
		
		
		
		
		
		// Le nombre total de Coef définis dans la classe 
		public function coefficientsClasse($classe){
			$sql = "SELECT SUM(coef) as somme_coef
					FROM prof_classe 
					WHERE id_classe='".$classe."'";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat = $res;
			}
			return $resultat;
		}	
		
		
		
		
		
		
		
		
		// Creation de la table qui contiendra les données annuelles
		public function prepaTableAnnuelle($classe){
			$table = 'annuel_'.$classe;
			$execution = $this->_db->query("DROP TABLE IF EXISTS $table");
			$sql = "CREATE TABLE $table(
						id int(11) auto_increment primary key,
						id_eleve int(11),
						nom_eleve varchar(255) not null,
						sexe varchar(10),
						date_naissance varchar(100),
						lieu_naissance varchar(255),
						matricule  varchar(20),
						rne varchar(100),
						adresse_parent varchar(100),
						statut varchar(10), "; 
			
			$groupes = $this->getGroupeClasse($classe);
			// echo '<pre>';print_r($groupes);
			for($i=0;$i<count($groupes);$i++){
				$groupe = $groupes[$i];
				// echo $groupe.'<br/>';
				$matieres = $this->getMatiereGroupe($groupe, $classe);
				for($j=0;$j<count($matieres);$j++){
					$matiere = $matieres[$j]['id_matiere'];
					// echo $matiere.'<br>';
					$champ_trim1 = $matiere.'_trim1';
					$champ_trim2 = $matiere.'_trim2';
					$champ_trim3 = $matiere.'_trim3';
					$champ_Ann = $matiere.'_ann';
					$champ_min = $matiere.'_min';
					$champ_max = $matiere.'_max';
					$champ_Coef = $matiere.'_coef';
					$champ_total = $matiere.'_total';
					$champ_Appr = $matiere.'_appr';
					$champ_cote = $matiere.'_cote';
					$champ_Prof = $matiere.'_enseignant';
					
					
					// $champ_Total = $matiere.'_total';
					
					
					$sql .= $champ_trim1.' float(4,2), ';
					$sql .= $champ_trim2.' float(4,2), ';
					$sql .= $champ_trim3.' float(4,2), ';
					$sql .= $champ_Ann.' float(4,2), ';
					$sql .= $champ_min.' float(4,2), ';
					$sql .= $champ_max.' float(4,2), ';
					$sql .= $champ_Coef.' float(2,1), ';
					$sql .= $champ_total.' float(5,2), ';
					$sql .= $champ_Prof.' varchar(255), ';
					$sql .= $champ_Appr.' varchar(255), ';
					$sql .= $champ_cote.' varchar(255), ';
				}
				$groupe_Tr1 = $groupe.'_tr1';
				$groupe_Tr2 = $groupe.'_tr2';
				$groupe_Tr3 = $groupe.'_tr3';
				$groupe_Moyenne = $groupe.'_moyenne';
				$groupe_Coef = $groupe.'_Coef';
				$groupe_Total = $groupe.'_total';
				$groupe_Appr = $groupe.'_Appr';
				$groupe_Cote = $groupe.'_cote';
				
				$sql .= $groupe_Tr1.' float(4,2), ';
				$sql .= $groupe_Tr2.' float(4,2), ';
				$sql .= $groupe_Tr3.' float(4,2), ';
				$sql .= $groupe_Moyenne.' float(4,2), ';
				$sql .= $groupe_Coef.' float(4,2), ';
				$sql .= $groupe_Total.' float(5,2), ';
				$sql .= $groupe_Appr.' varchar(255), ';
				$sql .= $groupe_Cote.' varchar(255), ';
			}
			$sql .= 'total_point float(5,2), ';
			$sql .= 'total_coef float(5,2), ';
			$sql .= 'moyenne_1 float(5,2), ';
			$sql .= 'moyenne_2 float(5,2), ';
			$sql .= 'moyenne_3 float(5,2), ';
			$sql .= 'moyenne float(5,2), ';
			$sql .= 'appreciation varchar(255), ';
			$sql .= 'cote varchar(100), ';
			$sql .= 'min float(4,2), ';
			$sql .= 'max float(4,2), ';
			$sql .= 'classes int(11), ';
			$sql .= 'rang varchar(255), ';
			$sql .= 'absence_total int(11), ';
			$sql .= 'absence_non_just int(11), ';
			$sql .= 'absence_just int(11), ';
			$sql .= 'photo varchar(255) ';
			$sql .= ');';
			
			$req = $this->_db->query($sql);
			
			// En bonus, on ajoute une fois les élèves dans cette table 
			$liste = $this->listeEleve($classe, 'non_supprime');
			for($k=0;$k<count($liste);$k++){
				$nomEleve = addslashes(strtoupper($liste[$k]['nom']).' '.ucwords($liste[$k]['prenom']));
				$idEleve = $liste[$k]['id'];
				$sexe = $liste[$k]['sexe'];
				$statut = $liste[$k]['statut'];
				$dateNaiss = $liste[$k]['date_fr'];
				$lieuNaiss = addslashes(ucwords($liste[$k]['lieu_naissance']));
				$matricule = $liste[$k]['matricule'];
				$rne = $liste[$k]['rne'];
				$adresse = $liste[$k]['adresse_parent'];
				$photo = $liste[$k]['photo'];
				$insert  = "INSERT INTO $table(nom_eleve, 
												id_eleve, 
												sexe, 
												statut, 
												date_naissance, 
												lieu_naissance, 
												matricule, photo, rne, adresse_parent)
							VALUES('$nomEleve',
									'$idEleve',
									'$sexe',
									'$statut',
									'$dateNaiss',
									'$lieuNaiss',
									'$matricule', '$photo','$rne', '$adresse')";
				$exec = $this->_db->query($insert);
			}
		}
		
		
		
		
		
		
		
		
		
		
		public function prepaRecapNoteAnnuelle($classe){
			$tableTrimestreUn = 'trimestre_1_'.$classe;
			$tableTrimestreDeux = 'trimestre_2_'.$classe;
			$tableTrimestreTrois = 'trimestre_3_'.$classe;
			
			$database = database;
			// echo $database;
			// On vérifie d'abord l'existence des tables trimestrielles
			$sql = 'SHOW TABLES';
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			
			for($i=0;$i<count($res);$i++){
				$nomIndex = 'Tables_in_'.$database;
				$tables[] = $res[$i][$nomIndex];
			}
			// echo '<pre>';print_r($tables);
			
			// Si la Table Premier Trimestre Existe
			if(in_array(strtolower($tableTrimestreUn), $tables, true)){
				
				$trim1 = $this->tableTrimestre(1, $classe);
				$listeEleve = $this->listeEleve($classe, 'non_supprime');
				for($j=0;$j<count($listeEleve);$j++){
					$idEleve = $listeEleve[$j]['id'];
					$listeMatiere = $this->listeMatiereClasse($classe);
					for($k=0;$k<count($listeMatiere);$k++){
						$codeMat = $listeMatiere[$k]['id_matiere'];
						$champArrivee = $codeMat.'_trim1';
						$champDepart = $codeMat.'_trim';
						$sql_depart = "SELECT $champDepart 
										FROM $tableTrimestreUn 
										WHERE id_eleve = '$idEleve'";
						$req_depart = $this->_db->query($sql_depart);
						$res_depart = $req_depart->fetch(PDO::FETCH_ASSOC);
						// print_r($res_depart);
						$tableAnnuelle = 'annuel_'.$classe;
						$sql_arrivee = "UPDATE $tableAnnuelle 
										SET $champArrivee = '$res_depart[$champDepart]'
										WHERE id_eleve = '$idEleve'";
						// echo $sql_arrivee;
						$req_arrivee = $this->_db->query($sql_arrivee);
					}
				}
			}
			
			// Si la Table Deuxième Trimestre Existe
			if(in_array(strtolower($tableTrimestreDeux), $tables, true)){
				// echo "<p>Il y'a le trimestre Deux.</p>";
				$trim2 = $this->tableTrimestre(2, $classe);
				$listeEleve = $this->listeEleve($classe, 'non_supprime');
				for($j=0;$j<count($listeEleve);$j++){
					$idEleve = $listeEleve[$j]['id'];
					$listeMatiere = $this->listeMatiereClasse($classe);
					for($k=0;$k<count($listeMatiere);$k++){
						$codeMat = $listeMatiere[$k]['id_matiere'];
						$champArrivee = $codeMat.'_trim2';
						$champDepart = $codeMat.'_trim';
						$sql_depart = "SELECT $champDepart 
										FROM $tableTrimestreDeux 
										WHERE id_eleve = '$idEleve'";
						$req_depart = $this->_db->query($sql_depart);
						$res_depart = $req_depart->fetch(PDO::FETCH_ASSOC);
						// print_r($res_depart);
						$tableAnnuelle = 'annuel_'.$classe;
						$sql_arrivee = "UPDATE $tableAnnuelle 
										SET $champArrivee = '$res_depart[$champDepart]'
										WHERE id_eleve = '$idEleve'";
						// echo $sql_arrivee;
						$req_arrivee = $this->_db->query($sql_arrivee);
					}
				}
			}
			// Si la Table Troisième Trimestre Existe 
			if(in_array(strtolower($tableTrimestreTrois),$tables, true)){
				// echo "<p>Il y'a le trimestre Trois.</p>";
				$trim3 = $this->tableTrimestre(3, $classe);
				$listeEleve = $this->listeEleve($classe, 'non_supprime');
				for($j=0;$j<count($listeEleve);$j++){
					$idEleve = $listeEleve[$j]['id'];
					$listeMatiere = $this->listeMatiereClasse($classe);
					for($k=0;$k<count($listeMatiere);$k++){
						$codeMat = $listeMatiere[$k]['id_matiere'];
						$champArrivee = $codeMat.'_trim3';
						$champDepart = $codeMat.'_trim';
						$sql_depart = "SELECT $champDepart 
										FROM $tableTrimestreTrois 
										WHERE id_eleve = '$idEleve'";
						$req_depart = $this->_db->query($sql_depart);
						$res_depart = $req_depart->fetch(PDO::FETCH_ASSOC);
						// print_r($res_depart);
						$tableAnnuelle = 'annuel_'.$classe;
						$sql_arrivee = "UPDATE $tableAnnuelle 
										SET $champArrivee = '$res_depart[$champDepart]'
										WHERE id_eleve = '$idEleve'";
						// echo $sql_arrivee;
						$req_arrivee = $this->_db->query($sql_arrivee);
					}
				}
			}		
		}
		
		
		
		
		
		
		
		
		
		
		public function prepaRecapMoyenneAnnuelle($classe){
			 
			$listeEnseignant = $this->conseilDeClasse($classe);
			// echo '<pre>'; print_r($listeEnseignant); echo '</pre>';
			$tableAnnuelle = 'annuel_'.$classe;
			for($i=0;$i<count($listeEnseignant);$i++){
				// Recupération et positionnement du nom des enseignants
				$nomEnseignant = $listeEnseignant[$i]['sexe'];
				$nomEnseignant .= ' '.strtoupper($listeEnseignant[$i]['nom']);
				$nomEnseignant .= ' '.ucwords($listeEnseignant[$i]['prenom']);
				
				$nomChamp = $listeEnseignant[$i]['id_matiere'].'_enseignant';
				$sql[$i] = "UPDATE ".$tableAnnuelle." SET 
						".$nomChamp." = '".$nomEnseignant."', ";
				
				
				// Récupération et positionnement des minimum et des maximum par matière
				$champAnnuel = $listeEnseignant[$i]['id_matiere'].'_ann';
				$champMin = $listeEnseignant[$i]['id_matiere'].'_min';
				$champMax = $listeEnseignant[$i]['id_matiere'].'_max';
				$sql_min = "SELECT MIN(".$champAnnuel.") as minimum 
							FROM ".$tableAnnuelle." 
							WHERE ".$champAnnuel." > 0";
				$req_min = $this->_db->query($sql_min);
				$res_min = $req_min->fetch(PDO::FETCH_ASSOC);
				$minimum = $res_min['minimum'];
				$sql[$i] .= " $champMin = '$minimum', ";
				// echo '<pre>';print_r($res_min); echo '</pre>';
				$sql_max = "SELECT MAX(".$champAnnuel.") as maximum 
							FROM ".$tableAnnuelle." 
							WHERE ".$champAnnuel." > 0";
				$req_max = $this->_db->query($sql_max);
				$res_max = $req_max->fetch(PDO::FETCH_ASSOC);
				$maximum = $res_max['maximum'];
				$sql[$i] .= " $champMax = '$maximum'";
				// echo '<pre>';print_r($res_max); echo '</pre>';
			}
			// Exécution de la Réquête 
			for($x=0;$x<count($sql);$x++){
				// echo "<p>".$sql[$x]."</p>";
				$this->_db->query($sql[$x]);
			}
		}
		
		
		
		
		
		
		
		
		
		public function conseilDeClasse($classe) {
			$this->_classe = $classe;
			$sql = "SELECT	id_prof, id_classe, id_matiere, coef, groupe,
							nom_matiere, nom_classe, nom, prenom, sexe
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
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************************
		***********************************************************************************
		***********************		LES SETTERS *******************************************
		***********************************************************************************
		**********************************************************************************/
		
		
		
		/**********************************************************************************
		***********************************************************************************
		***********************		LES GETTERS *******************************************
		***********************************************************************************
		**********************************************************************************/
		
		// On récupère le Groupe auquel appartient la matière
		private function getGroupeMatiere($matiere, $classe){
			$sql = "SELECT groupe
					FROM prof_classe 
					WHERE id_classe='".$classe."' AND id_matiere = '".$matiere."' 
					";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// On récupère le Coef d'une matière. Ceci est utile pour calculer les notes
		private function getCoefMatiere($matiere, $classe){
			$sql = "SELECT coef
					FROM prof_classe 
					WHERE id_classe='".$classe."' AND id_matiere = '".$matiere."' 
					";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat = $res['coef'];
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		// Les informations issues du PDF de voir Note Sequentielles
		public function viewSequenceClasse($periode, $classe){
			$table = 'view_sequence_'.$periode.'_'.$classe;
			$sql = "SELECT * FROM $table";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		// On veut vérifier l'existence d'une table dans la BD
		protected function verifTable($table){
			$sql = "SHOW TABLES";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			// On transforme le tableau retourné 
			for($i=0;$i<count($res);$i++){
				$resultat[$i] = $res;
				foreach($resultat[$i] as $cle=>$valeur){
					foreach($valeur as $code=>$tables){
						$listeTable[] = $tables;
					}
				}
			}
			if(in_array($table,$listeTable)){
				$reponse = true;
			}else{
				$reponse = false;
			}
			return $reponse;
		}
		
		
		
		
		/**********************************************************************************
		***********************************************************************************
		***********************		CREATE TABLE 		***********************************
		***********************************************************************************
		**********************************************************************************/
				
		
		
		
		
		
		
		
		
		
		
		/*************
		On créé les tables qui vont gérer les traitements 
		des notes séquentielles(Table 1 : sequence_numSeq_Classe
		Table 2 : moyennes_sequence_numSeq_Classe)
		************************************************************/
		private function tableTraiteNoteSequence($periode, $classe,$table){
			$sql_1 = "DROP TABLE IF EXISTS ".$table;
			mysql_query($sql_1) or die(mysql_error());
			$sql = "CREATE TABLE ".$table."(
						id int(11) AUTO_INCREMENT PRIMARY KEY,
						id_eleve int(11) not null,
						nom varchar(255) not null,
						sexe varchar(5),
						statut varchar(5),
						effectif int(11) not null,
						date_naissance date,
						lieu_naissance varchar(255),
						classe varchar(100),
						nb_gpe int(11),
						matricule varchar(20))";
			$this->_db->query($sql);
			
			$tab2 = "moyennes_".$table;
			$sql_2 = "DROP TABLE IF EXISTS ".$tab2;
			mysql_query($sql_2) or die(mysql_error());
			$sql = "CREATE TABLE ".$tab2."(
						id int(11) AUTO_INCREMENT PRIMARY KEY,
						id_eleve int(11) not null,
						nom varchar(255) not null,
						sexe varchar(5),
						statut varchar(5),
						effectif int(11) not null,
						date_naissance date,
						lieu_naissance varchar(255),
						classe varchar(100),
						matricule varchar(20))";
			$this->_db->query($sql);
		}
		
		
		
		
		
		
		
		
		
		protected function createTableTrimestre($trimestre, $classe){
			if($trimestre==1){
				$listeMatiere = $this->listeMatiereClasse($classe);
				// print_r($listeMatiere);
				$nomTable = "Note_Trimestre_".$trimestre."_".$classe;
				$nomTable00 = "Moyenne_Trimestre_".$trimestre."_".$classe;
				// On supprime d'abord la table si elle existe
				$sql_1 = "DROP TABLE IF EXISTS ".$nomTable;
				$sql_100 = "DROP TABLE IF EXISTS ".$nomTable00;
				mysql_query($sql_1) or die(mysql_error());
				mysql_query($sql_100) or die(mysql_error());
				// Ensuite on la créé à nouveau
				$sql = "CREATE TABLE ".$nomTable."(
					id int(11) AUTO_INCREMENT PRIMARY KEY,
					nom varchar(255) not null,
					id_eleve int(11) not null,
					sexe varchar(10),
					statut varchar(10),
					date_naissance varchar(100),
					lieu_naissance varchar(255),
					matricule varchar(20))";
				$this->_db->query($sql);
				
				$sql100 = "CREATE TABLE ".$nomTable00."(
					id int(11) AUTO_INCREMENT PRIMARY KEY,
					nom varchar(255) not null,
					id_eleve int(11) not null,
					sexe varchar(10),
					statut varchar(10),
					date_naissance varchar(100),
					lieu_naissance varchar(255),
					matricule varchar(20))";
				mysql_query($sql100) or die(mysql_error());
				 
				// Maintenant on insère de nouveaux champs
				for($i=0;$i<count($listeMatiere);$i++){
					$nomMatiere = $listeMatiere[$i]['id_matiere'];
					$sql_2 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_seq1` FLOAT(4,2) null";
					$sql_3 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_seq2` FLOAT(4,2) null";
					$sql_4 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_trim1` FLOAT(4,2) null";
					$sql_5 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_coef` FLOAT(2,1) null";
					$sql_6 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_total` FLOAT(5,2) null";
					$sql_7 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_appreciation` VARCHAR(255) not null";
					$sql_700 = "ALTER TABLE `".$nomTable00."` 
						ADD `".$nomMatiere."` FLOAT(4,2) null";
					mysql_query($sql_2) or die(mysql_error());
					mysql_query($sql_3) or die(mysql_error());
					mysql_query($sql_4) or die(mysql_error());
					mysql_query($sql_5) or die(mysql_error());
					mysql_query($sql_6) or die(mysql_error());
					mysql_query($sql_7) or die(mysql_error());
					mysql_query($sql_700) or die(mysql_error());
				}
				$sql_7000 = "ALTER TABLE `".$nomTable00."` 
							ADD moyenne FLOAT(4,2) null";
				mysql_query($sql_7000);
				$groupe = $this->getGroupeClasse($classe);
				for($j=0;$j<count($groupe);$j++){
					$nomGroupe = $groupe[$j];
					$sql_10 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_total` FLOAT(5,2) null";
					$sql_11 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_coef` FLOAT(4,2) null";
					$sql_12 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_moyenne` FLOAT(4,2) null";
					mysql_query($sql_10) or die(mysql_error());
					mysql_query($sql_11) or die(mysql_error());
					mysql_query($sql_12) or die(mysql_error());
				}
				$sql_20 = "ALTER TABLE `".$nomTable."`ADD total_point FLOAT(5,2) null";
				$sql_21 = "ALTER TABLE `".$nomTable."`ADD total_coef FLOAT(4,2) null";
				$sql_22 = "ALTER TABLE `".$nomTable."`ADD moyenne FLOAT(4,2) null";
				$sql_23 = "ALTER TABLE `".$nomTable."`ADD appreciation VARCHAR(100) null";
				$sql_24 = "ALTER TABLE `".$nomTable."`ADD classes INT(11) null";
				$sql_25 = "ALTER TABLE `".$nomTable."`ADD rang varchar(10) null";
				mysql_query($sql_20) or die(mysql_error());
				mysql_query($sql_21) or die(mysql_error());
				mysql_query($sql_22) or die(mysql_error());
				mysql_query($sql_23) or die(mysql_error());
				mysql_query($sql_24) or die(mysql_error());
				mysql_query($sql_25) or die(mysql_error());
			}
			elseif($trimestre==2){
				$listeMatiere = $this->listeMatiereClasse($classe);
				// print_r($listeMatiere);
				$nomTable = "Note_Trimestre_".$trimestre."_".$classe;
				$nomTable00 = "Moyenne_Trimestre_".$trimestre."_".$classe;
				// On supprime d'abord la table si elle existe
				$sql_1 = "DROP TABLE IF EXISTS ".$nomTable;
				$sql_100 = "DROP TABLE IF EXISTS ".$nomTable00;
				mysql_query($sql_1) or die(mysql_error());
				mysql_query($sql_100) or die(mysql_error());
				// Ensuite on la créé à nouveau
				$sql = "CREATE TABLE ".$nomTable."(
					id int(11) AUTO_INCREMENT PRIMARY KEY,
					nom varchar(255) not null,
					id_eleve int(11) not null,
					sexe varchar(10),
					statut varchar(10),
					date_naissance varchar(100),
					lieu_naissance varchar(255),
					matricule varchar(20))";
				$this->_db->query($sql);
				
				$sql100 = "CREATE TABLE ".$nomTable00."(
					id int(11) AUTO_INCREMENT PRIMARY KEY,
					nom varchar(255) not null,
					id_eleve int(11) not null,
					sexe varchar(10),
					statut varchar(10),
					date_naissance varchar(100),
					lieu_naissance varchar(255),
					matricule varchar(20))";
				mysql_query($sql100) or die(mysql_error());
				 
				// Maintenant on insère de nouveaux champs
				for($i=0;$i<count($listeMatiere);$i++){
					$nomMatiere = $listeMatiere[$i]['id_matiere'];
					$sql_2 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_seq3` FLOAT(4,2) null";
					$sql_3 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_seq4` FLOAT(4,2) null";
					$sql_4 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_trim2` FLOAT(4,2) null";
					$sql_5 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_coef` FLOAT(2,1) null";
					$sql_6 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_total` FLOAT(5,2) null";
					$sql_7 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_appreciation` VARCHAR(255) not null";
					$sql_700 = "ALTER TABLE `".$nomTable00."` 
						ADD `".$nomMatiere."` FLOAT(4,2) null";
					mysql_query($sql_2) or die(mysql_error());
					mysql_query($sql_3) or die(mysql_error());
					mysql_query($sql_4) or die(mysql_error());
					mysql_query($sql_5) or die(mysql_error());
					mysql_query($sql_6) or die(mysql_error());
					mysql_query($sql_7) or die(mysql_error());
					mysql_query($sql_700) or die(mysql_error());
				}
				$sql_7000 = "ALTER TABLE `".$nomTable00."` 
							ADD moyenne FLOAT(4,2) null";
				mysql_query($sql_7000);
				$groupe = $this->getGroupeClasse($classe);
				for($j=0;$j<count($groupe);$j++){
					$nomGroupe = $groupe[$j];
					$sql_10 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_total` FLOAT(5,2) null";
					$sql_11 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_coef` FLOAT(4,2) null";
					$sql_12 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_moyenne` FLOAT(4,2) null";
					mysql_query($sql_10) or die(mysql_error());
					mysql_query($sql_11) or die(mysql_error());
					mysql_query($sql_12) or die(mysql_error());
				}
				$sql_20 = "ALTER TABLE `".$nomTable."`ADD total_point FLOAT(5,2) null";
				$sql_21 = "ALTER TABLE `".$nomTable."`ADD total_coef FLOAT(4,2) null";
				$sql_22 = "ALTER TABLE `".$nomTable."`ADD moyenne FLOAT(4,2) null";
				$sql_23 = "ALTER TABLE `".$nomTable."`ADD appreciation VARCHAR(100) null";
				$sql_24 = "ALTER TABLE `".$nomTable."`ADD classes INT(11) null";
				$sql_25 = "ALTER TABLE `".$nomTable."`ADD rang varchar(10) null";
				mysql_query($sql_20) or die(mysql_error());
				mysql_query($sql_21) or die(mysql_error());
				mysql_query($sql_22) or die(mysql_error());
				mysql_query($sql_23) or die(mysql_error());
				mysql_query($sql_24) or die(mysql_error());
				mysql_query($sql_25) or die(mysql_error());
			}
			elseif($trimestre==3){ 
				$listeMatiere = $this->listeMatiereClasse($classe);
				// print_r($listeMatiere);
				$nomTable = "Note_Trimestre_".$trimestre."_".$classe;
				$nomTable00 = "Moyenne_Trimestre_".$trimestre."_".$classe;
				// On supprime d'abord la table si elle existe
				$sql_1 = "DROP TABLE IF EXISTS ".$nomTable;
				$sql_100 = "DROP TABLE IF EXISTS ".$nomTable00;
				mysql_query($sql_1) or die(mysql_error());
				mysql_query($sql_100) or die(mysql_error());
				// Ensuite on la créé à nouveau
				$sql = "CREATE TABLE ".$nomTable."(
					id int(11) AUTO_INCREMENT PRIMARY KEY,
					nom varchar(255) not null,
					id_eleve int(11) not null,
					sexe varchar(10),
					statut varchar(10),
					date_naissance varchar(100),
					lieu_naissance varchar(255),
					matricule varchar(20))";
				$this->_db->query($sql);
				
				$sql100 = "CREATE TABLE ".$nomTable00."(
					id int(11) AUTO_INCREMENT PRIMARY KEY,
					nom varchar(255) not null,
					id_eleve int(11) not null,
					sexe varchar(10),
					statut varchar(10),
					date_naissance varchar(100),
					lieu_naissance varchar(255),
					matricule varchar(20))";
				mysql_query($sql100) or die(mysql_error());
				 
				// Maintenant on insère de nouveaux champs
				for($i=0;$i<count($listeMatiere);$i++){
					$nomMatiere = $listeMatiere[$i]['id_matiere'];
					$sql_2 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_seq5` FLOAT(4,2) null";
					$sql_3 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_seq6` FLOAT(4,2) null";
					$sql_4 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_trim3` FLOAT(4,2) null";
					$sql_5 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_coef` FLOAT(2,1) null";
					$sql_6 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_total` FLOAT(5,2) null";
					$sql_7 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomMatiere."_appreciation` VARCHAR(255) not null";
					$sql_700 = "ALTER TABLE `".$nomTable00."` 
						ADD `".$nomMatiere."` FLOAT(4,2) null";
					mysql_query($sql_2) or die(mysql_error());
					mysql_query($sql_3) or die(mysql_error());
					mysql_query($sql_4) or die(mysql_error());
					mysql_query($sql_5) or die(mysql_error());
					mysql_query($sql_6) or die(mysql_error());
					mysql_query($sql_7) or die(mysql_error());
					mysql_query($sql_700) or die(mysql_error());
				}
				$sql_7000 = "ALTER TABLE `".$nomTable00."` 
							ADD moyenne FLOAT(4,2) null";
				mysql_query($sql_7000);
				$groupe = $this->getGroupeClasse($classe);
				for($j=0;$j<count($groupe);$j++){
					$nomGroupe = $groupe[$j];
					$sql_10 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_total` FLOAT(5,2) null";
					$sql_11 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_coef` FLOAT(4,2) null";
					$sql_12 = "ALTER TABLE `".$nomTable."` 
						ADD `".$nomGroupe."_moyenne` FLOAT(4,2) null";
					mysql_query($sql_10) or die(mysql_error());
					mysql_query($sql_11) or die(mysql_error());
					mysql_query($sql_12) or die(mysql_error());
				}
				$sql_20 = "ALTER TABLE `".$nomTable."`ADD total_point FLOAT(5,2) null";
				$sql_21 = "ALTER TABLE `".$nomTable."`ADD total_coef FLOAT(4,2) null";
				$sql_22 = "ALTER TABLE `".$nomTable."`ADD moyenne FLOAT(4,2) null";
				$sql_23 = "ALTER TABLE `".$nomTable."`ADD appreciation VARCHAR(100) null";
				$sql_24 = "ALTER TABLE `".$nomTable."`ADD classes INT(11) null";
				$sql_25 = "ALTER TABLE `".$nomTable."`ADD rang varchar(10) null";
				mysql_query($sql_20) or die(mysql_error());
				mysql_query($sql_21) or die(mysql_error());
				mysql_query($sql_22) or die(mysql_error());
				mysql_query($sql_23) or die(mysql_error());
				mysql_query($sql_24) or die(mysql_error());
				mysql_query($sql_25) or die(mysql_error());
			}
			
			
			
		}
		
		
		
		
		
		
		
		
		
		
		
		protected function createTableAnnuelle($classe){
			$listeMatiere = $this->listeMatiereClasse($classe);
			$nomTableAnnuelle = "Note_annuelle_".$classe;
			$nomTableViewAnnuelle = 'view_annuelle_'.$classe;
			
			// On supprime d'abord les tables si elles existent
			$sql_100 = "DROP TABLE IF EXISTS ".$nomTableAnnuelle;	
			$sql_200 = "DROP TABLE IF EXISTS ".$nomTableViewAnnuelle;
			mysql_query($sql_100) or die(mysql_error());
			mysql_query($sql_200) or die(mysql_error());
			
			// Maintenant on crée la table de visualisation
			$sql_201 = "CREATE TABLE ".$nomTableViewAnnuelle."(
						id int(11) AUTO_INCREMENT PRIMARY KEY,
						nom varchar(255) not null,
						id_eleve int(11) not null,
						sexe varchar(10),
						statut varchar(10),
						date_naissance varchar(100),
						lieu_naissance varchar(255),
						matricule varchar(20))
				";
			mysql_query($sql_201) or die(mysql_error());
			// Maintenant on insère de nouveaux champs	
			for($i=0;$i<count($listeMatiere);$i++){
				$nomMatiere = $listeMatiere[$i]['id_matiere'];
				$sql_202 = "ALTER TABLE `".$nomTableViewAnnuelle."` 
							ADD `".$nomMatiere."` FLOAT(4,2) null";
				mysql_query($sql_202) or die(mysql_error());
			}				
				
				
			// Créons aussi la table qui contiendra les notes à proprement dites annuelles 
			$sql_101 = "CREATE TABLE ".$nomTableAnnuelle."(
						id int(11) AUTO_INCREMENT PRIMARY KEY,
						nom varchar(255) not null,
						id_eleve int(11) not null,
						sexe varchar(10),
						statut varchar(10),
						date_naissance varchar(100),
						lieu_naissance varchar(255),
						matricule varchar(20))
				";
			mysql_query($sql_101) or die(mysql_error());	
			// Insérons aussi ses nouveaux champs 
			for($j=0;$j<count($listeMatiere);$j++){
				$nomMatiere = $listeMatiere[$j]['id_matiere'];
				$sql_102 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_trim1` FLOAT(4,2) null";
				$sql_103 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_trim2` FLOAT(4,2) null";
				$sql_104 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_trim3` FLOAT(4,2) null";
				$sql_105 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_annuel` FLOAT(4,2) null";
				$sql_106 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_coef` FLOAT(4,2) null";
				$sql_107 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_total` FLOAT(4,2) null";
				$sql_108 = "ALTER TABLE `".$nomTableAnnuelle."` 
							ADD `".$nomMatiere."_appreciation` FLOAT(4,2) null";
				mysql_query($sql_102) or die(mysql_error());
				mysql_query($sql_103) or die(mysql_error());
				mysql_query($sql_104) or die(mysql_error());
				mysql_query($sql_105) or die(mysql_error());
				mysql_query($sql_106) or die(mysql_error());
				mysql_query($sql_107) or die(mysql_error());
				mysql_query($sql_108) or die(mysql_error());
			}
			$groupe = $this->getGroupeClasse($classe);	
			for($k=0;$k<count($groupe);$k++){
				$nomGroupe = $groupe[$k];
				$sql_109 = "ALTER TABLE `".$nomTableAnnuelle."` 
						ADD `".$nomGroupe."_trim1` FLOAT(5,2) null";
				$sql_110 = "ALTER TABLE `".$nomTableAnnuelle."` 
						ADD `".$nomGroupe."_trim2` FLOAT(5,2) null";
				$sql_111 = "ALTER TABLE `".$nomTableAnnuelle."` 
						ADD `".$nomGroupe."_trim3` FLOAT(5,2) null";
				$sql_112 = "ALTER TABLE `".$nomTableAnnuelle."` 
						ADD `".$nomGroupe."_total` FLOAT(5,2) null";
				$sql_113 = "ALTER TABLE `".$nomTableAnnuelle."` 
						ADD `".$nomGroupe."_coef` FLOAT(4,2) null";
				$sql_114 = "ALTER TABLE `".$nomTableAnnuelle."` 
						ADD `".$nomGroupe."_moyenne` FLOAT(4,2) null";
				mysql_query($sql_109) or die(mysql_error());
				mysql_query($sql_110) or die(mysql_error());
				mysql_query($sql_111) or die(mysql_error());
				mysql_query($sql_112) or die(mysql_error());
				mysql_query($sql_113) or die(mysql_error());
				mysql_query($sql_114) or die(mysql_error());
			}				
			$sql_115 = "ALTER TABLE `".$nomTableAnnuelle."`ADD total_coef FLOAT(4,2) null";	
			$sql_116 = "ALTER TABLE `".$nomTableAnnuelle."`ADD moy_trim1 FLOAT(4,2) null";	
			$sql_117 = "ALTER TABLE `".$nomTableAnnuelle."`ADD moy_trim2 FLOAT(4,2) null";	
			$sql_118 = "ALTER TABLE `".$nomTableAnnuelle."`ADD moy_trim3 FLOAT(4,2) null";	
			$sql_119 = "ALTER TABLE `".$nomTableAnnuelle."`ADD moy_annuelle FLOAT(4,2) null";	
			$sql_120 = "ALTER TABLE `".$nomTableAnnuelle."`ADD rang_annuel FLOAT(4,2) null";	
			$sql_121 = "ALTER TABLE `".$nomTableAnnuelle."`ADD appr_annuelle VARCHAR(100) null";	
			$sql_122 = "ALTER TABLE `".$nomTableAnnuelle."`ADD classes_ann INT(11) null";	
			mysql_query($sql_115) or die(mysql_error());
			mysql_query($sql_116) or die(mysql_error());
			mysql_query($sql_117) or die(mysql_error());
			mysql_query($sql_118) or die(mysql_error());
			mysql_query($sql_119) or die(mysql_error());
			mysql_query($sql_120) or die(mysql_error());
			mysql_query($sql_121) or die(mysql_error());
			mysql_query($sql_122) or die(mysql_error());
				
				
				
				
				
				
		}
		
		
		
		
		
		/**********************************************************************************
		***********************************************************************************
		***********************				INSERT INTO  	*******************************
		***********************************************************************************
		**********************************************************************************/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*********************
		On ajoute les noms des élèves dans les tables devant traiter les 
		notes séquentielles
		*****************************************************************/
		private function ajouteInformationsTableSequence($periode, $classe,$table){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$tab2 = 'moyennes_'.$table;
			for($i=0;$i<count($listeEleve);$i++){
				$nomEleve = strtoupper($listeEleve[$i]['nom']);
				$nomEleve .= " ";
				$nomEleve .= ucwords($listeEleve[$i]['prenom']);
				$sexeEleve = $listeEleve[$i]['sexe'];
				$statutEleve = $listeEleve[$i]['statut'];
				$effectifClasse = count($listeEleve);
				$dateNaissance = $listeEleve[$i]['date_naissance'];
				$lieuNaissance = $listeEleve[$i]['lieu_naissance'];
				$classeEleve = $classe;
				$matriculeEleve = $listeEleve[$i]['matricule'];
				$idEleve = $listeEleve[$i]['id'];
				
				$sql_1 = "INSERT INTO ".$table."(nom, sexe, statut, effectif, 
									date_naissance, lieu_naissance, classe, 
									matricule,
									id_eleve)
							VALUES('$nomEleve','$sexeEleve','$statutEleve',
							'$effectifClasse','$dateNaissance','$lieuNaissance',
							'$classeEleve','$matriculeEleve','$idEleve')";
				mysql_query($sql_1) or die(mysql_error());
				
				$sql_2 = "INSERT INTO ".$tab2."(nom, sexe, statut, effectif, 
									date_naissance, lieu_naissance, classe, 
									matricule,
									id_eleve)
							VALUES('$nomEleve','$sexeEleve','$statutEleve',
							'$effectifClasse','$dateNaissance','$lieuNaissance',
							'$classeEleve','$matriculeEleve','$idEleve')";
				mysql_query($sql_2) or die(mysql_error());
				
				// Insertion des points dans les cases correspondantes
				$variable = $this->viewNoteEleveSequence($idEleve, $periode);
				for($w=0;$w<count($variable);$w++){
					$matiere = 'nt_'.$variable[$w]['id_matiere'];
					$note = $variable[$w]['note_simple'];
					$insert = "UPDATE ".$table."
						SET ".$matiere."='".$note."'
						WHERE id_eleve = '".$idEleve."'";
					mysql_query($insert) or die(mysql_error());
				}
			}
			$requete = "ALTER TABLE ".$table."
				DROP `id_eleve`";
			mysql_query($requete) or die(mysql_error());
			$requete = "ALTER TABLE ".$tab2."
				DROP `id_eleve`";
			mysql_query($requete) or die(mysql_error());
			// Insertion des enseignants dans les colonnes enseignants 
				
			$sql = "SELECT id_prof,nom, prenom, coef, id_matiere
					FROM prof_classe, enseignant
					WHERE id_classe='$classe'
						AND login=id_prof";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$champ1 = 'coef_'.$res['id_matiere'];
				
				$sql_17 = "UPDATE ".$table." 
							SET ".$champ1." = ".$res['coef'];
				$champ2 = 'enseignant_'.$res['id_matiere'];
				$nomEns = strtoupper($res['nom'])." ".ucwords($res['prenom']);
				$sql_18 = "UPDATE ".$table." 
							SET ".$champ2." = '".$nomEns."'";
				mysql_query($sql_17) or die(mysql_error());
				mysql_query($sql_18) or die(mysql_error());
			}
		}
		
		
		
		
		
		
		
		
		// On insère les noms et informations des élèves dans la table de notes trimestrielle
		protected function addNameTrimestre($trimestre, $classe){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$nomTable = 'Note_trimestre_'.$trimestre.'_'.$classe;
			$nomTable00 = 'moyenne_trimestre_'.$trimestre.'_'.$classe;
			
			for($i=0;$i<count($listeEleve);$i++){
				$nom = strtoupper($listeEleve[$i]['nom']).' '.ucwords($listeEleve[$i]['prenom']);
				$idEleve = $listeEleve[$i]['id'];
				$sexeEleve = $listeEleve[$i]['sexe'];
				$statutEleve = $listeEleve[$i]['statut'];
				$dateNaissanceEleve = $listeEleve[$i]['date_fr'];
				$lieuNaissanceEleve = strtoupper($listeEleve[$i]['lieu_naissance']);
				$matriculeEleve = $listeEleve[$i]['matricule'];
				$sql = "INSERT INTO ".$nomTable." (nom, id_eleve, sexe, statut, 
											date_naissance, lieu_naissance, matricule)
					VALUES('".$nom."','".$idEleve."','".$sexeEleve."','".$statutEleve."',
							'".$dateNaissanceEleve."','".$lieuNaissanceEleve."', '".$matriculeEleve."')";
				$this->_db->query($sql);
				$sql2 = "INSERT INTO ".$nomTable00." (nom, id_eleve, sexe, statut, 
											date_naissance, lieu_naissance, matricule)
					VALUES('".$nom."','".$idEleve."','".$sexeEleve."','".$statutEleve."',
							'".$dateNaissanceEleve."','".$lieuNaissanceEleve."', '".$matriculeEleve."')";
				mysql_query($sql2) or die(mysql_error());
			}
			
		}
		
		
		
		
		
		
		
		
		
		protected function addNameAnnuel($classe){
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$tableView = 'view_annuelle_'.$classe;
			$tableAnnuelle = 'note_annuelle_'.$classe;
			
			for($i=0;$i<count($listeEleve);$i++){
				$nom = strtoupper($listeEleve[$i]['nom']).' '.ucwords($listeEleve[$i]['prenom']);
				$idEleve = $listeEleve[$i]['id'];
				$sexeEleve = $listeEleve[$i]['sexe'];
				$statutEleve = $listeEleve[$i]['statut'];
				$dateNaissanceEleve = $listeEleve[$i]['date_fr'];
				$lieuNaissanceEleve = strtoupper($listeEleve[$i]['lieu_naissance']);
				$matriculeEleve = $listeEleve[$i]['matricule'];
				
				$sql_100 = "INSERT INTO ".$tableView." (nom, id_eleve, sexe, statut, 
											date_naissance, lieu_naissance, matricule)
					VALUES('".$nom."','".$idEleve."','".$sexeEleve."','".$statutEleve."',
							'".$dateNaissanceEleve."','".$lieuNaissanceEleve."', '".$matriculeEleve."')";
				
				$sql_101 = "INSERT INTO ".$tableAnnuelle." (nom, id_eleve, sexe, statut, 
											date_naissance, lieu_naissance, matricule)
					VALUES('".$nom."','".$idEleve."','".$sexeEleve."','".$statutEleve."',
							'".$dateNaissanceEleve."','".$lieuNaissanceEleve."', '".$matriculeEleve."')";
				
				mysql_query($sql_100) or die(mysql_error());
				mysql_query($sql_101) or die(mysql_error());
			}
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************************
		***********************************************************************************
		***********************			SELECT FROM  	***********************************
		***********************************************************************************
		**********************************************************************************/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Calcule le produit trimestriel d'une note donnée
		protected function genereProduitTrimestre($note, $coef){
			$produit = $note*$coef;
			return $produit;
		}
		
		
		
		
		
		
		
		
		// Affiche les notes trimestrielles de l'élève
		 public function afficheBulletinEleve($eleve, $nomTable){
			 $sql = "SELECT * FROM $nomTable WHERE id_eleve = '$eleve'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat = $res;
			}
			return $resultat;
		 }
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// On sélectionne les notes de deux séquences pour les compacter
		private function prepaNoteTrim($trimestre, $classe){
			if(empty($classe) or empty($trimestre)){
				$_SESSION['message'] = 'Toutes les valeurs doivent être renseignées.';
				header('Location: '.$source);
			}
			else{
				if($trimestre==1){
					$sequence_1 = 1;
					$sequence_2 = 2;
					// On commence par extraire les élèves de la classe concernée
					$listeEleve = $this->listeEleve($classe, 'non_supprime');
					print_r($listeEleve);
					// Ensuite, pour chaque élève, on ressort ses notes par séquence
					for($i=0;$i<count($listeEleve);$i++){
						$codeEleve = $listeEleve[$i]['id'];
						$eleveNote['seq1'][] = $this->viewNoteEleveSequence($codeEleve, $sequence_1);
						$eleveNote['seq2'][] = $this->viewNoteEleveSequence($codeEleve, $sequence_2);
					}
					return $eleveNote;
				}
				elseif($trimestre==2){
					$sequence_1 = 3;
					$sequence_2 = 4;
					// On commence par extraire les élèves de la classe concernée
					$listeEleve = $this->listeEleve($classe, 'non_supprime');
					// Ensuite, pour chaque élève, on ressort ses notes par séquence
					for($i=0;$i<count($listeEleve);$i++){
						$codeEleve = $listeEleve[$i]['id'];
						$eleveNote['seq3'][] = $this->viewNoteEleveSequence($codeEleve, $sequence_1);
						$eleveNote['seq4'][] = $this->viewNoteEleveSequence($codeEleve, $sequence_2);
					}
					return $eleveNote;
				}
				elseif($trimestre==3){
					$sequence_1 = 5;
					$sequence_2 = 6;
					// On commence par extraire les élèves de la classe concernée
					$listeEleve = $this->listeEleve($classe, 'non_supprime');
					// Ensuite, pour chaque élève, on ressort ses notes par séquence
					for($i=0;$i<count($listeEleve);$i++){
						$codeEleve = $listeEleve[$i]['id'];
						$eleveNote['seq5'][] = $this->viewNoteEleveSequence($codeEleve, $sequence_1);
						$eleveNote['seq6'][] = $this->viewNoteEleveSequence($codeEleve, $sequence_2);
					}
					return $eleveNote;
				}
			}
		}
		
		
		
		
		
		
		
		
		// Les notes qui étaient dans les tables provisoires doivent être copiées à la table finale
		protected function copieNoteProvisoire($periode, $classe){
			$tableCoef = 'provisoire_coef_trimestre_'.$classe;
			$tableMatiere = 'provisoire_matiere_trimestre_'.$classe;
			// On commence par ressortir les groupes définis dans la classe
			$groupes  = $this->getGroupeClasse($classe);
			for($i=0;$i<count($groupes);$i++){
				// Pour chaque groupe, on invoque ses matières
				$groupe = $groupes[$i];
				$matieres = $this->matiereGroupe($groupes[$i], $classe);
				// print_r($matieres);
				for($a=0;$a<count($matieres);$a++){
					$matiere[$groupe][$a] = $matieres[$a]['id_matiere'];
					$mat = $matiere[$groupe][$a];
					$sql = "SELECT id_eleve FROM $tableCoef";
					$req = $this->_db->query($sql);
				}
				
				
			echo '<h1>End Groupe : '.$groupe.'.</h1>';	
			}
			
		}
		
		
		
		
		
		
		
		
		
		// La Table qui contient les informations de bulletins trimestriels
		public function tableTrimestre($periode, $classe){
			$nomTable = "trimestre_".$periode."_".$classe;
			$sql = "SELECT * FROM $nomTable";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		// La Table qui contient les informations de bulletins séquentiels
		public function tableSequence($periode, $classe){
			$nomTable = "sequence_".$periode."_".$classe;
			$sql = "SELECT * FROM $nomTable";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		/*Dans la Table Trimestrielle, on extrait les noms des élèves
		qui méritent un tAbleau d'Honneur, c'est à dire qui onr une moyenne supérieure 
		ou égale à 12 */
		public function tableauTrimestre($periode, $classe){
			$nomTable = "trimestre_".$periode."_".$classe;
			$sql = "SELECT * 
					FROM $nomTable
					WHERE moyenne >=12";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		public function tableTrimestreMerite($periode, $classe){
			$nomTable = "trimestre_".$periode."_".$classe;
			$sql = "SELECT * FROM $nomTable ORDER BY moyenne DESC";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		public function tableSequenceMerite($periode, $classe){
			$nomTable = "sequence_".$periode."_".$classe;
			$sql = "SELECT * FROM $nomTable ORDER BY moyenne DESC";
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		// La Table qui contient les informations de bulletins Annuels
		public function tableAnnuelle($classe){
			$nomTable = "annuel_".$classe;
			$sql = "SELECT * FROM $nomTable";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		private function noteTrimestreUn($classe){
			$suffixe = '_trim1';
			$getMatiere = 
			$sql = "SELECT ";
		}
		
		
		
		
		
		
		
		
		
		public function getMoyenneTrimestre($periode){
			if($periode==1){
				// Le trimestre est un 
				// On recolte les notes y afférentes 
				$sql = "SELECT * FROM ";
				
			}
			elseif($periode==2){
				// Le trimestre est deux 
				
			}
			elseif($periode==3){
				// Le trimestre est trois 
				
			}
			else{
				
			}
		}
		
		/**********************************************************************************
		***********************************************************************************
		***********************			UPDATE TABLE 	***********************************
		***********************************************************************************
		**********************************************************************************/
		
		
		
		
		
		
		
		
		
		
		
		/*private function calculTotalSequence($eleve,$sequence,$classe){
			// On récupère le total des points et coef par groupe.
			$groupes = $this->afficheGroupe($classe);
			$nb = count($groupes);
			for($i=0;$i<$nb;$i++){
				$gpe[$i] = $groupes[$i]['groupe'];
				
				$champPts = 'points_'.$gpe[$i];
				$champCoef = 'coefs_'.$gpe[$i];
				$nomTable = 'moyennes_sequence_'.$sequence.'_'.$classe;
				$sql = "SELECT $champPts, $champCoef
						FROM $nomTable
						WHERE nom='$eleve'";
				$req = mysql_query($sql)or die(mysql_error());
				$res = $req->fetchAll(PDO::FETCH_ASSOC);{
					$points[] = $res[$champPts];
					$coef[] = $res[$champCoef];
				}
				// On les stocke dans leurs variables respectives et ensuite 
				// on les somme
				if($nb == count($points)){
					$totalPoints = array_sum($points);
					$totalCoefs = array_sum($coef);
					$upd = "UPDATE $nomTable 
							SET total_points = $totalPoints,
							total_coefs = $totalCoefs
							WHERE nom ='$eleve'";
					mysql_query($upd) or die(mysql_error());
				}
			}
		}*/
		
		
		
		
		
		
		
		
		
		/*private function calculMoyenneSequence($eleve,$sequence,$classe){
			/* On récupère d'abord le nombre de Coefficient définis dans la 
			classe.*/
			/*$coefDefinis = $this->coefficientsClasse($classe);
			$nomTable = 'moyennes_sequence_'.$sequence.'_'.$classe;
			// print_r($coefDefinis);
			$sql = "SELECT total_coefs, total_points
						FROM $nomTable 
					WHERE nom='$eleve'";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$coefEleve = $res['total_coefs'];
			$pourcentage = $coefDefinis['somme_coef'] * 70/100;
			if($coefEleve >= $pourcentage){
				// Elève à classer
				$moyenneEleve = $res['total_points']/$coefEleve;
				$appreciation = $this->showAppreciation($moyenneEleve);
				$sql = "UPDATE $nomTable 
						SET moyenne = '$moyenneEleve',
						appreciation = '$appreciation'
						WHERE nom = '$eleve'";
				$this->_db->query($sql);
			}
			else{
				// Elève à ne pas classer
				$moyenneEleve = 0;
				$appreciation = $this->showAppreciation($moyenneEleve);
				$sql = "UPDATE $nomTable 
						SET moyenne = '$moyenneEleve',
						appreciation = '$appreciation'
						WHERE nom = '$eleve'";
				$this->_db->query($sql);
			}
		}*/
		
		
		
		
		
		
		
		
		
		private function calculRangClasseSequence($eleve,$sequence,$classe){
			$nomTable = 'moyennes_sequence_'.$sequence.'_'.$classe;
			// Personnes classées
			$sql = "SELECT count(*) as nb_classes
					FROM $nomTable 
					WHERE moyenne > 0";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$evalues = $res['nb_classes'];
			$requete = "UPDATE $nomTable 
						SET classes='$evalues'";
			mysql_query($requete) or die(mysql_error());
			$sql2 = "SELECT moyenne, nom
					FROM $nomTable";
			$req2 = mysql_query($sql2) or die(mysql_error());
			while($res2 = mysql_fetch_assoc($req2)){
				$moyenne[] = $res2['moyenne'];
				$nom[] = $res2['nom'];
			}
			$moy = arsort($moyenne);
			if($moy){
				$i = 1;
				foreach($moyenne as $cle=>$valeur){
					if($valeur=='0.00'){  //Personne n'est classé
						$rang = 0;
						$sqlFin = "UPDATE $nomTable
									SET rang = '$rang'
									WHERE nom = '$nom[$cle]'";
						mysql_query($sqlFin) or die(mysql_error());
					}
					else{
						if($i==1){  // On gère le cas 1"er"
							$rang = $i."er";
						}
						else{
							$rang = $i."ème";
						}
						$sqlFin = "UPDATE $nomTable
									SET rang = '$rang'
									WHERE nom = '$nom[$cle]'";
						mysql_query($sqlFin) or die(mysql_error());
						$i++;
					}
				}
			}
			else{
				$rang = "NC";
			}
			/*$sqlFin = "UPDATE $nomTable
						SET rang = '$rang'
						WHERE nom = '$nom[$cle]'";
			mysql_query($sqlFin) or die(mysql_error());*/
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************************
		***********************************************************************************
		***********************			DELETE FROM 	***********************************
		***********************************************************************************
		**********************************************************************************/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************
		***********************************************************
		Les Public function 
		***********************************************************
		**********************************************************/
		
		
		
		
		
		
		
		
		
		
		
		public function statTrimestre($periode, $classe){
			$table = 'trimestre_'.$periode.'_'.$classe;
			
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
			
			$tauxMasc = $res3['moyMasc']*100/$res1['evalMasc'];
			$tauxFille = $res4['moyFille']*100/$res2['evalFille'];
			
			$sql = "SELECT count(moyenne) as moyTotal 
					FROM $table 
					WHERE moyenne >='10.00'";
			$req = $this->_db->query($sql) ;
			$res =$req->fetch(PDO::FETCH_ASSOC);
			$tauxTotal = $res['moyTotal']*100/$evalTotal.' %';
			
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
			$stat['tauxMasc'] = $this->couperChiffre($tauxMasc,5);
			$stat['tauxFille'] = $this->couperChiffre($tauxFille,5);
			$stat['tauxTotal'] = $this->couperChiffre($tauxTotal,5);
			$stat['noteForteMasc'] = $resNFM['maxMasc'];
			$stat['noteForteFille'] = $resNFF['maxFille'];
			$stat['noteForteTotal'] = $resNFT['maxTotal'];
			$stat['noteFaibleMasc'] = $res10['minMasc'];
			$stat['noteFaibleFille'] = $res11['minFille'];
			$stat['noteFaibleTotal'] = $res12['minTotal'];
			$stat['moyGenMasc'] = $this->couperChiffre($res20['moyGenMasc'],5);
			$stat['moyGenFille'] = $this->couperChiffre($res21['moyGenFille'],5);
			$stat['moyGenTotal'] = $this->couperChiffre($res22['moyGenTotal'],5);
			return $stat;
		}
		
		
		
		protected function couperChiffre($chaine, $tailleMax){
			$positionDernierEspace = 0;
			if(strlen($chaine)>=$tailleMax){
				
				$chaine = substr($chaine,0,$tailleMax);
				$positionDernierEspace = strrpos($chaine,'');
				$chaine .= substr($chaine,0,$positionDernierEspace);
			}
			return $chaine;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function statAnnuelle($classe){
			$table = 'annuel_'.$classe;
			
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
			$res5 = $req5->fetch(PDO::FETCH_ASSOC);
			
			$sql6 = "SELECT count(moyenne) as sousMoyFille 
					FROM $table 
					WHERE moyenne <10 AND moyenne > '0.00' AND sexe = 'F'";
			$req6 = $this->_db->query($sql6);
			$res6 = $req6->fetch(PDO::FETCH_ASSOC);
			
			
			
			$moyTotal = $res3['moyMasc'] + $res4['moyFille'];
			$sousMoyTotal = $res5['sousMoyMasc'] + $res6['sousMoyFille'];
			
			$tauxMasc = $res3['moyMasc']*100/$res1['evalMasc'].' %';
			$tauxFille = $res4['moyFille']*100/$res2['evalFille'].' %';
			
			$sql = "SELECT count(moyenne) as moyTotal 
					FROM $table 
					WHERE moyenne >='10.00'";
			$req = $this->_db->query($sql);
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$tauxTotal = $res['moyTotal']*100/$evalTotal.' %';
			
			$sqlNFM = "SELECT MAX(moyenne) as maxMasc 
					FROM $table 
					WHERE sexe = 'M' AND moyenne > '0.00'";
			$reqNFM = $this->_db->query($sqlNFM);
			$resNFM = $reqNFM->fetch(PDO::FETCH_ASSOC);
			
			$sqlNFF = "SELECT MAX(moyenne) as maxFille 
					FROM $table 
					WHERE sexe = 'F' AND moyenne >'0.00'";
			$reqNFF = $this->_db->query($sqlNFF);
			$resNFF = $reqNFF->fetch(PDO::FETCH_ASSOC);
			
			$sqlNFT = "SELECT MAX(moyenne) as maxTotal 
					FROM $table 
					WHERE moyenne > '0.00'";
			$reqNFT = $this->_db->query($sqlNFT);
			$resNFT = $reqNFT->fetch(PDO::FETCH_ASSOC);
			
			$sql10 = "SELECT MIN(moyenne) as minMasc 
					FROM $table 
					WHERE sexe = 'M' AND moyenne >'0.00'";
			$req10 = $this->_db->query($sql10);
			$res10 = $req10->fetch(PDO::FETCH_ASSOC);
			
			$sql11 = "SELECT MIN(moyenne) as minFille 
					FROM $table 
					WHERE sexe = 'F' AND moyenne >'0.00'";
			$req11 = $this->_db->query($sql11);
			$res11 = $req11->fetch(PDO::FETCH_ASSOC);
			
			$sql12 = "SELECT MIN(moyenne) as minTotal 
					FROM $table 
					WHERE moyenne >'0.00'";
			$req12 = $this->_db->query($sql12);
			$res12 = $req12->fetch(PDO::FETCH_ASSOC);
			
			$sql20 = "SELECT AVG(moyenne) as moyGenMasc 
					FROM $table 
					WHERE sexe='M' AND moyenne>'0.00'";
			$req20 = $this->_db->query($sql20);
			$res20 = $req20->fetch(PDO::FETCH_ASSOC);
			
			$sql21 = "SELECT AVG(moyenne) as moyGenFille 
					FROM $table 
					WHERE sexe='F' AND moyenne>'0.00'";
			$req21 = $this->_db->query($sql21);
			$res21 = $req21->fetch(PDO::FETCH_ASSOC);
			
			$sql22 = "SELECT AVG(moyenne) as moyGenTotal 
					FROM $table 
					WHERE moyenne>'0.00'";
			$req22 = $this->_db->query($sql22);
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
			$stat['tauxMasc'] = $tauxMasc;
			$stat['tauxFille'] = $tauxFille;
			$stat['tauxTotal'] = $tauxTotal;
			$stat['noteForteMasc'] = $resNFM['maxMasc'];
			$stat['noteForteFille'] = $resNFF['maxFille'];
			$stat['noteForteTotal'] = $resNFT['maxTotal'];
			$stat['noteFaibleMasc'] = $res10['minMasc'];
			$stat['noteFaibleFille'] = $res11['minFille'];
			$stat['noteFaibleTotal'] = $res12['minTotal'];
			$stat['moyGenMasc'] = $res20['moyGenMasc'];
			$stat['moyGenFille'] = $res21['moyGenFille'];
			$stat['moyGenTotal'] = $res22['moyGenTotal'];
			return $stat;
		}
		
		
		
		
		
		
		
		
		
		
		
		/*************
		On a validé le bouton TRAITER LES NOTES SEQUENTIELLES
		******************************************************/
		public function traiterNoteSequence($source,$periode, $classe){
			// On crée d'abord la table qui va accueillir les notes et moyennes 
			// de la séquence 
			$table = "sequence_".$periode."_".$classe;
			$req_crea = "CREATE TABLE $table (";
			$req_crea .= "id int(11) auto_increment primary key, ";
			$req_crea .= "id_eleve int(11) not null, ";
			$req_crea .= "nom_eleve varchar(255) not null, ";
			$req_crea .= "sexe varchar(1) not null, ";
			$req_crea .= "date_naissance date not null, ";
			$req_crea .= "date_fr varchar(255) not null, ";
			$req_crea .= "lieu_naissance varchar(255) not null, ";
			$req_crea .= "matricule varchar(255) not null, ";
			$req_crea .= "rne varchar(255) not null, ";
			$req_crea .= "adresse_parent varchar(255) not null, ";
			$req_crea .= "statut varchar(1) not null, ";
			$listeMatiere = $this->listeMatiereClasse($classe);
			
			for($a=0;$a<count($listeMatiere);$a++){
				$matiere = $listeMatiere[$a]['id_matiere'];
				$req_creation_0 = "`".$matiere."_competence` varchar(255) NULL, ";
				$req_creation_1 = "`".$matiere."_seq1` decimal(4,2) DEFAULT NULL, ";
				$req_creation_2 = "`".$matiere."_coef` decimal(4,2) NULL, ";
				$req_creation_3 = "`".$matiere."_total` decimal(5,2) NULL, ";
				$req_creation_4 = "`".$matiere."_min` decimal(4,2) NULL, ";
				$req_creation_5 = "`".$matiere."_max` decimal(4,2) NULL, ";
				$req_creation_6 = "`".$matiere."_appreciation` varchar(255) not null, ";
				$req_creation_7 = "`".$matiere."_cote` varchar(255) not null, ";
				$req_creation_8 = "`".$matiere."_enseignant` varchar(255) not null, ";
				
				$req_crea .= $req_creation_0;
				$req_crea .= $req_creation_1;
				$req_crea .= $req_creation_2;
				$req_crea .= $req_creation_3;
				$req_crea .= $req_creation_4;
				$req_crea .= $req_creation_5;
				$req_crea .= $req_creation_6;
				$req_crea .= $req_creation_7;
				$req_crea .= $req_creation_8;
			}
			$groupe = $this->getGroupeClasse($classe);
			for($b=0;$b<count($groupe);$b++){
				$gp = $groupe[$b];
				$req_crea .= $gp."_total decimal(5,2) NULL, ";
				$req_crea .= $gp."_coef decimal(4,2) NULL, ";
				$req_crea .= $gp."_moyenne decimal(4,2) NULL, ";
				$req_crea .= $gp."_min decimal(4,2) NULL, ";
				$req_crea .= $gp."_max decimal(4,2) NULL, ";
				$req_crea .= $gp."_appreciation varchar(255) NULL, ";
				$req_crea .= $gp."_cote varchar(100) NULL, ";
			}
			
			$req_crea .= "total_point decimal(5,2) NULL, ";
			$req_crea .= "total_coef decimal(4,2) NULL, ";
			$req_crea .= "moyenne decimal(4,2) NULL, ";
			$req_crea .= "min decimal(4,2) NULL, ";
			$req_crea .= "max decimal(4,2) NULL, ";
			$req_crea .= "appreciation varchar(100), ";
			$req_crea .= "cote varchar(100), ";
			$req_crea .= "classes int(11), ";
			$req_crea .= "rang varchar(100) not null, ";
			$req_crea .= "absence_total int(11) null, ";
			$req_crea .= "absence_non_just int(11) null, ";
			$req_crea .= "absence_just int(11) null, ";
			$req_crea .= "photo varchar(255) null ";
			$req_crea .= ")";
			
			$req_1 = $this->_db->query("DROP TABLE IF EXISTS ".$table.";"); 
			$req_2 = $this->_db->query($req_crea);
			
			// Après avoir crée la table, on insère les noms des élèves dans la table créée.
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			for($c=0;$c<count($listeEleve);$c++){
				$idEleve = $listeEleve[$c]['id'];
				$nomEleve = strtoupper($listeEleve[$c]['nom'])." ";
				$nomEleve .= ucwords($listeEleve[$c]['prenom']);
				$sexeEleve = $listeEleve[$c]['sexe'];
				$dateNaissance = $listeEleve[$c]['date_naissance'];
				$date_fr = $listeEleve[$c]['date_fr'];
				$lieuNaissance = strtoupper($listeEleve[$c]['lieu_naissance']);
				$matriculeEleve = $listeEleve[$c]['matricule'];
				$rneEleve = $listeEleve[$c]['rne'];
				$adresseParent = $listeEleve[$c]['adresse_parent'];
				$statut = $listeEleve[$c]['statut'];
				$photo = $listeEleve[$c]['photo'];
				
				$sql_insert = "INSERT INTO $table(id_eleve, 
													nom_eleve,
													sexe, 
													date_naissance,
													date_fr,
													lieu_naissance,
													matricule, statut, photo, rne, adresse_parent)";
				$sql_insert .= " VALUES('$idEleve',
										'$nomEleve',
										'$sexeEleve',
										'$dateNaissance',
										'$date_fr',
										'$lieuNaissance',
										'$matriculeEleve',
										'$statut', '$photo', '$rneEleve', '$adresseParent')";
				$req_3 = $this->_db->query($sql_insert);
				/*En fonction de la séquence on fait les calculs et on applique un coefficient ainsi que les 
				moyennes par matières et appréciation qui s'imposent */
				if($periode==1){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	1, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 1 
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
					
					
					// On produit les Notes sequentielles par matière 
					$this->calculNoteSequence(1, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}
				elseif($periode==2){
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
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}
				elseif($periode==3){
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
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}
				elseif($periode==4){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	4, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 4 
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
					$this->calculNoteSequence(4, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);
					
					// On Introduit les heures d'Absence qu'il faut  
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}
				elseif($periode==5){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	5, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 5 
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
					$this->calculNoteSequence(5, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);
					
					// On Introduit les heures d'Absence qu'il faut  
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}
				elseif($periode==6){
					$sequence_1 = $this->viewNoteSequentielleEleve($classe,
																	6, 
																	$idEleve);
					// print_r($sequence_2);
					// On introduit les Notes de la Séquence 1 
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
					$this->calculNoteSequence(6, $classe, $idEleve);
					$req_traite = "INSERT INTO bull_seq(pret, classe, sequence) ";
					$req_traite .= "VALUES('oui', '$classe', '$periode')";
					$req_traite_del = "DELETE FROM bull_seq";
					$req_traite_del .= " WHERE classe='$classe' 
											AND sequence='$periode'";
					$exec_traite_del = $this->_db->query($req_traite_del);
					$exec_traite = $this->_db->query($req_traite);
					
					// On Introduit les heures d'Absence qu'il faut  
					/*$absences = $this->calculAbsenceTrimestre($idEleve,1);
					$sql_10 = "UPDATE $table SET 
								absence_total = '".$absences['total']."',
								absence_non_just = '".$absences['non_justif']."',
								absence_just = '".$absences['justif']."'
								WHERE id_eleve = '$idEleve'";
					$this->_db->query($sql_10);*/
					// print_r($absences);
					
					$_SESSION['message'] = "Notes de la Séquence ";
					$_SESSION['message'] .= $periode." traitées";
					header('Location: '.$source);
				}
								
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*************
		On a validé le bouton TRAITER LES MOYENNES SEQUENTIELLES
		******************************************************/
		public function traiterMoyenneSequence($source, $periode, $classe){
			$table = "sequence_".$periode."_".$classe;
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			// print_r($listeEleve);
			$section = $this->getSection($classe);			
			// On fait un traitement pour chaque élève de la classe 
			for($i=0;$i<count($listeEleve);$i++){
				$idEleve = $listeEleve[$i]['id'];
				$nom = strtoupper($listeEleve[$i]['nom']);
				$prenom = ucwords($listeEleve[$i]['prenom']);
				$nomComplet = $nom.' '.$prenom;
				
				
				// On récupère les matières par Groupe 
				$groupe = $this->getGroupeClasse($classe);
				// print_r($groupe);	
				for($a=0;$a<count($groupe);$a++){
					$matieres = $this->getMatiereGroupe($groupe[$a],$classe);
					// print_r($matieres);
					for($b=0;$b<count($matieres);$b++){
						$codeGroupe = $groupe[$a];
						$champMatiere = $matieres[$b]['id_matiere'].'_total';
						$champCoef = $matieres[$b]['id_matiere'].'_coef';
						$champEnseignant = $matieres[$b]['id_matiere'].'_enseignant';
						$nomEnseignant = strtoupper($matieres[$b]['nom']).' ';
						$nomEnseignant .= ucwords($matieres[$b]['prenom']);
						// echo $champEnseignant.' = '.$nomEnseignant.' <br/>';
						$sql_gp_note = "SELECT $champMatiere 
										FROM $table 
										WHERE id_eleve = '$idEleve'";
						// echo $sql_gp_note;
						$req_gp_note = $this->_db->query($sql_gp_note);
						$res_gp_note = $req_gp_note->fetch(PDO::FETCH_ASSOC);
						$champTotalMatiere[$codeGroupe][$champMatiere] = $res_gp_note[$champMatiere];
						$sql_gp_coef = "SELECT $champCoef 
										FROM $table 
										WHERE id_eleve = '$idEleve'";
						// echo $sql_gp_coef;
						$req_gp_coef = $this->_db->query($sql_gp_coef);
						$res_gp_coef = $req_gp_coef->fetch(PDO::FETCH_ASSOC);
						$champTotalCoef[$codeGroupe][$champCoef] = $res_gp_coef[$champCoef];
					}
					$SommeCoef[$a] = array_sum($champTotalCoef[$codeGroupe]);
					$SommePoint[$a] = array_sum($champTotalMatiere[$codeGroupe]);
					if($SommeCoef[$a]==0){
						$moyenneGroupe[$a] = 0;
					}else{
						$moyenneGroupe[$a] = $SommePoint[$a] / $SommeCoef[$a];
						$apprec = $this->showAppreciation($moyenneGroupe[$a]);
						if($section=='fr'){
							$appreci=$apprec['nom_appreciation'];
							$coteGroupe = $apprec['cote'];
						}elseif($section=='en'){
							$appreci=$apprec['nom_appreciation_anglais'];
							$coteGroupe = $apprec['cote'];
						}
					}
					
					$champGroupeTotal = $codeGroupe.'_total';
					$champGroupeCoef = $codeGroupe.'_coef';
					$champGroupeMoyenne = $codeGroupe.'_moyenne';
					$champGroupeAppreciation = $codeGroupe.'_appreciation';
					$champGroupeCote = $codeGroupe.'_cote';
					$sql_upd = "UPDATE $table 
								SET $champGroupeTotal = '$SommePoint[$a]',
								 $champGroupeCoef = '$SommeCoef[$a]',
								 $champGroupeMoyenne = '$moyenneGroupe[$a]',
								 $champEnseignant = '$nomEnseignant',
								 $champGroupeAppreciation = '$appreci',
								 $champGroupeCote = '$coteGroupe'
								WHERE id_eleve = '$idEleve'";
					$req_upd = $this->_db->query($sql_upd);
				}
				$totalPoint = array_sum($SommePoint);
				$totalCoef = array_sum($SommeCoef);
				/*Pour être classé, le total des Coef doit être supérieur ou égale à 60% des coef 
				définis dans la classe */
				$CoefDefinis = $this->getCoefClasse($classe);
				$classementPossible = $CoefDefinis * 60 /100;
				if($totalCoef>=$classementPossible){
					$moyenne = $totalPoint / $totalCoef;
					$appr = $this->showAppreciation($moyenne);
					if($section=='fr'){
						$appreciation = $appr['nom_appreciation'];
					}elseif($section='en'){
						$appreciation = $appr['nom_appreciation_anglais'];	
					}
					$cote = $appr['cote'];
				}
				else{
					$moyenne = 0;
					$appreciation= 'Non Classé';
					$cote= '';
				}
				$sql_upd2 = "UPDATE $table 
							SET total_point = '$totalPoint',
								total_coef = '$totalCoef',
								moyenne = '$moyenne',
								appreciation = '$appreciation',
								cote = '$cote'
							WHERE id_eleve='$idEleve'";
				$req_upd2 = $this->_db->query($sql_upd2);
				
				$sql = "SELECT count(moyenne) as classes 
						FROM $table 
						WHERE moyenne !='0.00'";
				$req = $this->_db->query($sql);
				$res = $req->fetch(PDO::FETCH_ASSOC);
				$classes = $res['classes'];
				$sql_upd3 = "UPDATE $table 
								SET classes = '$classes'";
				$req_upd3 = $this->_db->query($sql_upd3);
			}
			$rang = $this->showRangEleve($table);
			for($j=0;$j<count($rang['resultat']);$j++){
				echo "<p>L'élève ".$rang['id'][$j]." a obtenu ".$rang['resultat'][$j]." et est classé "; 
						echo $rang['rang'][$j].".</p>";
				$rank = $rang['rang'][$j];
				$id = $rang['id'][$j];
				$moy = $rang['resultat'][$j];
				$sql = "UPDATE $table 
						SET rang = '$rank'
						WHERE  moyenne = '$moy'";
				$req = $this->_db->query($sql);
			}
			$_SESSION['message'] = 'Moyennes de la classe de '.$classe;
			$_SESSION['message'] .= ' traitées pour la Séquence '.$periode;
			$_SESSION['message'] .= '. Vous pouvez imprimer les bulletins de la classe.';
			header('Location: '.$source);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************************
		***********************************************************************
		******** 	PARAMETRAGE DES NOTES DE TRIMESTRE  		***************
		***********************************************************************
		**********************************************************************/
		
		
		
		/**********************************************************
		***********************************************************
		Les Private function 
		***********************************************************
		**********************************************************/
		
		
		/****************************************************
		ON CREE LA TABLE POUR VISUALISER LES NOTES TRIMESTRIELLES
		******************************************************/
		private function tableNoteTrimestre($periode, $classe){
			$listeMatiere = $this->listeMatiereClasse($classe);
			$nomTable = "view_trimestre_".$periode."_".$classe;
			// On supprime d'abord la table si elle existe 
			$sql_1 = "DROP TABLE IF EXISTS ".$nomTable;
			mysql_query($sql_1) or die(mysql_error());
			// Ensuite on la créé à nouveau
			$sql = "CREATE TABLE ".$nomTable."(
						id int(11) AUTO_INCREMENT PRIMARY KEY,
						nom varchar(255) not null,
						id_eleve int(11) not null,
						sexe varchar(10),
						statut varchar(10),
						date_naissance date,
						matricule varchar(20))";
			$this->_db->query($sql);
			$nomMatiere = $listeMatiere[0]['id_matiere'];
			// Maintenant on insère de nouveaux champs
			for($i=0;$i<count($listeMatiere);$i++){
				$nomMatiere = $listeMatiere[$i]['id_matiere'];
				$sql_2 = "ALTER TABLE `".$nomTable."` 
							ADD `".$nomMatiere."` FLOAT(4,2) null";
				mysql_query($sql_2) or die(mysql_error());
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**********************************************************
		***********************************************************
		Les Public function 
		***********************************************************
		**********************************************************/
		
		/*Visualiser les Notes Trimestrielles d'une classe */
		public function viewNoteTrimestrielle($periode,$classe){
			// On appelle la fonction qui créé notre table
			$this->tableNoteTrimestre($periode, $classe);
			// Ensuite on extrait les notes de la table note pour insertion
			// dans notre table de destination.
			// On procède de manière unitaire c'est-à-dire que pour une classe,
			// on procède à l'extraction élève par élève. 
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			$nomTable = "view_trimestre_".$periode."_".$classe;
			for($i=0;$i<count($listeEleve);$i++){
				$nomEleve = strtoupper($listeEleve[$i]['nom']);
				$nomEleve .= " ";
				$nomEleve .= ucwords($listeEleve[$i]['prenom']);
				$sexeEleve = $listeEleve[$i]['sexe'];
				$statutEleve = $listeEleve[$i]['statut'];
				$matriculeEleve = $listeEleve[$i]['matricule'];
				$dateNaissance = $listeEleve[$i]['date_naissance'];
				$idEleve = $listeEleve[$i]['id'];
				$sql_1 = "INSERT INTO `".$nomTable."`(nom, sexe, statut, 
								matricule, date_naissance, id_eleve)
						VALUES('$nomEleve','$sexeEleve','$statutEleve',
							'$matriculeEleve','$dateNaissance','$idEleve')";
				mysql_query($sql_1) or die(mysql_error());
				/* Le principe est le suivant : Pour visulaiser les notes 
				trimestrielles d'une classe, il faut absolument avoir visualisé
				ses notes séquentielles. En effet, il s'agira dans cette visua-
				lisation d'aller consulter les deux tables séquentielles et de 
				les mettre en vis à vis afin de produire une note trimestrielle.
				Il faut noter aussi que si l'élève a été évalué dans les deux
				séquences, alors on fait la moyenne de ces notes. Sinon, 
				c'est à dire s'il a été absent à un des examens, on fait une 
				simple addition. */
				if($periode==1){
					// Vérification de l'existence des séquences
					$tableSeq1 = 'view_sequence_1_'.$classe;
					$tableSeq2 = 'view_sequence_2_'.$classe;
					$sql1 = "SHOW TABLES FROM noteplus LIKE '$tableSeq1'";
					$sql2 = "SHOW TABLES FROM noteplus LIKE '$tableSeq2'";
					$verif1 = mysql_query($sql1);
					$verif2 = mysql_query($sql2);
					if($verif1==false or $verif2==false){
						$_SESSION['message'] = "L'une des séquences n'a pas ";
						$_SESSION['message'] .= "été visualisée.";
						header('Location:index.php');
					}
					else{
						$s1 = $this->viewSequenceClasse(1, $classe);
						$s2 = $this->viewSequenceClasse(2, $classe);
						
					}
				}
				elseif($periode==2){ 
					
				}
				elseif($periode==3){ 
					
				}
				
				
				
				
				
				
				
				
				
				
				
				// On va consulter la table note pour récupérer les notes des deux
				// Séquences pour lesquelles faire les travaux trimestriels
				if($periode==1){ // On traite le Trimestre 1
					$var1 = $this->viewNoteEleveSequence($idEleve,1);
					$var2 = $this->viewNoteEleveSequence($idEleve,2);
					for($j=0;$j<count($var1);$j++){
						
					}
					
				}
				elseif($periode==2){ //On traite le Trimestre 2
					$var1 = $this->viewNoteEleveSequence($idEleve,3);
					$var2 = $this->viewNoteEleveSequence($idEleve,4);
				}
				elseif($periode==3){ //On traite le Trimestre 3
					$var1 = $this->viewNoteEleveSequence($idEleve,5);
					$var2 = $this->viewNoteEleveSequence($idEleve,6);
				}
				
				// 
				// for($a=0;$a<count($variable);$a++){
					// $matiere = $variable[$a]['id_matiere'];
					// $note = $variable[$a]['note_simple'];
					
					// $insert = "UPDATE `".$nomTable."` 
								// SET `".$matiere."` = ".$note." 
								// WHERE id_eleve = ".$idEleve."";
					// mysql_query($insert) or die(mysql_error());
				// }
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		/************************************************************************
		*************************************************************************
		*************************************************************************
		********************	TRAITEMENTS DES NOTES ET MOYENNES	*************
		********************										*************
		*************************************************************************
		*************************************************************************
		************************************************************************/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function bulletinAnnuel($classe){
			$table = 'annuel_'.$classe;
			$sql = "SELECT *
					FROM $table";
			// $req = $this->_db->query($sql);
			$req = $this->_db->query($sql);
			while($res = $req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		public function bulletinAnnuelMerite($classe){
			$table = 'annuel_'.$classe;
			$sql = "SELECT *
					FROM $table
					ORDER BY moyenne DESC";
			$req = $this->_db->query($sql);
			while($res =$req->fetch(PDO::FETCH_ASSOC)){
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		// Affiche le contenu des tables générées(sequence, trimestre, annuel)
		private function showNote($table){
			$sql = "SELECT * 
					FROM ".$table;
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat[] = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// Les Coefficient d'un groupe 
		private function coefficientGroupe($gp, $classe){
			$sql = "SELECT SUM(coef) as somme_coef
					FROM prof_classe 
					WHERE groupe='".$gp."'
						AND id_classe = '".$classe."'";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);{
				$resultat = $res;
			}
			return $resultat;
		}
		
		
		
		
		
		
		
		
		
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
			Les Fonctions Privées pour la public function 
			statNotePeriode et la public function statDuProf. */
		private function nbM($nomTable, $periode, $classe){
			$sql = "SELECT count(*) as nbGarcons
					FROM $nomTable
					WHERE sexe = 'M'";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['nbGarcons'];
			return $resultat;
		}
		
		private function nbF($nomTable, $periode, $classe){
			$sql = "SELECT count(*) as nbFilles
					FROM $nomTable
					WHERE sexe = 'F'";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['nbFilles'];
			return $resultat;
		}
		
		private function evalM($nomTable, $periode, $classe, $matiere){
			$sql = "SELECT count(*) as nbEvalM
					FROM $nomTable
					WHERE sexe = 'M' 
						AND $matiere > 0 ";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['nbEvalM'];
			return $resultat;
		}
		
		private function evalF($nomTable, $periode, $classe, $matiere){
			$sql = "SELECT count(*) as nbEvalF
					FROM $nomTable
					WHERE sexe = 'F' 
						AND $matiere > 0 ";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['nbEvalF'];
			return $resultat;
		}
		
		private function moyM($nomTable, $periode, $classe, $matiere){
			$sql = "SELECT count(*) as moyM
					FROM $nomTable
					WHERE sexe = 'M' 
						AND $matiere >= 10 ";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['moyM'];
			return $resultat;
		}
		
		private function moyF($nomTable, $periode, $classe, $matiere){
			$sql = "SELECT count(*) as moyF
					FROM $nomTable
					WHERE sexe = 'F' 
						AND $matiere >= 10 ";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['moyF'];
			return $resultat;
		}
		
		
		
		
		private function maxF($nomTable,$periode,$classe,$matiere){
			$sql = "SELECT max($matiere) as maxF
					FROM $nomTable
					WHERE sexe = 'F' ";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['maxF'];
			return $resultat;
		}
		
		
		
		
		
		
		private function mgF($nomTable,$periode,$classe,$matiere){
			$sql = "SELECT avg($matiere) as mgF
					FROM $nomTable
					WHERE sexe = 'F'";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['mgF'];
			return $resultat;
		}
		
		private function mgT($nomTable,$periode,$classe,$matiere){
			$sql = "SELECT avg($matiere) as mgT
					FROM $nomTable";
			$req = $this->_db->query($sql);
			$res = mysql_fetch_assoc($req);
			$resultat = $res['mgT'];
			return $resultat;
		}
		
		
		
		
		
		
		public function listeRegion(){
			$sql = "SELECT id, libelle_region
					FROM region 
					ORDER BY libelle_region";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		public function listeDepartement($region){
			$sql = "SELECT id, libelle_departement
					FROM departement
					WHERE num_region = '$region'
					ORDER BY libelle_departement";
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		// On exporte les notes sous forme de Fichier Excel
		public function exportExcel($source, $classe){
			// On vérifie d'abord que les notes existent bel et bien dans la table 
			$tableVerif = 'annuel_'.$classe;
			$database = database;
			$sql = 'SHOW TABLES';
			$req = $this->_db->query($sql);
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			for($i=0;$i<count($res);$i++){
				$nomIndex = 'Tables_in_'.$database;
				$tables[] = $res[$i][$nomIndex];
			}
			if(in_array(strtolower($tableVerif), $tables, true)){
				$information = $this->tableAnnuelle($classe);
				$nomFichier = 'Recap_'.$classe.'.csv';
				echo '<pre>'; print_r($information); echo '</pre>';
				// Ensuite on créé le fichier pour y insérer les données
				$file = fopen($nomFichier,'a+');
				for($i=0;$i<20;$i++){
					fputs($file,"Informations $i \n");
					fputs($file,"Vérifications $i \n");
				}
				
				$file = fclose($file);
				
			}else{
				$_SESSION['message'] = 'La Classe ne dispose pas de Notes Annuelles';
				header('Location:'.$source);
			}
		}
		
		
		
		
		public function genereMoyenneGroupe($classe){
			$table = strtolower('annuel_'.$classe);
			$listeEleve = $this->listeEleve($classe, 'non_supprime');
			// print_r($listeEleve);
			$section = $this->getSection($classe);
			for($i=0;$i<count($listeEleve);$i++){
				$idEleve = $listeEleve[$i]['id'];
				// echo "<h3>Nom : ".$listeEleve[$i]['nom'].".</h3>";
				$listeGroupe = $this->getGroupeClasse($classe);
				for($b=0;$b<count($listeGroupe);$b++){
					$listeMatiere = $this->getMatiereGroupe($listeGroupe[$b], $classe);
					$codeGroupe = $listeGroupe[$b];
					// echo "<p> L'élève ".$idEleve." a le groupe ".$codeGroupe.".</p>";
					$champCoefGroupe = $codeGroupe.'_Coef';
					$champPointGroupe = $codeGroupe.'_total';
					$champMoyenneGroupe = $codeGroupe.'_moyenne';
					$champApprGroupe = $codeGroupe.'_Appr';
					$champCoteGroupe = $codeGroupe.'_cote';
					
					$sql = "SELECT $champCoefGroupe, $champPointGroupe
							FROM $table 
							WHERE id_eleve = '$idEleve'";
					$req = $this->_db->query($sql);
					$res = $req->fetch(PDO::FETCH_ASSOC);
					// print_r($res);
					if($res[$champCoefGroupe]!='0.00' or $res[$champCoefGroupe]!=0){
						$moyenneGroupe = round($res[$champPointGroupe] / $res[$champCoefGroupe],2);
						$appr = $this->showAppreciation($moyenneGroupe);
						$coteGroupe = $appr['cote'];
						if($section=='fr'){
							$apprGroupe = $appr['nom_appreciation'];
						}elseif($section=='en'){
							$apprGroupe = $appr['nom_appreciation_anglais'];
						}
						
						$sql_upd = "UPDATE $table 
									SET $champMoyenneGroupe = '$moyenneGroupe',
									$champApprGroupe = '$apprGroupe',
									$champCoteGroupe = '$coteGroupe'
									WHERE id_eleve = '$idEleve'
									";
						$this->_db->query($sql_upd);
					}						
				}
			}
		}
		
		
		
		
		
	}