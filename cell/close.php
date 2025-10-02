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
	<title>Cloturer l'Année Scolaire</title>
	<script>
			function go(){
				var xhr = getXhr()
				// On définit ce qu'on va faire quand on aura la reponse 
				xhr.onreadystatechange = function(){
					// On ne fait klk choz que si on a tt rxu et ke le serveur est ok
					if(xhr.readyState==4 && xhr.status==200){
						leselect = xhr.responseText;
						// On se sert de l'innerHTML pour rajouter les options à la liste
						document.getElementById('departement').innerHTML = leselect;
					}
				}
				// Ici on va voir comment faire du POST
				xhr.open("POST", "ajaxJournaux.php", true);
				// Ne pas oublier xa pour le POST 
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				// Ne pas oublier de poster les arguments 
				// C'est-à-dire l'id de la Region par exemple
				sel = document.getElementById('region');
				region = sel.options[sel.selectedIndex].value;
				xhr.send("region="+region);
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
		<h1>Cloturer l'année Scolaire</h1>
		<h3 class='alert'>Espace en Construction</h3>
		<form method='post' action='../traitement.php' target='_blank'>
			<p>Voulez - vous cloturer l'année scolaire 
			<font class='alert'><?php echo $_SESSION['as']; ?></font>
			<input type='hidden' name='endYear' value='<?php echo $_SESSION['as'];?>' />
			et ouvrir l'année scolaire 
			<select name='newYear'>
				<?php 
				// $date = DATE('Y')-4;
				for($date=DATE('Y')-1;$date<DATE('Y')+2;$date++){
					$cls = $date + 1;
					echo '<option value="'.$date.'/'.$cls.'">'.$date.'/'.$cls.'</option>';
				}
				
				?>
				<option selected value=''>---</option>
			</select>
			 pour le compte du 
			 <font class='alert'><?php echo $_SESSION['ets']; ?></font>
			 ? 
			
			<input type='submit' name='closeYear' value='Oui' />
			<input type='submit' name='closeYear' value='Non' /></p>
		</form>
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
