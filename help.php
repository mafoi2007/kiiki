<?php
	require_once('inc/connect.inc.php');
	session_start();
	if(isset($_SESSION['poste'])){
		$nomFichier = 'help/help_'.$_SESSION['poste'].'.php';
		require_once($nomFichier);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="images/banniere.png" />
	<link type="text/javascript" src="javascript/js.js" />
	<title>Fichier d'Aide</title>
</head>

<body>
<div id='body'>
	<div id="General">
		<h1>Aide Générale</h1>
	</div>
	
	<div id="config">
		<h1>Aide sur le Menu Configuration Générale</h1>
	</div>
	
	<div id="note">
		<h1>Aide sur le Menu Gestion des Notes</h1>
	</div>
	
	<div id="traitementnote">
		<h1>Aide sur le Menu Traitement des Notes</h1>
	</div>
	
	<div id="traitementannuel">
		<h1>Aide sur le Menu Traitements Annuels</h1>
		<h2 id='viewntann'>A propos du sous menu visualisations des notes annuelles</h2>
		<h2 id='traitntann'>A propos du sous menu traitement Annuel des Notes</h2>
		<h2 id='traitmoyann'>A propos du sous menu traitement Annuel des Moyennes</h2>
	</div>
	
	<div id="bulletin">
		<h1>Aide sur le Menu Bulletins</h1>
	</div>
	
	<div id="statistique">
		<h1>Aide sur le Menu Statistique</h1>
	</div>
</div>
	<?php 
	echo '<pre>';
		print_r($_SERVER);
	echo '</pre>';
	phpinfo();
	?>
</body>
</html>
