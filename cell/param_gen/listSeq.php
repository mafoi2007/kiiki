<h1 id='body3'>Consulter les Périodes</h1>

		<table border='1' width='85%'>
			<tr>
				<th>Nom de la Période</th>
				<th>Date d'ouverture</th>
				<th>Date de Cloture</th>
			</tr>
	<?php 
			$periodeSequentielle = $config->viewPeriode();
			for($a=0;$a<count($periodeSequentielle);$a++) {
				echo "<tr>\n";
					echo "<td>".$periodeSequentielle[$a]['nom_periode']."</td>\n";
					echo "<td>".$periodeSequentielle[$a]['ouverture']."</td>\n";
					echo "<td>".$periodeSequentielle[$a]['fermeture']."</td>\n";
				echo "</tr>\n";
			}
	?>
		</table>
	