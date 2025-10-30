<?php
	session_start();
	require_once('../inc/connect.inc.php');
	
	$config = new config($db);
	$note = new Note($db);
	$gestionnaire = new gestionnaire($db);
	
	if(isset($_SESSION['message'])){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}unset($_SESSION['message']);
	if($_SESSION['user']['userPost']=='cell') { 
		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/homme.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Journal des Connexions</title>
	<script>
			function journalAll(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('resultat').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "journaux/allJournal.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Region par exemple
				sel = document.getElementById('enseignant');
				enseignant = sel.options[sel.selectedIndex].value;
				xhr.send("enseignant="+enseignant);
			}
	</script>
</head>

<body>
	<?php
		require_once('../part/entete.php');
		// require_once('../part/nav.php');
		require_once('../part/menu.php');
	?>
	
	<div id="body">
		
	
		<h1>Journal de Connexion</h1>
		<ul>
			<li><h3><a href="journaux.php?choix=<?php echo sha1('allJournal'); ?>#body2">Journal des enseignants</a></h3></li>
			<li><h3><a href="journaux.php?choix=<?php echo sha1('myJournal'); ?>#body2">Mon journal</a></h3></li>
		</ul>
	</div>
		<?php 
		if(isset($_GET['choix'])){
			$choix = urldecode($_GET['choix']);
			echo "<div id='body2'>";
				if($choix==sha1('allJournal')){
					require_once('journaux/allJournal.php');
				}elseif($choix==sha1('myJournal')){
					require_once('journaux/myJournal.php');
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
