<?php
	
	class censeur extends gestionnaire {
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function affecterMatiere() {
			if(isset($_POST['ajout_matiere'])) {
				/*echo '<pre>';
				print_r($_POST);
				echo '</pre>';*/
				
				$classe = mysql_real_escape_string(htmlspecialchars($_POST['classe']));
				$matiere = mysql_real_escape_string(htmlspecialchars($_POST['matiere']));
				$coef = mysql_real_escape_string(htmlspecialchars(str_replace(',','.',$_POST['coef'])));
				
				
				/*Un controle de validité s'impose pour s'assurer les variables $classe et $matiere ne sont pas vides de même
				 $coef soit un nombre entier ou décimal */
				 if(empty($classe) or $classe=='null' or empty($matiere) or $matiere=='null') {
					echo "<script>alert('Les valeurs de classe et/ou matière doivent contenir une valeur valide.');</script>";
				 }
				 
				 else {
					/* Un autre controle s'impose: on doit éviter que pour la même classe, il y'ait deux matières identiques même si les 
					coefficients diffèrent. On va donc devoir vérifier en BD si les informations n'y sont pas déjà. */
					$sql = "SELECT * FROM prof_classe WHERE id_classe = '$classe' AND id_matiere ='$matiere'";
					$req = mysql_query($sql) or die(mysql_error());
					$res = mysql_fetch_array($req);
					// La matière y a déjà été enegistrée, on renvoie un message d'erreur
					if(!empty($res['id'])) {
						echo "<script>alert('La matière existe déjà pour la classe.');</script>";
					}
					// La matière n'est pasq encore enregistrée en BD, on peut donc le faire
					elseif(empty($res['id'])) {
						$sql = "INSERT INTO prof_classe(id_classe, id_matiere, coef) VALUES('$classe','$matiere','$coef')";
						$req = mysql_query($sql) or die(mysql_error());
						echo "<script>alert('Matière insérée pour la classe.');</script>";
					}
				 }
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function affecterProfesseur() {
			echo "Affecter Prof";
			
			
			
			
			
			
			
			
			
			
		}
		
		
		
	}