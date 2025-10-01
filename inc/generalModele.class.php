<?php
	
	
	class generalModele {
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION DE SELECTION UTILISANT LA CLAUSE SELECT FROM **************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		/* Pour une fouille simple */
		public function getInfoEleve($info) {
			$sql = "SELECT * FROM eleve WHERE nom LIKE '$info' OR prenom LIKE '$info'";
			$req = mysql_query($sql) or die(mysql_errno());
			$res = mysql_fetch_assoc($req);
			return $res;
		}
		
		
		
		public function nbConnexion($id) {
			$sql = "SELECT COUNT(*) AS nombre FROM journal_connexion WHERE utilisateur='$id'";
			$req = mysql_query($sql) or die(mysql_error());
			$res = mysql_fetch_assoc($req);
			return $res;
		}
		
		
		
		
		public function listeJournal($id) {
			$sql = "
				SELECT utilisateur, adresse_ip, 
					DATE_FORMAT(periode_de_connexion, '%d / %m / %Y') AS jour, 
					DATE_FORMAT(periode_de_connexion, '%H h %i min %s sec') AS heure, 
					nom, prenom 
				FROM journal_connexion, enseignant 
				WHERE utilisateur = login AND utilisateur = '$id' ORDER BY jour";
			$req = mysql_query($sql) or die(mysql_error());
			$i = 1;
			while($res = mysql_fetch_assoc($req)) {
				$journal[$i] = $res;
				$i++;
			}
			return $journal;
			
		}
		
		
		
		
		
		
		
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION D'AJOUT UTILISANT LA CLAUSE INSERT INTO *******************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		/* Inscrire les périodes séquentielles dans la Base */
		public function insertPeriode($debut, $fin, $nom) {
			$exec = "INSERT INTO periode(nom_periode, date_ouvert, date_fermet) VALUES('$nom','$debut','$fin')";
			$req = mysql_query($exec) or die(mysql_error());
			return $req;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/**************************************************************************************************
		***************************************************************************************************
		*****************************  FONCTION D'EFFACEMENT UTILISANT LA CLAUSE DELETE *******************
		***************************************************************************************************
		**************************************************************************************************/
		
		
		
		
		public function delJournal($id) {
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}