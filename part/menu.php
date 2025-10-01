<?php
	
	/* Le menu sera différent selon qu'on est 
		-->administrateur, (SUPER ADMINISTRATEUR) 
		-->Cellule Informatique,(ADMINISTRATEUR DE L'APPLICATION) 
		-->Censeur,(GESTIONNAIRE DES PARAMETRES DE L'APPLICATION) 
		-->Surv. Général,(GESTIONNAIRE DES HEURES D'ABSENCE) 
		-->Agent Financier,(GESTIONNAIRE DES ENTREES DE CAISSE JOURNALIERES) 
		-->Enseignant(AGENT DE SAISIE DES NOTES DES ELEVES) , 
		*/
	
	if($_SESSION['poste']=='admin'){
		require_once('menu_admin.php');
	}elseif($_SESSION['poste']=='cell'){
		require_once('menu_cell.php');
	}elseif($_SESSION['poste']=='chef'){
		require_once('menu_chef.php');
	}elseif($_SESSION['poste']=='censeur'){
		require_once('menu_censeur.php');
	}elseif($_SESSION['poste']=='sg'){
		require_once('menu_sg.php');
	}elseif($_SESSION['poste']=='eco'){
		require_once('menu_eco.php');
	}elseif($_SESSION['poste']=='prof'){
		require_once('menu_prof.php');
	}else{
		require_once('no_menu.php');
	}