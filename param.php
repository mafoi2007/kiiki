<?php
	session_start();
	require('inc/connect.inc.php');
	$gestionnaire = new gestionnaire($db);
	$config = new config($db);
	require('inc/fonction.inc.php');
	
	if(isset($_SESSION['message'])){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	} unset($_SESSION['message']);
	
	if($_SESSION['poste']=='admin' 
			or $_SESSION['poste']=='prof' 
			or $_SESSION['poste']=='sg' 
			or $_SESSION['poste']=='censeur'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
	Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="images/banniere.png" />
	<link type="text/javascript" src="javascript/js.js" />
	<title>Paramètres de l'utilisateur</title>
</head>

<body>
	<?php
		
		require_once('part/entete.php');
		require_once('part/menu.php');
		
		
	?>
	
	
	
	
	<div id="body">
		<h2>Changer mon mot de passe</h2>
		<form 
			method ="POST" 
			action="traitement.php">
			<p>Entrez votre mot de passe actuel: 
						<input 
							type="password" 
							name="mdp_ancien" 
							id="mdp_ancien" /></p>
			<p>Entrez votre <b class='alert'>nouveau</b> mot de passe: 
						<input 
							type="password" 
							name="nouveau_mdp" 
							id="nouveau_mdp" /></p>
			<p><b class='alert'>Confirmez le nouveau</b> mot de passe: 
						<input 
							type="password" 
							name="mdp_confirm" 
							id="mdp_confirm" /></p>
			<p><input 
					type="submit" 
					name="changer_mdp" 
					value="Changer mot de passe" />
		</form>
	</div>
	
	
	<div id="body">
		<h2>Mettre/Modifier ma photo</h2>
		
		<form 
			method ="POST" 
			action="traitement.php" 
			enctype="multipart/form-data">
		<p>Où se trouve la photo ? <input 
										type="file" 
										name="photo" /></p>
		<input 
			type="submit" 
			value="ajouter la photo" 
			name='ajout_photo' />
		</form>
	</div>
	
	
	<?php /*
	<div id="body">
		<h2>Supprimer ma photo</h2>
		
		<h3 class='alert'>Espace en construction</h3>
		</form>
	</div>
	
	
	
	
	
	<div id="body">
		<h2>Changer l'apparence de mon application</h2>
		<h3 class='alert'>Espace en construction</h3>
	</div>
	
	
	<div id="body">
	</div>
	
	
	<div id="body">
	</div> */ 
		require('part/footer.php');
	?>
</body>
</html>



<?php
		}
	else{	
		// Si on est connecté mais qu'on n'est ni administrateur, 
		// ni prof ni sg de l'application, 
		// la page ne doit pas s'afficher.
	/* Ceci a été conçu dans le but d'empêcher que quelqu'un 
	réussisse à se connecter à la BD
	et pense qu'il a accès à tous les espaces. 
	*/
		echo $erreur_admin;
		}
