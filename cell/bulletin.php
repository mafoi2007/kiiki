<?php
	session_start();
	require_once('../inc/connect.inc.php');
	// require_once('../inc/fonction.inc.php');
	
	/*$smarty->assign('poste', $_SESSION['poste']);
	$smarty->assign('login', $_SESSION['login']);
	$smarty->display('index.tpl');*/
	$config = new config($db);
	$note = new Note($db);
	$gestionnaire = new gestionnaire($db);
	// echo '<pre>'; print_r($_SESSION); echo '</pre>';
	
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
	<title><?php echo $_SESSION['user']['nom_complet_enseignant']; ?>: Bulletins</title>
		<script>
			function goBullSeq(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('sekence').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "bulletin/ajaxBullSeq.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
			}
			
			
			
			
			function goRapSeq(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('sekence').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "bulletin/rapSeq.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
			}
			
			
			
			
			
			
			function goRapTrim(){
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
				xhr.open("POST", "bulletin/rapTrim.ajax.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
			}
			
			
			
			
			function goBullTrim(){
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
				xhr.open("POST", "bulletin/ajaxBullTrim.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Classe par exemple
				sel = document.getElementById('classe');
				classe = sel.options[sel.selectedIndex].value;
				xhr.send("classe="+classe);
			}
			
			
			
			
			
			function goTabTrim(){
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
				xhr.open("POST", "bulletin/ajaxTabTrim.php", true);
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
		require_once('../part/entete.php');
		// require_once('../part/nav.php');
		require_once('../part/menu.php');
	?>
	
	
	<div id="body">
		<h1>Bulletins</h1>
		<ul>
			<?php /*<li><h3><a 
				href="bulletin.php?choix=<?php echo sha1('etatRempl'); ?>#body2">
				Etat de remplissage</a></h3></li> */ ?>
			<li><h3><a 
				href="bulletin.php?choix=<?php echo sha1('bullSeq'); ?>#body2">
				Bulletin Séquentiel</a></h3></li>
			<li><h3><a 
				href="bulletin.php?choix=<?php echo sha1('bullTrim'); ?>#body2">
				Bulletin Trimestriel</a></h3></li>
			
			<li><h3><a 
				href="bulletin.php?choix=<?php echo sha1('bullAnn'); ?>#body2">
				Bulletin Annuel</a></h3></li>
			<li><h3><a 
				href="bulletin.php?choix=<?php echo sha1('rapSeq'); ?>#body2">
				Rapport Séquentiel</a></h3></li>
			<li><h3><a 
				href="bulletin.php?choix=<?php echo sha1('rapTrim'); ?>#body2">
				Rapport Trimestriel</a></h3></li>
		</ul>
	</div>
	
	
	<div id="body2">
	<?php
		if(isset($_GET['choix'])){ // ON A FAIT UN CHOIX 
			if($_GET['choix']==sha1('bullSeq')){
				include_once('bulletin/bullSeq.php');
			}elseif($_GET['choix']==sha1('bullTrim')){
				include_once('bulletin/bullTrim.php');
			}elseif($_GET['choix']==sha1('bullAnn')){
				include_once('bulletin/bullAnn.php');
			}elseif($_GET['choix']==sha1('tabTrim')){
				include_once('bulletin/tabTrim.php');
			}elseif($_GET['choix']==sha1('tabAnn')){
				include_once('bulletin/tabAnn.php');
			}elseif($_GET['choix']==sha1('rapSeq')){
				include_once('bulletin/rapSeq.php');
			}elseif($_GET['choix']==sha1('rapTrim')){
				include_once('bulletin/rapTrim.php');
			}else{
				echo "<h3 class='alert'>L'application ne prend pas en charge 
				votre choix.</h3>";
			}
			
		}
	?>
	
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
