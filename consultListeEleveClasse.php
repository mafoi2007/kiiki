




<h2>Classe de <?php echo $affiche['classe']; ?></h2>

<table border ='1' width='100%'>
	<tr>
		<th>N°</th>
		<th>Noms et Prénoms</th>
		<th>Matricule</th>
		<th>Sexe</th>
		<th>Date de Naissance</th>
		<th>Lieu de naissance</th>
		<th>Statut</th>
	</tr>
	<?php
		for($i=1;$i<=count($affiche['nb']);$i++) {
			echo "<tr>\n";
				echo "<td>".$i."</td>\n";
				echo "<td>".$affiche[$i]['nom']."</td>\n";
				echo "<td>".$affiche[$i]['matricule']."</td>\n";
				echo "<td>".$affiche[$i]['sexe']."</td>\n";
				echo "<td>".$affiche[$i]['dnaissance']."</td>\n";
				echo "<td>".$affiche[$i]['lnaissance']."</td>\n";
				echo "<td>".$affiche[$i]['statut']."</td>\n";
			echo "</tr>\n";
		}
	?>	
</table>