<?php
	session_start();
	// require_once('inc/connect.inc.php');
	/*D'abord on vérifie si on est à la phase d'initialisation
	Si le fichier Init.php existe, alors on l'execute. Sinon on suppose
	qu'il a été renommé suite à l'initialisation de la base de Données.*/
	if(isset($_SESSION['message'])){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
	
	$verif = include_once('inc/init.php');
	if($verif==true){
		
		/*On execute ce que contient le fichier d'initialisation.
		A la fin on le renomme.*/
		require_once('inc/init.php');
	}
	else{
		require_once('inc/connect.inc.php');
		// Appel de la classe devant gérer l'authentification
		$gestionnaire = new gestionnaire($db);
		// Si on n'a pas de variables de session, on affiche le formulaire
		if(!isset($_SESSION['poste'])){
			require_once('formConnect.php');
		}
		// Si on avait déjà les variables de connexion, on est rédirigé
		// automatiquement vers sa page.
		elseif(isset($_SESSION['poste'])){
			// on peut être professeur, admin, sg, censeur, proviseur
			if($_SESSION['poste']=='prof'){
				header('Location:prof/');
			}
			elseif($_SESSION['poste']=='admin'){
				header('Location:admin/');
			}
			elseif($_SESSION['poste']=='censeur'){
				header('Location:censeur/');
			}
			elseif($_SESSION['poste']=='sg'){
				header('Location:sg/');
			}
			elseif($_SESSION['poste']=='chef'){
				header('Location:chef/');
			}
			elseif($_SESSION['poste']=='cell'){
				header('Location:cell/');
			}
			elseif($_SESSION['poste']=='eco'){
				header('Location:eco/');
			}
			// Sinon on renvoie un message d'erreur car la 
			// connexion est frauduleuse
			else{
				session_destroy();
				exit;
			}
		}
	}