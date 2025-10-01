<div id='menu'>
	<div id='sous_menu'>
		<h3><a href='<?php echo $serveur; ?>sg/config.php'>Discipline</a></h3>
		<ul>
			<li><a href='config.php?choix=<?php echo sha1('addAbs');?>#body2'>Saisie des Absences</a></li>
			<li><a href='config.php?choix=<?php echo sha1('justAbs');?>#body2'>Justification d'Absence</a></li>
			<li><a href='config.php?choix=<?php echo sha1('viewAbs');?>#body2'>Consultation Absences</a></li>
			<li><a href='config.php?choix=<?php echo sha1('delAbs');?>#body2'>Supprimer Absences</a></li>
		</ul>
	</div>
	
	<div id='sous_menu'>
		<h3><a href='<?php echo $serveur; ?>sg/note.php'>Gestion des Notes</a></h3>
		<ul>
			<li><a href='note.php?choix=<?php echo sha1('addnt');?>#body2'>Saisie des Notes</a></li>
			<li><a href='note.php?choix=<?php echo sha1('cpnt');?>#body2'>Copie des Notes</a></li>
			<li><a href='note.php?choix=<?php echo sha1('delnt');?>#body2'>Suppression des Notes</a></li>
			<li><a href='note.php?choix=<?php echo sha1('statnt');?>#body2'>Statistique des Notes</a></li>
		</ul>
	</div>
	
	
	<div id='sous_menu'>
		<h3><a href='<?php echo $serveur; ?>sg/journal.php'>Journal des Connexions</a></h3>
	</div>
</div>