<h1>Corbeille des classes</h1>

<table border='1' width='100%'>
	<tr>
		<th>Nom de la Classe</th>
		<th>code de la classe</th>
		<th>Option 1</th>
		<th>Option 2</th>
	</tr>
	
<?php
	$liste = $classe->listeClasseAll('inactif');
	
	/* Il faut prévoir le cas où la corbeille est vide */
	if(!empty($liste)) {
		for($a=1;$a<=count($liste);$a++) {
			echo "<tr>";
				echo "<td>".$liste[$a]['nom_classe']."</td>";
				echo "<td>".$liste[$a]['code_classe']."</td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?choix=".sha1('rest')."&amp;id=".$liste[$a]['id']."'>Restaurer</a></td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?choix=".sha1('dest')."&amp;id=".$liste[$a]['id']."'>Supprimer</a></td>";
			echo "</tr>";
		}
	}
	else {
		echo "<tr>";
			echo "<th colspan='5'>Aucune classe dans la corbeille.</th>";
		echo "</tr>";
	}
	
	
?>
</table>