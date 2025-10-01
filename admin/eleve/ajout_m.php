<h2> J'ajoute plusieurs élèves.</h2>
<?php $eleve ->ajouterPlusieursEleves($_POST['ajout_plusieurs_eleves']); ?>
<h3>Le fichier d'élèves à importer, uniquement au format CSV, doit contenir les informations suivantes dans l'ordre : 
	<ul>
		<li>nom et prénom</li>
		<li>sexe(M ou F)</li>
		<li>Date de Naissance(au format AAAA-MM-JJ)</li>
		<li>Lieu de naissance</li>
		<li>Classe(6A pour Sixième A, etc.)</li>
		<li>statut(Red pour Redoublants ou Nv pour Nouveau)</li>
	</ul>

<h3 class='alert'>Espace en construction.</h3>

<form method='post' action='' enctype='multipart/form-data'>
	<input type='file' name='fichier' /><br />
	<input type='submit' name = 'ajout_plusieurs_eleves' value='Envoyer le fichier' />
</form>
<?php


?>
