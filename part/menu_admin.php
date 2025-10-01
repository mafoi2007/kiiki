<div id="menu">
	
	<div id="sous_menu">
		<h3><a href='<?php echo $serveur?>admin/config.php'>configuration Générale</a></h3>
		<ul>
			<li><a href='config.php?cat=eleve'>élève</a></li>
			<li><a href='config.php?cat=classe'>classe</a></li>
			<li><a href='config.php?cat=matiere'>matière</a></li>
			<li><a href='config.php?cat=gestionnaire'>enseignant</a></li>
			<li><a href='config.php?cat=autre'>période</a></li>
			<li><a href='config.php?cat=conseil'>Parametrage de la classe</a></li>
		</ul>
		
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>admin/note.php">Gestion des Notes</a></h3>
		<ul>
			
			<li><a href="note.php?choix=<?php echo sha1('addnt'); ?>">Saisie des Notes</a></li>
			<li><a href="note.php?choix=<?php echo sha1('cpnt'); ?>">Copie des Notes</a></li>
			<li><a href="note.php?choix=<?php echo sha1('delnt'); ?>">Suppression des Notes</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/traitementnote.php">Traitement des Notes</a></h3>
		<ul>
			<li><a href='traitementnote.php?choix=<?php echo sha1('etatRempl');?>'>Etat de Remplissage  des Notes Séquentielles</a></li>
			<li><a href='traitementnote.php?choix=<?php echo sha1('viewntseq');?>'>Visualisation des Notes Séquentielles</a></li>
			<li><a href='traitementnote.php?choix=<?php echo sha1('traitnttrim');?>'>Traitements trimestriels des notes</a></li>
			<li><a href='traitementnote.php?choix=<?php echo sha1('traitmoytrim');?>'>traitements trimestriels des moyennes</a></li>
			
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/traitementannuel.php">Traitements Annuels</a></h3>
		<ul>
			<li><a href='traitementannuel.php?choix=<?php echo sha1('traitntann');?>'>traitements annuels des notes</a></li>
			<li><a href='traitementannuel.php?choix=<?php echo sha1('traitmoyann');?>'>traitements annuels des moyennes</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/bulletin.php">Bulletins</a></h3>
		<ul>
			<li><a href='bulletin.php?choix=<?php echo sha1('bulltrim');?>#body2'>Bulletins trimestriels</a></li>
			<li><a href='bulletin.php?choix=<?php echo sha1('bullann');?>#body2'>Bulletins annuels</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/statistique.php">Statistiques</a></h3>
		<ul>
			<li><a href='statistique.php?choix=statnot'>Statistiques des notes</a></li>
			<li><a href='statistique.php?choix=statmoy'>Statistique des moyennes</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/journal.php">Journal des Connexions</a></h3>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/etat.php">états</a></h3>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/close.php">Cloturer l'année</a></h3>
	</div>
	
</div>
