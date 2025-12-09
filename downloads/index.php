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
	<title>Fichiers Téléchargés : </title>
</head>

<body>
	<?php
		require_once('../part/entete.php');
		// require_once('../part/nav.php');
		require_once('../part/menu.php');
	?>
	
	<div id="body">
		<h1>Fichiers téléchargés</h1>
	</div>
	<div id='body'>
		<table border='1' width='60%'>
			<tr>
				<th>Nom du Fichier</th>
				<th>Télécharger</th>
				<th>Supprimer</th>
			</tr>
			<?php 
			$dossiers = scandir(__dir__);
			$a = 1;
			foreach($dossiers as $fichier){
				echo "<tr>";
					if($fichier=='.' or $fichier=='..' or $fichier=='index.php'){
					}else{
						echo "<td>".$fichier."</td>
						<td><a href='".$fichier."'>Download</a></td>";
						echo "<td><a href='".$fichier."'>Delete</a></td>";
					}
				echo "</tr>";
			$a++;
			}
			?>
		</table>
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
