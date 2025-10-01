<div id="menu">
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>chef/etat.php">états</a></h3>
		<ul>
			<li><a href="etat.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('listePP'); ?>#body2">Liste des Professeurs Principaux</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('conseil'); ?>#body2">Conseil de classe</a></li>
		</ul>
	</div>
	
	
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>chef/note.php">Gestion des Notes</a></h3>
		<ul>
			<li><a href="note.php?choix=<?php echo sha1('viewNoteSeq'); ?>#body2">Vue globale des Notes Séquentielles</a></li>
			<li><a href="note.php?choix=<?php echo sha1('viewNoteTrim'); ?>#body2">Recapitulatif des notes Trimestrielles</a></li>
			<li><a href="note.php?choix=<?php echo sha1('viewNoteAnn'); ?>#body2">Recapitulatif des Notes Annuelles</a></li>
		</ul>
	</div>
	
</div>
