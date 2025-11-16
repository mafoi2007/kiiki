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
	if($_SESSION['user']['userPost']=='cell')
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
	<title><?php echo $_SESSION['user']['nom_complet_enseignant'];?> : Traitements Trimestriels</title>
	<script>
			function goView(){
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
				xhr.open("POST", "traitement_trim/ajaxViewNt.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('clas');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("clas="+clas);
			}
			
			
			
			function goAdd(){
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
				xhr.open("POST", "note/ajaxAddnt.php", true);
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
				xhr.open("POST", "traitement_trim/ajaxTraitNt.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
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
				xhr.open("POST", "traitement_trim/ajaxTraitMoy.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
			}
			
			
			
			
			
			
			
			function goViewAll(){
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
				xhr.open("POST", "traitement_trim/ajaxViewNoteAll.php", true);
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
		<h1>Traitements Trimestriels</h1>
		<ul>
			<?php /*<li><h3><a 
				href="traitement_trim.php?choix=<?php echo sha1('etatRempl'); ?>#body2">
				Etat de remplissage</a></h3></li> 
			<li><h3><a 
				href="traitement_trim.php?choix=<?php echo sha1('viewNote'); ?>#body2">
				Visualisation des Notes</a></h3></li>
			
			<li><h3><a 
				href="traitement_trim.php?choix=<?php echo sha1('viewNoteAll'); ?>#body2">
				Recapitulatif des Notes</a></h3></li> */ ?>
			<li><h3><a 
				href="traitement_trim.php?choix=<?php echo sha1('traitNote'); ?>#body2">
				Traitement des Notes</a></h3></li>
			<li><h3><a 
				href="traitement_trim.php?choix=<?php echo sha1('traitMoy'); ?>#body2">
				Traitement des Moyennes</a></h3></li>
		</ul>
	</div>
	
	
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){ // ON A FAIT UN CHOIX 
			if($_GET['choix']==sha1('etatRempl')){
				include_once('traitement_trim/etatRempl.php');
			}elseif($_GET['choix']==sha1('viewNote')){
				include_once('traitement_trim/viewNote.php');
			}elseif($_GET['choix']==sha1('viewNoteAll')){
				include_once('traitement_trim/viewNoteAll.php');
			}elseif($_GET['choix']==sha1('traitNote')){
				include_once('traitement_trim/traitNote.php');
			}elseif($_GET['choix']==sha1('traitMoy')){
				include_once('traitement_trim/traitMoy.php');
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