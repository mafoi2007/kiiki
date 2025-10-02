<?php
	$page = $config->pageEnCours();
	$base = $serveur.$_SESSION['user']['userPost'];
?>
<header>
	<div id='titre'>
		<h1><?php echo appName.' '.appVersion.'  '.appSlogan; ?></h1>
		<h3>
			Année Scolaire Activée : 
				<font color='blue'><?php echo $_SESSION['information']['annee_scolaire']; ?>
				</font>
		</h3>
	</div>
	<div id='utilisateur'>
		<h3>Nom : <?php echo $_SESSION['user']['nom']; ?></h3>
		<h3>Poste : <?php echo $_SESSION['user']['libellePoste']; ?></h3>
	</div>
	<nav>
		<ul>
			<li><h3>Etablissement : 
				<font color='red'>
					<?php echo utf8_decode($_SESSION['information']['nom_etablissement_fr']);?> /
					<i>
					<?php echo utf8_decode($_SESSION['information']['nom_etablissement_en']);?>
					</i>
				</font>
			</h3></li>
		</ul>
	</nav>
</header>