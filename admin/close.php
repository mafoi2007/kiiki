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
	?>
	
	
	<div id="body">
		<h3 class='alert'>Espace en Construction</h3>
		<form method='post' action='../traitement.php'>
			<p>Voulez - vous cloturer l'année scolaire 
			<font class='alert'><?php echo $_SESSION['as']; ?></font>
			<input type='hidden' name='endYear' value='<?php echo $_SESSION['as'];?>' />
			et ouvrir l'année scolaire 
			<select name='newYear'>
				<?php 
				// $date = DATE('Y')-4;
				for($date=DATE('Y')-1;$date<DATE('Y')+2;$date++){
					$cls = $date + 1;
					echo '<option value="'.$date.'/'.$cls.'">'.$date.'/'.$cls.'</option>';
				}
				
				?>
				<option selected value=''>---</option>
			</select>
			 pour le compte du 
			 <font class='alert'><?php echo $_SESSION['ets']; ?></font>
			 ? 
			
			<input type='submit' name='closeYear' value='Oui' />
			<input type='submit' name='closeYear' value='Non' /></p>
		</form>
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

