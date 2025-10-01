<?php
	
	class Matiere extends matiereModele
	{
		/* Déclaration des attributs */
		
		private $id;
		private $nom_matiere;
		private $categorie;
		private $etat;
		private $code_matiere;
		
		
		
		
		
		
		/* Déclaration des méthodes */
		
		
		
		
		
		public function restaurerMatiere()
		{
			
		}
		
		
		
		public function matiereDeClasses() {
			
			/* Un comportement est atendu. lorsque la classe est désignée, on doit pouvoir afficher toutes les matières qui y passent
			avec le coeffcient et le professeur intervenant dans la classe.
			*/
			if(isset($_GET['cls'])) {
				$classe = urldecode($_GET['cls']);
				$sql = "
						SELECT id_prof, id_classe, nom_matiere AS matiere, coef, nom_classe AS classe
						FROM prof_classe, matiere, classe
						WHERE id_classe = '$classe' AND id_matiere = matiere.id AND id_classe = code_classe
						ORDER BY matiere.categorie ASC
					   ";
				
				echo "<table border='1' width='80%'>";
					echo "<tr>";
						echo "<th>Matière</th>";
						echo "<th>Coef</th>";
						echo "<th>Enseignant</th>";
					echo "</tr>";
					
				$req = mysql_query($sql) or die(mysql_error());
				//Je dois prévoir le cas où il n'yaurait pas encore de matière ou de coef ou enseignant enregistré pour la classe
				while($res = mysql_fetch_assoc($req)) {
					echo "<caption>Matières de la ".ucwords($res['classe'])."</caption>";
					echo "<tr>";
						echo "<td>";
						if(empty($res['matiere'])) { echo "<blink class='alert'>Pas encore de matière</blink>"; } else { echo ucwords($res['matiere']);} 
						echo "</td>";
						echo "<td>".$res['coef']."</td>";
						echo "<td>";
						if(empty($res['id_prof'])) { echo "<blink class='alert'>Pas encore d'enseignant</blink>"; } else { echo $res['id_prof'];} 
						echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
		
		
		
		
		
		
		
		public function matiereDeClasse($classe) {
			/* Un comportement est atendu. lorsque la classe est désignée, on doit pouvoir afficher toutes les matières qui y passent
			avec le coeffcient et le professeur intervenant dans la classe.
			*/
			
				$sql = "
						SELECT id_prof, principal, coef, id_classe, nom_matiere
						FROM prof_classe, matiere
						WHERE id_classe = '$classe' AND matiere.id = id_matiere
						ORDER BY id_classe
					   ";
				
				
				$req = mysql_query($sql) or die(mysql_error());
				$i = 1;
				while($res = mysql_fetch_assoc($req)) {
					$resultat = $res;
					
					$prof[$i] = $resultat['id_prof'];
					$coef[$i] = $resultat['coef'];
					$mat[$i] = $resultat['nom_matiere'];
					$ppal = $resultat['principal'];
					$cls[$i] = $resultat['id_classe'];
					
					$i++;
					// $prof = $res['id_prof'];
					// $matiere = $res['nom_matiere'];
					// $coef = $res['coef'];
					// foreach($matiere as 
					// echo "<p> Le prof ".$prof." enseigne le(la) ".$matiere." </p>";					
				}
				
				$prof_classe = array(
									"prof" => $prof,
									"coef" =>$coef,
									"matiere" =>$mat,
									"principal" =>$ppal,
									"classe" => $cls);
				return $prof_classe;
				// echo '<pre>';
				// print_r($prof_classe);
				
		
		}
		
		
		
		
		
		
		
		
		public function attribuerMatiere() {
			if(isset($_REQUEST['ajout_matiere'])) {
				/*echo '<pre>';
					print_r($_REQUEST);
				echo '</pre>';*/
				
				$classe = mysql_real_escape_string(htmlspecialchars($_REQUEST['classe']));
				$matiere = mysql_real_escape_string(htmlspecialchars($_REQUEST['matiere']));
				$coef = mysql_real_escape_string(htmlspecialchars($_REQUEST['coef']));
				/*On convertir le coef en nombre réel.*/
				settype($coef, "double");
				/*Tester la présence d'erreur */
				if($classe=='null' or $matiere=='null') {
					echo "La valeur de Classe et/ou Matière n'a pas été renseignée.";
				}
				else {
					if($coef==0) {
						echo "<script>alert('Le coef doit contenir une valeur numérique');</script>";
					}
					else {
						/*Verifier que la matière n'existe pas déjà en base */
						$verification = $this->verifMatiere($matiere, $classe);
						if(!empty($verification['id'])) {
							echo "<script>alert('La matière que vous tentez d\'enregistrer existe déjà pour cette classe.');</script>";
						}
						else {
							/*On enregistre*/
							$enregistrement = $this->setMatiereClasse($classe, $matiere, $coef);
							if($enregistrement==true) {
								echo "<script>alert('Matière attribuée');</script>";
							}
						}
						
					}
				}
				
				
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		public function attribuerProfesseur() {
			if(isset($_REQUEST['rProf'])) {
				/*echo '<pre>';
				print_r($_REQUEST);
				echo '</pre>';*/
				
				foreach($_REQUEST['prof'] as $id=>$login) {
					/*Si les valeurs de prof ne sont pas nulles. L'objectif ici est de ne retenir que les valeurs pour
					lesquelles on a fourni une valeur de prof.*/
					if($login!='null') {
						$prof = $login;
						$ligne = $_REQUEST['id'][$id];
						$enregistrement = $this->setProfesseurClasse($ligne, $prof);
						if($enregistrement) {
							$page = $_SERVER['PHP_SELF'];
							$_SESSION['message'] = "Attribution effectuée";
							header('Location:'.$page);
						}
					}
				}
			}
		}
		
		
		
		
		
		
		
		
		
		public function attribuerProfesseurPrincipal() {
			if(isset($_REQUEST['profPpal'])) {
				/*echo '<pre>';
					print_r($_REQUEST);
				echo '</pre>';*/
				
				foreach($_REQUEST['prof'] as $id=>$login) {
					
					if($login!='null') {
						$prof = $login;
						$classe = $_REQUEST['classe'][$id];
						// Avant de procéder à l'enregistrement, on doit vérifier que la même information n'apparait
						// pas deux fois dans la même table
						$ver = "SELECT * FROM classe_principale WHERE prof = '$prof' AND classe = '$classe'";
						$sqlVer = mysql_query($ver) or die(mysql_error());
						$resVer = mysql_fetch_assoc($sqlVer);
						if(!empty($resVer['id'])) { //La table contenait deja les informations
							echo "<script>alert('La classe de ".$classe." a déjà un professeur principal.');</script>";
						}
						else {
							$enregistrement = $this->setProfesseurPrincipal($classe,$prof);
							/*Maintenant on va dans la table Prof_classe et on fait un update en mettant non sur toutes
							les autres valeurs de principal en prenant soin de préciser au préalable qui sont les 
							prof principaux*/
							
							
							
							//Je met d'abord à oui tous les prof principaux
							$req = "UPDATE prof_classe SET principal = 'oui' WHERE id_prof='$prof' AND id_classe ='$classe'";
							$exec = mysql_query($req) or die(mysql_error());
							
							
							
							
							
							if($enregistrement) {
								$page = $_SERVER['PHP_SELF'];
								$_SESSION['message'] = "Professeur Principal Désigné.";
								header('Location:'.$page);
							}
							
							
						}
						
						
					}
				}
			}
		}
		
		
		
		
		public function listeMatiereClasse($classe) {
			return $this->getMatieresClasse($classe);
		}
		
		
		
		
	}
