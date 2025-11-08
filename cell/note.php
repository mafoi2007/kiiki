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
	// print_r($_SESSION['user']);
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
			href="../images/logo.jpg" />
	<link type="text/javascript" 
			src="../javascript/js.js" />
	<title><?php echo $_SESSION['user']['nom_complet_enseignant'];?> : Gestion des Notes</title>
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
				xhr.open("POST", "note/viewnt.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
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
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
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
			
			

			function goListe(){
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
				xhr.open("POST", "note/revendic.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				clas = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+clas);
			}
			
			
			
	</script>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		<h1>Gestion des Notes</h1>
		
	</div>
	
	
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){ // ON A FAIT UN CHOIX 
			if($_GET['choix']==sha1('viewnt')){
				include_once('note/viewnt.php');
			}
			elseif($_GET['choix']==sha1('addnt')){
				include_once('note/addnt.php');
			}
			elseif($_GET['choix']==sha1('cpnt')){
				include_once('note/cpnt.php');
			}
			elseif($_GET['choix']==sha1('delnt')){
				include_once('note/delnt.php');
			}
			elseif($_GET['choix']==sha1('revendic')){
				include_once('note/revendic.php');
			}
			else{
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