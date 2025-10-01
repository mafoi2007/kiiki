<?php
	require('../inc/connect.inc.php');
	session_start();
	
	$config = new config($db);
	$gestionnaire = new gestionnaire($db);
	$note = new note($db);
	$eleve = new Eleve($db);
	if($_SESSION['message']){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
	if($_SESSION['poste']=='admin'){
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" 
			content="text/html; charset=utf-8" />
	<link rel="stylesheet" 
			type="text/css" 
			href="../styles/style.css" />
	<link rel ="shortcut icon" 
			type="image/x-icon" 
			href="../images/banniere.png" />
	<link type="text/javascript" 
			src="../javascript/js.js" />
	<title>Etats</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h1>Etats</h1>
		<pre><?php /*print_r($_SERVER);*/ ?></pre>
		<ul>
			<li>
				<h3>
					<a href=''>Liste des Elèves
					</a></h3></li>
			<li>
				<h3>
					<a href=''>Vue d'Ensemble des Effectifs
					</a></h3></li>
			<li>
				<h3>
					<a href=''>Conseil de Classe
					</a></h3></li>
			<li>
				<h3>
					<a href=''>Liste des Professeurs Principaux
					</a></h3></li>
			<li>
				<h3>
					<a href=''>Vue trimestrielle des notes
					</a></h3></li>
			<li>
				<h3>
					<a href=''>Statistique des Notes
					</a></h3></li>
			<li>
				<h3>
					<a href=''>Statistique des Moyennes
					</a></h3></li>
		</ul>
		
		
		
		
		
		
		
		<ul>
			<li>
				<h3>
					<a 
						href="eleve.php?choix=<?php echo sha1('ajout'); ?>#body2" 
						title="Ajouter un élève">
						Ajouter un Elève</a></h3></li>					
			<li>
				<h3>
					<a 
						href="eleve.php?choix=<?php echo sha1('find'); ?>#body2" 
						title="Rechercher un ou plusieurs élèves">
						Rechercher un Elève</a></h3></li>
			<li>
				<h3>
					<a 
						href="eleve.php?choix=<?php echo sha1('consult'); ?>#body2" 
						title="Liste des Élèves déjà  inscrit à  l'établissement">
						Liste des Elèves</a></h3></li>
			<li>
				<h3>
					<a 
						href="eleve.php?choix=<?php echo sha1('vueEffectif'); ?>#body2" 
						title="Effectifs Globaux par classe">
						Vue d'ensemble des Effectifs</a></h3></li>
	</div>
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){
			if($_GET['choix']==sha1('ajout')){
				// require_once('eleve/formAjout.php');
			}
			elseif($_GET['choix']==sha1('maj')){
				require_once('eleve/maj.php');
			}
			elseif($_GET['choix']==sha1('suppr')){
				require_once('eleve/suppr.php');
			}
			elseif($_GET['choix']==sha1('consult')){
				// require_once('eleve/consult.php');
			}
			elseif($_GET['choix']==sha1('find')){
				// require_once('eleve/find.php');
			}
			elseif($_GET['choix']==sha1('viewEleve')){
				// require_once('eleve/viewEleve.php');
			}
			elseif($_GET['choix']==sha1('ajout_m')){
				require_once('eleve/ajout_m.php');
			}
			elseif($_GET['choix']==sha1('vueEffectif')){
				// require_once('eleve/vueEff.php');
			}
			else{
				$_SESSION['text'] = "Désolé, l'application ne prend pas en charge ";
				$_SESSION['text'] .= "votre choix.";
				echo "<script>alert('".$_SESSION['text']."');</script>";
				unset($_SESSION['text']);
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
	/*Si on est connecté mais qu'on n'est pas administrateur de l'application,
	la page ne doit pas s'afficher.
	Ceci a été conçu dans le but d'empêcher que quelqu'un réussisse
	à se connecter à la BD et pense qu'il a accès à tous les espaces.
	Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant*/
	else{
		echo $erreur_admin;
	}	