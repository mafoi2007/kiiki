<h1>Liste des Matières enregistrées</h1>
	
	
	<table border='1' width='70%' align='center'>
		<tr>
			<th>N°</th>
			<th>Nom</th>
			<th>Code</th>
		</tr>
	<?php
		$liste = $config->listeMatiereAll('actif');
		$a = 1;
		if(empty($liste)){
			echo "<tr>
				<th colspan='3' class='alert'>Aucune matière enregistrée</th>
			</tr>";
		}
		else{
			for($i=0;$i<count($liste);$i++) {
				echo "<tr align='center'>";
					echo "<td> ".$a." </td>";
					echo "<td> ".ucwords($liste[$i]['nom_matiere'])." </td>";
					echo "<td> ".$liste[$i]['code_matiere']." </td>";
				echo "</tr>";
				$a++;
			}
		}
	?>
	</table>
	
	
	
	
	
