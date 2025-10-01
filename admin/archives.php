<?php
	require_once('../inc/connect.inc.php');
	// require_once('../inc/fonction.inc.php');
	session_start();
	$gestionnaire = new gestionnaire();
	$general = new general();
	if($_SESSION['poste']=='admin')
		{
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Catégorie Archives et Recherche</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h3>Choisissez l'archive à consulter dans la Base de Données.Vous pouvez décider d'effectuer une recherche simple
		ou alors une recherche approfondie.</h3>
		<h3>
			<ul>
				<li><h3><a href='archives.php?choix=simple'>Recherche Simple</a></h3></li>
				<li><h3><a href='archives.php?choix=approfondi'>Recherche Approfondie</a></h3></li>
				<li><h3><a href='archives.php?choix=connexion'>Journal des Connexions</a></h3></li>
	</div>
	
	
	<div id="body">
	<?php
		if(isset($_GET['choix'])) // ON A FAIT UN CHOIX SUR LA GESTION DES ARCHIVESw: SOIT ON VEUT AJOUTER(FORMULAIRE D'AJOUT), SOIT ON VEUT MAJ OU SUPPR
			{
	
			if($_GET['choix']=='simple')
				{
				include('archives/simple.php');
				}
			elseif($_GET['choix']=='approfondi')
				{
				include('archives/approfondi.php');
				}
			elseif($_GET['choix']=='connexion')
				{
				include('archives/connexion.php');
				}
			else
				{
				echo "<h3 class='alert'>Désolé, l'application ne prend pas en charge votre choix.</h3>";
				}
	
			}
	?>
	
	</div>
		
	
	
	<?php
		require('../part/footer.php');
	?>
</body>
</html>



<?php
		}
	else	// Si on est connecté mais qu'on n'est pas administrateur de l'application, la page ne doit pas s'afficher.
	/* Ceci a été conçu dans le but d'empêcher que quelqu'un réussisse à se connecter à la BD
	et pense qu'il a accès à tous les espaces. Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant
	*/
		{
		echo $erreur_admin;
		}
