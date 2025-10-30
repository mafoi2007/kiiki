<?php
	session_start();
	require_once('../inc/connect.inc.php');
	// require('../inc/fonction.inc.php');
	$gestionnaire = new gestionnaire($db);
	$config = new config($db);
	$note = new note($db);
	
	
	if($_SESSION['message']){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
	
	$poste = $_SESSION['poste'];
	// $smarty->assign('poste', $_SESSION['poste']);
	
	if($_SESSION['user']['userPost']=='sg')
		{
		 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Bienvenue <?php echo $_SESSION['user']['nom_complet_enseignant']; ?></title>
</head>

<body>
	<?php
		require_once('../part/entete.php');
		
		require_once('../part/menu.php');
	?>
	
	
	<div id="body">
		<h1>module disciplinaire.</h1>
		<h2>Cliquez sur le menu de gauche</h2>
		
	</div>
	
	
	
	
	
	
	<?php
		require('../part/footer.php');
	?>
</body>
</html>





<?php
		}
	else	// Si on est connecté mais qu'on n'est ni administrateur, ni prof ni sg de l'application, la page ne doit pas s'afficher.
	/* Ceci a été conçu dans le but d'empêcher que quelqu'un réussisse à se connecter à la BD
	et pense qu'il a accès à tous les espaces. */
	
		{
		header('Location:../index.php');
		}
