<?php
	require_once('../inc/connect.inc.php');
	session_start();
	$gestionnaire = new gestionnaire();
	$classe = new classe();
	$eleve = new eleve();
	$matiere = new matiere();
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
	<title>La Corbeille</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h3>Cette page fonctionne comme une véritable corbeille.<br />
		Vous pouvez <em>restaurez</em> ou alors <em>supprimer définitivement</em> des données.<br />
		Mais attention!!! Après suppression définitive, il n'y a plus de récupération possible.<br />
		Pour commencer, choisissez la catégorie de la corbeille.</h3>
		
		<ul>
			<li><h3><a href='corbeille.php?cat=<?php echo sha1("eleve"); ?>'>Elèves supprimés</a></h3></li>
			<li><h3><a href='corbeille.php?cat=<?php echo sha1("classe"); ?>'>Classes supprimées</a></h3></li>
			<li><h3><a href='corbeille.php?cat=<?php echo sha1("matiere"); ?>'>Matières supprimées</a></h3></li>
			<li><h3><a href='corbeille.php?cat=<?php echo sha1("gestionnaire"); ?>'>Gestionnaires supprimés</a></h3></li>
		</ul>
		
	
			
	</div>
	
	
	<div id="body">
	<?php
		if(isset($_GET['cat'])) // ON A FAIT UN CHOIX SUR LA CORBEILLE
			{
	
			if($_GET['cat']==sha1('eleve'))
				{
				include('corbeille/eleve.php');
				}
			elseif($_GET['cat']==sha1('classe'))
				{
				include('corbeille/classe.php');
				}
			elseif($_GET['cat']==sha1('matiere'))
				{
				include('corbeille/matiere.php');
				}
			elseif($_GET['cat']==sha1('gestionnaire'))
				{
				include('corbeille/gestionnaire.php');
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
