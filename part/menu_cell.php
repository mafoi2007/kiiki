<div id="menu">
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/etat.php">états</a></h3>
		<ul>
			<li><a href="etat.php?choix=<?php echo sha1('certif');?>#body2">Certificat de scolarité</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('relNote'); ?>#body2">Relevé de Notes des Enseignants</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('listePP'); ?>#body2">Liste des Professeurs Principaux</a></li>
			<li><a href="etat.php?choix=<?php echo sha1('conseil'); ?>#body2">Conseil de classe</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/journaux.php">Journal de Connexion</a></h3>
		<ul>
			<li><a href="journaux.php?choix=<?php echo sha1('allJournal'); ?>#body2">Journal des enseignants</a></li>
			<li><a href="journaux.php?choix=<?php echo sha1('myJournal'); ?>#body2">mon journal</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/mdp.php">mots de passe</a></h3>
		<ul>
			<li><a href="mdp.php?choix=<?php echo sha1('allpwd'); ?>#body2">Mot de passe enseignant</a></li>
			<li><a href="mdp.php?choix=<?php echo sha1('mypwd'); ?>#body2">Mon mot de passe</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/param_gen.php">paramètres généraux</a></h3>
		<ul>
			<li><a href="param_gen.php?choix=<?php echo sha1('eleve'); ?>#body2">élève</a></li>
			<li><a href="param_gen.php?choix=<?php echo sha1('classe'); ?>#body2">classe</a></li>
			<li><a href="param_gen.php?choix=<?php echo sha1('matiere'); ?>#body2">matière</a></li>
			<li><a href="param_gen.php?choix=<?php echo sha1('sequence'); ?>#body2">période</a></li>
			<li><a href="param_gen.php?choix=<?php echo sha1('enseignant'); ?>#body2">enseignant</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/photo.php">photos</a></h3>
		<ul>
			<li><a href="photo.php?choix=<?php echo sha1('addPicture'); ?>#body2">ajout des photos</a></li>
			<li><a href="photo.php?choix=<?php echo sha1('viewPicture'); ?>#body2">consultation des photos</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/note.php">Gestion des Notes</a></h3>
		<ul>
			<li><a href="note.php?choix=<?php echo sha1('viewnt'); ?>#body2">Vue globale des Notes Séquentielles</a></li>
			<li><a href="note.php?choix=<?php echo sha1('adntac'); ?>#body2">Attribuer une note académique à la classe</a></li>
			<li><a href="note.php?choix=<?php echo sha1('revendic'); ?>#body2">Révendications Séquentielles</a></li>
		</ul>
	</div> 
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/traitement_seq.php">traitements séquentiels</a></h3>
		<ul>
			
			<li><a href="traitement_seq.php?choix=<?php echo sha1('viewNoteAll'); ?>#body2">Rapport séquentiel des notes</a></li>
			<li><a href="traitement_seq.php?choix=<?php echo sha1('traitNote'); ?>#body2">traitement des notes</a></li>
			<li><a href="traitement_seq.php?choix=<?php echo sha1('traitMoy'); ?>#body2">traitement des moyennes</a></li>
		</ul>
	</div>
	
	
	
	
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/traitement_trim.php">traitements trimestriels</a></h3>
		<ul>
			<?php /*<li><a href="traitement_trim.php?choix=<?php echo sha1('etatRempl'); ?>#body2">état de remplissage</a></li> */?>
			<li><a href="traitement_trim.php?choix=<?php echo sha1('viewNote'); ?>#body2">visualisation des notes</a></li>
			<li><a href="traitement_trim.php?choix=<?php echo sha1('viewNoteAll'); ?>#body2">Recapitulatif des notes</a></li>
			<li><a href="traitement_trim.php?choix=<?php echo sha1('traitNote'); ?>#body2">traitement des notes</a></li>
			<li><a href="traitement_trim.php?choix=<?php echo sha1('traitMoy'); ?>#body2">traitement des moyennes</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/traitement_ann.php">traitements annuels</a></h3>
		<ul>
			<li><a href="traitement_ann.php?choix=<?php echo sha1('traitNote'); ?>#body2">traitement des notes</a></li>
			<li><a href="traitement_ann.php?choix=<?php echo sha1('traitMoy'); ?>#body2">traitement des moyennes</a></li>
			<li><a href="traitement_ann.php?choix=<?php echo sha1('viewNoteAll'); ?>#body2">Recapitulatif des Notes</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/bulletin.php">bulletins</a></h3>
		<ul>
			<li><a href="bulletin.php?choix=<?php echo sha1('bullSeq'); ?>#body2">bulletin séquentiel</a></li>
			<li><a href="bulletin.php?choix=<?php echo sha1('bullTrim'); ?>#body2">bulletin trimestriel</a></li>
			<li><a href="bulletin.php?choix=<?php echo sha1('bullAnn'); ?>#body2">bulletin annuel</a></li>
			<li><a href="bulletin.php?choix=<?php echo sha1('rapSeq'); ?>#body2">Rapport Séquentiel</a></li>
			<li><a href="bulletin.php?choix=<?php echo sha1('rapTrim'); ?>#body2">Rapport Trimestriel</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/exportation.php">exportation Excel</a></h3>
		<ul>
			<li><a href="exportation.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></li>
			<li><a href="exportation.php?choix=<?php echo sha1('listeEleveAll');?>#body2">Liste Globale des élèves</a></li>
			<li><a href="exportation.php?choix=<?php echo sha1('notesAnnuelles');?>#body2">Notes Annuelles</a></li>
		</ul>
	</div>
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/archive.php">archives</a></h3>
		<ul>
			<li><a href="archive.php?choix=<?php echo sha1('certif');?>#body2">Certificat de scolarité</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('relNote'); ?>#body2">Relevé de Notes des Enseignants</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('listePP'); ?>#body2">Liste des Professeurs Principaux</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('conseil'); ?>#body2">Conseil de classe</a></li>
		</ul>
	</div>


	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/revendication.php">Révendications Séquentielles</a></h3>
		<ul>
			<li><a href="archive.php?choix=<?php echo sha1('certif');?>#body2">Certificat de scolarité</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('listeEleve');?>#body2">Liste des élèves</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('vueEff'); ?>#body2">Vue d'ensemble des effectifs</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('relNote'); ?>#body2">Relevé de Notes des Enseignants</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('listePP'); ?>#body2">Liste des Professeurs Principaux</a></li>
			<li><a href="archive.php?choix=<?php echo sha1('conseil'); ?>#body2">Conseil de classe</a></li>
		</ul>
	</div>
	
	
	<div id="sous_menu">
		<h3><a href="<?php echo $serveur?>cell/close.php">cloturer l'année</a></h3>
	</div>
	
	
</div>
