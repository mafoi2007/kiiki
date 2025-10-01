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
	<title>Traitement des Notes</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h1>Traitement des Notes</h1>
		<h2>Ce module a pour but de permettre le calcul des notes séquentielles, 
		trimestrielles et annuelles.</h2>
		<ul>			
			<li>
				<h3>
					<a 
					href='traitementnote.php?choix=<?php echo sha1('etatRempl');?>#body2'
					title='On visualise les notes saisies'>
							Etat de Remplissage des Notes Séquentielles
					</a>
				</h3>
			</li>
			<li>
				<h3>
					<a 
					href='traitementnote.php?choix=<?php echo sha1('viewntseq');?>#body2'
					title='On visualise les notes saisies'>
							Visualisation des Notes Séquentielles
					</a>
				</h3>
			</li>
			<li>
				<h3>
					<a 
						href='traitementnote.php?choix=<?php echo sha1('traitnttrim');?>#body2'>
							Traitements trimestriels des notes
					</a>
				</h3>
			</li>
			<li>
				<h3>
					<a 
					href='traitementnote.php?choix=<?php echo sha1('traitmoytrim');?>#body2'>
							Traitements trimestriels des moyennes
					</a>
				</h3>
			</li>
		</ul>
	</div>
	
	
	<div id="body2">
	<?php
		/*ON VA GERER TROIS PRINCIPAUX TYPES DE NOTES:
		-->LES NOTES SEQ(Visualiser, Traiter les notes et générer les moyennes)
		-->LES NOTES TRIM(Visualiser, Traiter les notes et générer les moyennes)
		-->LES NOTES ANN(Visualiser, Traiter les notes et générer les moyennes)
		*/
		if(isset($_GET['choix'])){   
	
			if($_GET['choix']==sha1('viewntseq')){
				require_once('traitementnote/viewntseq.php');
			}
			/*elseif($_GET['choix']==sha1('traitntseq')){
				require_once('traitementnote/traitntseq.php');
			}*/
			/*elseif($_GET['choix']==sha1('traitmoyseq')){
				require_once('traitementnote/traitmoyseq.php');
			}*/
			/*elseif($_GET['choix']==sha1('viewnttrim')){
				require_once('traitementnote/viewnttrim.php');
			}*/
			elseif($_GET['choix']==sha1('traitnttrim')){
				require_once('traitementnote/traitnttrim.php');
			}
			elseif($_GET['choix']==sha1('etatRempl')){
				require_once('traitementnote/etatRempl.php');
			}
			elseif($_GET['choix']==sha1('traitmoytrim')){
				require_once('traitementnote/traitmoytrim.php');
			}
			elseif($_GET['choix']==sha1('viewntann')){
				// include_once('note/delnt.php');
			}
			elseif($_GET['choix']==sha1('traitntann')){
				// include_once('note/delnt.php');
			}
			elseif($_GET['choix']==sha1('traitmoyann')){
				// include_once('note/delnt.php');
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