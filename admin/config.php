<?php 
	require('../inc/connect.inc.php');
	session_start();
	
	$config = new config($db);
	$gestionnaire = new gestionnaire($db);
	if($_SESSION['message']){
		echo "<script>alert('".$_SESSION['message']."');</script>";
	}
	unset($_SESSION['message']);
	if($_SESSION['poste']=='admin'){
?>
<!DOCTYPE html>
<html>
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
	<title>Configuration</title>
</head>

<body>
	
	
</body>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


<body>
	<?php  
	require_once('../part/entete.php');
	require_once('../part/menu.php'); ?>
	<?php
		// require('../part/entete.php');
		
		// require('../part/menu.php');
		/*
	?>
	<article>
		<h1>Configuration Générale</h1>
		<aside>
			<ul>
			<?php 
				for($i=0;$i<count($sousMenu);$i++){
					echo "<li><a href='config.php?cat=";
					echo $sousMenu[$i]['categorie_sous_menu']."&amp;code=";
					echo $sousMenu[$i]['code_id']."'><h3>";
					echo ucwords($sousMenu[$i]['libelle_sous_menu_1']);
					echo "</h3></a></li>";				
				}
			*/?>
			</ul>
		</aside>
		<?php 
			/*
			$categorie = $_GET['cat'];
			$code = $_GET['code'];
			$sousMenu2 = $config->chargerSousMenu2($categorie);
			echo '<pre>';print_r($sousMenu2);echo '</pre>';
			if(isset($_GET['cat'])){
				echo "<article id='aside2'>";
					echo "<form method='get' action='".$_SERVER['PHP_SELF']."#body2'>";
						echo '<h3>Configuration de ';
						echo strtoupper($categorie).'</h3>';
						echo "<select name='choix'>";
						echo "<option value=''>-Faites un Choix-</option>";
						for($i=0;$i<count($sousMenu2);$i++){
							echo "<option 
										value='".$sousMenu2[$i]['choix']."'>";
									echo $sousMenu2[$i]['libelle_sous_menu_2'];
										echo "</option>";
						}
						echo "</select>";
						echo "<input type='submit' name='valider' value='ok' />";
					echo"</form>";
					
					
					
					
					
				echo "</article>";
			}
		
	</article>  */?>
	
	
	
	
	
	<div id="body">
		<h1>Configuration Générale</h1>
		<?php 
			/*echo '<pre>';print_r($_SERVER); echo '</pre>';*/
			if(isset($_GET['cat'])){
				// Sous Menu Eleve
				if($_GET['cat']=='eleve'){
					echo '<h2>Gestion des élèves</h2>';
					echo "<ul>
						<li><h3><a href='config.php?cat=eleve&choix=";
							echo sha1('ajoutstd')."#body2'>Ajouter un élève
							</a></h3></li>
						<li><h3><a href='config.php?cat=eleve&choix=";
							echo sha1('findstd')."#body2'>Rechercher un élève
							</a></h3></li>
						<li><h3><a href='config.php?cat=eleve&choix=";
							echo sha1('consultstd')."#body2'>Liste des Elèves
							</a></h3></li>
						<li><h3><a href='config.php?cat=eleve&choix=";
							echo sha1('vueEffectifstd')."#body2'>Vue 
							d'ensemble des Effectifs</a></h3></li>
						<li><h3><a href='config.php?cat=eleve&choix=";
							echo sha1('prepaListe')."#body2'>Préparer les listes
							</a></h3></li>
					</ul>";
				}
				// Sous Menu Classe
				elseif($_GET['cat']=='classe'){
					echo '<h2>Gestion des classes</h2>';
					echo "<ul>
						<li><h3><a href='config.php?cat=classe&choix=".sha1('ajoutcls')."#body2'>Ajouter une classe</a></h3></li>
						<li><h3><a href='config.php?cat=classe&choix=".sha1('consultcls')."#body2'>Consulter la liste des Classes</a></h3></li>
					</ul>";
				}
				// Sous Menu Matiere
				elseif($_GET['cat']=='matiere'){
					echo '<h2>Gestion des matières</h2>';
					echo "<ul>
						<li><h3><a href='config.php?cat=matiere&choix=".sha1('ajout')."#body2'>Ajouter une matière</a></h3></li>
						<li><h3><a href='config.php?cat=matiere&choix=".sha1('consult')."#body2'>Liste des Matières</a></h3></li>
					</ul>";
				}
				// Sous Menu Gestionnaire
				elseif($_GET['cat']=='gestionnaire'){
					echo '<h2>Gestion des enseignants</h2>';
					echo "<ul>
						<li><h3><a href='config.php?cat=gestionnaire&choix=".sha1('ajout')."#body2'>Ajouter un enseignant</a></h3></li>
						<li><h3><a href='config.php?cat=gestionnaire&choix=".sha1('consult')."#body2'>Liste des enseignants</a></h3></li>
						
					</ul>";
				}
				// Sous Menu Autre
				elseif($_GET['cat']=='autre'){
					echo '<h2>Gestion des périodes</h2>';
					echo "<ul>
						<li><h3><a href='config.php?cat=autre&choix=".sha1('ajout')."#body2'>Activer une séquence</a></h3></li>
						<li><h3><a href='config.php?cat=autre&choix=".sha1('maj')."#body2'>Verouiller une séquence</a></h3></li>
						<li><h3><a href='config.php?cat=autre&choix=".sha1('consult')."#body2'>Consulter les séquences</a></h3></li>
					</ul>";
				}
				// Sous Menu Conseil
				elseif($_GET['cat']=='conseil'){
					echo "<h2>Parametrage d'une classe</h2>";
					echo "<ul>
						<li><h3><a href='config.php?cat=conseil&choix=".sha1('addmatcls')."#body2'>Enregistrer une matière dans la classe</a></h3></li>
						<li><h3><a href='config.php?cat=conseil&choix=".sha1('addprofcls')."#body2'>Attribuer une matière à l'enseignant</a></h3></li>
						<li><h3><a href='config.php?cat=conseil&choix=".sha1('addpp')."#body2'>Désigner un professeur principal</a></h3></li>
						<li><h3><a href='config.php?cat=conseil&choix=".sha1('viewcc')."#body2'>Conseil de Classe</a></h3></li>
						<li><h3><a href='config.php?cat=conseil&choix=".sha1('viewpp')."#body2'>Liste des Professeurs Principaux</a></h3></li>
						<li><h3><a href='config.php?cat=conseil&choix=".sha1('relnt')."#body2'>Relevé de Notes de la Classe</a></h3></li>
					</ul>";
				}
			}
		?>
		
	</div>
	<div id="body2">
	<?php
	if(isset($_GET['cat']) and isset($_GET['choix'])){	
		$cat = urldecode($_GET['cat']);
		$choix = $_GET['choix'];
		switch($cat){
			case 'eleve':
			if($_GET['choix']==sha1('ajoutstd')){
				require_once('eleve/formAjout.php');
			}
			elseif($_GET['choix']==sha1('findstd')){
				require_once('eleve/find.php');
			}
			elseif($_GET['choix']==sha1('consultstd')){
				require_once('eleve/consult.php');
			}
			elseif($_GET['choix']==sha1('vueEffectifstd')){
				require_once('eleve/vueEff.php');
			}
			elseif($_GET['choix']==sha1('viewEleve')){
				require_once('eleve/viewEleve.php');
			}
			elseif($_GET['choix']==sha1('prepaListe')){
				require_once('eleve/prepaListe.php');
			}
			break;
			
			
			
			
			case 'classe':
			if($_GET['choix']==sha1('ajoutcls')){
				require_once('classe/formAjout.php');
			}
			elseif($_GET['choix']==sha1('consultcls')){
				require_once('classe/formConsult.php');
			}
			break;
			
			
			
			
			case 'matiere':
			if($_GET['choix']==sha1('ajout')){
				require_once('matiere/ajout.php');
			}
			elseif($_GET['choix']==sha1('consult')){
				require_once('matiere/consult.php');
			}
			break;
			
			
			
			
			case 'gestionnaire':
			if($_GET['choix']==sha1('ajout')){
				require_once('gestionnaire/ajout.php');
			}
			elseif($_GET['choix']==sha1('consult')){
				require_once('gestionnaire/consult.php');
			}
			elseif($_GET['choix']==sha1('maj')){
				require_once('gestionnaire/maj.php');
			}
			break;
			
			
			
			
			case 'autre':
			if($_GET['choix']==sha1('ajout')){
				require_once('autre/ajout.php');
			}
			elseif($_GET['choix']==sha1('consult')){
				require_once('autre/consult.php');
			}
			elseif($_GET['choix']==sha1('maj')){
				require_once('autre/maj.php');
			}
			break;
			
			
			
			
			case 'conseil':
			if($_GET['choix']==sha1('addmatcls')){
				require_once('conseil/addmatcls.php');
			}
			elseif($_GET['choix']==sha1('addprofcls')){
				require_once('conseil/addprofcls.php');
			}
			elseif($_GET['choix']==sha1('addpp')){
				require_once('conseil/addpp.php');
			}
			elseif($_GET['choix']==sha1('viewcc')){
				require_once('conseil/viewcc.php');
			}
			elseif($_GET['choix']==sha1('viewpp')){
				require_once('conseil/viewpp.php');
			}
			elseif($_GET['choix']==sha1('relnt')){
				require_once('conseil/relnt.php');
			}
			break;
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
	Ceci a été conçu dans le but d'empêcher que quelqu'un réussisse
	à se connecter à la BD et pense qu'il a accès à tous les espaces.
	Un admin ne peut être qu'admin et un enseignant ne peut être qu'un enseignant*/
	else{
		header('Location:index.php');
	}	