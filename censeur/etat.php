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
	if($_SESSION['user']['userPost']=='censeur'){ 
		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/homme.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<script>
		function recapMatiere(){
			var xhr = getXhr()
			// On définit ce qu'on va faire quand on aura la reponse 
			xhr.onreadystatechange = function(){
				// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
				if(xhr.readyState==4 && xhr.status==200){
					leselect = xhr.responseText;
					// On se sert de l'innerHTML pour rajouter les options à la liste
					document.getElementById('trimestre').innerHTML = leselect;
				}
			}
			// Ici on va voir comment faire du POST
			xhr.open("POST", "etat/statmatiere.ajax.php", true);
			// Ne pas oublier xa pour le POST 
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			// Ne pas oublier de poster les arguments 
			// C'est-à-dire l'id de la Classe par exemple
			sel = document.getElementById('matiere');
			matiere = sel.options[sel.selectedIndex].value;
			xhr.send("matiere="+matiere);
		}
	</script>
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
	</div>
		<?php 
		if(isset($_GET['choix'])){
			$lien = 'etat/'.urldecode($_GET['choix']).'.php';
			if($lien){
				require_once($lien);
			}else{
				echo "<h3 class='alert' align='center'>Choix Non Valide.</h3>";
			}
			/*echo $lien;
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
			echo "</div>";*/
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
