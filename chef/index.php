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
	<title>Bienvenue <?php echo $_SESSION['login']; ?></title>
</head>

<body>
	<?php
		require_once('../part/entete.php');
		// require_once('../part/nav.php');
		require_once('../part/menu.php');
	?>
	
	<div id="body">
		<h1>Choisissez une action dans le menu</h1>
		<?php /*
		<ul>
			<li><a href='config.php'><h2>configuration générale</h2></a></li>
			<li><a href='note.php'><h2>Gestion des Notes</h2></a></li>
			<li><a href='traitementnote.php'><h2>Traitement des Notes</h2></a></li>
			<li><a href='traitementnotennuel.php'><h2>Traitements annuels</h2></a></li>
			<li><a href='bulletin.php'><h2>Bulletins</h2></a></li>
			<li><a href='statistique.php'><h2>Statistiques</h2></a></li>
			<li><a href='close.php'><h2>Cloturer l'année</h2></a></li>
		</ul> */ ?>
	</div>
	
	
	
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
