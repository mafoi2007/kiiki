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
	if($_SESSION['poste']=='sg')
		{
	
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" 
			content="text/html; charset=utf-8" />
	<link rel="stylesheet" 
			type="text/css" 
			href="../styles/style.css" />
	<link rel ="shortcut icon" 
			type="image/x-icon" 
			href="../images/homme.png" />
	<link type="text/javascript" 
			src="../javascript/js.js" />
	<title><?php echo $_SESSION['sexeUser'].' '.$_SESSION['nomUser'];?> : Traitements Trimestriels</title>
	<script>
			function goView(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('eleve').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "config/ajaxViewAbs.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
			
			
			
			function goJustif(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('eleve').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "config/ajaxJustAbs.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
			
			
			
			function goCp(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('matiere').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "note/ajaxCpnt.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
			
			
			
			
			function goCpSequence(){
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
				xhr.open("POST", "note/ajaxCpSequence.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('matiere');
				matiere = sel.options[sel.selectedIndex].value;
				xhr.send("matiere="+matiere);
			}
			
			
			
			
			
			
			function goDel(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('matiere').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "note/ajaxDelnt.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
			
			
			
			
			
			
			function goTraitNt(){
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
				xhr.open("POST", "config/ajaxTraitNt.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
			
			
			
			
			
			
			
			function goTraitMoy(){
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
				xhr.open("POST", "config/ajaxTraitMoy.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
	</script>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h1>discipline</h1>
		<ul>
			<?php /*<li><h3><a 
				href="config.php?choix=<?php echo sha1('etatRempl'); ?>#body2">
				Etat de remplissage</a></h3></li> */ ?>
			<li><h3><a 
				href="config.php?choix=<?php echo sha1('addAbs'); ?>#body2">
				Saisie des Absences</a></h3></li>
			
			<li><h3><a 
				href="config.php?choix=<?php echo sha1('justAbs'); ?>#body2">
				Justification d'Absence</a></h3></li>
			<li><h3><a 
				href="config.php?choix=<?php echo sha1('viewAbs'); ?>#body2">
				Consultation Absences</a></h3></li>
			<li><h3><a 
				href="config.php?choix=<?php echo sha1('delAbs'); ?>#body2">
				Supprimer Absences</a></h3></li>
		</ul>
	</div>
	
	
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){ // ON A FAIT UN CHOIX 
			if($_GET['choix']==sha1('addAbs')){
				include_once('config/addAbs.php');
			}elseif($_GET['choix']==sha1('justAbs')){
				include_once('config/justAbs.php');
			}elseif($_GET['choix']==sha1('viewAbs')){
				include_once('config/viewAbs.php');
			}elseif($_GET['choix']==sha1('delAbs')){
				include_once('config/delAbs.php');
			}else{
				echo "<h3 class='alert'>L'application ne prend pas en charge 
				votre choix.</h3>";
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
		}else{
			$_SESSION['message'] = 'Tentative de connexion non autorisée';
			header('Location:index.php');
		}
?>