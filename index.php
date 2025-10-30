<?php
	session_start();
	require_once('inc/connect.inc.php');
	$verifConn = include_once('inc/init.php');
	$config = new config($db);
	
	$config->update();
	
	if(isset($_SESSION['message'])){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}unset($_SESSION['message']);
	/**********************************
	C'est la page d'accueil. Voici le comportement attendu : 
	1. A la toute première connexion, on propose un formulaire d'initialisation de la BD.
	On y renseigne les informations demandées. 
	2. A partir des prochaines conexions, on propose un formulaire de connexion qui redirigera
	selon qu'on est pca, eco, cell ou enseignant ou admin.
	
	*********************************/
	if($verifConn==false){
		require_once('accueil.php');
	}else{
		require_once('inc/init.php');
	}