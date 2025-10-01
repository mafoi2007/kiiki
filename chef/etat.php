<?php
	session_start();
	require_once('../inc/connect.inc.php');
	// require_once('../inc/fonction.inc.php');
	
	/*$smarty->assign('poste', $_SESSION['poste']);
	$smarty->assign('login', $_SESSION['login']);
	$smarty->display('index.tpl');*/
	$config = new config($db);
	
	$gestionnaire = new gestionnaire($db);
	
	if(isset($_SESSION['message'])){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}unset($_SESSION['message']);
	if($_SESSION['poste']=='chef') { 
		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/homme.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Etats</title>
</head>

<body>
	<?php
		require_once('../part/entete.php');
		// require_once('../part/nav.php');
		require_once('../part/menu.php');
	?>
	
	<div id="body">
		<h1>états</h1>
		<ul>
			<li><h3><a href="etat.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></h3></li>
			<li><h3><a href="etat.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></h3></li>
			<li><h3><a href="etat.php?choix=<?php echo sha1('listePP'); ?>#body2">Liste des Professeurs Principaux</a></h3></li>
			<li><h3><a href="etat.php?choix=<?php echo sha1('conseil'); ?>#body2">Conseil de classe</a></h3></li>
		</ul>
	</div>
		<?php 
		if(isset($_GET['choix'])){
			$choix = urldecode($_GET['choix']);
			echo "<div id='body2'>";
				if($choix==sha1('certif')){
					require_once('etat/certif.php');
				}elseif($choix==sha1('listeEleve')){
					require_once('etat/listeEleve.php');
				}elseif($choix==sha1('vueEff')){
					require_once('etat/vueEff.php');
				}elseif($choix==sha1('relNote')){
					require_once('etat/relNote.php');
				}elseif($choix==sha1('listePP')){
					require_once('etat/listePP.php');
				}elseif($choix==sha1('conseil')){
					require_once('etat/conseil.php');
				}else{
					echo "<h3 class='alert' align='center'>Choix Non Valide.</h3>";
				}
			echo "</div>";
		}
		?>
	
	
	
	<?php
		require_once('../part/footer.php');
		 
		
	?>
</body>
</html>



<?php
	}
	else{
		header('Location:../index.php');
	}
