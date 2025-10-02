<?php
	
	/* Le menu sera différent selon qu'on est 
		-->administrateur, (SUPER ADMINISTRATEUR) 
		-->Cellule Informatique,(ADMINISTRATEUR DE L'APPLICATION) 
		-->Censeur,(GESTIONNAIRE DES PARAMETRES DE L'APPLICATION) 
		-->Surv. Général,(GESTIONNAIRE DES HEURES D'ABSENCE) 
		-->Agent Financier,(GESTIONNAIRE DES ENTREES DE CAISSE JOURNALIERES) 
		-->Enseignant(AGENT DE SAISIE DES NOTES DES ELEVES) , 
		*/
	
	if($_SESSION['user']['userPost']=='admin'){
		require_once('menu_admin.php');
	}elseif($_SESSION['user']['userPost']=='cell'){
		require_once('menu_cell.php');
	}elseif($_SESSION['user']['userPost']=='chef'){
		require_once('menu_chef.php');
	}elseif($_SESSION['user']['userPost']=='censeur'){
		require_once('menu_censeur.php');
	}elseif($_SESSION['user']['userPost']=='sg'){
		require_once('menu_sg.php');
	}elseif($_SESSION['user']['userPost']=='eco'){
		require_once('menu_eco.php');
	}elseif($_SESSION['user']['userPost']=='prof'){
		require_once('menu_prof.php');
	}else{
		require_once('no_menu.php');
	}