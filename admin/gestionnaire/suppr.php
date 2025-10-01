<h1>Supprimer un gestionnaire</h1>

<?php 
	if(isset($_GET['id']))	 {
		$utilisateur = urldecode($_GET['id']);
		$gestionnaire->supprimerGestionnaire($utilisateur);
	}
?>

	
	<hr />
	<h2>Administrateur(s)</h2>
	<?php
		$admin = $gestionnaire->listeGestionnaire('admin', 'actif');
		for($a=1;$a<=count($admin);$a++) {
			echo "<p><b>Nom : ".$admin[$a]['sexe']." ".strtoupper($admin[$a]['nom'])." ".ucwords($admin[$a]['prenom'])."</b> 
			&nbsp; | &nbsp; <a href='".$_SERVER['PHP_SELF']."?choix=".sha1('suppr')."&amp;id=".$admin[$a]['id']."'>Supprimer</a></p>";
		}
		
	?>
	<hr />
	
	
	
	
	
	
	
	
	
	
	<hr />
	<h2>Censeur(s)</h2>
	<?php
		$censeur = $gestionnaire->listeGestionnaire('censeur', 'actif');
		for($a=1;$a<=count($censeur);$a++) {
			echo "<p><b>Nom : ".$censeur[$a]['sexe']." ".strtoupper($censeur[$a]['nom'])." ".ucwords($censeur[$a]['prenom'])."</b> 
			&nbsp; | &nbsp; <a href='".$_SERVER['PHP_SELF']."?choix=".sha1('suppr')."&amp;id=".$censeur[$a]['id']."'>Supprimer</a></p>";
		}
		
	?>
	<hr />
	
	
	
	
	
	
	
	
	
	
	<hr />
	<h2>Surveillant(s) Général(aux)</h2>
	<?php
		$sg = $gestionnaire->listeGestionnaire('sg', 'actif');
		for($a=1;$a<=count($sg);$a++) {
			echo "<p><b>Nom : ".$sg[$a]['sexe']." ".strtoupper($sg[$a]['nom'])." ".ucwords($sg[$a]['prenom'])."</b> 
			&nbsp; | &nbsp; <a href='".$_SERVER['PHP_SELF']."?choix=".sha1('suppr')."&amp;id=".$sg[$a]['id']."'>Supprimer</a></p>";
		}
		
	?>
	<hr />
	
	
	
	
	
	
	
	<hr />
	<h2>Professeur(s)</h2>
	<?php
		$prof = $gestionnaire->listeGestionnaire('prof', 'actif');
		for($a=1;$a<=count($prof);$a++) {
			echo "<p><b>Nom : ".$prof[$a]['sexe']." ".strtoupper($prof[$a]['nom'])." ".ucwords($prof[$a]['prenom'])."</b> 
			&nbsp; | &nbsp; <a href='".$_SERVER['PHP_SELF']."?choix=".sha1('suppr')."&amp;id=".$prof[$a]['id']."'>Supprimer</a></p>";
		}
		
	?>
	<hr />
	
