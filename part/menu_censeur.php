<div id='menu'>
	<div id='sous_menu'>
		<h3><a href='<?php echo $serveur; ?>censeur/etat.php'>états</a></h3>
		<ul>
			<li><a href="etat.php?choix=<?php echo sha1('certif');?>#body2">Certificat de scolarité</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('relNote'); ?>#body2">Relevé de Notes des Enseignants</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('listePP'); ?>#body2">Liste des Professeurs Principaux</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('conseil'); ?>#body2">Conseil de classe</a></li>
		</ul>
	</div>
	
	
	<div id='sous_menu'>
		<h3><a href='<?php echo $serveur; ?>censeur/note.php'>Gestion des Notes</a></h3>
		<ul>
			<li><a href='note.php?choix=<?php echo sha1('addnt');?>#body2'>Saisie des Notes</a></li>
			<li><a href='note.php?choix=<?php echo sha1('cpnt');?>#body2'>Copie des Notes</a></li>
			<li><a href='note.php?choix=<?php echo sha1('delnt');?>#body2'>Suppression des Notes</a></li>
			<li><a href='note.php?choix=<?php echo sha1('statnt');?>#body2'>Statistique des Notes</a></li>
		</ul>
	</div>
	
	
	<div id='sous_menu'>
		<h3><a href='http://<?php echo $serveur; ?>/censeur/journal.php'>Journal des Connexions</a></h3>
	</div>
</div>