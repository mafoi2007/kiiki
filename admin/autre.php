<?php
	require_once('../inc/connect.inc.php');
	// require_once('../inc/fonction.inc.php');
	session_start();
	$gestionnaire = new gestionnaire();
	$config = new config();
	$general = new general();
	if($_SESSION['message']){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
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
	<title>Configuration des Périodes</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h1>Gestion des séquences</h1>
		<ul>
			<li><h3><a href="autre.php?choix=<?php echo sha1('ajout'); ?>">Activer une période séquentielle</a></h3></li>
			<li><h3><a href="autre.php?choix=<?php echo sha1('maj'); ?>">Clore une période séquentielle</a></h3></li>
			<li><h3><a href="autre.php?choix=<?php echo sha1('consult'); ?>">Consulter les périodes définies</a></h3></li>
	</div>
	
	
	<div id="body">
	<?php
		if(isset($_GET['choix'])) // ON A FAIT UN CHOIX SUR LA GESTION DES PERIODES: SOIT ON VEUT DEFINIR UNE PERIODE, SOIT ON VEUT LA PROLONGER, OU ALORS SIMPLEMENT CONSULTER LES PERIODES
			{
	
			if($_GET['choix']==sha1('ajout'))
				{
				include('autre/ajout.php');
				}
			elseif($_GET['choix']==sha1('maj'))
				{
				include('autre/maj.php');
				}
			elseif($_GET['choix']==sha1('consult'))
				{
				include('autre/consult.php');
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
