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
	if($_SESSION['poste']=='cell') { 
		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/homme.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Paramètres Généraux</title>
	<script>
		function goPrepa(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('sequence').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "param_gen/ajaxPrepaListe.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('anneeDepart');
				anneeDepart = sel.options[sel.selectedIndex].value;
				xhr.send("anneeDepart="+anneeDepart);
			}
			
			
		function addClasse(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('niveau_classe').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "param_gen/ajaxAddClasse.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('section');
				section = sel.options[sel.selectedIndex].value;
				xhr.send("section="+section);
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
		<h1>paramètres généraux</h1>
		<ul>
			<li><h3><a href="param_gen.php?choix=<?php echo sha1('eleve'); ?>#body2">élève</a></h3></li>
			<li><h3><a href="param_gen.php?choix=<?php echo sha1('classe'); ?>#body2">classe</a></h3></li>
			<li><h3><a href="param_gen.php?choix=<?php echo sha1('matiere'); ?>#body2">matière</a></h3></li>
			<li><h3><a href="param_gen.php?choix=<?php echo sha1('sequence'); ?>#body2">période</a></h3></li>
			<li><h3><a href="param_gen.php?choix=<?php echo sha1('enseignant'); ?>#body2">enseignant</a></h3></li>
		</ul>
	</div>
		<?php 
		if(isset($_GET['choix'])){
			$choix = urldecode($_GET['choix']);
			echo "<div id='body2'>";
				if($choix==sha1('eleve')){
					require_once('param_gen/eleve.php');
				}elseif($choix==sha1('classe')){
					require_once('param_gen/classe.php');
				}elseif($choix==sha1('matiere')){
					require_once('param_gen/matiere.php');
				}elseif($choix==sha1('sequence')){
					require_once('param_gen/periode.php');
				}elseif($choix==sha1('enseignant')){
					require_once('param_gen/enseignant.php');
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
