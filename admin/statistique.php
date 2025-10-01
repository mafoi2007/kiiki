<?php
	require('../inc/connect.inc.php');
	session_start();
	
	$config = new config($db);
	$gestionnaire = new gestionnaire($db);
	$note = new note($db);
	if($_SESSION['message']){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
	if($_SESSION['poste']=='admin')
		{
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Statistiques</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h2>Ce module a pour but de permettre le calcul des notes séquentielles, 
		trimestrielles et annuelles.</h2>
		<ul>			
			<li>
				<h3>
					<a 
					href='bulletin.php?choix=<?php echo sha1('bulltrim');?>#body2'>
							Bulletins trimestriels
					</a>
				</h3>
			</li>
			<li>
				<h3>
					<a 
					href='bulletin.php?choix=<?php echo sha1('bullann');?>#body2'>
							Bulletins Annuels
					</a>
				</h3>
			</li>
		</ul>
	</div>
	
	
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){   
			if($_GET['choix']==sha1('bulltrim')){
				require_once('bulletin/bulltrim.php');
			}
			elseif($_GET['choix']==sha1('bullann')){
				require_once('bulletin/bullann.php');
			}
			else{
				$_SESSION['message'] = 'Choix non pris en charge';
				header('Location:'.$_SERVER['PHP_SELF']);
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
	la page ne doit pas s'afficher. Ceci a été conçu dans le but d'empêcher
	que quelqu'un réussisse à se connecter à la BD et pense qu'il a accès à 
	tous les espaces.
	Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant*/
	else{
		header('Location:index.php');
	}