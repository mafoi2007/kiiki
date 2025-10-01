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
	if($_SESSION['poste']=='admin')
		{
	
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<title>Gestion des Notes</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h2>Ce module a pour but de permettre la saisie, 
		la consultation, la modification,
		la copie et la suppression des notes.</h2>
		<ul>
			<li><h3><a 
				href="note.php?choix=<?php echo sha1('addnt'); ?>#body2">
				Saisie des Notes</a></h3></li>
			
			<li><h3><a 
				href="note.php?choix=<?php echo sha1('cpnt'); ?>#body2">
				Copie des Notes</a></h3></li>
			<li><h3><a 
				href="note.php?choix=<?php echo sha1('delnt'); ?>#body2">
				Suppression des Notes</a></h3></li>
		</ul>
	</div>
	
	
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){ // ON A FAIT UN CHOIX 
			if($_GET['choix']==sha1('addnt')){
				include_once('note/addnt.php');
			}
			/*elseif($_GET['choix']==sha1('viewnt')){
				include_once('note/viewnt.php');
			}*/
			/*elseif($_GET['choix']==sha1('updnt')){
				include_once('note/updnt.php');
			}*/
			elseif($_GET['choix']==sha1('cpnt')){
				include_once('note/cpnt.php');
			}
			elseif($_GET['choix']==sha1('delnt')){
				include_once('note/delnt.php');
			}
			else{
				echo "<h3 class='alert'>L'application ne prend pas en charge 
				votre choix.</h3>";
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
	else	// Si on est connecté mais qu'on n'est pas administrateur 
	// de l'application, la page ne doit pas s'afficher.
	/* Ceci a été conçu dans le but d'empêcher que quelqu'un 
	réussisse à se connecter à la BD et pense qu'il a accès à tous les espaces. 
	Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant
	*/
		{
		echo $erreur_admin;
		}
