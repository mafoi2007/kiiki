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
	<title>Journal des Connexions</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		require('../part/menu.php');
		$journal = $config->journalConnexion($_SESSION['login']);
		// echo '<pre>';print_r($journal);echo '</pre>';
	?>
	
	<div id="body">
		<h1>Journal des Connexions</h1>
		<pre><?php /*echo print_r($_SESSION);*/ ?></pre>
		<?php echo $journal[0]['sexe'];
		echo ' '.strtoupper($journal[0]['nom']);
		echo ' '.ucwords($journal[0]['prenom']);?>
		<table border='1' width='50%' align='center'>
			<tr>
				<th>N°</th>
				<th>Date</th>
				<th>Heure</th>
				<th>Poste</th>
			</tr>
			<?php 
			$a = 1;
			for($i=0;$i<count($journal);$i++){
				echo "<tr>
					<td align='center'>".$a."</td>
					<td>".$journal[$i]['jour']."</td>
					<td>".$journal[$i]['heure']."</td>
					<td>".$journal[$i]['adresse_ip']."</td>
				</tr>";
				$a++;
			}
			?>
		</table>
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
	Un admin ne peut être qu'admin et un enseignant 
	ne peut être qu'un enseignant*/
	else{
		echo $erreur_admin;
	}	