<?php



/***********************************************
**
**		La connexion au serveur n'a pas réussi
**
***********************************************/
$err1 = "<html>";
	$err1 .= "<head>";
		$err1 .= "<title>Erreur de Connexion au Serveur</title>";
	$err1 .= "</head>";
	$err1 .= "<body>";
		$err1 .= "<h2><font color='red'>La connexion au serveur ne peut pas être établie; veuillez contacter l'administrateur système.</font></h2>";
	$err1 .= "</body>";
$err1 .= "</html>";





/**************************************************************
**
**		La BD n'a pas été correctement choisie ou configurée
**
***************************************************************/
	$err2 = "<!DOCTYPE html>\n";
	$err2 .= "<html>\n";
		$err2 .= "<head>\n";
			$err2 .= "<title>Base de Données Introuvable</title>\n";
		$err2 .= "</head>\n";
		$err2 .= "<body>\n";
			$err2 .= "<h2><font color='red'>La connexion au serveur est établie, mais impossible de se connecter à la Base de Données. Veuillez contacter l'administrateur système.</font></h2>";
		$err2 .= "</body>\n";
	$err2 .= "</html>\n";
	
	
	/************************************************
	**
	**		Tentative de violation de la page d'admin
	************************************************/
	
	
	
	$erreur_admin ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$erreur_admin .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$erreur_admin .= '<head>';
	$erreur_admin .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	$erreur_admin .= '<link rel="stylesheet" type="text/css" href="../styles/style.css" />';
	$erreur_admin .= '<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />';
	$erreur_admin .= '<link type="text/javascript" src="../javascript/js.js" />';
	$erreur_admin .= "<title>Bienvenue "; if(isset($_SESSION['login'])) { $erreur_admin .= $_SESSION['login'];}  $erreur_admin .="</title>";
$erreur_admin .= '</head>';
$erreur_admin .= '<body>';
	$erreur_admin .= "<h2>Il semble que vous essayez d'avoir une connection non autorisée. Tant que vous n'avez pas le statut <u>d'administrateur</u>,";
	$erreur_admin .= "vous ne pouvez accéder au contenu de cette page.</h2>";
	
	
	$erreur_admin .= '<h4><a href="http://';
	$erreur_admin .= $_SERVER['SERVER_NAME'];
	$erreur_admin .= ':';
	$erreur_admin .= $_SERVER['SERVER_PORT'];
	$erreur_admin .= '/">Sortir de la Page</a>.</h4>';
		
	
$erreur_admin .= "</body>";
$erreur_admin .= "</html>";








/************************************************
	**
	**		Tentative de violation de la page de prof
	************************************************/
	
	
	
	$erreur_prof ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$erreur_prof .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$erreur_prof .= '<head>';
	$erreur_prof .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	$erreur_prof .= '<link rel="stylesheet" type="text/css" href="../styles/style.css" />';
	$erreur_prof .= '<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />';
	$erreur_prof .= '<link type="text/javascript" src="../javascript/js.js" />';
	$erreur_prof .= "<title>Bienvenue "; if(isset($_SESSION['login'])) { $erreur_prof .= $_SESSION['login'];}  $erreur_prof .="</title>";
$erreur_prof .= '</head>';
$erreur_prof .= '<body>';
	$erreur_prof .= "<h2>Il semble que vous essayez d'avoir une connection non autorisée. Tant que vous n'avez pas le statut <u>de professeurr</u>,";
	$erreur_prof .= "vous ne pouvez accéder au contenu de cette page.</h2>";
	
	
	$erreur_prof .= '<h4><a href="http://';
	$erreur_prof .= $_SERVER['SERVER_NAME'];
	$erreur_prof .= ':';
	$erreur_prof .= $_SERVER['SERVER_PORT'];
	$erreur_prof .= '/">Sortir de la Page</a>.</h4>';
		
	
$erreur_prof .= "</body>";
$erreur_prof .= "</html>";

