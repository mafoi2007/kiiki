<?php
	
	class Eleve extends eleveModele
	{
		/* Cette classe est chargée de la gestion des élèves chez l'administrateur, notamment :
		-- L'ajout simple
		-- La consultation des élèves
		-- La suppression des élèves
		-- La mise à jour des élèves
		-- L'ajout d'un fichier d'élèves au format CSV
		*/
		
		/* Déclaration des attributs */
		
		private $id;
		protected $nom;
		protected $prenom;
		protected $sexe;
		protected $date_naissance;
		protected $lieu_naissance;
		protected $matricule;
		protected $classe;
		protected $etat;
		protected $statut;
		protected $adresse_parent;
		protected $how;
		
		
		
		
		/* Protection de mes méthodes */
		
		protected function getId($id) {
			if(!$id) {
				throw new NotFoundException(__('Pas de valeur de id '));
			}
			if($id) {
				if(!is_int($id)) {
					throw new NotFoundException(__('La valeur doit être un entier'));
				}
				if(empty($id)) {
					throw new NotFoundException(__('La valeur doit exister.'));
				}
			}
			return $this->id;
		}
		
		
		
		protected function getNom($id) {
			if(!$id) {
				throw new NotFoundException(__('Pas de valeur de id '));
			}
			/* Il faut avoir d'où proviennent les données que nous voulons. Si elles proviennent d'un formulaire
				alors le how est request et on fait les vérifications d'usage. Si cela provient de la BD, le how
				est sql et on vérifie qu'il faut bien afficher cela. Dans tous les cas on termine par un return.*/
			if($id) {
				if($this->how == 'request') {
					
				}
				elseif($this->how == 'sql') {
					$this->id = $id;
				}
			}
			return $this->nom;
		}
		
		
		
		
		
		
		
		
		
		
		
		/********************************************
		****  Fonction d'ajout d'élève par fichier***
		********************************************/
		public function ajouterPlusieursEleves($valeur) {
			if(isset($_FILES['fichier'])){
				if($_FILES['fichier']['error']==0) {
					if($_FILES['fichier']['size']<=5000000) {
						//On vérifie l'extension du fichier
						$fichierCharge = pathinfo($_FILES['fichier']['name']);
						$extensionRecue = $fichierCharge['extension'];
						if($extensionRecue=='csv') {
							// On peut maintenant copier le fichier sur le serveur et le lire
							/* D'abord copions le */
							move_uploaded_file($_FILES['fichier']['tmp_name'], 'uploads/'.basename('file1.csv'));
							/* Le fichier étant téléchargé, maintenant copions son contenu dans la base MySQL */
							$monfichier = fopen('uploads/file1.csv', 'r');
								$i=0;
								while($ligne = fgetcsv($monfichier,250,';')) {
									$i++;
									/*echo '<pre>';
										print_r($ligne);
									echo '</pre>';*/
								$variable = mysql_query("INSERT INTO eleve(matricule, nom, sexe, date_naissance, lieu_naissance, classe, statut,etat) VALUES('1718A00$i','$ligne[0]','$ligne[1]','$ligne[2]','$ligne[3]','$ligne[4]','$ligne[5]','non_supprime')") or die(mysql_error());	
								
								}
							fclose($monfichier);
						}
						else {
							echo "<p>Vous n'avez pas téléchargé la bonne extension defichier. Assurez vous de télécharger un fichier au format CSV";
						}
					}
					else {
						echo '<p>Taille de Ficheir supérieure à 5 Mo. Télécharger un fichier de taille inféreiure';
					}
				}
			}
			
		}
		
		
	
		
		/* Cette fonction se charge de restaurer l'élève ayant été accidentellemnt envoyé à la corbeille */
		public function restaurerEleve() {
			if(isset($_GET['cat']) and $_GET['cat']== sha1('eleve') 
			   and isset($_GET['dec']) and $_GET['dec']== sha1('rest')
			   ) {
				$eleve = urldecode($_GET['mat']);
				$req = "UPDATE eleve SET etat = 'non_supprime' WHERE matricule = '$eleve'";
				mysql_query($req) or die(mysql_error());
				echo "<h4 class='bien'> L'élève a été restauré.</h4>";
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		/* Cette fonction, contrairement à supprimerElève, ne se contente pas d'envoyer à la corbeille en faisant un update pour inactif.
		Elle se charge se supprimer de la BD sans possibilité de récupération */
		public function effacerEleve() {
			//On a validé la suppression définitive.
			if(isset($_GET['cat']) and $_GET['cat']== sha1('eleve') 
			   and isset($_GET['dec']) and $_GET['dec']== sha1('suppr')
			   ) {
				$eleve = urldecode($_GET['mat']);
				$req = "DELETE FROM eleve WHERE matricule = '$eleve'";
				mysql_query($req) or die(mysql_error());
				echo "<h4 class='bien'> L'élève a été définitivement supprimé.</h4>";
			}
		
		
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
