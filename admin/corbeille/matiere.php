<h1>Corbeille des matières</h1>


<table border='1' width='100%'>
	<tr>
		<th>N°</th>
		<th>Nom Matière</th>
		<th>Option 1</th>
		<th>Option 2</th>
	</tr>
	
<?php
	$liste = $matiere->listeMatiereAll('inactif');
	
	/* Il faut prévoir le cas où la corbeille est vide */
	if(!empty($liste)) {
		for($a=1;$a<=count($liste);$a++) {
			echo "<tr>";
				echo "<td>".$a."</td>";
				echo "<td>".$liste[$a]['nom_matiere']."</td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?choix=".sha1('rest')."&amp;id=".$liste[$a]['id']."'>Restaurer</a></td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?choix=".sha1('dest')."&amp;id=".$liste[$a]['id']."'>Supprimer</a></td>";
			echo "</tr>";
		}
	}
	else {
		echo "<tr>";
			echo "<th colspan='5'>Aucune Matière dans la corbeille.</th>";
		echo "</tr>";
	}
	
	
?>
</table>



