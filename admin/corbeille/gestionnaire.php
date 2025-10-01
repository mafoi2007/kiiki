<h1>Corbeille des gestionnaires</h1>

<table border='1' width='100%'>
	<tr>
		<th>Nom du gest.</th>
		<th>Option 1</th>
		<th>Option 2</th>
	</tr>
	
<?php
	/* Ce code nécessite un petit commentaire : la classe modèle permet d'appeler la liste des gestionnaire en prenant 
	deux paramètres : le poste et l'état. Ici on ne veut que l'état inactif mais tous les postes. Alors on les appelle
	chacun dans son array, on les inclue dans un grand array que j'appelle ici liste et on parcours le tableau en prenant
	soin d'éliminer les élèments vides du tableau qui ne nous servent alors à rien. */
	
	$admin = $gestionnaire->listeGestionnaire('admin','inactif');
	$censeur = $gestionnaire->listeGestionnaire('censeur','inactif');
	$sg = $gestionnaire->listeGestionnaire('sg','inactif');
	$prof = $gestionnaire->listeGestionnaire('prof','inactif');
	$liste = array(
		"admin" => $admin,
		"censeur" => $censeur,
		"sg" => $sg,
		"prof" =>$prof);
	
	
	foreach($liste as $cle=>$element) {
		if(count($element)!=0) {
			foreach($element as $code=>$valeur) {
				
				echo "<tr>";
					echo "<td> ".strtoupper($valeur['nom'])." ".ucwords($valeur['prenom'])."</td>";
					echo "<td> <a href='".$_SERVER['PHP_SELF']."?choix=".sha1('rest')."&amp;id=".$valeur['id']."'>Restaurer</a></td>";
					echo "<td> <a href='".$_SERVER['PHP_SELF']."?choix=".sha1('dest')."&amp;id=".$valeur['id']."'>Supprimer Définitivement</a></td>";
				echo "</tr>";
			}
			
		}
		else {
			echo "<tr>";
				echo "<th colspan='6'> Aucun ".strtoupper($cle)." dans la corbeille.</th>";
			echo "</tr>";
		}
	}
	
?>
</table>


