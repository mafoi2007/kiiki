<div id="menu">
	
	<div id="sous_menu">
		<h3><a href='<?php echo $serveur?>admin/config.php'>Entrée de Caisse</a></h3>
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
		<h3><a href="<?php echo $serveur?>admin/note.php">Sortie de Caisse</a></h3>
		<ul>
			
			<li><a href="note.php?choix=<?php echo sha1('addnt'); ?>">Saisie des Notes</a></li>
			<li><a href="note.php?choix=<?php echo sha1('cpnt'); ?>">Copie des Notes</a></li>
			<li><a href="note.php?choix=<?php echo sha1('delnt'); ?>">Suppression des Notes</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur; ?>admin/traitementnote.php">Etats</a></h3>
		<ul>
			<li><a href='traitementnote.php?choix=<?php echo sha1('etatRempl');?>'>Etat de Remplissage  des Notes Séquentielles</a></li>
			<li><a href='traitementnote.php?choix=<?php echo sha1('viewntseq');?>'>Visualisation des Notes Séquentielles</a></li>
			<li><a href='traitementnote.php?choix=<?php echo sha1('traitnttrim');?>'>Traitements trimestriels des notes</a></li>
			<li><a href='traitementnote.php?choix=<?php echo sha1('traitmoytrim');?>'>traitements trimestriels des moyennes</a></li>
			
		</ul>
	</div>
	
</div>
