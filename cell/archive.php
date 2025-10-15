<?php
	session_start();
	require_once('../inc/connect.inc.php');
	
	$config = new config($db);
	
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
	<title>Archives</title>
	
	<script>
			function findName(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('certif').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "archive/certifListe.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('oldYear');
				oldYear = sel.options[sel.selectedIndex].value;
				xhr.send("oldYear="+oldYear);
			}
			
			
			function findClasse(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('liste').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "archive/listeEleve.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('oldYear');
				oldYear = sel.options[sel.selectedIndex].value;
				xhr.send("oldYear="+oldYear);
			}
			
			
			function findEleve(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leinput = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('resultat').innerHTML = leinput;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "archive/findEleve.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('eleve');
				eleve = sel.value;
				xhr.send("eleve="+eleve);
			}
		
			function listeEleve(){
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
				xhr.open("POST", "archive/ajaxListeEleve.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('section');
				section = sel.options[sel.selectedIndex].value;
				xhr.send("section="+section);
			}
			function findButtonEleve(){
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
				xhr.open("POST", "archive/boutonEleve.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
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
		<h1>archives</h1>
		<ul>
			<li><h3><a href="archive.php?choix=<?php echo sha1('certif');?>#body2">Certificat de scolarité</a></h3></li>
			<li><h3><a href="archive.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></h3></li>
			<li><h3><a href="archive.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></h3></li>
			<li><h3><a href="archive.php?choix=<?php echo sha1('relNote'); ?>#body2">Bulletin Séquentiel</a></h3></li>
			<li><h3><a href="archive.php?choix=<?php echo sha1('listePP'); ?>#body2">Bulletin Trimestriel</a></h3></li>
			<li><h3><a href="archive.php?choix=<?php echo sha1('conseil'); ?>#body2">Bulletin Annuel</a></h3></li>
		</ul>
	</div>
		<?php 
		if(isset($_GET['choix'])){
			$choix = urldecode($_GET['choix']);
			echo "<div id='body2'>";
				if($choix==sha1('certif')){
					require_once('archive/certif.php');
				}elseif($choix==sha1('listeEleve')){
					require_once('archive/listeEleve.php');
				}elseif($choix==sha1('vueEff')){
					require_once('archive/vueEff.php');
				}elseif($choix==sha1('relNote')){
					require_once('archive/relNote.php');
				}elseif($choix==sha1('listePP')){
					require_once('archive/listePP.php');
				}elseif($choix==sha1('conseil')){
					require_once('archive/conseil.php');
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
