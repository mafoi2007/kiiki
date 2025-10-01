<?php
	class eleveModele {
		
		
	
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION DE SELECTION UTILISANT LA CLAUSE SELECT FROM **************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		
		
		/* Liste de tous les élèves de l'application du moment qu'ils sont actifs */
		public function listeEleveAll($etat) {
			$sql = "SELECT eleve.id, nom, prenom, sexe, matricule, classe, lieu_naissance, adresse_parent, eleve.etat, statut, DATE_FORMAT(date_naissance, '%d / %m / %Y') AS date_naissance, nom_classe 
					FROM eleve, classe 
					WHERE eleve.etat='$etat' AND code_classe = classe ORDER BY nom";
			$req = mysql_query($sql) or die(mysql_error());
			$i=01;
			while($res=mysql_fetch_assoc($req)) {
				$eleve[$i] = $res;
				$i++;
			}
			return $eleve;
		}
		
		
		
		
		/* Nombre d'élève inscrits dans l'application avec le statut non_supprime ou supprime */
		public function nbEleveAll($etat) {
			$sql = "SELECT COUNT(*) AS nombre FROM eleve WHERE etat='$etat'";
			$req = mysql_query($sql) or die(mysql_error());
			$res = mysql_fetch_array($req);
			return $res['nombre'];
		}
		
		
		
		
		
		
		
		/* Il vérifie si le matricule est déjà présent dans la BD */
		public function getMatricule($matricule) {
			$sql = "SELECT * FROM eleve WHERE matricule = '$matricule'";
			$req = mysql_query($sql) or die(mysql_error());
			$res = mysql_fetch_assoc($req);
			return $res;
		}
		
		
		
		
	}