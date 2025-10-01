<?php
	
	
	$utilisateur = $config->viewGestionnaireCourant($_SESSION['idUser']);
	$nomUtilisateur = strtoupper($utilisateur['nom']);
	$nomUtilisateur .= ' '.ucwords($utilisateur['prenom']);
	$posteUtilisateur = $utilisateur['poste'];
	$nomPoste = $config->getPoste($posteUtilisateur);
	$baseAdresse = $serveur.$posteUtilisateur.'/';
	$connexion = $config->derniereConnexion($_SESSION['login']);
	echo '<pre>';
		// print_r($connexion);
	echo '</pre>'; 
?>
	<header>
		<div id='titre'>
			<h1><?php echo $_SESSION['app_version'].' , ';
			echo $_SESSION['app_name']; ?></h1>
			<h3>Année Scolaire Activée : <font color='blue'><?php echo $_SESSION['as']?>
					</font></h3>
		</div>
		<div id='utilisateur'>
			<h3>Nom : <?php echo $nomUtilisateur; ?></h3>
			<h3>Poste : <?php echo $nomPoste['libelle_poste']; ?></h3>
			<p>Dernière Connexion : 
				le <b><?php echo $connexion['periode_fr'];?></b> à 
				   <b><?php echo $connexion['heure_fr'];?></b></p>
		</div>
		<nav>
			<ul>
				<li><h3>Etablissement : <font color='red'><?php echo utf8_decode($_SESSION['ets']);?>
						</font></h3></li>
				<?php 
					/*$menu = $config->chargerMenu($posteUtilisateur);
					// echo var_dump($menu);
					// echo '<pre>';print_r($menu);echo '</pre>';
					for($i=0;$i<count($menu);$i++){
						echo "<li><a href='";
						echo $baseAdresse.$menu[$i]['page_menu']."'>";
						echo $menu[$i]['libelle_menu']."</a></li>";
					}*/
				?>
			</ul>
		</nav>
	</header>
	