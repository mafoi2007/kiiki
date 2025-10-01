<?php
	class matiereModele {
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION DE SELECTION UTILISANT LA CLAUSE SELECT FROM **************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		
		/* Liste de toutes les matières de l'application présentes dans Matiere */
		protected function getMatiereAll($etat) {
			$sql = "SELECT id, nom_matiere, categorie, etat, code_matiere
					FROM matiere 
					WHERE etat ='$etat' ORDER BY categorie, nom_matiere";
			$req = mysql_query($sql) or die(mysql_error());
			$i=01;
			while($res=mysql_fetch_assoc($req)) {
				$matiere[$i] = $res;
				$i++;
			}
			return $matiere;
		}
		
		
		
		
		
		/* Liste de toutes les matières de l'application présentes dans prof_classe */
		protected function getMatiereClasse() {
			$sql = "SELECT nom_classe AS classe, nom_matiere AS matiere, prof_classe.id
					FROM prof_classe, classe, matiere
					WHERE id_prof='' AND code_classe = id_classe AND id_matiere = matiere.id 
					ORDER BY id_classe
					
					";
			$req = mysql_query($sql) or die(mysql_error());
			$i=01;
			while($res=mysql_fetch_assoc($req)) {
				$matiere[$i] = $res;
				$i++;
			}
			return $matiere;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		/* Liste des matières qui passent dans une classe. un paramètre, la classe */
		protected function getMatieresClasse($classe) {
			$sql = "SELECT id_matiere, nom_matiere AS matiere, enseignant.nom, enseignant.prenom
					FROM prof_classe, matiere, enseignant
					WHERE id_classe = '$classe' AND id_matiere = matiere.id AND enseignant.login = id_prof
					ORDER BY categorie, matiere
					
					";
			$req = mysql_query($sql) or die(mysql_error());
			$i=01;
			while($res=mysql_fetch_assoc($req)) {
				$matiere[$i] = $res;
				$i++;
			}
			return $matiere;
		}
		
		
		
		
		
		
		
		
		/*Nombre de Matières qui passent dans une classe donnée : un paramètre, la classe */
		
		
		
		
		
		
		/* Vérifier la présence d'une matière dans la table Matière*/
		protected function getMatiere($matiere) {
			$sql = "SELECT * FROM matiere WHERE code_matiere = '$matiere'";
			$req = mysql_query($sql) or die(mysql_errno());
			$res = mysql_fetch_assoc($req);
			return $res;
		}
		
		
		
		
		/*Vérifier la présence d'une matière dans la table prof_matiere */
		protected function verifMatiere($matiere, $classe) {
			$sql = "SELECT * FROM prof_classe WHERE id_matiere = '$matiere' AND id_classe = '$classe'";
			$req = mysql_query($sql) or die(mysql_errno());
			$res = mysql_fetch_assoc($req);
			return $res;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION D'AJOUT UTILISANT LA CLAUSE INSERT INTO *******************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		protected function insertMatiere($code, $matiere, $etat, $categorie) {
			$sql = "INSERT INTO matiere(nom_matiere, categorie, etat, code_matiere)
					VALUES('$matiere','$categorie','$etat', '$code')";
			$req = mysql_query($sql) or die(mysql_errno());
			return $req;
		}
		
		
		
		
		
		
		
		
		
		protected function setMatiereClasse($classe, $matiere, $coef) {
			$sql = "INSERT INTO prof_classe(id_classe, id_matiere, coef)
					VALUES('$classe', '$matiere', '$coef')";
			$req = mysql_query($sql) or die(mysql_errno());
			return $req;
		}
		
		
		
		
		
		
		
		
		
		/*Pour ajouter un professeur principal*/
		protected function setProfesseurPrincipal($classe,$prof) {
			$sql = "INSERT INTO classe_principale(prof, classe) 
					VALUES('$prof','$classe')";
			$req = mysql_query($sql) or die(mysql_errno());
			return $req;
		}
		
		
		
		
		
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION DE MISE A JOUR UTILISANT LA CLAUSE UPDATE *****************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		
		protected function setProfesseurClasse($id, $prof) {
			$sql = "UPDATE prof_classe SET id_prof = '$prof' WHERE id = '$id'";
			$req = mysql_query($sql) or die(mysql_errno());
			return $req;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}