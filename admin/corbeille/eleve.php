<h1>Corbeille des élèves</h1>

<table border='1' width='100%'>
	<tr>
		<th>Matricule</th>
		<th>Nom Complet</th>
		<th>Sexe</th>
		<th>Classe</th>
		<th>Statut</th>
		<th>Option 1</th>
		<th>Option 2</th>
	</tr>
	
<?php
	$liste = $eleve->listeEleveAll('supprime');
	
	/* Il faut prévoir le cas où la corbeille est vide */
	if(!empty($liste)) {
		for($a=1;$a<=count($liste);$a++) {
			echo "<tr>";
				echo "<td>".strtoupper($liste[$a]['matricule'])."</td>";
				echo "<td>".strtoupper($liste[$a]['nom'])." ".ucwords($liste[$a]['prenom'])."</td>";
				echo "<td>".$liste[$a]['sexe']."</td>";
				echo "<td>".ucwords($liste[$a]['nom_classe'])	."</td>";
				echo "<td>".$liste[$a]['statut']."</td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?choix=".sha1('rest')."&amp;id=".$liste[$a]['id']."'>Restaurer</a></td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?choix=".sha1('dest')."&amp;id=".$liste[$a]['id']."'>Supprimer</a></td>";
			echo "</tr>";
		}
	}
	else {
		echo "<tr>";
			echo "<th colspan='8'>Aucun élève dans la corbeille.</th>";
		echo "</tr>";
	}
	
	
?>
</table>