<?php
	require('../inc/connect.inc.php');
	session_start();
	
	$config = new config();
	$gestionnaire = new gestionnaire();
	if($_SESSION['message']){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
	if($_SESSION['poste']=='admin')
		{
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	<link rel ="shortcut icon" type="image/x-icon" href="../images/banniere.png" />
	<link type="text/javascript" src="../javascript/js.js" />
	<title>Paramétrage des saisies</title>
</head>

<body>
	<?php
		require('../part/entete.php');
		
		require('../part/menu.php');
	?>
	
	<div id="body">
		
		<ul>
			<li>
				<h3>
					<a href="conseil.php?choix=<?php echo sha1('addmatcls'); ?>" 
						title="Affecter une matière à une classe">
							Affecter une matière à une classe
					</a>
				</h3>
			</li>
			
			<li>
				<h3>
					<a href="conseil.php?choix=<?php echo sha1('addprofcls'); ?>" 
						title="Atribuer un enseignant à une matière">
							Affecter un enseignant à une classe
					</a>
				</h3>
			</li>
			
			<li>
				<h3>
					<a href="conseil.php?choix=<?php echo sha1('addpp'); ?>" 
						title="Désigner le titulaire de la classe">
							Désigner un professeur principal
					</a>
				</h3>
			</li>
			
			<li>
				<h3>
					<a href="conseil.php?choix=<?php echo sha1('viewcc'); ?>" 
						title="Ajouter une ou plusieurs classes à l'établissement">
							Consulter le conseil de classe
					</a>
				</h3>
			</li>
			
			<li>
				<h3>
					<a href="conseil.php?choix=<?php echo sha1('viewpp'); ?>" 
						title="Ajouter une ou plusieurs classes à l'établissement">
							Consulter les professeurs principaux
					</a>
				</h3>
			</li>
			
			<li>
				<h3>
					<a href="conseil.php?choix=<?php echo sha1('relnt'); ?>" 
						title="Ajouter une ou plusieurs classes à l'établissement">
							Relevé de Notes
					</a>
				</h3>
			</li>
			
			
			
			
		</ul>
	</div>
	
	
	<div id="body">
	<?php
		/*ON A FAIT UN CHOIX SUR LA GESTION DES CLASSES: 
		SOIT ON VEUT AJOUTER(FORMULAIRE D'AJOUT),
		SOIT ON VEUT SUPPR*/
		if(isset($_GET['choix'])){ //  
			
	
			if($_GET['choix']==sha1('addmatcls')){
				include('conseil/addmatcls.php');
			}
			elseif($_GET['choix']==sha1('addprofcls')){
				include('conseil/addprofcls.php');
			}
			elseif($_GET['choix']==sha1('addpp')){
				include('conseil/addpp.php');
			}
			elseif($_GET['choix']==sha1('viewcc')){
				include('conseil/viewcc.php');
			}
			elseif($_GET['choix']==sha1('viewpp')){
				include('conseil/viewpp.php');
			}
			/*elseif($_GET['choix']==sha1('viewprof')){
				include('conseil/viewprof.php');
			}*/
			elseif($_GET['choix']==sha1('relnt')){
				include('conseil/relnt.php');
			}
			else {
				echo "<h3 class='alert'>Désolé, l'application ne prend
					pas en charge votre choix.</h3>";
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
		}
	/*Si on est connecté mais qu'on n'est pas administrateur de l'application, 
	la page ne doit pas s'afficher.
	Ceci a été conçu dans le but d'empêcher que quelqu'un réussisse à se connecter
	à la BD et pense qu'il a accès à tous les espaces.
	Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant*/
	else{
		echo $erreur_admin;
	}	